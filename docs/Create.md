# Create

**Function create()**:

The create method can be used to create Databases and Tables.

The function requieres the full SQL-Query without the `CREATE` keyword.

**Database**

Structure:

```json
{
  "type":"database",
  "name":"MyApp"
}
```

Excemple:

```php
$d = array (
  'type' => 'database',
  'name' => 'MyApp',
);
$msql->create($b);
```

**Table**

Structure:

```json
{
  "type":"table",
  "name":"Users",
  "columns":{
    "id":"INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY",
    "firstname":"VARCHAR(30) NOT NULL",
    "lastname":"VARCHAR(30) NOT NULL",
    "email":"VARCHAR(50)",
    "reg_date":"DATETIME"
  }
}
```

Excemple:

```php
$d = array (
  'type' => 'table',
  'name' => 'Users',
  'columns' => 
  array (
    'id' => 'INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY',
    'firstname' => 'VARCHAR(30) NOT NULL',
    'lastname' => 'VARCHAR(30) NOT NULL',
    'email' => 'VARCHAR(50)',
    'reg_date' => 'DATETIME',
  ),
);
$msql->create($b);
```