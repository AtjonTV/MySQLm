<?php
    echo "Including MySQLm ..<br>";
    include '../src/MySQLm.php';
    echo "Included!<br>";

    echo "Creating MySQLm Object ..<br>";
    $msql = new MySQLm("","","","","");
    echo "Created.<br>Connecting to Server without DB ..<br>";
    $msql->connect_ndb('localhost', 3306, 'root', '55#admin683455');
    echo "Connected!<br>Checking Connection..<br>";
    if($msql->checkConnection())
    {
        echo "Connection OK!<br>Creating Database..<br>";
        $msql->executeCreate("CREATE DATABASE mysqlm_test;");
        echo "Created!<br>Selecting Database ..<br>";
        $msql->selectDatabase("mysqlm_test");
        echo "Selected!<br>Creating Table..<br>";
        $msql->executeCreate("CREATE TABLE test ( id int NOT NULL AUTO_INCREMENT, num int, hash varchar(128), PRIMARY KEY (id));");
        echo "Created!<br>Starting Loop..<br>";
        for($i = 0; $i < 50; $i++)
        {
            echo "Starting to insert Data [$i] ..<br>";
            $num = $i+rand(2, 8);
            $hash = hash('ripemd160', $i+rand(2, 8));
            $msql->executeInsert("INSERT INTO mysqlm_test.test (id, num, hash) VALUES (NULL, $num, '$hash');");
            echo "Inserted!<br>";
        }
        echo "Loop finished!<br>Selecting Data and getting result ..<br>";
        $msql->executeSelect("SELECT num, hash FROM mysqlm_test.test WHERE num = 34", "2D_Array");
        $res = $msql->getResult();
        echo "Selected!<br>Checking Result..<br>";
        if($res != null)
        {
            echo "Result was found: ";
            echo $res[0][0]." ".$res[0][1];
            echo "<br>Updating database ..<br>";
            $msql->executeUpdate("UPDATE mysqlm_test.test SET num = '".rand(2, 8)."', hash = '".hash('ripemd160', rand(2, 8))."' WHERE num = 34;");
            echo "Updated!<br>";
        }
        echo "Dropping Table ..<br>";
        $msql->executeDrop("DROP TABLE mysqlm_test.test");
        echo "Dropped!<br>Dropping Database..";
        $msql->executeDrop("DROP DATABASE mysqlm_test;");
        echo "Dropped!<br>Disposing Object..";
        $msql->dispose("acc", "x");
        echo "Disposed!<br>";
        echo "Test Finished Successfully!";
    }
?>