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
		foreach( $this->Newsletters() as $newsletter )
			$newsletter->delete();
			
		parent::delete();
	}
	
	/** 
	 * Updates the group so the security section is also in sync with
	 * the curent newsletters.
	 */
	function onBeforeWrite() {
		if($this->ID){
			$group = $this->Group();
			if($group->Title != "$this->Title"){
			        $group->Title = _t('NewsletterType.MAILINGLIST', 'Mailing List:').' '. $this->Title;	
				// Otherwise the code would have mailing list in it too :-(
				$group->Code = SiteTree::generateURLSegment($this->Title);
				$group->write();
			}
		}
		parent::onBeforeWrite();
	}

	/**
	 * Get the fieldset to display in the administration section
	 */
	function getCMSFields() {
    	$fields = new FieldSet(
			new TabSet("Root",
				new Tab(_t('NewsletterAdmin.NLSETTINGS', 'Newsletter Settings'),
					new TextField("Title", _t('NewsletterAdmin.NEWSLTYPE','Newsletter Type')),
					new TextField("FromEmail", _t('NewsletterAdmin.FROMEM','From email address')),
					$templates = new TemplateList("Template", _t('NewsletterAdmin.TEMPLATE', 'Template'), $this->Template, NewsletterAdmin::template_path())
				)
			)
		);
    	
		$this->extend('updateCMSFields', $fields);
		
		return $fields;    	
	}
    
}

?>