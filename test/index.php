<?php

  include '../src/MySQLm.php';

  /* OBJECT CREATION START*/
  $data = array (
    'host' => 'localhost',
    'port' => 3306,
    'user' => 'testing',
    'password' => 'testing',
    'database' => 'testing_db',
    'charset' => 'utf8',
  );

  $json = json_encode($data);
  echo $json;
  die();

  _log("Object creation");
  $msql = new MySQLm($json);
  /* OBJECT CREATION END*/


  /* SWITCH SERVER START*/
  $data = array (
    'host' => 'localhost',
    'port' => 3306,
    'user' => 'testing',
    'password' => 'testing',
    'database' => 'testing_db',
    'charset' => 'utf8',
  );

  $json = json_encode($data);

  _log("Switch connection");
  $msql->connect($json);
  /* SWITCH SERVER END*/
  
  /* SWITCH SERVER NO DB START*/
  $data = array (
    'host' => 'localhost',
    'port' => 3306,
    'user' => 'testing',
    'password' => 'testing',
    'charset' => 'utf8',
  );

  $json = json_encode($data);

  _log("Switch connection without Database");
  $msql->connect($json);
  /* SWITCH SERVER NO DB END*/

  function _log($x){
    echo $x."<br>";
  }