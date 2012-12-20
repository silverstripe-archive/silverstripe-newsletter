@database-defaults
Feature: Unsubscribe from a newsletter
  As a website visitor, I can remove my email address from the system
  in order to stop receiving emails from it

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
    """

    Scenario: I can unsubscribe from all mailinglists via URL
    	Given I follow the newsletter unsubscribe link for "all@test.com"
    	Then I should see "You will no longer receive"
        And "test@test.com" is not subscribed to "newsletter 1"
        And "test@test.com" is not subscribed to "newsletter 2"