# Update

**Function update()**:

The update method can be used to update in Tables.

The function requieres the full SQL-Query without the `UPDATE` keyword.

Structure:

```json
{
  "table":"Users",
  "rows":{
    "email":"admin.atjontv@atvg-studios.at"
  },
  "where":[
    {
      "type":"or",
      "id":0,
      "email":"adm1n.atjontv@atvg-studios.at"
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
    'email' => 'admin.atjontv@atvg-studios.at',
  ),
  'where' =>
  array (
    0 => 
    array (
      'type' => 'or',
      'id' => 0,
      'email' => 'adm1n.atjontv@atvg-studios.at',
    ),
  ),
);
$msql->update($b);
```