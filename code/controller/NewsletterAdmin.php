<?php
/**
 * @package  newsletter
 */

/**
 * Newsletter administration section
 */
class NewsletterAdmin extends ModelAdmin
{

    private static $url_segment = 'newsletter';
    private static $menu_title = 'Newsletter';
    private static $menu_icon = 'newsletter/images/newsletter-icon.png';

    private static $managed_models = array(
        "Newsletter" => array('title' => 'Newsletters'),
        "Newsletter_Sent" => array('title' => 'Sent Newsletters'),
        "MailingList" => array('title' => 'Mailing Lists'),
        "Recipient" => array('title' => 'All Recipients')
    );

    /**
     * @var array Array of template paths to check
     */
    public static $template_paths = null; //could be customised in _config.php

    public function init()
    {
        parent::init();

        Requirements::javascript(CMS_DIR . '/javascript/SilverStripeNavigator.js');
        Requirements::javascript(NEWSLETTER_DIR . '/javascript/ActionOnConfirmation.js');
        Requirements::css('newsletter/css/NewsletterAdmin.css');
    }

    public function getEditForm($id = null, $fields = null)
    {
        $form = parent::getEditForm($id, $fields);

        //custom handling of the newsletter modeladmin with a specialized action menu for the detail form
        if ($this->modelClass == "Newsletter" || $this->modelClass == "Newsletter_Sent") {
            $config = $form->Fields()->first()->getConfig();
            $config->removeComponentsByType('GridFieldDetailForm')
                ->addComponents(new NewsletterGridFieldDetailForm());
            if ($this->modelClass == "Newsletter_Sent") {
                $config->removeComponentsByType('GridFieldAddNewButton');
            }
            $config->getComponentByType('GridFieldDataColumns')
                ->setFieldCasting(array(
                    "Content" => "HTMLText->LimitSentences",
            ));
        }
        if ($this->modelClass == "Recipient") {
            $config = $form->Fields()->first()->getConfig();
            $config->getComponentByType('GridFieldDataColumns')
                ->setFieldCasting(array(
                    "Blacklisted" => "Boolean->Nice",
                    "Verified" => "Boolean->Nice",
            ));
        }
        return $form;
    }

    /**
     * looked-up the email template_paths.
     * if not set, will look up both theme folder and project folder
     * in both cases, email folder exsits or Email folder exists
     * return an array containing all folders pointing to the bunch of email templates
     *
     * @return array
     */
    public static function template_paths()
    {
        if (!isset(self::$template_paths)) {
            if (class_exists('SiteConfig') && ($config = SiteConfig::current_site_config()) && $config->Theme) {
                $theme = $config->Theme;
            } elseif (SSViewer::current_custom_theme()) {
                $theme = SSViewer::current_custom_theme();
            } elseif (SSViewer::current_theme()) {
                $theme = SSViewer::current_theme();
            } else {
                $theme = false;
            }

            if ($theme) {
                if (file_exists("../".THEMES_DIR."/".$theme."/templates/email")) {
                    self::$template_paths[] = THEMES_DIR."/".$theme."/templates/email";
                }

                if (file_exists("../".THEMES_DIR."/".$theme."/templates/Email")) {
                    self::$template_paths[] = THEMES_DIR."/".$theme."/templates/Email";
                }
            }

            $project = project();

            if (file_exists("../". $project . '/templates/email')) {
                self::$template_paths[] = $project . '/templates/email';
            }

            if (file_exists("../". $project . '/templates/Email')) {
                self::$template_paths[] = $project . '/templates/Email';
            }
        } else {
            if (is_string(self::$template_paths)) {
                self::$template_paths = array(self::$template_paths);
            }
        }
        return self::$template_paths;
    }

    public function getList()
    {
        $list = parent::getList();
        if ($this->modelClass == "Newsletter" || $this->modelClass == "Newsletter_Sent") {
            if ($this->modelClass == "Newsletter") {
                $statusFilter = array("Draft", "Sending");

                //using a editform detail request, that should allow Newsletter_Sent objects and regular Newsletters
                if (!empty($_REQUEST['url'])) {
                    if (strpos($_REQUEST['url'], '/EditForm/field/Newsletter/item/') !== false) {
                        $statusFilter[] = "Sent";
                    }
                }
            } else {
                $statusFilter = array("Sent");
            }

            $list = $list->addFilter(array("Status" => $statusFilter));
        }



        return $list;
    }

    /**
     * @return SearchContext
     */
    public function getSearchContext()
    {
        $context = parent::getSearchContext();

        if ($this->modelClass === "Newsletter_Sent") {
            $context = singleton("Newsletter")->getDefaultSearchContext();
            foreach ($context->getFields() as $field) {
                $field->setName(sprintf('q[%s]', $field->getName()));
            }
            foreach ($context->getFilters() as $filter) {
                $filter->setFullName(sprintf('q[%s]', $filter->getFullName()));
            }
        }

        return $context;
    }
}
