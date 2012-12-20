# Changelog

## 1.0.0

 * The `NewsletterType` model is obsolete, there's no distinction between "newsletters"
   and "types" any longer. Can can copy any existing newsletter to create a new one.
 * The `Newsletter` model now has a many-many relationship to mailinglists, 
   rather than a has-one proxied through `NewsletterType`
 * Newsletter recipients are decoupled from security groups, into new 
   `Recipient` and `MailingList` data structures. Consequently removed `Newsletter_Recipient` class.
 * Newsletter templates use a `Recipient` model rather than a modified `Member`.
   Most template placeholders stay the same, but it is recommended to check your templates.
 * Also removed the following classes: `BouncedList`, `NewsletterList`, `NewsletterRole`,
   `NewsletterType`, `ProgressBar`, `RecipientImportField`, `TrackingLinksEmail`, 
   `Unsubscribe_MailingListForm`, `Unsubscribe_EmailAddressForm`, `UnsubscribedList`

Since the datamodel has been changed, you'll need to upgrade existing data.
Execute `newsletter/migration/0.5-to-1.0.sql` in your database,
for example in MySQL through `mysql < newsletter/migration/0.5-to-1.0.sql`.

 * Please back up your data before performing this operation.
 * The migration script only works when no data has been created through the new newsletter module yet
   (such as new recipients or newsletters)
 * Please ensure all newsletters have finished sending before the migration
 * The migration script is targeted at MySQL databases, and will require minor adjustment
   for other database drivers.

## 0.5

n/a

## 0.4

n/a

## 0.3

 * [80363] TemplateList (extends from DropdownField) is entirely unnecessary and only used once for making a dropdown field from passed in $path variable. In addition, currently the dropdown source only contains the files from project()/template/email if there is this folder and there are files under it. This patch is to delete the file TemplateList.php, deprecate NewsletterAdmin::template_path(), add NewsletterAdmin:;template_paths() and NewsletterAdmin::templateSource().
 * [91112] introducing the CheckboxSetWithExtraField which is normal checkbox set with extra data field for each check box need to be saved.
 * [91130] APICHANGE: move SubscribeSumission.ss from cms module to newsletter module, cos it is only used by newsletter module.
 * [86122] customise the label or title before the newsletter list checkbox set.
 * [91112] decoupling the 'newsletter' module from 'userform' module, re-implementing the SubscriptionPage which contains a SubscritionForm.
 * [94818] Added a heading field to the subscription form and removed hardcoded heading field 
 * [78078] Added translation for Arabic (Saudi Arabia) - thanks to Talal Al Asmari, added translation for Estonian (Estonia) - thanks to Marti, Tanel, Tiit and Teet, added translation for Malay (Malaysia) - thanks to castd, Su Yin and Emil
 * [83942] Make SubscribeForm? more robust, dealing with the special case when there is no newsletters can be subscribe to
 * [88195] group "Sent Items" in newsletter admin into two groups: -- Most Recent 5 and -- Older for each newsletter type. Also default the tree node to be closed initially. All these efforts are for making the newsletter admin interface neat and clean.
 * [93245] Newsletter archive added to frontpage

## 0.2

 * [70943] Newsletter module heading doesn't have current status

## 0.1.1

 * [64365] Pulled out Newsletter specific stuff from Member.php in sapphire core into the newsletter module. This includes Member_UnsubscribeRecord which is now just UnsubscribeRecord, and member fields and methods that can now be found in NewsletterRole
 * [66757] Added static properties to NewsletterType for allowing decoration
 * [66760] Encapsulated the NewsletterType CMS fields into NewsletterType->getCMSFields(), removing the old unused getCMSFields()
 * [68929] Made tree items collapsed instead of expanded by default to avoid insanity
 * [68996] Added ability to choose message in unsubscribe
 * [69336] Allow for longer FromEmail in the DB
 * [69898] Allow preview of a Newsletter object by going to the URL admin/newsletter/preview/(ID) where (ID) is a valid ID of a Newsletter record in the database
 * [69904] Added link to preview the newsletter (opens a new tab or window)
 * [70406] Allow manual selection of group to send newsletters to instead of hardcoded group automagically created when new newsletter type is created
 * [70809] Removed blacklist newsletter specific code out of core and into newsletter module
 * [62309] Moved ProgressBar and support files to newsletter/trunk module, as this is the module where it's used
 * [65554] Tidy up NewsletterAdmin
 * [64434] Fixing usage of deprecated APIs
 * [65098] Adjusted NewsletterAdmin to new CMS Menu generation (see #2872)
 * [65554] a lot of methods in this class now passed $params as HTTPRequest object, rather than as a array if the function is called from Ajax or top-level of front-end, some method is called in both manner, ie. called from Ajax and called internally as well, so we need to check $params type and do further process. This is a partial fix of open source ticket #3035
 * [66703] Fix newsletter module to work with the 2.3 URL handler
 * [66760] Allow loading data from the NewsletterType for all fields, not just 2
 * [68703] Updated newsletter admin to support HtmlEditorField changes in r68701
 * [68936] Fixed member search in Mailing List in CMS
 * [68967] Fixed resend and save buttons greyed out when viewing a draft
 * [68987] fixed bugs in URL for unsubscribe
 * [68989] updated URL handler for unsubscribe controller
 * [69461] Fixed TinyMCE 3.2 in newsletter
 * [69920] #3322: Fixed newsletter html editor saving
 * [70599] styling newsletter send button to match
 * [70668] Fixed error in preview if no template is discovered (falls back to GenericEmail)
 * [70672] Fixed newsletter cancel/send actions to be styled consistent - removed button and used consistent input type submit tag instead

## 0.1.0

 * Initial release