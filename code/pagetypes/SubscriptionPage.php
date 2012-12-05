<?php

/**
 * Page type for creating a page that contains a form that visitors can
 * use to subscript to newsletters.
 * 
 * @package newsletter
 */

class SubscriptionPage extends Page {
	
	static $db = array(
		'Fields' => 'Text',
		'Required' => 'Text',
		'CustomisedHeading' => 'Text',
		'CustomisedLabels' => 'Text',
		'CustomisedErrors' => 'Text',
		'MailingLists' => 'Text',
		'SubmissionButtonText' => 'Varchar',
		'SendNotification' => 'Boolean',
		'NotificationEmailSubject' => 'Varchar',
		'NotificationEmailFrom' => 'Varchar',
		"OnCompleteMessage" => "HTMLText",
	);
	
	static $defaults = array(
		'Fields' => 'Email',
		'SubmissionButtonText' => 'Submit'
	);

	function getCMSFields() {
		$fields = parent::getCMSFields();
		$fields ->addFieldToTab("Root",
			$subscriptionTab = new Tab(
				_t('Newsletter.SUBSCRIPTIONFORM', 'SubscriptionForm')
			)
		);
		
		$subscriptionTab->push(
			new HeaderField(
				"SubscriptionFormConfig",
				_t('Newsletter.SUBSCRIPTIONFORMCONFIGURATION', "Subscription Form Configuration")
			)
		);
		
		$subscriptionTab->push(
			new TextField('CustomisedHeading', 'Heading at the top of the form')
		);

		//Fields selction
		$frontFields = singleton('Recipient')->getFrontendFields()->dataFields();

		$fieldCandidates = array();
		if(count($frontFields)){
			$exludes = array(
				"BouncedCount",
				"Blacklisted",
				"ReceivedCount",
				"ValidateHash",
				"ValidateHashExpired",
				"LanguagePreferred",
				"Archived"
			);
			foreach($frontFields as $fieldName => $dataField){
				if(!in_array($fieldName, $exludes))
				$fieldCandidates[$fieldName]= $dataField->Title()?$dataField->Title():$dataField->Name();
			}
		}



		//Since Email field is the Recipient's identifier,
		//and newsletters subscription is non-sence if no email is given by the user,
		//we should force that email to be checked and required.
		//FisrtName should be checked as default, though it might not be required
		$defaults = array("Email", "FirstName");
				
		$extra = array('CustomisedLabels'=>"Varchar","CustomisedErrors"=>"Varchar","Required" =>"Boolean");
		$extraValue = array(
			'CustomisedLabels'=>$this->CustomisedLabels,
			"CustomisedErrors"=>$this->CustomisedErrors,
			"Required" =>$this->Required
		);

		$subscriptionTab->push(
			$fieldsSelection = new CheckboxSetWithExtraField("Fields",
				"Select the fields to display on the subscription form",
				$fieldCandidates,
				$extra,
				$defaults,
				$extraValue
			)
		);

		$fieldsSelection->setCellDisabled(array("Email"=>array("Value","Required")));

		//Mailing Lists selection
		$mailinglists = MailingList::get()->filter(array('Disabled'=>false));
		$newsletterSelection = $mailinglists && $mailinglists->count()?
		new CheckboxSetField("MailingLists",
			"Newsletters to subscribe to",
			$mailinglists,
			$mailinglists
		):
		new LiteralField(
			"NoMailingList",
			'<p>You haven\'t defined any mailing list yet, please go to '
			. '<a href=\"admin/newsletter\">the newsletter administration area</a> '
			. 'to define a mailing list.</p>');
		$subscriptionTab->push(
			$newsletterSelection
		);
		
		$subscriptionTab->push(
			new TextField("SubmissionButtonText", "Submit Button Text")
		);
		
		$subscriptionTab->push(
			new ToggleCompositeField("SendNotificationToggle", "Send notification email to the subscriber?",
				new SelectionGroup("SendNotification", array(
					"0//no" => new CompositeField(),
					"1//yes" => new CompositeField(
						new TextField("NotificationEmailSubject", "Notification Email Subject Line:"),
						new TextField("NotificationEmailFrom", "From Email Address for Notification Email")
					))
				)
			)
		);
		
		$subscriptionTab->push(
			new HtmlEditorField('OnCompleteMessage', "Message shown on completion")
		);
		return $fields;
	}
	
	/**
	 * Email field is the member's identifier, and newsletters subscription is non-sense if no email is given 
	 * by the user, we should force that email to be checked and required.
	 */
	function getRequired(){
		return (!$this->getField('Required')) ? '{"Email":"1"}' : $this->getField('Required');
	}
}

/**
 * @package newsletter
 */
