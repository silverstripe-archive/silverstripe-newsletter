<?php

namespace SilverStripe\Newsletter\Form\GridField;

use SilverStripe\Forms\GridField\GridFieldConfig_RecordEditor;
use SilverStripe\Forms\GridField\GridFieldDataColumns;
use SilverStripe\Forms\GridField\GridFieldDetailForm;
use SilverStripe\Newsletter\Form\GridField\NewsletterGridFieldDetailForm;
use SilverStripe\Newsletter\Form\GridField\NewsletterGridFieldDetailForm_ItemRequest;

class NewsletterGridFieldConfig extends GridFieldConfig_RecordEditor
{
    public function __construct($itemsPerPage = null)
    {
        parent::__construct($itemsPerPage);

        $this->removeComponentsByType(GridFieldDetailForm::class);
        $this->addComponent(
            (new NewsletterGridFieldDetailForm())->setItemRequestClass(
                NewsletterGridFieldDetailForm_ItemRequest::class
            )
        );

        $this->getComponentByType(GridFieldDataColumns::class)
            ->setFieldCasting(
                array(
                "Content" => "HTMLText->LimitSentences",
                )
            );
    }
}
