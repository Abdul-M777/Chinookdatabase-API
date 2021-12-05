<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$dbConn = mysqli_connect('localhost', 'root', '', 'chinook_abridged') or die('MySQL connect failed. ' . mysqli_connect_error());

function dbQuery($sql)
{
    global $dbConn;
    $result = mysqli_query($dbConn, $sql) or die(mysqli_error($dbConn));
    return $result;
}

function dbFetchAssoc($result)
{
    return mysqli_fetch_assoc($result);
}

function closeConn()
{
    global $dbConn;
    mysqli_close($dbConn);
}