class SubscriptionPage_Controller extends Page_Controller {
	
	/**
	 * Load all the custom jquery needed to run the custom 
	 * validation 
	 */
	public function init() {
		parent::init();
		
		// block prototype validation
		//Validator::set_javascript_validation_handler('none');
		
		// load the jquery
		Requirements::javascript(THIRDPARTY_DIR . '/jquery/jquery.js');
		Requirements::javascript(THIRDPARTY_DIR . '/jquery-validate/jquery.validate.min.js');
	}
	
	function Form(){
		if($this->URLParams['Action'] == 'complete') return;
		$dataFields = singleton('Recipient')->getCMSFields()->dataFields();
		
		if($this->CustomisedLables) $customisedLables = Convert::json2array($this->CustomisedLables);

		$fields = array();
		if($this->Fields){
			$fields = explode(",",$this->Fields);
		}

		$memberInfoSection = new CompositeField();
		if(!empty($fields)){
			foreach($fields as $field){
				if(isset($dataFields[$field]) && $dataFields[$field]){
					if(isset($customisedLables[$field])){
						$dataFields[$field]->setTitle($customisedLables[$field]);
					}
					if(is_a($dataFields[$field], "ImageField")){
						$dataFields[$field] = new SimpleImageField(
							$dataFields[$field]->Name(), $dataFields[$field]->Title()
						);
					}
					$memberInfoSection->push($dataFields[$field]);
				}
			}
		}
		$formFields = new FieldList(
			new HeaderField("CustomisedHeading", $this->owner->CustomisedHeading),
			$memberInfoSection
		);
		$memberInfoSection->setID("MemberInfoSection");

		if($this->MailingLists){
			$mailinglists = DataObject::get("MailingList", "ID IN (".$this->MailingLists.")");
		}
		
		if(isset($mailinglists) && $mailinglists && $mailinglists->count()>1){
			$newsletterSection = new CompositeField(
				new LabelField("Newsletters", _t("SubscriptionPage.To", "Subscribe to:"), 4),
				new CheckboxSetField("NewsletterSelection","", $mailinglists, $mailinglists->getIDList())
			);
			$formFields->push($newsletterSection);
		}
		
		$buttonTitle = $this->SubmissionButtonText;
		$actions = new FieldList(
			new FormAction('doSubscribe', $buttonTitle)
		);
		
		$requiredFields = Convert::json2array($this->Required);
		if(!empty($requiredFields)) $required = new RequiredFields($requiredFields);
		else $required = null;
		$form = new Form($this, "Form", $formFields, $actions, $required);
		
		// using jQuery to customise the validation of the form
		$FormName = $form->FormName();
		$customisedErrors = Convert::json2array($this->CustomisedErrors);

		if(!empty($requiredFields)){
			$jsonRuleArray = array();
			$jsonMessageArray = array();
			foreach($requiredFields as $field => $true){
				if($true){
					if(isset($customisedErrors[$field]) && $customisedErrors[$field]) {
						$error = $customisedErrors[$field];
					}else{
						$label = isset($customisedLables[$field])?$customisedLables[$field]:$dataFields[$field]->Title();
						$error = "Please enter your $label field";
					}
					
					if($field === 'Email') {
						$jsonRuleArray[] = $field.":{required: true, email: true}";
						$message = <<<JSON
{
required: "<span class='exclamation'></span><span class='validation-bubble'>
$error<span></span></span>",
email: "<span class='exclamation'></span><span class='validation-bubble'>
Please enter a valid email address<span></span></span>"
}
JSON;
						$jsonMessageArray[] = $field.":$message";
					} else {
						$jsonRuleArray[] = $field.":{required: true}";
						$message = <<<HTML
<span class='exclamation'></span><span class='validation-bubble'>$error<span></span></span>
HTML;
						$jsonMessageArray[] = $field.":\"$message\"";
					}
				}
			}
			$rules = "{".implode(", ", $jsonRuleArray)."}";
			$messages = "{".implode(",", $jsonMessageArray)."}";
		}else{
			$rules = "{Email:{required: true, email: true}}";
			$messages = <<<JS
{Email: {
required: "<span class='exclamation'></span><span class='validation-bubble'>
Please enter your email address<span></span></span>",
email: "<span class='exclamation'></span><span class='validation-bubble'>
Please enter a valid email address<span></span></span>"
}}
JS;
		}

		// set the custom script for this form
		Requirements::customScript(<<<JS
(function($) {
	jQuery(document).ready(function() {
		$("#$FormName").validate({
			errorPlacement: function(error, element){
				error.insertAfter(element);
			},
			focusCleanup: true,
			messages: $messages,
			rules: $rules
		});
	});
})(jQuery);
JS
		);

		return $form;
	}
	
