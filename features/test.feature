Feature: Add Item
  In order to add a todo item into todo list
  As anybody
  I need to provide todo work and priority
Scenario: add a todo item to todo list
  Given i am on "/add"
  When I fill the todowork with "Learn behat"
  And I press the "submit" button
  Then page should redirect to "/index"

