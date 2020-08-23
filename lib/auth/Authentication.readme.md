## Authentication.php

This Authentication class is used to make Authorization processes, such as Login, Register, etc., at ease. It has only one private data member, the `$dbo`, which is the [Database Class](../dbconnect/Database.php) Object.

The `$dbo` is initialized inside the `__construct()` method.

```php
$this->dbo = new Database();
```

And all else functions, you can refer to and understand. Read the [Database Readme](../dbconnect/Database.readme.md) for more details.