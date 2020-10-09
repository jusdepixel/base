Feature: Register Visitor
  Scenario: I want to register as visitor user
    Given I need to register to have a visitor account
    When I fill the visitor registration form
    Then I can log in with my visitor account