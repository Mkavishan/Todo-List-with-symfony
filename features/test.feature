Feature: adder
  In order to display the sum of two numbers
  As anybody
  I need to provide two numbers
  Scenario: Display the sum of two provided numbers
    Given I have the number 50 and the number 25
    When I add the togrther
    Then I should get 70
