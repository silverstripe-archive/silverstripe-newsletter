<?php
/**
 * Displays a progress bar in a form.
 * These are currently only linked to Batch Processes.
 * @see BatchProcess
 * @package forms
 * @subpackage fields-dataless
 */
class ProgressBar extends FormField {

	function FieldHolder() {
		Requirements::javascript('newsletter/javascript/ProgressBar.js');
		Requirements::css('newsletter/css/ProgressBar.css');
		
		return $this->renderWith('ProgressBar');
	}

}
?>
