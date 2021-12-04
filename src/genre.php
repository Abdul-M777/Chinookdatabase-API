<?php

require_once 'db.php';


class Genre
{

    function getGenre()
    {
        $sql = 'SELECT * FROM genre';
        $results = dbQuery($sql);
        $rows = array();

        while ($row = dbFetchAssoc($results)) {
            $rows[] = $row;
        }

        return $rows;
    }
}
