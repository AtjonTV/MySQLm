<?php
    /*
     *  Copyright 2015-2018 AtjonTV (Thomas Obernosterer)
     * 
     *  This is an OSPL Project
     *      OSPL is an License by ATVG-Studios: http://open-source-project-license.atvg-studios.at/
     * 
     *  Documentation of MySQLm can be found on http://Github.com/AtjonTV/MySQLm/wiki .
     */
    echo "Including MySQLm ..<br>";
    include '../../src/MySQLm.php';
    echo "Included!<br>";

    echo "Creating MySQLm Object ..<br>";
    $msql = new MySQLm("","","","","","");
    echo "Created.<br>";
    echo "MySQLm v".$msql->getVersion(true, true);
    echo "<br><br>Checking Version..<br>";
    echo $msql->checkForUpdate();
    echo "<br>Checked<br><br>";
    if($msql->isUpdate())
    {
        echo "Trying to Update";
        $msql->autoUpdate();
        echo "<br><br>";
        if(!$msql->isUpdate())
            echo "Up to Date!";
    }
    else{
        echo "Up to Date!";
    }
?>
