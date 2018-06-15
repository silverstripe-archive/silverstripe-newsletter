<?php

namespace SilverStripe\Newsletter\Control;

use SilverStripe\Admin\ModelAdmin;
use SilverStripe\Newsletter\Model\Newsletter;
use SilverStripe\Newsletter\Model\MailingList;
use SilverStripe\Newsletter\Model\Recipient;
use SilverStripe\SiteConfig\SiteConfig;
use SilverStripe\Forms\GridField\GridFieldDataColumns;
use SilverStripe\Forms\GridField\GridFieldDetailForm;
use SilverStripe\Newsletter\Form\GridField\NewsletterGridFieldDetailForm;

class NewsletterAdmin extends ModelAdmin
{
    private static $url_segment = 'newsletter';

    private static $menu_title = 'Newsletter';

    private static $menu_icon = 'silverstripe/newsletter:client/images/newsletter-icon.png';

    private static $extra_requirements_css = [
        'silverstripe/newsletter:client/css/NewsletterAdmin.css'
    ];

    private static $extra_requirements_js = [
        'silverstripe/newsletter:client/javascript/ActionOnConfirmation.js'
    ];

    private static $managed_models = [
        Newsletter::class,
        MailingList::class,
        Recipient::class
    ];

    private static $template_paths = null;

    public function getEditForm($id = null, $fields = null)
    {
        $form = parent::getEditForm($id, $fields);

        //custom handling of the newsletter modeladmin with a specialized action menu for the detail form
        if ($this->modelClass == Newsletter::class) {
            $config = $form->Fields()->first()->getConfig();
            $config->removeComponentsByType(GridFieldDetailForm::class)
                ->addComponents(new NewsletterGridFieldDetailForm());

            $config->getComponentByType(GridFieldDataColumns::class)
                ->setFieldCasting(array(
                    "Content" => "HTMLText->LimitSentences",
            ));
        }
        else if ($this->modelClass == Recipient::class) {
            $config = $form->Fields()->first()->getConfig();
            $config->getComponentByType(GridFieldDataColumns::class)
                ->setFieldCasting(array(
                    "Blacklisted" => "Boolean->Nice",
                    "Verified" => "Boolean->Nice",
            ));
        }

        return $form;
    }

    public static function template_paths()
    {
        if (!isset(self::$template_paths)) {
            if ($config = SiteConfig::current_site_config()) {
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
}
