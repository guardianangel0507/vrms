## Database.php

The Database Class is the common center of All Database Operations in our project. We use PHP Data Objects or PDO's to enable Secure Database Connectivity and Management features. And of course, we are creating our own framework for the same.

```php
// DB Properties
private $db_host = DB_HOST; // From config.php
private $db_user = DB_USER; // From config.php
private $db_password = DB_PASS; // From config.php
private $db_name = DB_NAME; // From config.php

private $db_handler; // Database Handler
private $db_error; // A Variable to store Database Connection Errors 
private $db_stmt; // A Statement object used to execute queries
```

These are all the Database Properties, to initialize our PDO Database Connection.

Lets start explaining the methods.

#### *__construct()*

Every PDO connection requires a Data Source Name, which is the details about our database host (in our case, `localhost)` and database name(`db_vrms`). Though, we already defined these data as PHP Constants inside the [config.php](../../config/config.php). And then, these constants are used to initialize the Database Properties of Database Class.

```php
$dsn = "mysql:host=" . $this->db_host . ";dbname=" . $this->db_name;
```

This `$dsn` is a string which stores the above mentioned data. The format is like,

`"mysql:host=localhost;dbname=db_vrms"`.

Next is the PDO Options, which are the configurations we are setting for our PDO Connection. Google about PDO to know more.

Everything coming after `PDO::` are the data members of PDO Class. Google about each of the Options and find out yourself, the uses of them.

Then we create our PDO Instance in the `db_handler`, by creating new PDO Object.

```php
$this->db_handler = new PDO($dsn, $this->db_user, $this->db_password, $options);
```

It returns a PDO Class Object to `$db_handler`. Now `db_handler` can access all the methods of PDO Class.

#### *query($query)*

The `query()` is the method name, and `$query` is the variable name, which contains an SQL Query String. The `prepare()` method of `db_handler` is used to prepare the query with the Database by returning a statement object. The statement object is later used to execute SQL queries with the database and fetch data. When we pass the `$query` to `prepare()` method, it will create an Object with the `query` string and some parameters, which we'll discuss soon.

Let's see different types of examples of queries:

A) "SELECT * from tb_users where username = :username and password = :password" - SECURE way.

B) "SELECT * from tb_users where username = $username and password = $password" - INSECURE way.

We should be going with the first type. You can use the second one if there is not much security concern in any queries.

I hope, you got a "HOW" doubt with the method (A). Read the following to clear it out.

####  *bind($param, $value, $type = null)*

The `bind()` method is what we use to insert the values into our query. In the method (A), `:username` and `:password` are called **placeholders**. The `bind()` method is used to find out the datatype of the value we are passing to the query, and put it in the place of the **placeholders**. 

The `cleanData()` method is a private function declared inside Database Class, inorder to prevent security threats through SQL Injection. We don't need to go deep into that, though, if you are interested, please do😂. About `cleanData()` method, we will discuss below.

Then comes the `bindValue()` method, which takes three parameters, `$param, $value, $type`. 

`$param` - the placeholder, in our example, `:username` and `:password`.

`$value` - the value we need to put in to the query, that is the variable which holds the data. in our example, `$username` and `$password`.

`$type` - The datatype of the variable or `$value`, which we found out using the `switch` statement just above. By default it will be of String Type.

The `bindValue()` method puts these `$value` in the place of `$param` (placeholder) within the query with it's datatype. Remember, it is a builtin method of the PDO Statement Class. You can google it to find more about.

#### *execute()*

this function is used to call the PDO Statement Object's `execute()` method. No Big Deal😉.

#### *fetchMultipleResults()*

This function calls the `execute()` method, which returns references to the `db_stmt`, and then we call the `fetchAll()` method of the PDO Statement Class, to fetch multiple result sets. I said before, Google for everything starts with `PDO::`.

#### *fetchSingleResult()*

This function calls the `execute()` method, which returns references to the `db_stmt`, and then we call the `fetch()` method of the PDO Statement Class, to fetch Single result set.

`PDO::FETCH_OBJ` is used to fetch data from Database as PDO Standard Class Objects, i.e, Indexed Data Objects.

#### *cleanData($data)*

This method takes any variable passed to it, and checks the integrity of the variable. That is, this method converts the data to be best suitable for Database Operations. 

The `stripslashes()` method and `htmlspecialchars()` method are used for this conversion. Google about them to know more.