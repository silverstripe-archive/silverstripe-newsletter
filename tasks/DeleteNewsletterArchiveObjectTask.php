<?php

class DeleteNewsletterArchivedObjectTask extends DailyTask{
	static $trunk_length = 50;
	static $days_for_newsletters;
	static $days_for_recipients;

	public function process() {
		$config = DataObject::get_one("SiteConfig");
		if($config && $config->exists()){
			if($config->DaysAfterWhichArchivedNewslettersDeleted === 0){
				echo "no newsletter has been deleted permanently";
			}else{
				$total_deleted = $this->deleting_by_type("Newsletter",
					$config->DaysAfterWhichArchivedNewslettersDeleted);
				echo $total_deleted." newsletters deleted permanently";
			}

			if($config->DaysAfterWhichArchivedRecipientsDeleted === 0){
				echo "no recipients has been deleted permanently";
			}else{
				$total_deleted = $this->deleting_by_type("Recipient",
					$config->DaysAfterWhichArchivedRecipientsDeleted);
				echo $total_deleted." recipients deleted permanently";
			}
		}

		return false;
	}

	public function deleting_by_type($type, $days){
		$start = 0;
		$total = 0;
		
		while($deleted = $this->delete_tunck_by_type($type, $start, $days)){
			$total = $total + $deleted;
			$start = $start + self::$trunk_length;
			if($deleted < 50) break;
		}
		return $total;
	}

	public function delete_tunck_by_type($type, $offset, $days){
		set_time_limit(18000);
		ini_set('memory_limit','512M');

		$objects = DataList::create($type)
			->where("\"$type\".\"Archived\" = 1 AND \"$type\".\"LastEdited\" > NOW() - INTERVAL $days DAY")
			->limit(self::$trunk_length, $offset);

		$count = $objects->count();
		if($count){
			foreach($objects as $object){
				if($object->canDelete()) $object->delete();
			}
		}
		return $count;
	}
}