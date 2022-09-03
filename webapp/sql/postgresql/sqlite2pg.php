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

    $sql = "INSERT INTO public.player_score SELECT id,tenant_id,player_id,competition_id,score,row_num,created_at,updated_at FROM (SELECT *,rank() OVER (partition by tenant_id,competition_id,player_id ORDER BY row_num DESC) as rank FROM sqlite{$i}.player_score) AS ranking WHERE rank = 1;";
    echo $sql . PHP_EOL;
}

