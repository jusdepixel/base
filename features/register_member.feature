Feature: Register Member
  Scenario: I want to register as member user
    Given I need to register to have a member account
    When I fill the member registration form
    Then I can log in with my member account