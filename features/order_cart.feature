Feature: Order Cart management

    Scenario: Add a single dish to the cart
        Given the cart is empty
        And a dish "Pizza" with id "1" and price 10.50
        When I add the dish "1" to the cart
        Then the cart should contain 1 item
        And the total should be 10.50

    Scenario: Add the same dish twice
        Given the cart is empty
        And a dish "Burger" with id "2" and price 5.00
        When I add the dish "2" to the cart
        And I add the dish "2" to the cart
        Then the quantity of "2" should be 2
        And the total should be 10.00

    Scenario: Remove a dish
        Given the cart has a dish "3" with price 3.00
        When I remove the dish "3" from the cart
        Then the cart should be empty

    Scenario: Increment dish quantity
        Given the cart has a dish "4" with price 2.00
        When I increment the dish "4"
        Then the quantity of "4" should be 2
        And the total should be 4.00

    Scenario: Set a package to the cart
        Given the cart is empty
        And a package "Box A" with id "1"
        When I assign the package "1" to the cart
        Then the cart should have package "1"

    Scenario: Clear the package from the cart
        Given the cart has a package "1"
        When I assign no package
        Then the cart should have no package

    Scenario: Calculate total with multiple dishes
        Given the cart is empty
        And a dish "Pasta" with id "5" and price 7.00
        And a dish "Salad" with id "6" and price 4.00
        When I add the dish "5" to the cart
        And I add the dish "6" to the cart
        And I increment the dish "5"
        Then the total should be 18.00

    Scenario: Add and remove multiple dishes
        Given the cart is empty
        And a dish "Soup" with id "7" and price 6.00
        And a dish "Juice" with id "8" and price 2.50
        When I add the dish "7" to the cart
        And I add the dish "8" to the cart
        And I remove the dish "7" from the cart
        Then the cart should contain 1 item
        And the total should be 2.50

    Scenario: Add multiple unique dishes
        Given the cart is empty
        And a dish "Steak" with id "9" and price 15.00
        And a dish "Fish" with id "10" and price 12.00
        When I add the dish "9" to the cart
        And I add the dish "10" to the cart
        Then the cart should contain 2 items
        And the total should be 27.00

    Scenario: Cart remains empty after removing non-existent dish
        Given the cart is empty
        When I remove the dish "4545"
        Then the cart should be empty
