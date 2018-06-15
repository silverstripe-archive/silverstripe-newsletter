<?php

namespace SilverStripe\Newsletter\Form\GridField;

use SilverStripe\Forms\GridField\GridField_HTMLProvider;
use SilverStripe\Newsletter\Model\SendRecipientQueue;

class GridFieldNewsletterSummaryHeader implements GridField_HTMLProvider
{
    public function getHTMLFragments($gridField)
    {
        if ($gridField && $gridField->getModelClass() && $gridField->getModelClass() == SendRecipientQueue::class) {
            $list = $gridField->getList();

            $scheduled = $list->filter(array('Status'=>'Scheduled'))->count();
            $progress = $list->filter(array('Status'=>'InProgress'))->count();
            $sent = $list->filter(array('Status'=>'Sent'))->count();
            $failed = $list->filter(array('Status'=>array('Failed', 'Bounced', 'BlackListed')))->count();

            $statuses = array();
            if ($scheduled) {
                $statuses[] = _t('Newsletter.Scheduled', '{count} scheduled', array('count' => $scheduled));
            }
            if ($progress) {
                $statuses[] = _t('Newsletter.InProgress', '{count} in progress', array('count' => $progress));
            }
            if ($sent) {
                $statuses[] = _t('Newsletter.Sent', '{count} sent', array('count' => $sent));
            }
            if ($failed) {
                $statuses[] = _t('Newsletter.Failed', '{count} failed', array('count' => $failed));
            }

            $gridField->StatusText = implode(', ', $statuses);

            return array(
                'header' => $gridField->renderWith('GridFieldNewsletterSummaryHeader')
            );
        }
    }
}
