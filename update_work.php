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

Static method can be called directly without creating an instance of the class first. static method can't instatiate by other class, because already its method and properties are public.

A class have both static and not-static methods, A static method can be accessed from a method in the same class using the self keyword and double colon (::) .
Static method can also be called from methods in other classes. To do this the static method should be public.
To call a static method from a child class use the parent keyword inside the child class, here the static method can be public or protected.
Static properties can be called without creating an instance of a class -> ClassName::$property;

Interfaces allow you to specify whate methods a class should implement. Interfaces make it easy to use a variety of classes in the same way when one or more classes use the same interface, it is referred to as polymorphism. 

Interface are similler to as abstract class.
The difference berween interfaces and abstract classes are.
Interfaces can't have properties while abstract classes can
All interfaces methods must be public while abstract method is public or protected
All methods in an interface are abstract so that they cannot implemented in code and the abstract keyword is not necessary.
Class can implement an interface while inheriting from another class at the same time.
A class that implements an interfaces must implement all of the interfaces methods as abstract class.

Trait : php only support single inheritance, a child class can inherit only from one single parent.
Traits are used to declare methods that can be used in multiple classes.
Trait can have methods and abstract methods that can be used in multiple classes, and the methods can have any access modifier

Namespace are qualifiers that solve two different problems,
1. They allow for better organization by gouping classes that work together to perform a task.
2. They allow the same name to be used for more than one class.

Namespaces are declared at the beginning of a file using the namespace keyword -> namespace Html;
Any code that follows a namespace declaration is operating that belong to the namespace can be instantiated without any qualifiers

To access classes form outside a namespace the class needs to have the namespace attached to it.
*It can be useful to give a message or class an alias to make it easier to write this is done with the use keyword.


Iterable : An iterable is any value which can be looped through with a foreach() loop.
The iterable keyword can be used as a data type of a function argument or as the return type of a function.

All array are iterables so any array can be used as an argument for a function that requires an iterable.

cURL : cURL is a library that allow you to connect and communicate to many different type of servers with many different type of protocols. It deals with url, To use cURL in php you need to ensure that php is compiled with cURL support.
The cURL project has two products, 1. libcurl 2. curl.
cURL : A command line tool for getting or sending files using URL syntax. phpinfo() function will display in its output. 

Exam : The simplest and most common request/operation made using HTTP is to get a URL. The client issues a GET  request to the server and receives the document it asked it.

cURL basic function :
curl_init() -> will initialize a new session and return a cURL handle.
curl_exec($ch) -> Its purpose is simply to execute the predefined curl session (given by $ch);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1) -> return page contents, if set 0 then no ouptput will be returned.
curl_setopt($ch, CURLOPT_URL, $URL) -> pass url as a parameter. This is your target server website address. This is the url you want to get from the internet.
curl_close($ch) -> close curl resources and free-up system resources.
<?php
// create a new cURL resource
$ch = curl_init();

// set URL and other appropriate options
curl_setopt($ch, CURLOPT_URL, "http://www.example.com/");
curl_setopt($ch, CURLOPT_HEADER, 0);

// grab URL and pass it to the browser
curl_exec($ch);

// close cURL resource, and free up system resources
curl_close($ch);
?>

