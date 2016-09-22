Feature:
  In order to add item
  As  user
  I need to add a item
  Scenario: click on the "Add ToDo"
    Given I go to "http://drupal.org"
    When I fill in "Search Drupal.org" with "behat"
    And I press "Search"
    Then I should see "Behat Drupal Extension"