# Changelog

`+` = Added, `-` = Removed, `~` = Changed

***

# Version 1.5.x

## v1.5.0
`+` Added Extension Check Fucntion

`~` Changed all Connection Functions to use the Extension Check

***

# Version 1.4.x

## v1.4.9
`+` Added Default Charset

`~` Splitted Query Function:
>`+` Added Function for Stored Querys

>`+` Added Function for non Stored Querys

## v1.4.8
`~` Added/Changed Charset integration for Charset in Reconnect | [Bugfix 7](https://atvg-studios.mantishub.io/view.php?id=7)

`+` Added Connection check in close Connection | [Bugfix 8](https://atvg-studios.mantishub.io/view.php?id=8)

## v1.4.7
Fixed [Bugfix 4](https://atvg-studios.mantishub.io/view.php?id=4)
>`+` Added Function to set Charset

>`~` Final Charset integration

Fixed [Bugfix 3](https://atvg-studios.mantishub.io/view.php?id=3)
>`+` Added Function to Trim and Escape Strings

Fixed [Bugfix 6](https://atvg-studios.mantishub.io/view.php?id=6)
>`+` Added Function to get Information about Client and Server

>`+` Added Function to get Version from Client and Server

## v1.4.6
`+` Added Connection Checks

`~` Added/Chaged Charset integration in __construct

## v1.4.5
`~` Changed the second return type check

## v1.4.4
`+` Added Versioning in the Code

`+` Added Charset selection

### v1.4.3 (Not Existend)

## v1.4.2
`+` Added Function for Escaping Strings to top SQL Injections

## v1.4.1
`~` Execute Select
>`~` Input Check

>`~` Return Type Check

`+` Added Return Type Enum Class

## v1.4.0
`+` Added Command Begin to query functions
>executeQuery

>executeDrop

>executeInsert

>executeSelect

>executeUpdate

***

# Version 1.3.x

### v1.3.9 (Not Existend)

## v1.3.8
Release with the new Internal Error System

## v1.3.7
`-` Removed Internal Error from Value Check

`+` Added Internal Error to connect ndb

`+` Added Internal Error to execute drop

## v1.3.6
`+` Added Function getLastInternalError

`+` Added Variable lastInternalError

`~` Changed many Functions to use lastInternalError

## v1.3.5
`+` Function: connect_ndb();

`+` Function: selectDatabase();

`+` Function: executeCreate();

`+` Function: executeUse();

`~` Constructor:
>`+` Added saving of Connection data

>`+` Added Input check

>`+` Added Error Throw on connection fail

>`+` Added check for empty input


`~` Error Throw:
>`~` Changed dispose Function call to close connection

`~` Dispose:
>`+` Added Input check

`~` Execute Query:
>`~` Changed Throw error call for no success

`~` Execute Select:
>`+` Added Input check

>`+` Added Throw error call for closed connection

>`~` Changed Throw error call for no success

`~` Execute Insert:
>`+` Added Input check

>`+` Added Throw error call for closed connection

>`~` Changed Throw error call for no success

`~` Execute Delete:
>`+` Added Input check

>`+` Added Throw error call for closed connection

>`~` Changed Throw error call for no success

`~` Execute Drop:
>`+` Added Input check

>`+` Added Throw error call for closed connection

>`~` Changed Throw error call for no success

## v1.3.4
`~` Changed Version notation

Some Test were made with this version.

## v1.3.3
`~` Fixed wrong function call

## v1.3.2
`+` Value Check Function

`~` Added Value Check Function call to all Functions

## v1.3.1
`+` Check to only execute querrys on open connections

`+` Added Error Throws when connection is closed

### v1.3.0 (Not Existend)

***

# Version 1.2.0

## v1.2.0
MySQLm is now going Public 😃