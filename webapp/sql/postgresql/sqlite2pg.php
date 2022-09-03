<?php

for ($i=1; $i <= 100; $i++) { 
    $sql = "CREATE schema sqlite{$i};";
    $sql = "CREATE SERVER sqlite_server{$i} FOREIGN DATA WRAPPER sqlite_fdw OPTIONS (database '/home/isucon/webapp/tenant_db/{$i}.db');";
    $sql = "IMPORT FOREIGN SCHEMA public FROM SERVER sqlite_server{$i} INTO sqlite{$i};";
    echo $sql . PHP_EOL;
}

