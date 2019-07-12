# SilverStripe Newsletter Module

[![Build Status](https://secure.travis-ci.org/silverstripe-archive/silverstripe-newsletter.png?branch=master)](https://travis-ci.org/silverstripe-labs/silverstripe-newsletter)

## Installation

This module requires `silverstripe/cms` and `symbiote/silverstripe-queuedjobs` 
and is compatible with SilverStripe 4.

    composer require silverstripe/newsletter "2.x-dev"

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

Templates are created in `mysite/templates/Email`. So for example, if you 
created `Newsletter.ss` inside `mysite/templates/email` then the plugin will 
recognise this new file  and let you select it in the dropdown. You'll find a 
default template with minimal styling in 
`templates/Emails/SimpleNewsletterTemplate.ss`.

Template paths are configurable using the *Config API*
    
    *mysite/_config/newsletter.yml*
    :::yaml
    SilverStripe\Newsletter\Control\NewsletterAdmin
        template_paths: 
            - "themes/mytemplate/templates/email";

## Usage

### Mailing Lists and Recipients

A mailing list (class `MailingList`) can contain many recipients 
(class `Recipient`). Both can be created through the "Newsletter" Admin UI. 
Each newsletter can be sent to one or more mailing lists. The current recipients 
of a mailing list are copied to a `SendRecipientQueue` once a newsletter 
sending process starts, fixing the mailing list state for this newsletter.

### Queuing

Generating emails is processing intensive, at least on the scale of potentially
several thousand recipients. We need a safe way to track already sent message
in case of a fatal error halfway through. Also, sending large volumes of email 
in a short period of time can get you blacklisted. Which is why the newsletter 
uses a queue to send emails.

Each individual email for a newsletter is queued up as a `SendRecipientQueue` 
record. This queue is worked off by queued job `NewsletterMailerJob` in 
configurable batches. For more information about the queuing process see the
`symbiote/silverstripe-queuedjobs` module.

### Bounce Handling

The modules allows tracking of email "bounces" per recipient, for email which 
could not be delivered for some reason.

It's important to keep your mailing list clean of recipients which permanently 
deny delivery, in terms of decreasing the likelihood that your outgoing mail is 
classified as spam by other parties.

The `Recipient` model has `BouncedCount` and `Blacklisted` properties to track 
this. By default, this has to be handled manually by the recipient of your
"reply-to" address as configured through the newsletter admin UI. This mailbox 
should be regularly scanned for bouned emails, and their original recipients 
blacklisted by ticking the "Blacklisted" checkbox in the admin UI for that 
recipient.

Note: This process can be automated by forwarding bounce emails to the
["emailbouncehandler" module](https://github.com/silverstripe-labs/silverstripe-emailbouncehandler).
This process is experimental at the moment, some assembly required.

## Contributing

### Translations

Translations of the natural language strings are managed through a
third party translation interface, transifex.com.
Newly added strings will be periodically uploaded there for translation,
and any new translations will be merged back to the project source code.

Please use [https://www.transifex.com/projects/p/silverstripe-newsletter/](https://www.transifex.com/projects/p/silverstripe-newsletter/) to contribute translations,
rather than sending pull requests with YAML files.

See the ["i18n" topic](http://doc.silverstripe.org/framework/en/trunk/topics/i18n) on doc.silverstripe.org for more details.
