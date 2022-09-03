<?php

for ($i=1; $i <= 100; $i++) { 
    //ddl
    $sql = "CREATE schema sqlite{$i};";
    $sql = "CREATE SERVER sqlite_server{$i} FOREIGN DATA WRAPPER sqlite_fdw OPTIONS (database '/home/isucon/webapp/tenant_db/{$i}.db');";
    $sql = "IMPORT FOREIGN SCHEMA public FROM SERVER sqlite_server{$i} INTO sqlite{$i};";

    // data
    $sql = "INSERT INTO public.competition SELECT * from sqlite{$i}.competition;";
    $sql = "INSERT INTO public.player SELECT * from sqlite{$i}.player;";
    $sql = "INSERT INTO public.player_score SELECT * from sqlite{$i}.player_score;";
    echo $sql . PHP_EOL;

}

