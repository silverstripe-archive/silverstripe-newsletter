<?php
/**
 * @package  newsletter
 */

/**
 * Adding this class to a {@link GridFieldConfig} of a {@link GridField} adds a header title with a summary of the
 * Status of the contained records
 */
class GridFieldSummaryHeader implements GridField_HTMLProvider {
	public function getHTMLFragments( $gridField) {
		if ($gridField && $gridField->getModelClass() && $gridField->getModelClass() == "SendRecipientQueue") {
			$list = $gridField->getList();
			$scheduled = $list->filter(array('Status'=>'Scheduled'))->count();			
			$progress = $list->filter(array('Status'=>'InProgress'))->count();
			$sent = $list->filter(array('Status'=>'Sent'))->count();
			$failed = $list->filter(array('Status'=>array('Failed','Bounced','BlackListed')))->count();

			$statusText = '<span>'
				. _t('Newsletter.Scheduled', '{count} scheduled', array('count' => $scheduled))
				. '</span>'
				. '<span>'
				. _t('Newsletter.InProgress', '{count} in progress', array('count' => $progress)) 
				. '</span>'
				. '<span>'
				. _t('Newsletter.Sent', '{count} sent', array('count' => $sent)) 
				. '</span>'
				. '<span>'
				. _t('Newsletter.Failed', '{count} failed', array('count' => $failed)) 
				. '</span>';

			$gridField->StatusText = $statusText;

			return array(
				'header' => $gridField->renderWith('GridFieldSummaryHeader')
			);
		}
	}
}
