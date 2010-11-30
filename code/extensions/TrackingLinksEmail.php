<?php

/**
 * Extension to the default {@link NewsletterEmail} which rewrites the body links inside <a>
 * tags to use the shorter tracking url {@link Newsletter_TrackedLink} instead.
 *
 * @todo Unit Tests
 *
 * @package newsletter
 */
class TrackingLinksEmail extends Extension {
	
	/**
	 * Rewrite the links
	 *
	 * @param NewsletterEmail
	 */
	function updateNewsletterEmail(&$email) {
		if(!$email->body || !$email->newsletter) return;
		
		$text = $email->body->forTemplate();
		
		// find all the matches
		if(preg_match_all("/<a\s[^>]*href=\"([^\"]*)\"[^>]*>(.*)<\/a>/siU", $text, $matches)) {

			if(isset($matches[1]) && ($links = $matches[1])) {
				
				$titles = (isset($matches[2])) ? $matches[2] : array();
				$id = (int) $email->newsletter->ID;
				
				$replacements = array();
				$current = array();
				
				// workaround as we want to match the longest urls (/foo/bar/baz) before /foo/
				array_unique($links);
				
				$sorted = array_combine($links, array_map('strlen', $links));
				arsort($sorted);

				foreach($sorted as $link => $length) {
					$SQL_link = Convert::raw2sql($link);

					$tracked = DataObject::get_one('Newsletter_TrackedLink', "\"NewsletterID\" = '". $id . "' AND \"Original\" = '". $SQL_link ."'");
					
					if(!$tracked) {
						// make one.
						
						$tracked = new Newsletter_TrackedLink();
						$tracked->Original = $link;
						$tracked->NewsletterID = $id;
						$tracked->write();
					}
					
					// replace the link
					$replacements[$link] = $tracked->Link();
					
					// track that this link is still active
					$current[] = $tracked->ID;
				}
				
				// replace the strings
				$text = str_ireplace(array_keys($replacements), array_values($replacements), $text);
				
				// replace the body
				$output = new HTMLText();
				$output->setValue($text);
				
				$email->body = $output;
			}
		}
	}
}