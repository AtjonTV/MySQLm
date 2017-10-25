<?php
    class MySQLm # Version 1.3.6:24_10_2017
    {
        /* Private Variables */
        private $connectionOpen = false;
        private $connectionInfo = null;
        private $connection = null;
        private $queryString = null;
        private $lastResult = null;
        private $lastInternalError = null;

        /* Constructor for the Object to directly open a connection */
        function __construct($host, $port, $user, $pass, $db) 
        {
            if(empty($host)&&empty($port)&&empty($user)&&empty($pass)&&empty($db))
            {
                $this->lastInternalError = "at __construct: NO ARGUMENTS GIVEN, CONNECTION LESS OBJECT.";
            }
            else{
                $this->checkVars(array($host, $port, $user, $pass, $db), "__construct($host, $port, $user, $pass, $db)");

                $this->connection = @new mysqli($host, $user, $pass, $db, $port);
                
                if($this->connection->connect_error)
                    $this->throwError("An Error Occured while opening a connection to the database: ".$this->connection->connect_error, "dispose");
    
                $this->connectionOpen = true;
                $this->connectionInfo = array(
                    "Host" => $host,
                    "User" => $user,
                    "Pass" => $pass,
                    "DaBa" => $db,
                    "Port" => $port
                );
            }
        }

        /* Function to open a connection */
        function connect($host, $port, $user, $pass, $db) 
        {
            $this->checkVars(array($host, $port, $user, $pass, $db), "connection($host, $port, $user, $pass, $db)");            

            $this->connection = @new mysqli($host, $user, $pass, $db, $port);
            
            if($this->connection->connect_error)
                $this->throwError("An Error Occured while opening a connection to the database: ".$this->connection->connect_error, "dispose");

            $this->connectionOpen = true;
            $this->connectionInfo = array(
                "Host" => $host,
                "User" => $user,
                "Pass" => $pass,
                "DaBa" => $db,
                "Port" => $port
            );
        }

        /* Function to select a Database */
        function connect_ndb($host, $port, $user, $pass)
        {
            $this->checkVars(array($host, $port, $user, $pass), "connection($host, $port, $user, $pass)");            
            
            $this->connection = @new mysqli($host.':'.$port, $user, $pass);
            
            if($this->connection->connect_error)
                $this->throwError("An Error Occured while opening a connection to the database: ".$this->connection->connect_error, "dispose");

            $this->connectionOpen = true;
            $this->connectionInfo = array(
                "Host" => $host,
                "User" => $user,
                "Pass" => $pass,
                "DaBa" => "",
                "Port" => $port
            );
        }

        /* Function to select database */
        function selectDatabase($db)
        {
            $this->checkVars(array($db), "selectDatabase($db)");
            if($this->connectionOpen)
            {
                $lresult = $this->connection->query("USE $db;") or
                    $this->throwError("There was an error while selecting the database. [selectDatabase($db);] [".$this->connection->error."]", "");
                $this->connectionInfo["DaBa"] = $db;
                $this->lastResult = $lresult;
            }
            else
                $this->throwError("ERROR, the connection seams to be closed. Run connect() or reconnect() to make a connection", "x");
        }

        /* Function to close a connection */
        function closeConnection()
        {
            $this->connection->close();
            $this->connectionOpen = false;
        }

        /* Recreates the connection with the last given connection string */
        function reconnect()
        {
            $this->dispose("without", "connectionInfo");
            $this->connection = @new mysqli($this->connectionInfo["Host"], $this->connectionInfo["User"], $this->connectionInfo["Pass"], $this->connectionInfo["DaBa"], $this->connectionInfo["Port"]);
            if($this->connection->connect_error)
                $this->throwError("An Error Occured while opening a connection to the database: ".$this->connection->connect_error, "dispose");
            $this->connectionOpen = true;
        }

        /* Set a QueryString to execute later */
        function setQueryString($query)
        {
            $this->checkVars(array($query), "setQueryString($query)");

            if($this->connectionOpen)
                $this->queryString;
            else
                $this->throwError("ERROR, the connection seams to be closed. Run connect() or reconnect() to make a connection", "x");
        }

        /* Execute stored query string */
        function executeQuery()
        {
            if($this->connectionOpen)
            {
                $lresult = $this->connection->query($this->queryString) 
                    or $this->throwError("There was an error while querying the database. [executeQuery($this->queryString);] [".$this->connection->error."]", "x");
                $this->lastResult = $lresult;
            }
            else
                $this->throwError("ERROR, the connection seams to be closed. Run connect() or reconnect() to make a connection", "x");
        }

        /* Execute query string */
        function executeCreate($query)
        {
            $this->checkVars(array($query), "executeCreate($query)");
            if($this->connectionOpen)
            {
                $lresult = $this->connection->query($query) or
                    $this->throwError("There was an error while querying the database. [executeCreate($query);] [".$this->connection->error."]", "");
                $this->lastResult = $lresult;
            }
            else
                $this->throwError("ERROR, the connection seams to be closed. Run connect() or reconnect() to make a connection", "x");
        }

        /* Execute query string */
        function executeUse($query)
        {
            $this->checkVars(array($query), "executeUse($query)");
            if($this->connectionOpen)
            {
                $lresult = $this->connection->query($query) or
                    $this->throwError("There was an error while querying the database. [executeUse($query);] [".$this->connection->error."]", "");
                $this->lastResult = $lresult;
            }
            else
                $this->throwError("ERROR, the connection seams to be closed. Run connect() or reconnect() to make a connection", "x");
        }

        /* Execute query string */
        function executeSelect($query, $returnType)
        {
            $this->checkVars(array($query, $returnType), "executeSelect($query, $returnType)");
            if($this->connectionOpen)
            {
                $lresult = $this->connection->query($query)
                    or $this->throwError("Error while querying the Database. [executeSelect($query, $returnType);] [".$this->connection->error."]", "x");
                if($returnType == "2D_Array")
                {
                    $llresult = array();
                    while($res = mysqli_fetch_array($lresult, MYSQLI_NUM))
                    {
                        array_push($llresult, $res);
                    }
                    $this->lastResult = $llresult;
                    mysqli_free_result($lresult);
                    return $this->lastResult;
                }
                else if ($returnType == "MySQL_Table")
                {
                    $this->lastResult = $lresult;
                    return $this->lastResult;
                }
            }
            else
                $this->throwError("ERROR, the connection seams to be closed. Run connect() or reconnect() to make a connection", "x");
        }

        /* Execute query string */
        function executeInsert($query)
        {
            $this->checkVars(array($query), "executeInsert($query)");
            if($this->connectionOpen)
            {
                $lresult = $this->connection->query($query) or
                    $this->throwError("There was an error while querying the database. [executeInsert($query);] [".$this->connection->error."]", "");
                $this->lastResult = $lresult;
            }
            else
                $this->throwError("ERROR, the connection seams to be closed. Run connect() or reconnect() to make a connection", "x");
        }

        /* Execute query string */
        function executeDelete($query)
        {
            $this->checkVars(array($query), "executeDelete($query)");
            if($this->connectionOpen)
            {
                $lresult = $this->connection->query($query) or
                    $this->throwError("There was an error while querying the database. [executeDelete($query);] [".$this->connection->error."]", "");
                $this->lastResult = $lresult;
            }
            else
                $this->throwError("ERROR, the connection seams to be closed. Run connect() or reconnect() to make a connection", "x");
        }

        /* Execute query string */
        function executeUpdate($query)
        {
            $this->checkVars(array($query), "executeUpdate($query)");
            if($this->connectionOpen)
            {
                $lresult = $this->connection->query($query) or
                    $this->throwError("There was an error while querying the database. [executeUpdate($query);] [".$this->connection->error."]", "");
                $this->lastResult = $lresult;
            }
            else
                $this->throwError("ERROR, the connection seams to be closed. Run connect() or reconnect() to make a connection", "x");
        }

        /* Execute query string */
        function executeDrop($query)
        {
            $this->checkVars(array($query), "executeDrop($query)");
            if($this->connectionOpen)
            {
                $lresult = $this->connection->query($query) or
                    $this->throwError("There was an error while querying the database. [executeDrop($query);] [".$this->connection->error."]", "");
                $this->lastResult = $lresult;
            }
            else
                $this->throwError("ERROR, the connection seams to be closed. Run connect() or reconnect() to make a connection", "x");
        }

        /* if mysqli::ping() is true it returns true, if mysqli::ping() && connectionOpen is true it returns true, else it always returns false */
        function checkConnection()
        {
            if($this->connection->ping() && $this->connectionOpen)
                return true;
            else if ($this->connection->ping())
                return true;
            else
                return false;
        }

        /* Kills the Script and displays a error Message */
        function throwError($message, $action)
        {
            if(!isset($action) || empty($action))
                $action = "";
            switch($action)
            {
                case "dispose":
                    $this->dispose("acc", "x");
                    die($message);
                case "closeConnection":
                    $this->closeConnection();
                    die($message);
                default:
                    die($message);
            }
        }

        /* Return the last Result */
        function getResult()
        {
            return $this->lastResult;
        }

        /* Return the last Script Internal Error */
        function getLastInternalError()
        {
            return $this->lastInternalError;
        }

        /* Closes Open Connection, removes content from Variables [if action "without" is selectet, the varname is not removed]*/
        function dispose($action, $varname)
        {
            $this->checkVars(array($action, $varname), "dispose($action, $varname)");
            if($action === "without")
            {
                switch($varname)
                {
                    case "connectionOpen":
                        $this->closeConnection();
                        $this->connectionInfo = null;
                        $this->connection = null;
                        $this->queryString = null;
                        $this->lastResult = null;
                        $this->lastInternalError = null;
                        break;
                    case "connectionInfo":
                        $this->closeConnection();
                        $this->connectionOpen = false;
                        $this->connection = null;
                        $this->queryString = null;
                        $this->lastResult = null;
                        $this->lastInternalError = null;
                        break;
                    case "connection":
                        $this->closeConnection();
                        $this->connectionOpen = false;
                        $this->connectionInfo = null;
                        $this->queryString = null;
                        $this->lastResult = null;
                        $this->lastInternalError = null;
                        break;
                    case "queryString":
                        $this->closeConnection();
                        $this->connectionOpen = false;
                        $this->connectionInfo = null;
                        $this->connection = null;
                        $this->lastResult = null;
                        $this->lastInternalError = null;
                        break;
                    case "lastResult":
                        $this->closeConnection();
                        $this->connectionOpen = false;
                        $this->connectionInfo = null;
                        $this->connection = null;
                        $this->queryString = null;
                        $this->lastInternalError = null;
                        break;
                    case "lastInternalError":
                        $this->closeConnection();
                        $this->connectionOpen = false;
                        $this->connectionInfo = null;
                        $this->connection = null;
                        $this->queryString = null;
                        $this->lastResult = null;
                        break;
                    default:
                        $this->closeConnection();
                        $this->connectionOpen = false;
                        $this->connectionInfo = null;
                        $this->connection = null;
                        $this->queryString = null;
                        $this->lastResult = null;
                        $this->lastInternalError = null;
                        break;
                }
            }
            else if ($action == "acc")
            {
                $this->closeConnection();
                $this->connectionOpen = false;
                $this->connectionInfo = null;
                $this->connection = null;
                $this->queryString = null;
                $this->lastResult = null;
                $this->lastInternalError = null;
            }
            else
            {
                $this->connectionOpen = false;
                $this->connectionInfo = null;
                $this->connection = null;
                $this->queryString = null;
                $this->lastResult = null;
                $this->lastInternalError = null;
            }
        }

        /* Checks if given variables are null or empty, if so it throws an error */
        private function checkVars($ar, $loc)
        {
            $ok = true;

            foreach($ar as $a)
            {
                if(!isset($a) || empty($a))
                    $ok = false;
            }
            $this->lastInternalError = "at checkVars: AN EMPTY OR NULL ARGUMENTS WAS GIVEN AT $loc";
            if(!$ok)
                $this->throwError("One or more variables in '$loc' are null or empty", "x");
        }
    }
?>