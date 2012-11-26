<?php

/**
 * @deprecated BouncedList is deprecated. It is neither used anywhere, nor has an replacement class 
 * Form field showing a list of bounced addresses
 *
 * @package newsletter
 */
class BouncedList extends FormField {
    function __construct( $name, $newsletterType ) {
        Deprecation::notice('3.0', 'BouncedList is deprecated. It is neither used anywhere, nor has an replacement class',
            Deprecation::SCOPE_CLASS);
		parent::__construct( $name, '', null );
    }
}