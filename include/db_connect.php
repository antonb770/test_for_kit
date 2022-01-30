<?
    $db = new mysqli($DB_SERVER, $DB_USER_NAME, $DB_USER_PASS, $DB_NAME);
    mysqli_set_charset($db, "utf8");
    if ($db->connect_error) {
        exit('Error DB connect');
    }