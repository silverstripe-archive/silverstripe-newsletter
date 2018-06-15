<?php

namespace SilverStripe\Newsletter\Pagetypes;

use PageController;

class UnsubscriptionPageController extends PageController
{
    public function Form()
    {
        return $this->renderWith('UnsubscribeRequestForm');
    }
}
