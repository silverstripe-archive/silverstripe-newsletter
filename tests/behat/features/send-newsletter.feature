@database-defaults
Feature: Send a newsletter
  As a CMS author, I want to send newsletters via email
  in order to reach people who are not visiting the website frequently

  Background:
    Given there are the following MailingList records
    """
    daily:
        Title: daily newsletter list
    monthly:
        Title: monthly newsletter list
    """
    And there are the following Newsletter records
    """
    daily:
        Title: Daily Newsletter
        MailingLists: =>MailingList.daily
    monthly:
        Title: Monthly Newsletter
        MailingLists: =>MailingList.monthly
    """
    And there are the following Recipient records
    """
    recipient_all:
        Salutation: Mr.
        FirstName: All
        Email: all@test.com
        MailingLists: =>MailingList.daily
    recipient_daily:
        Salutation: Mr.
        FirstName: Daily
        Email: daily@test.com
        MailingLists: =>MailingList.daily
    recipient_monthly:
        Salutation: Mr.
        FirstName: Monthly
        Email: monthly@test.com
        MailingLists: =>MailingList.monthly
    """
    And I go to "/admin/newsletter"

    Scenario: I can send a test newsletter
      # TODO

    Scenario: I can send a newsletter to a single mailinglist
      Given I click "newsletter 1" in the "Newsletters" table
      And I fill in "Hello $Recipient.Title" into the "Content" HTML field
      And I fill in "Test Newsletter" into the "Subject" field
      And I select "daily newsletter list" in "Mailinglists"
      And I press the "Send" button
      And I confirm the dialog
      Then there should be an email to "all@test.com" titled "Test Newsletter"
      And there should be an email to "daily@test.com" titled "Test Newsletter"
      And there should not be an email to "monthly@test.com" titled "Test Newsletter"
      And an email to "all@test.com" titled "Test Newsletter" should contain "Hello Mr. All"
      And an email to "daily@test.com" titled "Test Newsletter" should contain "Hello Mr. Daily"

    Scenario: I can send a newsletter to a multiple mailinglists
      Given I click "newsletter 1" in the "Newsletters" table
      And I fill in "Hello $Recipient.Title" into the "Content" HTML field
      And I fill in "Test Newsletter" into the "Subject" field
      And I select "daily newsletter list" in "Mailinglists"
      And I select "monthly newsletter list" in "Mailinglists"
      And I press the "Send" button
      And I confirm the dialog
      Then there should be an email to "all@test.com" titled "Test Newsletter"
      And there should be an email to "daily@test.com" titled "Test Newsletter"
      And there should be an email to "monthly@test.com" titled "Test Newsletter"

    Scenario: I can track the sending process
      Given I go to "/admin/newsletter/Newsletter_Sent"
      And I click on "newsletter 1" in the "Newsletters" table
      Then I should see "3 Sent"