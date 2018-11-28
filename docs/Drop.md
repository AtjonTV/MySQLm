# Drop

**Function drop()**:

The drop method can be used to drop Databases or Tables.

The function requieres the full SQL-Query without the `DROP` keyword.

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
$msql->drop($b);
```

**Table**

Structure:

```json
{
  "type":"table",
  "name":"Users"
}
```

Excemple:

```php
$d = array (
  'type' => 'table',
  'name' => 'Users',
);
$msql->drop($b);
```