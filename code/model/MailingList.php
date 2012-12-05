<?php

/**
 * Represents a specific containner of newsletter recipients 
 * 
 * @package newsletter
 */
class MailingList extends DataObject {

	/* the database fields */
	static $db = array(
		'Title'					=> "Varchar",
		'Disabled'				=> "Boolean",   //hide this mailing list from showing up in the Newsletter detail form
	);

	/* a mailing list could contains many newsletter recipients */
	static $many_many = array(
		'Recipients'			=> "Recipient",
	);

	static $belongs_many_many = array(
		'Newsletters'			=> "Newsletter",
	);

	//Only for statistics purpose, we keep a unsubscribed count field for each MailingList <=> Recipient peer.
	static $many_many_extraFields = array(
		"Recipients" => array(
			'UnsubscribeCounts'	=> "Int", // if 0, this recipient has naver unsubscribe from this mailing list.
		)
	);

	function getCMSFields() {
		$fields = new FieldList();
		$fields->push(new TabSet("Root", $mainTab = new Tab("Main")));
		$mainTab->setTitle(_t('SiteTree.TABMAIN', "Main"));

		$fields->addFieldToTab('Root.Main',
			new TextField('Title',_t('NewsletterAdmin.MailingListTitle','Mailing List Title')));
		$fields->addFieldToTab('Root.Main',new CheckboxField('Disabled',_t('NewsletterAdmin.Disabled','Disabled')));

		$gridFieldConfig = GridFieldConfig::create()->addComponents(
			new GridFieldToolbarHeader(),
			new GridFieldSortableHeader(),
			new GridFieldDataColumns(),
			new GridFieldFilterHeader(),
			new GridFieldDeleteAction(true),
			new GridFieldPaginator(30),
			new GridFieldEditButton(),
			new GridFieldAddNewButton(),
			new GridFieldDetailForm(),
			new GridFieldAddExistingAutocompleter('before',	array(
					'FirstName',
					'MiddleName',
					'Surname',
					'Email',
				)
			)
		);

		$recipientsGrid = GridField::create(
			'Recipients2',
			_t('NewsletterAdmin.Recipients', 'Mailing list recipients'),
			$this->Recipients(),
			$gridFieldConfig
		);


		$fields->addFieldToTab('Root.Main',new FieldGroup($recipientsGrid));
		$this->extend("updateCMSFields", $fields);		

		return $fields;
	}
}