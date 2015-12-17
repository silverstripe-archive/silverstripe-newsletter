<?php
/**
 * @package  newsletter
 */

/**
 * Single newsletter instance that shows only the
 * sent newsletters in the NewsletterAdmin ModelAdmin.
 * Only necessary because ModelAdmin doesn't allow managing
 * multiple variations of the same class.
 */
class Newsletter_Sent extends Newsletter
{

    private static $singular_name = "Sent Newsletters";
    private static $plural_name = "Sent Newsletters";
}
