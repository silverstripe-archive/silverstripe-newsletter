<?php

/**
 * This class is a {@link GridField} component that adds a archive action for objects.
 * The object has to has an $db field: "Archived"=>"Boolean" and canArchive() function
 *
 * <code>
 * $action = new GridFieldArchiveAction(); // delete objects permanently
 * </code>
 *
 * @package newsletter
 * @subpackage gridfield
 */

class GridFieldArchiveAction implements GridField_ColumnProvider, GridField_ActionProvider {
	
	/**
	 * Add a column 'Archive'
	 * 
	 * @param type $gridField
	 * @param array $columns 
	 */
	public function augmentColumns($gridField, &$columns) {
		if(!in_array('Actions', $columns)) {
			$columns[] = 'Actions';
		}
	}
	
	/**
	 * Return any special attributes that will be used for FormField::createTag()
	 *
	 * @param GridField $gridField
	 * @param DataObject $record
	 * @param string $columnName
	 * @return array
	 */
	public function getColumnAttributes($gridField, $record, $columnName) {
		return array('class' => 'col-buttons');
	}
	
	/**
	 * Add the title 
	 * 
	 * @param GridField $gridField
	 * @param string $columnName
	 * @return array
	 */
	public function getColumnMetadata($gridField, $columnName) {
		if($columnName == 'Actions') {
			return array('title' => '');
		}
	}
	
	/**
	 * Which columns are handled by this component
	 * 
	 * @param type $gridField
	 * @return type 
	 */
	public function getColumnsHandled($gridField) {
		return array('Actions');
	}
	
	/**
	 * Which GridField actions are this component handling
	 *
	 * @param GridField $gridField
	 * @return array 
	 */
	public function getActions($gridField) {
		return array('archiverecord');
	}
	
	/**
	 *
	 * @param GridField $gridField
	 * @param DataObject $record
	 * @param string $columnName
	 * @return string - the HTML for the column 
	 */
	public function getColumnContent($gridField, $record, $columnName) {
			if(!$record->canArchive()) {
				return;
			}
			$field = GridField_FormAction::create($gridField,  'ArchiveRecord'.$record->ID, false, "archiverecord",
					array('RecordID' => $record->ID))
				->addExtraClass('gridfield-button-archive')
				->setAttribute('title', _t('GridAction.Archive', "Archive"))
				//->setAttribute('data-icon', 'archive')
				->setAttribute('data-icon', 'plug-disconnect-prohibition')
				->setDescription(_t('Newsletter.ARCHIVE_DESCRIPTION','Archive'));
		return $field->Field();
	}
	
	/**
	 * Handle the actions and apply any changes to the GridField
	 *
	 * @param GridField $gridField
	 * @param string $actionName
	 * @param mixed $arguments
	 * @param array $data - form data
	 * @return void
	 */
	public function handleAction(GridField $gridField, $actionName, $arguments, $data) {
		if($actionName == 'archiverecord') {
			$item = $gridField->getList()->byID($arguments['RecordID']);
			if(!$item) {
				return;
			}
			if(!$item->canArchive()) {
				throw new ValidationException(
					_t('Newsletter_Sent.Archive',"No archive permissions"),0);
			}
			$item->Archived = true;
			$item->write();
		} 
	}
}
