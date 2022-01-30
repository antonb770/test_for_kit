<?
if (!isset($_GET['id'])) {
	exit ('Нет данных!');
}

$id = intval($_GET['id']);

include_once $_SERVER['DOCUMENT_ROOT'].'/config.php';
include_once ($_SERVER['DOCUMENT_ROOT'].'/include/db_connect.php');

$query = "SELECT description FROM description_category WHERE id=?";
if (!($statement = $db->prepare($query))) {
    exit('Error query (users)');
}
$statement->bind_param("i", $id);
$statement->execute();
$statement->bind_result($description);
while ($statement->fetch()) {
    echo strip_tags($description);
}
