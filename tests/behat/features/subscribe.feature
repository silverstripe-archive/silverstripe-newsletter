@database-defaults
Feature: Subscribe to a newsletter
  As a website visitor, I can add my email address to the system
  in order to receive emails about news on the website

  Background:
    Given there are the following MailingList records
		"""
    daily:
        Title: newsletter 1
    monthly:
        Title: newsletter 2
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

    Scenario: I can fill in my email address in the subscription form
    	Given I go to the "/newsletter-subscription" page
    	And I fill in "Email" with "test@test.com"
    	And I press the "Submit" button
    	Then I should see "Thanks for subscribing"
    	And "test@test.com" is subscribed to "newsletter 1"

    Scenario: I can confirm my subscription by email
    	Given I go to the "/newsletter-subscription" page
    	And I fill in "Email" with "test@test.com"
    	And I press the "Submit" button
    	Then I should see "Thanks for subscribing"
    	And there is an email to "test@test.com" titled "Thanks for subscribing to our mailing lists, please verify your email"
    	And the newsletter subscription for "test@test.com" is not verified
    	When I go to '#subscription-link' in the email to "test@test.com"
    	Then I should see "Subscription Completed"
    	And there is an email to "test@test.com" titled "Confirmation of your subscription to our mailing lists"
    	And the newsletter subscription for "test@test.com" is verified