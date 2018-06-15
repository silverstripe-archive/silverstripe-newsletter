<?php

namespace SilverStripe\Newsletter\Tasks;

use SilverStripe\Dev\BuildTask;
use SilverStripe\Newsletter\Pagetypes\SubscriptionPage;
use SilverStripe\Newsletter\Model\Recipient;

class DeleteUnverifiedRecipientsTask extends BuildTask
{
    private static $trunk_length = 50;

    public function run($request) {
        parent::run($request);

        $start = 0;
        $total = 0;

        while($deleted = $this->delete_trunk($start)) {
            $total = $total + $deleted;
            $start = $start + self::$trunk_length;
            if($deleted < self::$trunk_length) break;
        }

        echo "totally ".$total." recipients deleted";
    }

    public function delete_trunk($offset) {
        $days =  SubscriptionPage::get_days_verification_link_alive();

        $objects = Recipient::get()->filter([
            "Verified" => 0
        ])
            ->where("\"Created\" < NOW() - INTERVAL $days DAY")
            ->limit($this->config()->get('trunk_length'), $offset);

        $count = $objects->count();

        if ($count) {
            foreach($objects as $object) {
                if($object->canDelete()) {
                    $object->delete();
                }
            }
        }
        return $count;
    }
}
