Feature: Todo list . it can add todo items

  Scenario: Add new todo to todo list
    Given First i goto the "/todo/add"
    And I fill the  "todo"
    And I fill in "priority" with "normal"
    And I press "Add Todo"
    Then I should see "/todo/index"