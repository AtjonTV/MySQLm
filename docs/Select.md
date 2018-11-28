# Select

**Function select()**:

The select method can be used to select from Tables.

The function requieres the full SQL-Query without the `SELECT` keyword.

Structure:

```json
{
  "table":"Users",
  "columns":[
    "*"
  ],
  "where":[
    {
      "type":"or",
      "id":0,
      "lastname":"Obernosterer"
    }
  ]
}
```

Excemple:

```php
$d = array (
  'table' => 'Users',
  'columns' => 
  array (
    0 => '*',
  ),
  'where' =>
  array (
    0 => 
    array (
      'type' => 'or',
      'id' => 0,
      'lastname' => 'Obernosterer',
    ),
  ),
);
$msql->select($b);
```