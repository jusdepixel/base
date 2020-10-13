Feature: Update resume Member
  Scenario: In order to have a full Member resume
    Given I want to update my Member resume
    When I fill my Member resume form
    Then I have a full Member resume
