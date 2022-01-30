<?
if (!isset($_GET['id']) || !isset($_GET['newparent'])) {
	exit ('Нет данных!');
}

$id = intval($_GET['id']);
$parent_category = intval($_GET['newparent']);

include_once $_SERVER['DOCUMENT_ROOT'].'/config.php';
include_once ($_SERVER['DOCUMENT_ROOT'].'/include/db_connect.php');

$query = "UPDATE category SET parent_category=? WHERE id=?";
if (!($statement = $db->prepare($query))) {
    exit('Error query (users)');
}
$statement->bind_param("ii", $parent_category, $id);
$result = $statement->execute() ? 'Родительская категория успешно изменена.':'Ошибка записи';

echo $result;

