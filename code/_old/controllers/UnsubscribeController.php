<?php

/**
 * Create a form that a user can use to unsubscribe from a mailing list
 *
 * @package newsletter
 */
class UnsubscribeController extends Page_Controller {
	static public $days_unsubscribe_link_alive = 30;

	function __construct($data = null) {
		parent::__construct($data);
	}

	function init() {
		parent::init();
		Requirements::css('newsletter/css/SubscriptionPage.css');
		Requirements::javascript(THIRDPARTY_DIR . '/jquery/jquery.js');
		Requirements::javascript(THIRDPARTY_DIR . '/jquery-validate/jquery.validate.min.js');
	}

	static public function set_days_unsubscribe_link_alive($days){
		self::$days_unsubscribe_link_alive = $days;
	}

	static public function get_days_unsubscribe_link_alive(){
		return self::$days_unsubscribe_link_alive;
	}

	function RelativeLink($action = null) {
		return "unsubscribe/$action";
	}

	private function getRecipient(){
		$validateHash = Convert::raw2sql($this->urlParams['ValidateHash']);
		if($validateHash) {
			$recipient = DataObject::get_one('Recipient', "\"ValidateHash\" = '$validateHash'");
			$now = date('Y-m-d H:i:s');
			if($now <= $recipient->ValidateHashExpired) return $recipient;
		}
	}
	
	private function getMailingLists($recipient = null){
		$siteConfig = DataObject::get_one("SiteConfig");
		if($siteConfig->GlobalUnsubscribe){
			return $mailinglists = $recipient->MailingLists();
		}else{
			$mailinglistIDs = $this->urlParams['IDs'];
			if($mailinglistIDs) {
				return $mailinglists = DataList::create("MailingList")->where("\"ID\" in (".$mailinglistIDs.")");
			}
		}
	}

	private function getMailingListsByUnsubscribeRecords($recordIDs){
		$unsubscribeRecords = DataList::create("UnsubscribeRecord")->where("\"ID\" in (".$recordIDs.")");
		$mailinglists = new ArrayList();
		if($unsubscribeRecords->count()){
			foreach($unsubscribeRecords as $record){
				$list = DataObject::get_by_id("MailingList", $record->MailingListID);
				if($list && $list->exists()){
					$mailinglists->push($list);
				}
			}
		}
		return $mailinglists;
	}

	function index() {
		$recipient = $this->getRecipient();
		$mailinglists = $this->getMailingLists($recipient);
		if($recipient && $recipient->exists() && $mailinglists && $mailinglists->count()) {
			$unsubscribeRecordIDs = array();
			$this->unsubscribeFromLists($recipient, $mailinglists, $unsubscribeRecordIDs);
			$url = Director::absoluteBaseURL() . $this->RelativeLink('done') . "/" . $recipient->ValidateHash . "/" . implode(",", $unsubscribeRecordIDs);
			Director::redirect($url);
			return $url;
		}else{
			return $this->customise(array(
				'Title' => _t('Newsletter.INVALIDLINK', 'Invalid Link'),
				'Content' => _t('Newsletter.INVALIDUNSUBSCRIBECONTENT', 'This unsubscribe link is invalid')
			))->renderWith('Page');
		}
    }

	function done() {
		$unsubscribeRecordIDs = $this->urlParams['IDs'];
		$hash = $this->urlParams['ID'];
		if($unsubscribeRecordIDs){
			$fields = new FieldList(
				new HiddenField("UnsubscribeRecordIDs", "", $unsubscribeRecordIDs),
				new HiddenField("Hash", "", $hash),
				new LiteralField("ResubscribeText", "Click the \"Resubscribe\" if you unsubscribed by accident and want to re-subscribe")
			);

			$actions = new FieldList(
				new FormAction("resubscribe", "Resubscribe")
			);

			$form = new Form($this, "ResubscribeForm", $fields, $actions);
			$form->setFormAction($this->Link('resubscribe'));
			$mailinglists = $this->getMailingListsByUnsubscribeRecords($unsubscribeRecordIDs);

			if($mailinglists && $mailinglists->count()){
				$listTitles = "";
				foreach($mailinglists as $list) {
					$listTitles .= "<li>".$list->Title."</li>";
				}
				$recipient = $this->getRecipient();
				$title = $recipient->FirstName?$recipient->FirstName:$recipient->Email;
				$content = sprintf(
					_t('Newsletter.UNSUBSCRIBEFROMLISTSSUCCESS', '<h3>Thank you, %s.</h3><br />You will no longer receive: %s.'),
					$title, 
					"<ul>".$listTitles."</ul>"
				);
			}else{
				$content = 
					_t('Newsletter.UNSUBSCRIBESUCCESS', 'Thank you.<br />You have been unsubscribed successfully');
			}
		}

		return $this->customise(array(
			'Title' => _t('UNSUBSCRIBEDTITLE', 'Unsubscribed'),
			'Content' => $content,
			'Form' => $form
		))->renderWith('Page');
	}

   /**
    * Unsubscribe the user from the given lists.
    */
	function resubscribe() {
		if(isset($_POST['Hash']) && isset($_POST['UnsubscribeRecordIDs'])){
			$recipient = DataObject::get_one('Recipient', "\"ValidateHash\" = '".$_POST['Hash']."'");
			$mailinglists = $this->getMailingListsByUnsubscribeRecords($_POST['UnsubscribeRecordIDs']);
			if($recipient && $recipient->exists() && $mailinglists && $mailinglists->count()){
				$recipient->MailingLIsts()->addMany($mailinglists);
			}
			$url = Director::absoluteBaseURL() . $this->RelativeLink('undone') . "/" . $_POST['Hash']. "/" . $_POST['UnsubscribeRecordIDs'];
			Director::redirect($url);
			return $url;
		}else{
			return $this->customise(array(
				'Title' => _t('Newsletter.INVALIDRESUBSCRIBE', 'Invalid resubscrible'),
				'Content' => _t('Newsletter.INVALIDRESUBSCRIBECONTENT', 'This resubscribe link is invalid')
			))->renderWith('Page');
		}
	}

	function undone(){
		$recipient = $this->getRecipient();
		$mailinglists = $this->getMailingLists($recipient);

		if($mailinglists && $mailinglists->count()){
			$listTitles = "";
			foreach($mailinglists as $list) {
				$listTitles .= "<li>".$list->Title."</li>";
			}

			$title = $recipient->FirstName?$recipient->FirstName:$recipient->Email;
			$content = sprintf(
				_t('Newsletter.RESUBSCRIBEFROMLISTSSUCCESS', '<h3>Thank you. %s!</h3><br />You have been resubscribed to: %s.'),
				$title, 
				"<ul>".$listTitles."</ul>"
			);
		}else{
			$content = 
				_t('Newsletter.RESUBSCRIBESUCCESS', 'Thank you.<br />You have been resubscribed successfully');
		}

    	return $this->customise(array(
    		'Title' => _t('Newsletter.RESUBSCRIBED', 'Resubscribed'),
    		'Content' => $content,
    	))->renderWith('Page');
	}

	protected function unsubscribeFromLists($recipient, $lists, &$recordsIDs) {
		if($lists && $lists->count()){
			foreach($lists as $list){
				$recipient->Mailinglists()->remove($list);
				$unsubscribeRecord = new UnsubscribeRecord();
				$unsubscribeRecord->unsubscribe($recipient, $list);
				$recordsIDs[] = $unsubscribeRecord->ID;
			}
		}
    }
}
