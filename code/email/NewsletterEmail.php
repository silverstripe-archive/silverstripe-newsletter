<?php

/**
 * Email object for sending newsletters.
 *
 * @package newsletter
 */
class NewsletterEmail extends Email {

	protected $type;
	protected $newsletter;
	
	static $casting = array(
		'Newsletter' => 'Newsletter',
		'UnsubscribeLink' => 'Text'
	);
	
	/**
	 * @param Newsletter $newsletter
	 * @param NewsletterType $type
	 */
	//TODO NewsletterType deprecated
	function __construct($newsletter, $type = null) {
		$this->newsletter = $newsletter;

		$this->nlType = $type ? $type : $newsletter->getNewsletterType();
		
		parent::__construct();
		
		$this->body = $newsletter->getContentBody();
		
		$this->populateTemplate(new ArrayData(array(
			'Newsletter' => $this->Newsletter,
			'UnsubscribeLink' => $this->UnsubscribeLink()
		)));
		
		if($this->body && $this->newsletter) {
		
			$text = $this->body->forTemplate();
			
			// find all the matches
			if(preg_match_all("/<a\s[^>]*href=\"([^\"]*)\"[^>]*>(.*)<\/a>/siU", $text, $matches)) {

				if(isset($matches[1]) && ($links = $matches[1])) {
					
					$titles = (isset($matches[2])) ? $matches[2] : array();
					$id = (int) $this->newsletter->ID;
					
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
					
					$this->body = $output;
				}
			}
		}
	}

	public function send($id = null) {
		$this->extend('onBeforeSend');
		parent::send($id);
	}

	/**
	 * @return Newsletter
	 */
	function Newsletter() {
		return $this->newsletter;
	}
	
	function UnsubscribeLink(){
		$emailAddr = $this->To();
		$member=DataObject::get_one("Member", "\"Email\" = '".$emailAddr."'"); 
		if($member){ 
			if($member->AutoLoginHash){ 
				$member->AutoLoginExpired = date('Y-m-d', time() + (86400 * 2)); 
				$member->write(); 
			}else{ 
				$member->generateAutologinHash(); 
			} 
			$nlTypeID = $this->nlType->ID; 
			return Director::absoluteBaseURL() . "unsubscribe/index/".$member->AutoLoginHash."/$nlTypeID"; 
		}else{
			return Director::absoluteBaseURL() . "unsubscribe/index/";
		}
	}
	
	function getData() {
		return $this->template_data;
	}
}