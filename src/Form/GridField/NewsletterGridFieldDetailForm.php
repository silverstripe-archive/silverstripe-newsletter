<?php

namespace SilverStripe\Newsletter\Form\GridField;

use SilverStripe\Forms\GridField\GridFieldDetailForm;
use SilverStripe\Core\Injector\Injector;

class NewsletterGridFieldDetailForm extends GridFieldDetailForm
{
    public function getItemRequestHandler($gridField, $record, $requestHandler)
    {
        $handler = Injector::inst()->createWithArgs(
            NewsletterGridFieldDetailForm_ItemRequest::class,
            array($gridField, $this, $record, $requestHandler, $this->name)
        );

        if ($template = $this->getTemplate()) {
            $handler->setTemplate($template);
        }

        $this->extend('updateNewsletetterItemRequestHandler', $handler);

        return $handler;
    }
}
