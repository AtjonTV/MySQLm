# About MySQLm 2
MySQLm 2 is an 'Library' made to be used to connect to a MySQL Server.  
MySQLm 2 is made with OOP (Object Oriented Programming) and used MySQLi [OOP]  
MySQLm 2 uses a JSON interface called SQJ (Structured Query JSON) which is defined by the SQJ-Definition by ATVG-Studios

The newest version of MySQLm is **[2.0.0](https://gitlab.atvg-studios.at/root/MySQLm/tags/v2.0.0)** Released on **XX XXXX 2019**

Development branch:  
`https://gitlab.atvg-studios.at/root/MySQLm/tree/dev-2.0`

Release Build:  
`https://gitlab.atvg-studios.at/root/MySQLm/`

# Deprection and Game-Breaker Warning

### Deprecation

With the upcomming release 2.0 we will mark all version of 1.x as deprecated.

Most of the 1.x releases will be fully deprecated. Only the versions following in 1.5.1x will be considered as `Legacy` version and still be supporeted and updated to some extend. (Current Legacy versions would be: 1.5.10 and 1.5.11)

Version 1.x will not experiance a new minor release like 1.6! New features might get inplemented in 1.5.1x depending on if they do not break any compatibility.

Also version 1.x will follow the [LTS cycle](https://wiki.osmium.software/index.php/Software_Support_Cycles) and fully deprecate with 22nd October 2020, Version 2.0 will follow the [LTS cycle](https://wiki.osmium.software/index.php/Software_Support_Cycles) too and may also get the [LTS+ cycle](https://wiki.osmium.software/index.php/Software_Support_Cycles).

### Game-Breaker

Version 2.0 will fully break any software using MySQLm 1.x!

To integrate version 2.0 into any software using 1.x, the switch should be slowly integrate in a seperate development branch of your software.

# Versioning

With the release of 2.0 we will start to use [Semantic Versioning](https://semver.org/).

Version 1.5.x will be kept in the old versioning format where only the patch version will be increaced even on minor changes. (Major changes will not be integrated in the 1.5.x version)

Our fomat: MAJOR.MINOR.PATCH-TYPE+RELEASE

* Major = Major as defined in SemVer
* Minor = Minor as defined in SemVer
* Patch = Patch as defined in SemVer
* Type  = Release Type (defined as Pre-Release in SemVer)
* Release = Release number, this will be increaced on each release and wont be reset (Defined like Build in SemVer) [Release is required to be unique]

Example: 2.0.0+1
Exanole: 2.0.1+2
Example: 2.0.2+3
Exanole: 2.0.3+4

*The lastest version of 1.x in this versioning*: 1.5.11+30

# Report Bugs or Wishes  
You can Report Bugs or add Wishes on our Bugtracker Site:  

[Issues](https://gitlab.atvg-studios.at/root/MySQLm/issues)

# How to use MySQLm?
See the [Wiki](https://gitlab.atvg-studios.at/root/MySQLm/wikis/home)

# License
This Software is Licensed under ATVG-Studios's OSPL 1.4 or later [ http://www.ospl.atvg-studios.at/ ]

Copyright holder is ATVG-Studios, Copyright 2015-2018 ATVG-Studios

All Contributers dismiss thair Copyright by commiting to this project, the copyright will be given to ATVG-Studios.

# What is OSPL? Show it to me, so i can ignore it.
OSPL v1 (Open Source Project License Version 1.4, Revision 6 by ATVG-Studios)

Copyright (c) 2015-2019 Thomas Obernosterer (ATVG-Studios)

Permission is hereby granted to any person
obtaining a copy of this software and associated documentation
files (the "Software"), to deal in the Software without limitation,
the rights to use, copy, modify, merge, publish, distribute
and sublicense the Software and to permit persons to whom the
Software is furnished to do so, subject to the following conditions
and limitations:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

This Software may not be used in the context of a commerciall product.
The Copyright holder themselfs insist on the right to commercially use
this software in any context.
Also the Copyright holder insist on the right to trademark or patent this Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE. 

[This License was Copied from its original website: https://ospl.atvg-studios.at]
