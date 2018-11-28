# Insert

**Function insert()**:

The insert method can be used to insert into Tables.

The function requieres the full SQL-Query without the `INSERT` keyword.

Structure:

```json
{
  "table":"Users",
  "rows":[
    {
      "firstname":"Thomas",
      "lastname":"Obernosterer",
      "email":"adm1n.atjontv@atvg-studios.at",
      "reg_date":"DEFAULT"
    }
  ]
}
```

Excemple:

```php
$d = array (
  'table' => 'Users',
  'rows' => 
  array (
    0 => 
    array (
      'firstname' => 'Thomas',
      'lastname' => 'Obernosterer',
      'email' => 'adm1n.atjontv@atvg-studios.at',
      'reg_date' => 'DEFAULT',
    ),
  ),
);
$msql->insert($b);
```

----

[Prior](Changeing-Database.md) - [Next](Select.md)