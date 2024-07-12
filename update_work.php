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



mysqli connect ->
<?php
$servername = "localhost";
$username = "username";
$password = "password";

// Create connection
$conn = mysqli_connect($servername, $username, $password);

// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully";
?>
mysqli connect ->
create database and check query ->
// Create database
$sql = "CREATE DATABASE myDB";
if ($conn->query($sql) === TRUE) {
  echo "Database created successfully";
} else {
  echo "Error creating database: " . $conn->error;
}

$conn->close();
create database and check query ->
create table->
CREATE TABLE MyGuests (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
firstname VARCHAR(30) NOT NULL,
lastname VARCHAR(30) NOT NULL,
email VARCHAR(50),
reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)
create table->
Insert query ->
INSERT INTO table_name (column1, column2, column3,...)
VALUES (value1, value2, value3,...)
Insert query and select last insert id ->
$sql = "INSERT INTO MyGuests (firstname, lastname, email)
VALUES ('John', 'Doe', 'john@example.com')";

if ($conn->query($sql) === TRUE) {
  $last_id = $conn->insert_id;
  echo "New record created successfully. Last inserted ID is: " . $last_id;
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}
Insert query and select last insert id ->
insert myltiple query ->
$sql = "INSERT INTO MyGuests (firstname, lastname, email)
VALUES ('John', 'Doe', 'john@example.com');";
$sql .= "INSERT INTO MyGuests (firstname, lastname, email)
VALUES ('Mary', 'Moe', 'mary@example.com');";
$sql .= "INSERT INTO MyGuests (firstname, lastname, email)
VALUES ('Julie', 'Dooley', 'julie@example.com')";

if (mysqli_multi_query($conn, $sql)) {
  echo "New records created successfully";
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}
insert myltiple query ->
mysqli select data ->

$sql = "SELECT id, firstname, lastname FROM MyGuests";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
  }
} else {
  echo "0 results";
}
mysqli select data -> for return variable $row = $result->fetch_all(MYSQLI_ASSOC);

Customize handling for PHP errors by throwing an ErrorException on any E_NOTICE or E_WARNING.
function errHandle($errNo, $errStr, $errFile, $errLine) {
    $msg = "$errStr in $errFile on line $errLine";
    if ($errNo == E_NOTICE || $errNo == E_WARNING) {
        throw new ErrorException($msg, $errNo);
    } else {
        echo $msg;
    }
}
set_error_handler('errHandle');

sql join using sql query with php programing
Inner join, left join, right join
Inner join -> Select all records form left table and matching recors from right table
left join -> Return all records from left table and matching record from the right table
Right join -> The right join keyword return all records from the right table and matching records from the left table


Foreighn key and on DELETE CASCADE
CREATE TABLE IF NOT EXISTS (
FOREIGN KEY(student_id) REFERENCES student(student_id) on DELETE CASCADE)

PHP errors can occure during web development and understanding their types is essential for troubleshooting and improving code quality.
php in common four errors types-:
Parse error : (sytax errors)-> These errors occure due to mistakes in the source code.
Fatal error: It is the type of error where php compiler understand the php code but it recognizes an undeclared function.
Warinig error-> The main reason of warning errors are including a missing file.
Notice errors-> It is similar to warning error. It means that the program contains something wrong but it allows the execution of script.

In php when a script encounters a parse error it immediately stops execution, however if you want to handle execution and continue execution you can use try catch blocks, also fatal error,

In php Notice and warnings are non-fatal errors that allows the script to continue executing.

Define and register a custom error handler using (set_error_handler).



Both json and xml can be used to receive data from a web server. 
JSON USING PHP AND JAVASCRIPT
JSON stand for javaScript Object Notation, Json is a lightweight format for storing and transporting data. json is self-describing and easy to understand.
syntax-> Data is in name/value pairs, Data is separated by commas, Curly braces hold objects, Square brackets hold array, 

The json format is syntactically identical to the code for creating javascript objects, because this similarity a javaScript program can easily convert json data into native javascript.

A common use of json is to read data from a web server and display the data in a web page.
Json is language independent. 
JSON.parse() is use to convert the string into a javascript object. 

JSON.stringify() -> Convert a javaScript object into a string.
if you have already a object such as $obj = {"name":"jhon", "city":"london"};
$myjson = JSON.stingify($obj); -> this function is use to send information to a server as a json type data;

In json values must be one of the following data types -> string, array, number, object, Boolean, null.
The file type for json files is ".json" , The mime type for json text is "application/json" .

for loop and for in loop
exa ->
let text = "";
for(let x in myObj){
  text += x +"," ;
}

php is a server side programing language and can be used to access a database. When sending data to the server, it is often best to use the HTTP POST method. and the data sent to the server must now be an argument to the send() method.

xmlhttp.open("POST", "JSON_demo_db_post.php");
xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencode");
xmlhttp.send("x="+dbParam);

The file from the data a file get as client have statement first -> header("Content-Type: application/json;charset=utf-8");
JSONP is a method for sending JSON data without warrying about cross-domain issues JSONP does not use the XMLHttpRequest oject, JSONP use the <script> tag instead requesting a file from another domain can cause problems, due to cross-domain policy.
JSONP uses this advantage and request files using the script tag instead of the XMLHttpRequest object.
exa -> <script scrc = "demo_json.php">

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

The symbol of "phi" and "phase" symbol 
As php relies on a server the real-time location can't be provided. Only a static location can be provided. But there is a need to post the javscript data to php so  that it can easily be accessible to a program on the server.
An ip address gives you a quite unreliable location. To find current location is visit the google cloud console.

Modularity in oop is achieves through classes and objects. classes=> Blueprint for creating objects they define properties (attributes) and methods (functions).
Objects=> Instances of classes. They bundle data and behavior together.

Oop promotes better code organization reusability and scalability.


