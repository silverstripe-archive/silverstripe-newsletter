<?php

/**
 * Page type for creating a page that contains a form that visitors can
 * use to unsubscribe from all mailing lists.
 *
 * @package newsletter
 */

class UnsubscriptionPage extends Page {

	static $defaults = array(
		'Content' => 'Enter your email address and we will send you an email with an unsubscribe link'
	);
}

class UnsubscriptionPage_Controller extends Page_Controller {

	function Form() {
		$this->renderWith('UnsubscribeRequestForm');
	}
}