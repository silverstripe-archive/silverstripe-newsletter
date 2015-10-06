<?php

class DeleteUnverifiedRecipientsTask extends DailyTask{
	static $trunk_length = 50;

	public function process() {
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
		set_time_limit(18000);
		ini_set('memory_limit','512M');

		$days =  SubscriptionPage::get_days_verification_link_alive();

		$objects = DataList::create('Recipient')
			->where("\"Recipient\".\"Verified\" = 0 AND \"Recipient\".\"Created\" < NOW() - INTERVAL $days DAY")
			->limit(self::$trunk_length, $offset);

		$count = $objects->count();
		if($count) {
			foreach($objects as $object) {
				if($object->canDelete()) {
					$object->delete();
				}
			}
		}
		return $count;
	}
}