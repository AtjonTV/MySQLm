# Delete

**Function delete()**:

The delete method can be used to delete from Databases or Tables.

The function requieres the full SQL-Query without the `DELETE` keyword.

Structure:

```json
{
  "table":"Users",
  "where":[
    {
      "type":"and",
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
  'where' => 
  array (
    0 => 
    array (
      'type' => 'and',
      'id' => 0,
      'lastname' => 'Obernosterer',
    ),
  ),
);
$msql->delete($b);
```