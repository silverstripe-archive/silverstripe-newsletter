@database-defaults
Feature: Manage Mailinglist
  As a CMS author I want to manage mailinglists
  in order to keep controller over who receives my newsletters

  Background:
    Given I am logged in with "ADMIN" permissions
    And I go to "/admin/newsletter"

  Scenario: I can create a new mailinglist

  Scenario: I can add a recipient to a mailinglist
    Given I go to "/admin/newsletter/MailingList"
    # ... add recipient@test.com
    And I go to "/admin/newsletter/Recipient"
    Then I should see "recipient@test.com" in the "Recipients" table