<?php

class NewsletterSiteConfig extends DataExtension{
	function extraStatics($class = null, $extension = null) {
		return array(
			'db' => array(
				"DaysAfterWhichArchivedNewslettersDeleted" => "Int(90)", // if 0, never delete
				"DaysAfterWhichArchivedRecipientsDeleted" => "Int(90)", // if 0, never delete
				"GlobalUnsubscribe" => "Boolean",
			)
		);
	}

	public function updateCMSFields(FieldList $fields) {
		$fields->addFieldToTab("Root",
			new Tab(_t("Newsletter.Configuration", "NewsletterConfiguration"),
				new NumericField("DaysAfterWhichArchivedNewslettersDeleted", 
					_t("Newsletter.LabelNewslettersArchivedDeletionDays", "Number of days after which archived
					newsletters will be deleted")),
				new NumericField("DaysAfterWhichArchivedRecipientsDeleted", 
					_t("Newsletter.LabelRecipientsArchivedDeletionDays", "Number of days after which archived
					recipients will be deleted")),
				$globalUnsubscribe = new CheckboxField("GlobalUnsubscribe",
					_t("Newsletter.LabelGobalUnsubscribe", "Turned on globally unsubscribe?"))
			)
		);
		$globalUnsubscribeDescription = _t("Newsletter.GlobalUnsubscribeDescription",
			"Clicking any unsubscribe links in each newsletter will unsubscribe the recipient from all mailing lists 
			if checked<br />
			otherwise only unsubscribe the recipient from mailing lists that the newsletter related to"
		);
		$globalUnsubscribe->setDescription($globalUnsubscribeDescription);
	}

	/*public function populateDefaults(){
		if(!$this->owner->DaysAfterWhichArchivedNewslettersDeleted){
			$this->DaysAfterWhichArchivedNewslettersDeleted = 90;
		}

		if(!$this->owner->DaysAfterWhichArchivedRecipientsDeleted) {
			$this->DaysAfterWhichArchivedRecipientsDeleted =90;
		}
	}*/
}