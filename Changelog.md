# Changelog

`+` = Added, `-` = Removed, `~` = Changed

***

## Un-Released (In Development)

### v1.6.0  
`~` Added new Framework: MySQLm in version 1.6.0

***

## Version 1.6.x

## Version 1.5.x

### v1.5.8
[30.06.2018]  
`+` Account Registration
`+` Custom UserAgent
`~` Updates now run from GitLab

### v1.5.7
[01.05.2018]  
`+` Unsafe Query Execution (UQE)  
`+` Default charset param

### v1.5.6
[14.12.2017]  
`+` Added echo loggin for Updating  
`~` Beautifyed update test

### v1.5.5
[12.12.2017]  
`+` Added API Auth for more than 60 Requests from one pc (Usefull if the Update check is called on multiple sites)

[The Key only gives access to public user info, public repo info and public gists (Same rights as on the Github site without beeing logged in)]

### v1.5.4
[12.12.2017]  
`~` Changed CheckForUpdate Function  
`+` Added New Update System
>`+` Added Auto Update Function  
>`+` Added Update Available Test Function  
>`+` Added Make Update Function  
>`+` Added Internal Function for cURL Github API Requests

Made [Bugfix 6](http://bugtracker.atvg-studios.at/view.php?id=6)
>`-` Removed Password Empty Check from every Connection Function

`+` Added 'php-zip' to extension check

[Moved Query Test]  
[Created Updating Test]

### v1.5.3 
[10.12.2017]  
`~` Changed Extension check
>`+` Added 'Curl'  
>`+` Added Connection Check  
>`~` Changed Error Message for MySQLi


### v1.5.2
[10.12.2017]  
`+` Added Input Check for execute Query

`+` Added Function to execute a Query multiple times

`~` Versioning
>`+` Added extra Version variable  
>`+` Added Version Check with link for a new Version  
>`~` Changed the way how the version Function returns the Version

### v1.5.1 (Security Patch)
[10.12.2017]  
Made [Bugfix 5](http://bugtracker.atvg-studios.at/view.php?id=5)
>`+` Added Escape String Trim Function call to all Query Functions to prevent SQL Injection by default

### v1.5.0
[10.12.2017]  
`+` Added Extension Check Fucntion

`~` Changed all Connection Functions to use the Extension Check

***

## Version 1.4.x

### v1.4.9
[03.12.2017]  
`+` Added Default Charset

`~` Splitted Query Function:
>`+` Added Function for Stored Querys  
>`+` Added Function for non Stored Querys

### v1.4.8
[30.11.2017]  
Made [Bugfix 7](https://atvg-studios.mantishub.io/view.php?id=7)
>`~` Added/Changed Charset integration for Charset in Reconnect

Made [Bugfix 8](https://atvg-studios.mantishub.io/view.php?id=8)
>`+` Added Connection check in close Connection

### v1.4.7
[27.11.2017]  
Made [Bugfix 3](https://atvg-studios.mantishub.io/view.php?id=3)
>`+` Added Function to Trim and Escape Strings

Made [Bugfix 4](https://atvg-studios.mantishub.io/view.php?id=4)
>`+` Added Function to set Charset  
>`~` Final Charset integration

Made [Bugfix 5](https://atvg-studios.mantishub.io/view.php?id=5) and [Bugfix 6](https://atvg-studios.mantishub.io/view.php?id=6)
>`+` Added Function to get Information about Client and Server  
>`+` Added Function to get Version from Client and Server

### v1.4.6
[27.11.2017]  
`+` Added Connection Checks

`~` Added/Chaged Charset integration in __construct

### v1.4.5
[15.11.2017]  
`~` Changed the second return type check

### v1.4.4
[14.11.2017]  
`+` Added Versioning in the Code

`+` Added Charset selection

#### v1.4.3 (Not Existend)

### v1.4.2
[10.11.2017]  
`+` Added Function for Escaping Strings to top SQL Injections

### v1.4.1
[09.11.2017]  
`~` Execute Select
>`~` Input Check  
>`~` Return Type Check

`+` Added Return Type Enum Class

### v1.4.0
[03.11.2017]  
`+` Added Command Begin to query functions
>executeQuery  
>executeDrop  
>executeInsert  
>executeSelect  
>executeUpdate

***

## Version 1.3.x

#### v1.3.9 (Not Existend)

### v1.3.8
[27.10.2017]  
Release with the new Internal Error System

### v1.3.7
[25.10.2017]  
`-` Removed Internal Error from Value Check

`+` Added Internal Error to connect ndb

`+` Added Internal Error to execute drop

### v1.3.6
[25.10.2017]  
`+` Added Function getLastInternalError

`+` Added Variable lastInternalError

`~` Changed many Functions to use lastInternalError

### v1.3.5
[24.10.2017]  
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

### v1.3.4
[24.10.2017]  
`~` Changed Version notation

Some Test were made with this version.

### v1.3.3
[24.10.2017]  
`~` Fixed wrong function call

### v1.3.2
[24.10.2017]  
`+` Value Check Function

`~` Added Value Check Function call to all Functions

### v1.3.1
[24.10.2017]  
`+` Check to only execute querrys on open connections

`+` Added Error Throws when connection is closed

#### v1.3.0 (Not Existend)

***

## Version 1.2.0

### v1.2.0
[23.10.2017]  
MySQLm is now going Public 😃