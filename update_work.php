In PHP $this is a special variable used within an object to refer to the current instance of the class.
In PHP, when using Object-Oriented Programming (OOP), there are primarily three types of functions/methods that can be defined within a class:
Instance Methods: Operate on instances of a class ($this context), most commonly used in OOP.
Static Methods: Belong to the class itself (self:: context), useful for utility methods or when no instance-specific data is needed.
Magic Methods: Predefined methods with special names that are automatically called by PHP based on specific actions or conditions.

In PHP function type based on argument and return value:

Function Based on Arguments:

Functions can accept zero or more arguments.
Optional arguments can have default values if not provided.
Function Based on Return Value:

Functions can return a single value, multiple values (using arrays or objects), or different types based on conditions.
Return statements terminate the function and can return control to the calling code with a value.

Function are four types in php
1.Function with no argument and no return value.
2.Function with required argument but not return value.
3. Function returning a value but not argument.
4.Function with returning value and with required argument.

A function argument are two type that is first Actual argument and second is formal argument. 

Access Modifiers:
Public: When a property or method is declared as public it can be accessed from anywhere, both within the class itself and forom outside.
Protected: When a property or method is declared as protected it can only be accessed within the class itself and by classes that extend it (subclases).
Private : When a property or method is declared as private it can only accessed within the class itself. it cannot be accessed by child classes or form outside the classes.
Use of access modifier : Access modifiers allow you to restrict or allow access to class members based on your design requirements.
Encapsulation : They enforce encapsulation by hiding internal implementation details of a class, improving code readability and maintainability.
Method overriding : Method overriding is a feature in object-oriented-programing that allow a subclass or child class to provide a specific implementation of a method that is already defined its superclass or parent class.

Abstract class: In php, an abstract class is a class that can't be instantiated on its own and is mean to be extended by other classes
-An abstract class can have abstract methods which are methods declared without an implementation. Subclasses of the abstract class are required to implement these methods.

Property overriding in php occurs when a child class difines a property with the same name as a property in its parent class. When this happens the property in the child class overrides the property in the parent class for instances of the child class.
