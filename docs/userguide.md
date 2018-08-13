
## User Guide

This guide has been created to help you send newsletters using SilverStripe.
The module is an addition to the content management system
that allows administrative users to send bulk emails.

To access the module's administration interface, open the "Newsletter" section in the main CMS menu.

### MailingLists and Recipients

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