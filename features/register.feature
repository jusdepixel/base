Feature: Register
  Scenario: I want to register as free user
    Given I need to register to have an account
    When I fill the registration form
    Then I can log in with my account
  Scenario: I want to register as paid user
    Given I need to register to have an account
    When I fill the registration form
    Then I can log in with my account