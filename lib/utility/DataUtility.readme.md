## DataUtility.php

The DataUtility class can be used to perform Data Operations on Php Array Objects.

The *__construct()* function is just for loggin the information to the console window.

Also, make sure that every functions that are called outside a Class are declared public. If not, they won't be accessible outside of the class, even if we use the class object.

#### *extractData($data, $attribute)*

This function is used to retrieve a specific dataset from a PDO(PHP Data Object) Array. We'll discuss more about PDO in [Database Readme](../dbconnect/Database.readme.md) file. Google about PDO though, there is a lot of things you should know.

`$data` is the PDO array of collection of different attributes and data which we need to extract data for a specific attribute only, which is specified in `$attribute`.

For a practical example, you can run [tester.php](../../temp/tester.php) by passing it's location to the `$indexTemplate`. Before that ensure there is enough data in Database(Insert users manually through phpmyadmin).

The process taking place here is that, when we call the `getUserTypes()` function of class [Authentication](../auth/Authentication.php) it returns a PDO Array with data which we need and we dont need. So, what we does is extract the data which we need only. 

In this example, the PDO Array is stored inside `$usertypesData`. This PDO Array is passed to the `extractData()` function by the function call below, to retrieve just the *user types*. 

```php
$userTypes = $dtu->extractData($userTypeData, "userType");
```

`extractData()` returns an associative array with the data about the attribute we specified. It will look like this.

```
Before extraction:
Array ( [0] => stdClass Object ( [userType] => manufacturer ) [1] => stdClass Object ( [userType] => dealer ) )
After extraction:
Array ( [userType_1] => manufacturer [userType_2] => dealer )
```

##### Explanation of Process

`$dataArray` is the instantaneous array we create to retreive and store data from PDO.

A PDO is a collection of Indexed Standard Class Data Objects, in which each Indexed Data Object is another array of Data Objects with Key Names. So, we used `foreach` to iterate through each Indexed Objects. 

In `array_key_exists($attribute, $dt))`, the attribute is the name of the attribute from the Database Tables. And `$dt` is the Indexed Object. We iterate through each indexed object, and extract the attribute from each indexed object.

In our example, `$attribute` is "userType", which is the attribute name from our tb_users table. Then,

```php
$dataArray[$attribute . "_" . $i++] = $dt->$attribute;
```

This statement appends new item to the `$dataArray` under the key name, `$attribute . "_" . $i++`, check the example above for reference. `$dt->$attribute`, as I said, `$dt` is a Data Object. `$attribute` is the attribute name we passed to the `extractData()` function, which will be the key inside `$dt`.

At last, after traversing all Indexed Data Objects, the runtime exits the `foreach`. And then, we return the `$dataArray`.