<?php

namespace SilverStripe\Newsletter\Model;

use SilverStripe\ORM\DataObject;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\Tab;
use SilverStripe\Forms\TabSet;
use SilverStripe\Forms\GridField\GridFieldConfig;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\FieldGroup;
use SilverStripe\Forms\GridField\GridFieldToolbarHeader;
use SilverStripe\Forms\GridField\GridFieldSortableHeader;
use SilverStripe\Forms\GridField\GridFieldDataColumns;
use SilverStripe\Forms\GridField\GridFieldFilterHeader;
use SilverStripe\Forms\GridField\GridFieldDeleteAction;
use SilverStripe\Forms\GridField\GridFieldPaginator;
use SilverStripe\Forms\GridField\GridFieldAddNewButton;
use SilverStripe\Forms\GridField\GridFieldDetailForm;
use SilverStripe\Forms\GridField\GridFieldEditButton;

class MailingList extends DataObject
{
    private static $db = [
        'Title' => "Varchar",
    ];

    private static $many_many = [
        'Recipients' => Recipient::class,
    ];

    private static $belongs_many_many = [
        'Newsletters' => Newsletter::class,
    ];

    private static $singular_name = 'Mailing List';

    private static $plural_name = 'Mailing Lists';

    private static $summary_fields = [
        'Title',
        'ActiveRecipients.Count'
    ];

    private static $searchable_fields = [
        'Title'
    ];

    private static $table_name = 'MailingList';

    public function fieldLabels($includelrelations = true)
    {
        $labels = parent::fieldLabels($includelrelations);

        $labels["Title"] = _t('Newsletter.FieldTitle', "Title");
        $labels["FullTitle"] = _t('Newsletter.FieldTitle', "Title");
        $labels["ActiveRecipients.Count"] = _t('Newsletter.Recipients', "Recipients");

        return $labels;
    }

    public function getCMSFields()
    {
        $fields = parent::getCMSFields();
        $fields->removeByName('FileTracking');
        $fields->removeByName('LinkTracking');

        return $fields;
    }

    public function getFullTitle()
    {
        return sprintf(
            '%s (%s)',
            $this->Title,
            _t(
                'Newsletter.NumberRecipients',
                '{count} recipients',
                array('count' => $this->ActiveRecipients()->Count())
            )
        );
    }

    /**
     * Returns all recipients who aren't blacklisted, and are verified.
     *
     * @return SS_List
     */
    public function ActiveRecipients()
    {
        if ($this->Recipients()  instanceof UnsavedRelationList) {
            return new ArrayList();
        }

        return $this->Recipients()
            ->exclude('Blacklisted', 1)
            ->exclude('Verified', 0);
    }
}
