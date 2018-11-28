# Changing the Database

**Function use()**:

The use method can be used to change the currently selected database.

The method makes a SQL-Query to the database with the `USE` command.

Structure:

1. Database
2. Allow UnsafeQueryExecution

Example:

```php
// Example with escapecharacters denyed
$msql->use('database');
$msql->use('database', false);

// Example with escapecharacters allowed
$msql->use('database', true);
```

SQL-Query:

```SQL
USE 'database';
```