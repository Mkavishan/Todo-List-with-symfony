Feature: Add Item
  In order to add a todo item into todo list
  As todolist user
  I need to provide todo work and it's priority
Scenario: add a todo item to todo list
  Given i am on "/add"
  When I fill the todowork with "Learn behat" priority "Normal"
  And get the item on todo list
  Then the result should be in "todowork" property  equlas "Learn behat"

