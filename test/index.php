<?php

  include '../src/MySQLm.php';

  /* OBJECT CREATION START*/
  $data = (object) [
    'host' => 'localhost',
    'port' => 3306,
    'user' => 'testing',
    'password' => 'testing',
    'database' => 'testing_db',
    'charset' => 'utf8',
  ];

  $json = json_encode($data);

  log("Object creation");
  $msql = new MySQLm($json);
  /* OBJECT CREATION END*/


  /* SWITCH SERVER START*/
  $data = (object) [
    'host' => '192.168.0.98',
    'port' => 3306,
    'user' => 'testing',
    'password' => 'testing',
    'database' => 'testing_db',
    'charset' => 'utf8',
  ];

  $json = json_encode($data);

  log("Switch connection");
  $msql->connect($json);
  /* SWITCH SERVER END*/
  
  /* SWITCH SERVER NO DB START*/
  $data = (object) [
    'host' => '192.168.0.98',
    'port' => 3306,
    'user' => 'testing',
    'password' => 'testing',
    'charset' => 'utf8',
  ];

  $json = json_encode($data);

  log("Switch connection without Database");
  $msql->connect($json);
  /* SWITCH SERVER NO DB END*/

  function log($x){
    echo $x."<br>";
  }