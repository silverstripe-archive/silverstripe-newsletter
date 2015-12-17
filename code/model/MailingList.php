<?php
/**
 * @package  newsletter
 */

/**
 * Represents a specific containner of newsletter recipients
 */
class MailingList extends DataObject
{

    /* the database fields */
    private static $db = array(
        'Title'                    => "Varchar",
    );

    /* a mailing list could contains many newsletter recipients */
    private static $many_many = array(
        'Recipients'            => "Recipient",
    );

    private static $belongs_many_many = array(
        'Newsletters'            => "Newsletter",
    );

    private static $singular_name = 'Mailinglist';

    private static $plural_name = 'Mailinglists';

    private static $summary_fields = array(
        'Title',
        'ActiveRecipients.Count'
    );

    private static $searchable_fields = array(
        'Title'
    );

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
        $fields = new FieldList();
        $fields->push(new TabSet("Root", $mainTab = new Tab("Main")));
        $mainTab->setTitle(_t('SiteTree.TABMAIN', "Main"));

        $fields->addFieldToTab('Root.Main',
            new TextField('Title', _t('NewsletterAdmin.MailingListTitle', 'Mailing List Title')));

        $gridFieldConfig = GridFieldConfig::create()->addComponents(
            new GridFieldToolbarHeader(),
            new GridFieldSortableHeader(),
            $dataColumns = new GridFieldDataColumns(),
            new GridFieldFilterHeader(),
            new GridFieldDeleteAction(true),
            new GridFieldPaginator(30),
            new GridFieldAddNewButton(),
            new GridFieldDetailForm(),
            new GridFieldEditButton(),
            $autocompelete = new GridFieldAutocompleterWithFilter('before',    array(
                    'FirstName',
                    'MiddleName',
                    'Surname',
                    'Email',
                )
            )
        );

        $dataColumns->setFieldCasting(array(
            "Blacklisted" => "Boolean->Nice",
            "Verified" => "Boolean->Nice",
        ));

        $autocompelete->filters = array(
            "Blacklisted" => false,
        );

        $recipientsGrid = GridField::create(
            'Recipients',
            _t('NewsletterAdmin.Recipients', 'Mailing list recipients'),
            $this->Recipients(),
            $gridFieldConfig
        );


        $fields->addFieldToTab('Root.Main', new FieldGroup($recipientsGrid));
        $this->extend("updateCMSFields", $fields);

        if (!$this->ID) {
            $fields->removeByName('Recipients');
        }

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
     */
    public function ActiveRecipients()
    {
        if ($this->Recipients()  instanceof UnsavedRelationList) {
            return new ArrayList();
        }
        return $this->Recipients()->exclude('Blacklisted', 1)->exclude('Verified', 0);
    }
}
