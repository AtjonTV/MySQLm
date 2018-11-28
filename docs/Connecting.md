# Connecting to a Server

**Constructor**:

The Constructor can be used to directly connect to a Database-Sever when creating the MySQLm object.

There are a view default values:

* Port: 3306
* Charset: utf8

Structure:

```json
{
  "host":"localhost",
  "port":3306,
  "user":"testing",
  "password":"testing",
  "database":"testing_db",
  "charset":"utf8"
}
```

Excemple:

```php
$d = array (
  'host' => 'localhost',
  'port' => 3306,
  'user' => 'testing',
  'password' => 'testing',
  'database' => 'testing_db',
  'charset' => 'utf8',
);
$msql = new MySQLm($b);
```

***

**Function connect()**:

The Connect method can be used to change to a different Database-Server on an existing object.

There are a view default values:

* Port: 3306
* Charset: utf-8

Structure:

```json
{
  "host":"localhost",
  "port":3306,
  "user":"testing",
  "password":"testing",
  "database":"testing_db",
  "charset":"utf8"
}
```

Excemple:

```php
$d = array (
  'host' => 'localhost',
  'port' => 3306,
  'user' => 'testing',
  'password' => 'testing',
  'database' => 'testing_db',
  'charset' => 'utf8',
);
$msql = new MySQLm('');
$msql->connect($b);
```

***

**Function connect() - No DB**:

The Connect-NoDatabase method can be used to change to a different Database-SErver on an existing object without selecting a Database.

There are a view default values:

* Port: 3306
* Charset: utf-8

Structure:

```json
{
  "host":"localhost",
  "port":3306,
  "user":"testing",
  "password":"testing",
  "charset":"utf8"
}
```

Excemple:

```php
$d = array (
  'host' => 'localhost',
  'port' => 3306,
  'user' => 'testing',
  'password' => 'testing',
  'charset' => 'utf8',
);
$msql = new MySQLm('');
$msql->connect($b);
```
