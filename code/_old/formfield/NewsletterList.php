<?php
/**
 *@deprecated Since the new NewsletterAdmin will be a DataModuleAdmin, this list is not needed from 1.0 onwords
 * 
 * @package newsletter
 */
class NewsletterList extends FormField {
	
	function __construct($name, $mailtype, $status = "Draft") {
		Deprecation::notice('1.0', 'NewsletterRole is deprecated. It is neither used anywhere, nor has an replacement class ', Deprecation::SCOPE_CLASS);
		parent::__construct(null);
	}
}