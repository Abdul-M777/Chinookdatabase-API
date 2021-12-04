<?php

require_once 'db.php';


class MediaType
{

    function getMediaType()
    {
        $sql = 'SELECT * FROM mediatype';
        $results = dbQuery($sql);
        $rows = array();

        while ($row = dbFetchAssoc($results)) {
            $rows[] = $row;
        }

        return $rows;
    }
}
