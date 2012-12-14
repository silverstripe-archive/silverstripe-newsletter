<?php
/**
 * Adding this class to a {@link GridFieldConfig} of a {@link GridField} adds a header title with a summary of the
 * Status of the contained records
 */
class GridFieldSummaryHeader implements GridField_HTMLProvider {
	public function getHTMLFragments( $gridField) {
		if ($gridField && $gridField->getModelClass() && $gridField->getModelClass() == "SendRecipientQueue") {
			$list = $gridField->getList();

			$statusText = '<span>'.$list->filter(array('Status'=>'Scheduled'))->count() .
					' Scheduled;</span>';
			$statusText.= ' <span>'.$list->filter(array('Status'=>'InProgress'))->count() .
					' InProgress;</span>';
			$statusText.= ' <span>'.$list->filter(array('Status'=>'Sent'))->count() .
					' Sent;</span>';
			$statusText.= ' <span>'.$list->filter(array('Status'=>
					array('Failed','Bounced','BlackListed')))->count() . ' Failed/Bounced/Blacklisted;</span>';

			$gridField->StatusText = $statusText;

			return array(
				'header' => $gridField->renderWith('GridFieldSummaryHeader')
			);
		}
	}
}
