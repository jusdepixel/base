Feature: Update resume
  Scenario: In order to have a full resume
    Given I want to update my resume
    When I fill my resume form
    Then I have a full resume
