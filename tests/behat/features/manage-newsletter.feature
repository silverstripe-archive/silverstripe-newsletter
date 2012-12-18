@database-defaults
Feature: Edit Newsletter
  As a CMS author I want to create and edit a newsletter
  in order to prepare it for sending out

  Background:
    Given there are the following MailingList records
    """
    daily:
        Title: newsletter 1
    monthly:
        Title: newsletter 2
    """
    And there are the following Recipient records
    """
    recipient_all:
        Email: all@test.com
        MailingLists: =>MailingList.daily,=>MailingList.monthly
    recipient_daily:
        Email: daily@test.com
        MailingLists: =>MailingList.daily
    recipient_monthly:
        Email: monthly@test.com
        MailingLists: =>MailingList.monthly
    """
    And I am logged in with "ADMIN" permissions
    And I go to "/admin/newsletter"

  Scenario: I can create a new newsletter

  Scenario: I can create a copy an existing newsletter