<h2>Template.php</h2>

The Template Class is used to render the files which are passed to Template objects as file paths.

FYI(For your Info):
There are two types of paths in PHP, directory paths and file paths. File paths are the paths pointing to files, directory paths are the paths pointing to the folders.

`$templatePath` is a file path. 

*$templatePath* stores the file paths(locations of files).

*$args* is an array, which stores the run-time data members passed to the Template Object.

#### *__construct($templatePath)*

*__construct($templatePath)* function takes the file path passed at the time of object creation and stores it in the *$templatePath* data member of the Template Class. 

*__set($key, $value)*  and *__get($key)* are magic functions used to store and retrieve run-time data members into corresponding class Objects. 

#### *__set($key, $value)*

When the Template Object, for example, the *$indexTemplate*, added an RTDM(Run Time Data member) called *title*, by the statement:

```php
$indexTemplate->title = "VRMS";
```

here, the *$indexTemplate* passes two values, $key and $value to the **__set()** function as, $key(value as "title") and $value(value as "VRMS").

Then the **__set()** appends this "title" RTDM as a key-value pair inside the *$args* array.

#### *__get($key)*

When any RTDM is referenced from any of the Template Rendered file, for example here, in the [lander.html](../../public/lander.html), we called the *$title* RTDM. 

This fires a request to the *$indexTemplate* to retrieve the value of "title" key from *$args*, which passes $key(value as "title") to the **__get()** function. 

The *__get()* function returns the value from *$args* array by retrieving it through the statement:

```php
return $this->args[$key];
```

#### *__toString()*

This magic method is called when we `echo` the Template object. For example, in "index.php", we echoed the `$indexTemplate`, which calls this method. 

the `extract()` function is used to convert all key value pairs into actual variables with values.

For Example:

suppose if the $args array look like this, 

```php
$args = array("title" => "VRMS", "user" => "Richard Brooks");
```

then, the `extract($this->args)` extracts the key value pairs into individual variables inside the scope of *__toString()* method, like this:

```php
$title = "VRMS";
$user = "Richard Brooks";
```

You can use `$title` or `$user` like usual PHP variables, but only inside the scope of *__toString()* method. 

`chdir()` function is used to change the directory to the directory path specified as the parameter for the function, in our case, the `$templatePath` 's directory path. To find out the directory path we use the function `dirname()`, which returns the directory path from the file path in our case from the `$templatePath`. And then it changes the directory.

`ob_start()` function is used to start display buffer. Display buffer is a container which displays the content inside the `$templatePath` file along with everything we extracted inside the `__toString()` function.

 Then,

```php
include basename($this->templatePath);
```

the `basename()` function returns just the name of the file from the specified file path. For example, our file path was,

```php+HTML
SITE_PATH."public/lander.html"
```

So, `basename($this->templatePath)` returns `lander.html` as the file name.

Since, we changed the directory to the corresponding file's directory using `chdir()`, we just need to use the name of the file to get it included in the PHP Script.

So by this statement, we includes the file in `$templatePath`  into the Display Buffer of the corresponding Template Object, for example, here, in the `$indexTemplate` Object's Display Buffer we included the [lander.html](../../public/lander.html) file. 

Now,

```php
return ob_get_clean();
```

`ob_get_clean()` method retrieves the contents in [lander.html](../../public/lander.html) and cleans the output buffer and returns those contents to the Template Object, so that, the `echo` can print Template Object, in our case, `$indexTemplate`. Here at this point, the Template Objects are considered as normal PHP Strings, because output buffers are "encoded strings".

This is just an example definition, for which I used `$indexTemplate` in [index.php](../../index.php). You can use this Template Class for other PHP pages also. For another example, check [home-route.php](../../public/default/home-route.php). 