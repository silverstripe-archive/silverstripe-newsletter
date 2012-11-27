# Newsletter module

[![Build Status](https://secure.travis-ci.org/silverstripe-labs/silverstripe-newsletter.png?branch=master)](https://travis-ci.org/silverstripe-labs/silverstripe-newsletter)

## Introduction

NewsletterAdmin is the CMS class for managing the newsletter system.

The Newsletters section can contain extra information about a Member class, but the default Member can be used. A site specific member should be placed under the `<site>`/code directory.

## Installation

In the _config.php, add:
`Email::setAdminEmail(`<default from address>`);`{php}
(This is the email address the newsletters are sent from. It can be overwritten on a per-type basis.)

If you have created a custom member class for the site, substitute it with the following line in the _config.php file:
`Object::useCustomClass("Member", "`<custom member classname>`");`{php}


## Email templates

The Newsletter templates are .ss files used as HTML for an email, with the following variables:


*  $Body - the content of the email as defined in the content field of the content tab in the CMS.

*  $Member - the member object. The member object has the following fields (although more can be added to a custom member class):
    * $Member.FirstName
    * $Member.Surname
    * $Member.Email
    * $Member.Password

*  $Subject

*  $From

*  $To

*  $UnsubscribeLink

Templates are created in mysite/templates/email. So for example, if you created Newsletter.ss inside mysite/templates/email then the Newsletter system will recognise this new .ss file and let you select it in the dropdown.

This currently goes against the convention of keeping templates inside themes/yourtheme/templates/email. If you want to keep you templates inside the themes/yourtheme/templates/email folder rather then the default mysite/template/email then you need to set this line in your mysite/_config file

	:::php
	// set email template folder to themes/mytemplate/templates/email
	NewsletterAdmin::$template_paths = "themes/mytemplate/templates/email";


### Example template

	
	`<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">`
	`<html>`
	
	`<head>`
	`<style>`
	...
	`</style>`
	`</head>`
	`<body>`
	
	`<h1>``<img src="http://www.mysite.com/images/image.png" alt="My Image" />``</h1>`
	
	`<div class="body">`
	`<p>`Dear $Member.FirstName,`</p>`
	$Body
	`</div>`
	
	`</body>`
	`</html>`


# User Guide

 
This guide has been created to help you send newsletters using SilverStripe.
The Silverstripe newsletter module is an addition to the content management system that allows administrative users to send bulk emails.

Users can be added to the system manually, one by one, or by importing a CSV file, or by creating a form that allows your site visitors to sign themselves up to one or several of your mailing lists.
The module also allows you to send a test email and preview the email before sending it to your recipients.

# Setting up the newsletter system


Initially the site tree on the left should be empty. The site tree contains a folder structure of the area. The newsletter is very similar.

To begin, you will need a newsletter type. Each newsletter type has its own mailing list and will appear as an option on a Subscribe Form (this will be covered later). A newsletter type can have several individual newsletters.

To create a newsletter type, click “Create” at the top of the site tree and choose “Add a type” from the dropdown that appears, then click “Go”. A new newsletter type will be added. By default, it is named “New newsletter type”. Beneath the Newsletter type folder, there will be drafts, sent items and mailing list folders.

In the right hand pane, you can edit the details of the newsletter type. Remember that the changes are not saved until you click the save icon in the top right corner of the edit pane.

Before you begin sending emails out you must:

1.	Add an appropriate name for the newsletter type
Fill in the field called “Newsletter type after you’ve selected a newsletter type.

2.	Add an email address for replies from this email.
There is an option called “send newsletters from” available when you select a newsletter type.

3.	Select a predefined template
Select the “template” tab and select a template from the predefined options.  

4.	Add recipients 
Typically you would import a list from an existing system using the import facility.  More information is supplied under the “Adding Recipients heading”

# Creating a newsletter


Newsletters are the individual messages sent out to each recipient. A newsletter is initially created as a draft until it is sent.  You can add content, images and links to a draft newsletter and save to the site for proofing and testing before you attempt a mass mail out 
•	A draft newsletter can only be created and added to one mailing list.
•	Newsletters can be resent if necessary. 

To create a newsletter:
1.	Click on the newsletter type in the site tree 

2.	Open the create menu by clicking “Create” at the top of the site tree. 

3.	Select “Add a draft” from the dropdown and click “Go”.

A new newsletter type will be created and opened in the right edit pane. The content field provides the same powerful content editing controls as the Site Content area.

4.	Add a subject, content, images and headings. 
We suggest creating your content in a text processor such as Microsoft Word or equivalent before adding to SilverStripe. 
Note: As with the newsletter type, any changes must be saved before the newsletter is sent.

5.	Preview Changes.
We recommend you send the email to yourself to ensure there are no spelling mistakes, grammatical errors and the images/ links are all valid before sending to the mailing list.
This can be achieved by selecting the “send” button, and typing an email address into the “send test to” field.  When sending test emails be sure to check the results on multiple email clients, and web mail. 

Sometimes you may wish to try different templates if they have been created for you, please consult your website developer for these options.

# Sending Newsletters


To send a newsletter, make sure you have a draft newsletter selected: (Remember draft newsletters can only be sent to one newsletter type and mailing list.

6.	Click on a draft newsletter under the site tree in the newsletter module. 

7.	Click “Send”.

This will open a small form with the option to send a test email to the address given, or to send it to the mailing list. 

8.	Choose the appropriate option and click “Send”. 

A progress bar will indicate how many emails have been sent so far.
Note: If you click send to mailing list, you can’t currently quit the process until it has finished. Closing the window will stop the server from sending to the nearest 10th person.  We hope to have this module upgrade shortly
 

# Adding recipients


Clicking on the “Mailing list” folder under a newsletter type in the site tree will open the mailing list of the newsletter type.

Adding recipients manually

The recipients list has a text field at the bottom of each column. Adding the recipient’s details into these fields and clicking “Add” will add the recipient to the mailing list.

Importing recipients from a CSV file
Rather than adding recipients one by one, the newsletter module provides functionality to import recipient data from a CSV file. CSV files can be exported from Excel and OpenOffice Calc.

The first row in the CSV file must contain the names of the columns. By default these are:
•	First Name
•	Surname
•	Email address
•	Password

Your site may have extra fields as per your requirements. The email address is the primary identifier and identifies a unique recipient. Importing details with the same email address as an existing recipient will update the existing recipient. As such, the email address must be provided. Rows with an empty email address will ignored during the import.

The import field is under the Import tab of the recipients tab. Use the file field to select the file and click show file to display it. This will open a table displaying the contents of the file. At the top of each column is a dropdown with each valid datum that can be entered for each recipient. The module will attempt to set these based on the column names. If they are incorrect, change them to the correct option. Selecting “unknown” will ignore the column during the import.

When you are happy with the column selection, click “Confirm”. The recipients will be imported and a short summary of the changes will be displayed.


# Viewing recipients

To view the recipients for a particular mailing list: 
•	Select the newsletter type in the tree to the left
•	Select the “recipients” tab.

Recipients can be filtered using the tab, and navigated using the previous and next buttons.


# Bounced emails


A bounced email is an email which could not be delivered because the email was incorrect, or doesn’t exist. Emails that get bounced are listed under the “sent” -> “Bounced” tab after you’ve selected a newsletter type.
Bounced emails need to be manually removed from the mailing list.

**Note:** The receiving email server needs to support bounce handling for it to work successfully. To test the functionality, GMail is one server that supports it. Most do, but some do not, so it can't be relied on as a completly accurate measure of how many email addresses don't work.

# Email templates

When you create a new newsletter type, there is a dropdown to choose a template. This is so you can send your newsletter as a custom template.

Templates are created in mysite/templates/email. So for example, if you created Newsletter.ss inside mysite/templates/email then the Newsletter system will recognise this new .ss file and let you select it in the dropdown.

This currently goes against the convention of keeping templates inside ''themes/yourtheme/templates/email''. If you want to keep you templates inside the ''themes/yourtheme/templates/email'' folder rather then the default ''mysite/template/email'' then you need to set this line in your mysite/_config file

	:::php
	// set email template folder to themes/mytemplate/templates/email
	NewsletterAdmin::$template_paths = "themes/mytemplate/templates/email";