<?
if (!isset($_GET['id'])) {
	exit ('Нет данных!');
}

$id = intval($_GET['id']);

include_once $_SERVER['DOCUMENT_ROOT'].'/config.php';
include_once ($_SERVER['DOCUMENT_ROOT'].'/include/db_connect.php');
include_once ($_SERVER['DOCUMENT_ROOT'].'/include/functions.php');

/* Удаляем категорию и описание категории */
$query = "DELETE ca, de FROM category AS ca JOIN description_category AS de ON de.id = ca.id WHERE ca.id=?";
if (!($statement = $db->prepare($query))) {
    exit('Error query DELETE (category)');
}
$statement->bind_param("i", $id);
$result = $statementi->execute() ? 'Успешно удалена категория '.$pr_id.'.':'Ошибка записи';

echo $result;