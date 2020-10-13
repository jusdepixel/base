Feature: Register Admin
  Scenario: I want to register as admin user
    Given I need to register to have an admin account
    When I fill the admin registration form
    Then I can log in with my admin account