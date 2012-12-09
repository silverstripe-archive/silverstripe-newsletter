<?php

/**
 * Displays a progress bar in a form.
 * These are currently only linked to Batch Processes.
 * 
 * @see BatchProcess
 * 
 * @package newsletter
 */
class ProgressBar extends FormField {

	function FieldHolder($properties = array()) {
		Requirements::javascript(NEWSLETTER_DIR . '/javascript/ProgressBar.js');
		Requirements::css(NEWSLETTER_DIR . '/css/ProgressBar.css');
		
		return $this->renderWith('ProgressBar');
	}
}