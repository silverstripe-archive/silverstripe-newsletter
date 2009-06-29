<?php 
/**
 * Represents a type of newsletter, for example the weekly products update.
 * The NewsletterType is associated with a recipient list and a bunch of
 * Newsletter objects, which are each either Sent or Draft.
 * 
 * @package newsletter
 */
class NewsletterType extends DataObject {

	static $db = array(
		"Title" => "Varchar",
		"Template" => "Varchar",
    	"FromEmail" => "Varchar(100)",
    	"Sent" => "Datetime"
	);
	
	static $has_one = array(
		"Parent" => "SiteTree",
		"Group" => "Group",
	);
	
	static $has_many = array(
		"Newsletters" => "Newsletter",
	);
	
	static $many_many = array(
	);
	
	static $defaults = array(
	);
	
	function DraftNewsletters() {
		return DataObject::get("Newsletter","ParentID={$this->ID} AND Status ='Draft'");
	}
	
	function SentNewsletters() {
		return DataObject::get("Newsletter","ParentID={$this->ID} AND Status ='Send'");
	}
	
	function Recipients() {
		return DataObject::get("Member", "Group_Members.GroupID = {$this->GroupID}", "", "JOIN Group_Members on Group_Members.MemberID = Member.ID");
	}
	
	function delete() {
		if($this->Newsletters()) {
			foreach($this->Newsletters() as $newsletter) {
				$newsletter->destroy();
				$newsletter->delete();
			}
		}
			
		parent::delete();
	}

	/**
	 * Get the fieldset to display in the administration section
	 */
	function getCMSFields() {
		$groups = DataObject::get('Group', '', 'Sort');
		$groupsMap = ($groups) ? $groups->map('ID', 'Title') : array();
		
		$templateSource = singleton("NewsletterAdmin")->templateSource();
		
    	$fields = new FieldSet(
			new TabSet("Root",
				new Tab(_t('NewsletterAdmin.NLSETTINGS', 'Newsletter Settings'),
					new TextField("Title", _t('NewsletterAdmin.NEWSLTYPE', 'Newsletter Type')),
					new DropdownField('GroupID', _T('NewsletterAdmin.MAILINGGROUP', 'Mailing list group'), $groupsMap, '', null, _t('NewsletterAdmin.CHOOSEMAILINGGROUP', '(Choose mailing group)')),
					new TextField("FromEmail", _t('NewsletterAdmin.FROMEM', 'From email address')),
					new DropdownField("Template", _t('NewsletterAdmin.TEMPLATE', 'Template'), $templateSource)
				)
			)
		);
    	
		$this->extend('updateCMSFields', $fields);
		
		return $fields;    	
	}
    
}
?>