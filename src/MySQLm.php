<?php
    /*
     *  Copyright 2015-2018 AtjonTV (Thomas Obernosterer)
     * 
     *  This is an OSPL Project
     *      OSPL is an License by ATVG-Studios: http://open-source-project-license.atvg-studios.at/
     * 
     *  Documentation of MySQLm can be found on http://Github.com/AtjonTV/MySQLm/wiki .
     */
    class MySQLm # Version 1.5.6:14_12_2017
    {
        /* Private Variables */
        private $version = "1.5.6"; 
        private $version_date = "1.5.6:14_12_2017";
        private $version_arr = array('major'=>1,'minor'=>5,'patch'=>6, 'release'=>24);
        private $connectionOpen = false;
        private $connectionInfo = null;
        private $connection = null;
        private $queryString = null;
        private $lastResult = null;
        private $lastInternalError = null;
        private $updateData = false;

        /* Constructor for the Object to directly open a connection */
        function __construct($host, $port, $user, $pass, $db, $charset) 
        {
            $this->checkExtensions();

            if(empty($host)&&empty($port)&&empty($user)&&empty($db)&&empty($charset))
            {
                $this->lastInternalError = "at __construct: NO ARGUMENTS GIVEN, CONNECTION LESS OBJECT.";
            }
            else{
                $this->checkVars(array($host, $port, $user, $db), "__construct($host, $port, $user, $pass, $db)");

				if(empty($charset)){
					$this->$charset="utf8";
				}

                $this->connection = @new mysqli($host, $user, $pass, $db, $port);

                if(!$this->checkConnection()){
                    $this->throwError("Could not Connect to the Database, Object Disposed.", 'dispose');
                }
                
                if (!$this->connection->set_charset($charset)) {
                    $this->throwError("An Error Occured while loading charset $charset", "dispose");
                }

                if($this->connection->connect_error){
                	$this->throwError("An Error Occured while opening a connection to the database: ".$this->connection->connect_error, "dispose");
                }
    
                $this->connectionOpen = true;
                $this->connectionInfo = array(
                    "Host" => $host,
                    "User" => $user,
                    "Pass" => $pass,
                    "DaBa" => $db,
                    "Port" => $port,
                    "ChSt" => $charset
                );
            }
        }

        /* Function to open a connection */
        function connect($host, $port, $user, $pass, $db, $charset) 
        {
            $this->checkExtensions();

            $this->checkVars(array($host, $port, $user, $db), "connect($host, $port, $user, $pass, $db)");            

			if(empty($charset)){
				$this->$charset="utf8";
			}

            $this->connection = @new mysqli($host, $user, $pass, $db, $port);
            
            if(!$this->checkConnection()){
                $this->throwError("Could not Connect to the Database, Object Disposed.", 'dispose');
            }
            
            if (!$this->connection->set_charset($charset)) {
                $this->throwError("An Error Occured while loading charset $charset", "dispose");
            }

            if($this->connection->connect_error){
            	$this->throwError("An Error Occured while opening a connection to the database: ".$this->connection->connect_error, "dispose");
            }
                
            $this->connectionOpen = true;
            $this->connectionInfo = array(
                "Host" => $host,
                "User" => $user,
                "Pass" => $pass,
                "DaBa" => $db,
                "Port" => $port,
                "ChSt" => $charset
            );
        }

        /* Function to select a Database */
        function connect_ndb($host, $port, $user, $pass, $charset)
        {
            $this->checkExtensions();

            $this->checkVars(array($host, $port, $user), "connect_ndb($host, $port, $user, $pass)");            
            
            if(empty($charset)){
				$this->$charset="utf8";
			}
            
            $this->connection = @new mysqli($host.':'.$port, $user, $pass);
            
            if(!$this->checkConnection())
                $this->throwError("Could not Connect to the Database, Object Disposed.", 'dispose');
            
                if (!$this->connection->set_charset($charset)) {
                $this->throwError("An Error Occured while loading charset $charset", "dispose");
            }

            if($this->connection->connect_error)
                $this->throwError("An Error Occured while opening a connection to the database: ".$this->connection->connect_error, "dispose");

            $this->connectionOpen = true;
            $this->lastInternalError = "at connect_ndb: COULD NOT GIVE ONE PARAMETER TO connectionInfo; DaBa -> NO DATABASE TO CONNECT TO.";
            $this->connectionInfo = array(
                "Host" => $host,
                "User" => $user,
                "Pass" => $pass,
                "DaBa" => "",
                "Port" => $port,
                "ChSt" => $charset
            );
        }

        /* Function to select database */
        function selectDatabase($db)
        {
            $db = $this->escapeStringTrim($db);
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
            if($this->checkConnection())
            {
                $this->connection->close();
                $this->connectionOpen = false;
            }
        }

        /* Recreates the connection with the last given connection string */
        function reconnect()
        {
            $this->dispose("without", "connectionInfo");
            $this->connection = @new mysqli($this->connectionInfo["Host"], $this->connectionInfo["Port"], $this->connectionInfo["User"], $this->connectionInfo["Pass"], $this->connectionInfo["DaBa"], $this->connectionInfo["ChSt"]);
            if($this->connection->connect_error)
                $this->throwError("An Error Occured while opening a connection to the database: ".$this->connection->connect_error, "dispose");
            $this->connectionOpen = true;
        }

        /* Set a QueryString to execute later */
        function setQueryString($query)
        {
            $query = $this->escapeStringTrim($query);
            $this->checkVars(array($query), "setQueryString($query)");

            if($this->connectionOpen)
                $this->queryString;
            else
                $this->throwError("ERROR, the connection seams to be closed. Run connect() or reconnect() to make a connection", "x");
        }

        /* Set the Charset on Connection */
        function setCharset($charset)
        {
            if(!$this->checkConnection())
            $this->throwError("Could not Connect to the Database, Object Disposed.", 'dispose');
        
            if (!$this->connection->set_charset($charset)) {
                $this->throwError("An Error Occured while loading charset $charset", "dispose");
            }
        }

        /* Execute stored query string */
        function executeSavedQuery()
        {
            if($this->connectionOpen)
            {
                $lresult = $this->connection->query($this->queryString) 
                    or $this->throwError("There was an error while querying the database. [executeStoredQuery($this->queryString);] [".$this->connection->error."]", "x");
                $this->lastResult = $lresult;
            }
            else
                $this->throwError("ERROR, the connection seams to be closed. Run connect() or reconnect() to make a connection", "x");
        }
        
        /* Execute query string */
        function executeQuery($query)
        {
            $query = $this->escapeStringTrim($query);
            $this->checkVars(array($query), "executeQuery($query)");
            if($this->connectionOpen)
            {
                $lresult = $this->connection->query($query) 
                    or $this->throwError("There was an error while querying the database. [executeQuery($query);] [".$this->connection->error."]", "x");
                $this->lastResult = $lresult;
            }
            else
                $this->throwError("ERROR, the connection seams to be closed. Run connect() or reconnect() to make a connection", "x");
        }

        /* Execute query x times */
        function executeQueryMultiTimes($query, $times)
        {
            $this->checkVars(array($query), "executeQueryMultiTimes($query)");
            $query = $this->escapeStringTrim($query);
            if(!$this->connectionOpen)
                $this->throwError("ERROR, the connection seams to be closed. Run connect() or reconnect() to make a connection", "x");

            $lresult = array();
            for($i = 0; $i < $times; $i++)
            {
                $lresult[$i] = $this->connection->query($query)
                or $this->throwError("There was an error while querying the database. [executeQueryMultiTimes($query, $times);] [".$this->connection->error."]", "x");
            }
            $this->lastResult = $lresult;
        }

        /* Execute query string */
        function executeCreate($query)
        {
            $query = $this->escapeStringTrim($query);
            $this->checkVars(array($query), "executeCreate($query)");
            if($this->connectionOpen)
            {
                $lresult = $this->connection->query("CREATE ".$query) or
                    $this->throwError("There was an error while querying the database. [executeCreate($query);] [".$this->connection->error."]", "");
                $this->lastResult = $lresult;
            }
            else
                $this->throwError("ERROR, the connection seams to be closed. Run connect() or reconnect() to make a connection", "x");
        }

        /* Execute query string */
        function executeUse($query)
        {
            $query = $this->escapeStringTrim($query);
            $this->checkVars(array($query), "executeUse($query)");
            if($this->connectionOpen)
            {
                $lresult = $this->connection->query("USE ".$query) or
                    $this->throwError("There was an error while querying the database. [executeUse($query);] [".$this->connection->error."]", "");
                $this->lastResult = $lresult;
            }
            else
                $this->throwError("ERROR, the connection seams to be closed. Run connect() or reconnect() to make a connection", "x");
        }

        /* Execute query string */
        function executeSelect($query, $returnType)
        {
            $query = $this->escapeStringTrim($query);
            $this->checkVars(array($query), "executeSelect($query)");
            if($this->connectionOpen)
            {
                $lresult = $this->connection->query("SELECT ".$query)
                    or $this->throwError("Error while querying the Database. [executeSelect($query, $returnType);] [".$this->connection->error."]", "x");
                if($returnType == E_ReturnType::TWODIMENSIONAL_ARRAY || $returnType == E_ReturnType::TWO_D_ARRAY)
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
                else if ($returnType == E_ReturnType::MYSQL_TABLE)
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
            $query = $this->escapeStringTrim($query);
            $this->checkVars(array($query), "executeInsert($query)");
            if($this->connectionOpen)
            {
                $lresult = $this->connection->query("INSERT ".$query) or
                    $this->throwError("There was an error while querying the database. [executeInsert($query);] [".$this->connection->error."]", "");
                $this->lastResult = $lresult;
            }
            else
                $this->throwError("ERROR, the connection seams to be closed. Run connect() or reconnect() to make a connection", "x");
        }

        /* Execute query string */
        function executeDelete($query)
        {
            $query = $this->escapeStringTrim($query);
            $this->checkVars(array($query), "executeDelete($query)");
            if($this->connectionOpen)
            {
                $lresult = $this->connection->query("DELETE ".$query) or
                    $this->throwError("There was an error while querying the database. [executeDelete($query);] [".$this->connection->error."]", "");
                $this->lastResult = $lresult;
            }
            else
                $this->throwError("ERROR, the connection seams to be closed. Run connect() or reconnect() to make a connection", "x");
        }

        /* Execute query string */
        function executeUpdate($query)
        {
            $query = $this->escapeStringTrim($query);
            $this->checkVars(array($query), "executeUpdate($query)");
            if($this->connectionOpen)
            {
                $lresult = $this->connection->query("UPDATE ".$query) or
                    $this->throwError("There was an error while querying the database. [executeUpdate($query);] [".$this->connection->error."]", "");
                $this->lastResult = $lresult;
            }
            else
                $this->throwError("ERROR, the connection seams to be closed. Run connect() or reconnect() to make a connection", "x");
        }

        /* Execute query string */
        function executeDrop($query)
        {
            $query = $this->escapeStringTrim($query);
            $this->checkVars(array($query), "executeDrop($query)");
            if($this->connectionOpen)
            {
                $lresult = $this->connection->query("DROP ".$query) or
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
            {
                $this->lastInternalError = "at checkConnection: THE CONNECTION IS CLOSED.";
                return false;
            }
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
            
            if(!$ok)
                $this->throwError("One or more variables in '$loc' are null or empty", "x");
        }

        /* Escape String to get Real SQL Code */
        function escapeString($sql_query)
        {
            return $this->connection->real_escape_string($sql_query);
        }

        /* Escape String and Remove Useless Spaces to get Real SQL Code */
        function escapeStringTrim($sql_query)
        {
            return $this->connection->real_escape_string(trim($sql_query));
        }

        /* Check if extensions are enabled or can be enabled*/
        function checkExtensions(){
            
            #Check if mysqli is enabled
            if(!extension_loaded('mysqli'))
            {
                if($this->connectionOpen)
                    $this->throwError("Extension 'mysqli' not Installed. (Please Install 'mysqli')", 'dispose');
                else
                $this->throwError("Extension 'mysqli' not Installed. (Please Install 'mysqli')", '');
            }

            #Check if curl is enabled
            if(!extension_loaded('curl'))
            {
                if($this->connectionOpen)
                    $this->throwError("Extension 'curl' not Installed. (Please Install 'curl')", 'dispose');
                else
                    $this->throwError("Extension 'curl' not Installed. (Please Install 'curl')", '');
            }

            #Check if zip is enabled
            if(!extension_loaded('zip'))
            {
                if($this->connectionOpen)
                    $this->throwError("Extension 'zip' not Installed. (Please Install 'zip')", 'dispose');
                else
                    $this->throwError("Extension 'zip' not Installed. (Please Install 'zip')", '');
            }
        }

        /* Return the version of the MySQL Manager */
        function getVersion($asString, $stringWithDate)
        {
            if($asString)
            {
                if($stringWithDate)
                    return $this->version_date;
                else
                    return $this->version;
            }
            else
                return $this->version_arr;
        }

        /* <UPDATE> */
        function checkForUpdate()
        {
            if($this->isUpdate()) 
                return "There is a new Version! <a href='".$this->updateData['html_url']."'>Get it Here</a>";
            else
                return "There is no new Version, your up to date!";
        }

        function autoUpdate($echo)
        {
            if($this->connectionOpen)
                $this->closeConnection();

            if($this->isUpdate($echo))
                $this->doUpdate($echo);
        }

        function isUpdate($echo)
        {
            if($echo)
                echo '<span id="msql-update">[MySQLm::Version Check] Downloading release list</span><br>';
            $res = $this->curlGET("https://api.github.com/repos/atjontv/mysqlm/releases/latest");
            $arr = json_decode($res, true);
            $ver = $arr['tag_name'];
            $ver = str_replace('v', '', $ver);
            $updateData = $arr;
            
            if($echo)
                echo '<span id="msql-update">[MySQLm::Version Check] Compairing versions</span><br>';
            if(version_compare($ver, $this->version, '>'))
            {    
                if($echo)
                    echo '<span id="msql-update">[MySQLm::Version Check] New version detected</span><br>';
                return true;
            }
            else
            {
                if($echo)
                    echo '<span id="msql-update">[MySQLm::Version Check] No new version detected</span><br>';
                return false;
            }
        }

        function doUpdate($echo)
        {
            if($echo)
                echo '<span id="msql-update">[MySQLm::Updater] Getting Version data</span><br>';
            if($this->updateData == null)
            {
                if($echo)
                    echo '<span id="msql-update">[MySQLm::Updater] Downloading Version data</span><br>';
                $this->updateData = json_decode($this->curlGET("https://api.github.com/repos/atjontv/mysqlm/releases/latest"), true);
            }
            if($echo)
                echo '<span id="msql-update">[MySQLm::Updater] Downloading updates</span><br>';
            $update = file_get_contents($this->updateData['assets'][0]['browser_download_url']);
            if($echo)
                echo '<span id="msql-update">[MySQLm::Updater] Installing Updates</span><br>';
            file_put_contents(__FILE__, $update);
            if($echo)
                echo '<span id="msql-update">[MySQLm::Updater] Updates done.</span>';
        }

        /*

        WRITTEN BUT UNUSED:

            $zip = new ZipArchive();
            $res = $zip->open('UPDATE.zip');
            if ($res === TRUE) {
                $zip->extractTo('UPDATE');
                $zip->close();
            } else {
                $this->throwError("Error while unziping the update!", '');
            }

        */

        private function curlGET($url)
        {
            $c = curl_init();
            curl_setopt($c, CURLOPT_URL, $url);
            curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($c, CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
            curl_setopt($c, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($c, CURLOPT_SSL_VERIFYPEER, 0);
            $headers = array(
                'Content-Type:application/json',
                'Authorization: token 900ac7d7a50213908a74b064f7433dd8c6499da6'
            );
            curl_setopt($c, CURLOPT_HTTPHEADER, $headers);
            $res = curl_exec($c);
            curl_close($c);
            return $res;
        }

        private function curlGET_FILE($url, $file)
        {
            set_time_limit(0);
            $fp = fopen ($file, 'w+');
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_TIMEOUT, 50);
            curl_setopt($ch, CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
            curl_setopt($ch, CURLOPT_FILE, $fp); 
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            $headers = array(
                'Content-Type:application/json',
                'Authorization: token 900ac7d7a50213908a74b064f7433dd8c6499da6'
            );
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_exec($ch); 
            curl_close($ch);
            fclose($fp);
        }
        /* </UPDATE> */

        /* Return Client/Server Information */
        function getInformation($fromServer)
        {
            if(!$fromServer)
            {
                return $this->connection->get_client_info();
            }
            else
            {
                return $this->connection->server_info;
            }
        }

        function getSqlVersion($fromServer)
        {
            if(!$fromServer)
            {
                return $this->connection->client_version;
            }
            else
            {
                return $this->connection->server_version;
            }
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