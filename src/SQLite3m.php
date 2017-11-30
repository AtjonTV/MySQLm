<?php
    /*
     *  Copyright 2015-2017 AtjonTV (Thomas Obernosterer)
     * 
     *  This is an OSPL Project
     *      OSPL is an License by ATVG-Studios: http://atvg-studios.at/OSPLv1.1
     * 
     *  Documentation of MySQLm can be found on http://Github.com/AtjonTV/MySQLm soon.
     */
    class SQLite3m # Version 1.0.3:27_11_2017
    {
        /* Private Variables */
        private $version = "1.0.3:27_11_2017";
        private $version_arr = array('major'=>1,'minor'=>0,'patch'=>3);
        private $connectionOpen = false;
        private $connection = null;
        private $connectionInfo = null;
        private $queryString = null;
        private $lastResult = null;
        private $lastInternalError = null;

        function __construct($sqlite_3_File)
        {
            $connection = new SQLite3($sqlite_3_File);
            $connectionOpen = true;
            $connectionInfo = array("DB_FILE"=>$sqlite_3_File);
        }

        function executeCreate($query)
        {
            $this->checkVars(array($query), "executeCreate($query)");
            if($this->connectionOpen)
            {
                $lresult = $this->connection->query('CREATE '.$query)
                    or $this->throwError("Error while querying the Database. [executeCreate($query);]", "x");
                return $lresult;
            }
            else
                $this->throwError("ERROR, the connection seams to be closed. Run connect() or reconnect() to make a connection", "x");
        }

        function executeSelect($query, $returnType)
        {
            trigger_error("Deprecated function called.", E_USER_NOTICE);
            $this->checkVars(array($query), "executeSelect($query)");
            if($this->connectionOpen)
            {
                $lresult = $this->connection->query("SELECT ".$query)
                    or $this->throwError("Error while querying the Database. [executeSelect($query, $returnType);]", "x");
                
                if($returnType == E_ReturnType::TWODIMENSIONAL_ARRAY || $returnType == E_ReturnType::TWO_D_ARRAY)
                {
                    $llresult = array();
                    while($res = $llresult->fatchArray())
                    {
                        array_push($llresult, $res);
                    }
                    $this->lastResult = $llresult;
                    return $this->lastResult;
                }
                else if ($returnType == E_ReturnType::SQLITE_TABLE)
                {
                    $this->lastResult = $lresult;
                    return $this->lastResult;
                }
            }
            else
                $this->throwError("ERROR, the connection seams to be closed. Run connect() or reconnect() to make a connection", "x");
        }

        function executeInsert($query)
        {
            $this->checkVars(array($query), "executeInsert($query)");
            if($this->connectionOpen)
            {
                $lresult = $this->connection->query('INSERT '.$query)
                    or $this->throwError("Error while querying the Database. [executeInsert($query);]", "x");
                return $lresult;
            }
            else
                $this->throwError("ERROR, the connection seams to be closed. Run connect() or reconnect() to make a connection", "x");
        }

        function executeUpdate($query)
        {
            $this->checkVars(array($query), "executeUpdate($query)");
            if($this->connectionOpen)
            {
                $lresult = $this->connection->query('UPDATE '.$query)
                    or $this->throwError("Error while querying the Database. [executeUpdate($query);]", "x");
                return $lresult;
            }
            else
                $this->throwError("ERROR, the connection seams to be closed. Run connect() or reconnect() to make a connection", "x");
        }

        function executeDelete($query)
        {
            $this->checkVars(array($query), "executeDelete($query)");
            if($this->connectionOpen)
            {
                $lresult = $this->connection->query('UPDATE '.$query)
                    or $this->throwError("Error while querying the Database. [executeDelete($query);]", "x");
                return $lresult;
            }
            else
                $this->throwError("ERROR, the connection seams to be closed. Run connect() or reconnect() to make a connection", "x");
        }

        function execute($query)
        {
            $this->checkVars(array($query), "execute($query)");
            if($this->connectionOpen)
            {
                $lresult = $this->connection->query($query)
                    or $this->throwError("Error while querying the Database. [execute($query);]", "x");
                return $lresult;
            }
            else
                $this->throwError("ERROR, the connection seams to be closed. Run connect() or reconnect() to make a connection", "x");
        }

        /* Return the version of the SQLite3 Manager */
        function getVersion($asString)
        {
            if($asString)
                return $this->version;
            else
                return $this->version_arr;
        }

        /* Return the version of SQLite3 */
        function getSQLiteVersion()
        {
            return SQLite3::version();
        }
    }

    abstract class E_ReturnType
    {
        const MYSQL_TABLE = 1;
        const SQLITE_TABLE = 2;
        const TWODIMENSIONAL_ARRAY = 3;
        const TWO_D_ARRAY = 3;
    }
?>