	/**
	 *  unsubscribes a $member from $newsletterType
	 *  	 
	 */	 	
	protected function removeUnsubscribe($newletterType,$member) {
		//TODO NewsletterType deprecated
		//TODO UnsubscribeRecord deprecated
		$result = DataObject::get_one("UnsubscribeRecord", "NewsletterTypeID = ".Convert::raw2sql($newletterType->ID)." AND MemberID = ".Convert::raw2sql($member->ID)."");
		if($result && $result->exists()) {
			$result->delete();
		}		
	}
	
	/**
	 * Subscribes a given email address to the {@link NewsletterType} associated
	 * with this page
	 *
	 * @param array
	 * @param Form
	 * @param SS_HTTPRequest
	 *
	 * @return Redirection
	 */
	function doSubscribe($data, $form, $request){
						
		//filter weird characters
		$data['Email'] = preg_replace("/[^a-zA-Z0-9\._\-@]/","",$data['Email']);		
		
		// check to see if member already exists
		$member = false; 
		
		if(isset($data['Email'])) {
			$member = DataObject::get_one('Recipient', "\"Email\" = '". Convert::raw2sql($data['Email']) . "'");
		}
		
		if(!$member) {
			$member = new Recipient();
		}
		
			
		$form->saveInto($member);
		$member->setField("Email", $data['Email']);		
		$member->write();
		
		if($member->ValidateHash){ 
			$member->ValidateHashExpired = date('Y-m-d', time() + (86400 * 2)); 
			$member->write(); 
		}else{ 
			$member->generateValidateHashAndStore(); 
		}
		
		$newsletters = array();
		
		if(isset($data["NewsletterSelection"])){
			foreach($data["NewsletterSelection"] as $n){
				$newsletterType = DataObject::get_by_id("NewsletterType", $n);
				
				if($newsletterType->exists()){
					//remove member from unsubscribe if needed
					$this->removeUnsubscribe($newsletterType,$member);
					
					$newsletters[] = $newsletterType;
					$groupID = $newsletterType->GroupID;
					$member->Groups()->add($groupID);
				}
			}
		} else {
			// if the page has associate with one newsletter type, it won't appear in front form, but the 
			// member needs to be added to the related group.
			
			if($this->MailingLists && ($types = explode(",",$this->MailingLists))) {
				foreach($types as $type){
					$newsletterType = DataObject::get_by_id("NewsletterType", $type);
					if($newsletterType->exists()){
						//remove member from unsubscribed records if the member unsubscribe the same mailling list before
						$this->removeUnsubscribe($newsletterType,$member);
						
						$newsletters[] = $newsletterType;
						$groupID = $newsletterType->GroupID;
						$member->Groups()->add($groupID);
					}	
				}
			}
			else {
				user_error('No Newsletter type selected to subscribe to', E_USER_WARNING);
			}
		}
		
		$memberInfoFields = $form->Fields()->fieldByName('MemberInfoSection')->FieldSet();
		$emailableFields = new FieldSet();
		if($memberInfoFields){
			foreach($memberInfoFields as $field){
				if(is_array($field->Value()) && is_a($field, 'SimpleImageField')){
					$funcName = $field->Name();
					$value = $member->$funcName()->CMSThumbnail()->Tag();
					$field->EmailalbeValue = $value;
				}else{
					$field->EmailalbeValue = $field->Value();
				}

				$emailableFields->push($field);
			}
		}
		$templateData = array(
			'FirstName' => $member->FirstName,
            'MemberInfoSection' => $emailableFields,
            'Newsletters' => new DataObjectSet( $newsletters ),
            'UnsubscribeLink' => Director::baseURL() . 'unsubscribe/index/' . $member->ValidateHash
        );

		if($this->SendNotification){
			$email = new Email();
			$email->setTo($member->Email);
			$from = $this->NotificationEmailFrom?$this->NotificationEmailFrom:Email::getAdminEmail();
	        $email->setFrom($from);
			$email->setTemplate('SubscriptionEmail'); 
	        $email->setSubject( $this->NotificationEmailSubject );

	        $email->populateTemplate( $templateData );
	        $email->send();
		}
		
		$url = $this->Link()."complete/".$member->ID;
		$this->redirect($url);
	}
	
	function complete(){
		if($id = $this->urlParams['ID']){
			$memberData = DataObject::get_by_id("Member", $id)->getAllFields();
		}
		return $this->customise(array(
    		'Title' => _t('SubscriptionCompleted.Title', 'Subscription completed!'),
    		'Content' => $this->customise($memberData)->renderWith('SubscribeSubmission'),
    	))->renderWith('Page');
	}
}
