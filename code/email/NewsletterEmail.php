<?php

/**
 * Email object for sending newsletters.
 *
 * @package newsletter
 */
class NewsletterEmail extends Email {

	protected $mailinglists;
	protected $newsletter;
	protected $recipient;
	protected $fakeRecipient;
	
	/**
	 * @param Newsletter $newsletter
	 * @param Mailinglists $recipient
	 * @param Boolean $fakeRecipient
	 */
	function __construct($newsletter, $recipient, $fakeRecipient=false) {
		$this->newsletter = $newsletter;
		$this->mailinglists = $newsletter->MailingLists();
		$this->recipient = $recipient;
		$this->fakeRecipient = $fakeRecipient;
		
		parent::__construct($this->newsletter->SendFrom, $this->recipient->Email);

		$this->populateTemplate(new ArrayData(array(
			'UnsubscribeLink' => $this->UnsubscribeLink(),
			'SiteConfig' => DataObject::get_one('SiteConfig'),
			'AbsoluteBaseURL' => Director::absoluteBaseURLWithAuth()
		)));
		
		$this->body = $newsletter->getContentBody();
		$this->subject = $newsletter->Subject;
		$this->ss_template = $newsletter->RenderTemplate;
		
		if($this->body && $this->newsletter) {
		
			$text = $this->body->forTemplate();

			//Recipient Fields ShortCode parsing
			$bodyViewer = new SSViewer_FromString($text);
			$text = $bodyViewer->process($this->templateData());
			
			// find all the matches
			if(!$this->fakeRecipient &&
					preg_match_all("/<a\s[^>]*href=\"([^\"]*)\"[^>]*>(.*)<\/a>/siU", $text, $matches)) {

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

						$tracked = DataObject::get_one('Newsletter_TrackedLink',
								"\"NewsletterID\" = '". $id . "' AND \"Original\" = '". $SQL_link ."'");
						
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
				}
			}
			// replace the body
			$output = new HTMLText();
			$output->setValue($text);
			$this->body = $output;
		}
	}

	public function send($id = null) {
		$this->extend('onBeforeSend');
		return parent::send($id);
	}

	/**
	 * @return Newsletter
	 */
	function Newsletter() {
		return $this->newsletter;
	}
	
	function UnsubscribeLink(){
		$listIDs = implode(",",$this->mailinglists->getIDList());
		if($this->recipient && !$this->fakeRecipient){ 
			if($this->recipient->ValidateHash){ 
				$this->recipient->ValidateHashExpired = date('Y-m-d H:i:s', time() + (86400 * 2)); 
				$this->recipient->write(); 
			}else{ 
				$this->recipient->generateValidateHashAndStore(); 
			} 
			return Director::absoluteBaseURL() . "unsubscribe/index/".$this->recipient->ValidateHash."/$listIDs"; 
		}else{
			return Director::absoluteBaseURL() . "unsubscribe/index/fackedvalidatehash/$listIDs";
		}
	}
	
	protected function templateData() {
		$default = array(
			"To" => $this->to,
			"Cc" => $this->cc,
			"Bcc" => $this->bcc,
			"From" => $this->from,
			"Subject" => $this->subject,
			"Body" => $this->body,
			"BaseURL" => $this->BaseURL(),
			"IsEmail" => true,
		);
		$default['Salutation'] = $this->recipient->Salutation;
		$default['FirstName'] = $this->recipient->FirstName;
		$default['MiddleName'] = $this->recipient->MiddleName;
		$default['Surname'] = $this->recipient->Surname;
		if($this->template_data) {
			return $this->template_data->customise($default);
		} else {
			return $this;
		}
	}

	public function getData() {
		return $this->templateData();
	}
}