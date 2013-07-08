# SilverStripe Newsletter Module

[![Build Status](https://secure.travis-ci.org/silverstripe-labs/silverstripe-newsletter.png?branch=master)](https://travis-ci.org/silverstripe-labs/silverstripe-newsletter)

## Introduction

## Overview

The module manages the creation and sending of newsletters
through the CMS, in a very similar fashion to editing pages.

Features:

 * WYSIWYG newsletter creation (incl. images and preview)
 * HTML emails (with auto-conversion to text)
 * Subscription page (in your own theme style)
 * Subscription confirmation by email
 * Unsubscribe by URL and web confirmation
 * Queued email sending (requires ["messagequeue" module](https://github.com/silverstripe-labs/silverstripe-messagequeue))
 * Batch sending and throttling
 * Custom SilverStripe templates for emails
 * Link tracking
 * Recipient blacklisting
 * Bounce tracking (experimental)
 * Decoratable `Recipient` class to add more properties

## Configuration

### Email Addresses

In the _config.php, add:
`Email::setAdminEmail(`<default from address>`);`
This is the email address the newsletters are sent from. It can be overwritten on a per-type basis.

### Email Templates

Newsletter templates are standard SilverStripe templates, with a few extra placeholders.

 * `UnsubscribeLink`: Personalized link to unsubscribe from newsletter
 * `AbsoluteBaseURL`: Absolute URL to the website
 * `To`: Recipient email address
 * `From`: Sender email address
 * `Subject`: Newsletter subject
 * `Recipient.Title`: Recipient full name, including salutation, first/middle/last name (all optional)
 * `Recipient.Salutation`
 * `Recipient.FirstName`
 * `Recipient.Surname`
 * `Recipient.Email`
 * `Now`: Current date and time (format e.g. with $Now.Nice)

Templates are created in `mysite/templates/email`. So for example, 
if you created `Newsletter.ss` inside `mysite/templates/email` 
then the system will recognise this new file  and let you select it in the dropdown.
You'll find a default template with minimal styling in `newsletter/templates/email/SimpleNewsletterTemplate.ss`.

Template paths are configurable:

	:::php
	NewsletterAdmin::$template_paths = "themes/mytemplate/templates/email";
	
## Usage

### Mailinglists and Recipients

A mailing list (class `MailingList`) can contain many recipients (class `Recipient`).
Both can be created through the "Newsletter" admin UI. Each newsletter can be sent
to one or more mailing lists. The current recipients of a mailinglist are
copied to a `SendRecipientQueue` once a newsletter sending process starts,
fixing the mailing list state for this newsletter.

### Queuing

Generating emails is processing intensive, at least on the scale of potentially
several thousand recipients. We need a safe way to track already sent message
in case of a fatal error halfway through. Also, sending large volumes of email in a short period
of time can get you blacklisted. Which is why the newsletter uses a queue to send emails.

Each individual email for a newsletter is queued up as a `SendRecipientQueue` record.
This queue is worked off by `NewsletterSendController` in configurable batches.
It doesn't contain the actual email content, but knows how to generate it.

If the ["messagequeue" module](https://github.com/silverstripe-labs/silverstripe-messagequeue)
is installed (highly recommended), these batches are further queued up

 * Send newsletter to 1000 recipients
 * 1000 `SendRecipientQueue` records are created with Status=Scheduled
 * A message is sent to the messagequeue module
 * The messagequeue module starts processing on PHP shutdown by default,
   processing the first batch (defaults to 50 items).
 * The batch of processed `SendRecipientQueue` records get a new status, mostly Status=Sent.
   (Note: There are still 1000 `SendRecipientQueue` records)
 * The messagequeue module starts a new sub-process in PHP.
 * First, the process process tries to re-send any failed items from the previous batch.
 * Then, the next batch is processed (defaults to 50 items)
 * ... Rinse and repeat until done

If this process ever fails for any reason, you can call this manually as a build task:

	/dev/tasks/NewsletterSendController?newsletter=<newsletter-id>
 
You can use the following static variables to configure the `NewsletterSendController`:

 * `$items_to_batch_process`: Number of emails to send out in "batches" to avoid spin up costs
 * `$stuck_timeout`: Minutes after which we consider an "InProgress" item in the queue "stuck"
 * `$retry_limit`: Number of times to retry sending email that get "stuck"
 * `$throttle_batch_delay`: Seconds to wait between sending out email batches

### Bounce Handling

The modules allows tracking of email "bounces" per recipient,
which means that an email could not be delivered for some reason.
Its important to keep your mailing list clean of recipients which
permanently deny delivery, in terms of decreasing the likelyhood
that your outgoing mail is classified as spam by other parties.

The `Recipient` model has `BouncedCount` and `Blacklisted` properties to track this. 
By default, this has to be handled manually by the recipient of your
"reply-to" address as configured through the newsletter admin UI.
This mailbox should be regularly scanned for bouned emails,
and their original recipients blacklisted by ticking the "Blacklisted" checkbox
in the admin UI for that recipient.

Note: This process can be automated by forwarding bounce emails to the
["emailbouncehandler" module](https://github.com/silverstripe-labs/silverstripe-emailbouncehandler).
This process is experimental at the moment, some assembly required.

### Reserved Page URLs
The /unsubscribe and /newsletterlinks URLs are reserved for use for the Newsletter module's controllers.
That means that you cannot create a regular Page using either of those URLs.

## User Guide

 
This guide has been created to help you send newsletters using SilverStripe.
The module is an addition to the content management system 
that allows administrative users to send bulk emails.

To access the module's administration interface, open the "Newsletter" section in the main CMS menu.

### Mailinglists and Recipients

Newsletters can be sent to one or more "mailinglists", which contains a number of "recipients".
To create one, select the "Mailinglists" tab and hit "Add Mailinglist".

### Recipients

Select the "All Recipients" tab to list all recipients across mailinglists.
They can be filtered by various criteria through the "Filter" sidebar.
You can add new recipients there through the "Add Recipient" button.
Please note that they won't be associated to a mailinglist there,
you'll need to add this relationship manually, through editin the mailinglist itself.

Alternatively, you can import recipients through a CSV file.
Common fields are: `Email`, `FirstName`, `MiddleName`, `Surname`, `Salutation`.
You'll want to set `Verified` to `1` in order to ensure the recipient gets picked up.
Please note that depending on your legislation and use case, you might need explicit approval
before you can send emails to you recipients.

### Subscription Form

Most likely, you'll want to have your recipients subscribe themselves
through your website. The newsletter module comes with a special page type
for this purpose, the "Newsletter Subscription Page". You can add it through
the standard "Pages" section in the CMS. You can choose which
fields to retrieve from your users there.
If you have more than one mailinglist, you can also choose which one should be
available for subscription.

### Creating a Newsletter

Newsletters are the individual messages sent out to one or more mailinglists.
A newsletter is initially created as a draft until it is sent.  
You can add content, images and links to a draft newsletter, very similar to how
you would interact with page content in the CMS.
Newsletters can be saved for proofing and testing before you attempt a mass mail out.

### Previewing and Testing a Newsletter

You can (roughly) preview a newsletter in the browser through the "Preview" button.
In this view, you'll also find an action to send a test email to a specified address.

### Sending a Newsletter

Once you're happy with the newsletter, send it out by pressing "Send".
Make sure to select at least one mailinglist.
If the sending process is started, the newsletter moves to the "Sent Newsletters" tab.
Note that each newsletter can only be sent once. To send it again, create a copy
through the "Save as new..." action. 

You can track the sending process in the "Sent To" tab when viewing a newsletter.
Depending on the size of your mailinglist, it can take a couple of minutes
or even hours for the process to complete.

### Bounced Emails and Blacklisted Recipients

A bounced email is an email which could not be delivered because the email was incorrect, 
or doesn’t exist. The number of bounces can be tracked on each recipient.
In most setups, somebody at your organization will need to go through the bounce emails every couple of days
and manually remove invalid addresses, by checking the "Blacklisted" button.

Depending on your own setup, this process might be automated.
Please ask your IT team for more information.

## Contributing

### Translations

Translations of the natural language strings are managed through a
third party translation interface, transifex.com.
Newly added strings will be periodically uploaded there for translation,
and any new translations will be merged back to the project source code.

Please use [https://www.transifex.com/projects/p/silverstripe-newsletter/](https://www.transifex.com/projects/p/silverstripe-newsletter/) to contribute translations,
rather than sending pull requests with YAML files.

See the ["i18n" topic](http://doc.silverstripe.org/framework/en/trunk/topics/i18n) on doc.silverstripe.org for more details.