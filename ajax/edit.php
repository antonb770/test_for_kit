<?
if (!isset($_GET['id']) || !isset($_GET['category'])) {
	exit ('Нет данных!');
}

$id = intval($_GET['id']);
$category = strip_tags(strval($_GET['category']));

if (strlen($category) < 1){
    $category = "*****";
}

include_once $_SERVER['DOCUMENT_ROOT'].'/config.php';
include_once ($_SERVER['DOCUMENT_ROOT'].'/include/db_connect.php');

$query = "UPDATE category SET category=? WHERE id=?";
if (!($statement = $db->prepare($query))) {
    exit('Error query (users)');
}
$statement->bind_param("si", $category, $id);
$result = $statement->execute() ? 'Категория '.$id.' успешно изменена.':'Ошибка записи';

echo $result;

