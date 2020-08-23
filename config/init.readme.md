## Init.php

The init.php file is like the **Engine Start Button** or **Key** of a car, for our project. Because, this is what initiates the starting process of our project, which is the [index.php](../index.php). 

Here what we does is, includes the [config.php](config.php) file. And then we developed an Auto Class Loading Script, so that, whenever a Class is referenced all over in our project's run time environment, the class will be automatically included into the Run time, if it is not included before. Don't confuse with `require` and `include` methods here, I just used it contextually, nothing like **code-wise**😂. Remember, there is no order for function definitions in PHP. Any function declared anywhere in a PHP file can be called from anywhere in the Runtime if the file is included. **Always make sure the class name and the class file name are Same. For example, if class file name is "Template.php", then class name should be "Template"**.

####  *autoClassLoader($className)*

`$scandir()` method returns the list of Sub Directory Paths under the passed Directory path. Then it passes the `$subdirs` to the `retrieveDir()` function with `currentPath` (  $_SERVER['DOCUMENT_ROOT'] . '/lib' ) and the `$className`. 

```php
retrieveDir($subdirs, $_SERVER['DOCUMENT_ROOT'] . '/lib', $className);
```

This `$className` is passed to the `autoClassLoader()` function by the `spl_autoload_register('autoClassLoader')`. The `spl_autoload_register()` method adds the `autoClassLoader()` function to the autoloader register of PHP Runtime. So, when a class is referenced, it passes the class name to the `spl_autoload_register()`, which passes the same to the `autoClassLoader()`.

#### *retrieveDir($dirs, $currentPath, $className)*

This is a recursive function, from which the initial call is made from the function `autoClassLoader()` defined after this method. At first, the `foreach` checks for the directories which are "." and "..", that means, "current directory" and  "previous directory" respectively. If we don't check this, the recursive function will run indefinitely, because, every directory is a "current directory" to itself. So, if "." or ".." are found, the recursive call will not be made, instead the `foreach` will continue to next iteration. 

`$newPath` - appends the next Directory path or File path to the `$currentPath`.

`is_dir()` function checks if the `$newPath` is a directory path. If not, then the only option is it must be a file path. Hence, if the `$newPath` is a directory, then, recursive call to `retrieveDir()` is made with new `$subdirs` (Which are the sub directory paths under the current directory path `$newPath`, if it is a Directory Path) and `currentPath` as the `$newPath`, and `$className`.

For example, if the `$className` is "Template":

```
Stage 1
Current path: C:/xampp/htdocs/vrms/lib
calls scandir()
New Path: C:/xampp/htdocs/vrms/lib/auth
check is_dir() - TRUE
calls scandir()
recursive call to retrieveDir() with New Path as the argument.
Stage 2
Current path: C:/xampp/htdocs/vrms/lib/auth
New Path: C:/xampp/htdocs/vrms/lib/auth/Authentication.php
check is_dir() - FALSE, means it is a file.
checks if its name is "Template" - False, skip including it.
Stage 3
Current Path: C:/xampp/htdocs/vrms/lib/utility
New Path: C:/xampp/htdocs/vrms/lib/utility/Template.php
check is_dir() - FALSE, means it is a file.
checks if its name is "Template" - TRUE, includes it.
```

if `$newPath` is not a Directory Path, then it must be a File Path. In that case, we call the requireClass() method mentioned below.

#### *requireClass($classFile, $className)*

`$classFile` - File Path

`$className` - Name of the class

This function is used to include a referred class file from its class name. The `class_exists()` method checks if the class is already added or not into the PHP runtime.  `basename()` method returns the name of the files, from the file path. 

```php
basename($classFile, ".php")
```

This removes the trailing ".php" from the `$classFile`, and returns just the name.

For example, suppose, 

```php
Class File - /opt/lampp/htdocs/vrms/lib/utility/Template.php

Base Name of Class - Template // which is retrieved from Class File using basename() method.

Class Name - Template // Passed when a Class is Referenced
```

`require_once()` includes the class to the Run time.

