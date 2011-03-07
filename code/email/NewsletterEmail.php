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
	function __construct($newsletter, $type = null) {
		$this->newsletter = $newsletter;
		$this->nlType = $type ? $type : $newsletter->getNewsletterType();
		
		parent::__construct();
		
		$this->body = $newsletter->getContentBody();
		
		$this->populateTemplate(new ArrayData(array(
			'Newsletter' => $this->Newsletter,
			'UnsubscribeLink' => $this->UnsubscribeLink()
		)));
		
		$this->extend('updateNewsletterEmail', $this);
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