<?
if (!isset($_GET['id']) || !isset($_GET['category'])) {
	exit ('Нет данных!');
}

$pr_id = $_GET['id'];
$category = strip_tags(strval($_GET['category']));
$id = null;
if ($pr_id == 'null') {
    $pr_id = null;
}

include_once $_SERVER['DOCUMENT_ROOT'].'/config.php';
include_once ($_SERVER['DOCUMENT_ROOT'].'/include/db_connect.php');


$query = "INSERT INTO category (id, category, parent_category) VALUES (?,?,?)";
if (!($statementi = $db->prepare($query))) {
    exit('Error query INSERT (category)');
}
$statementi->bind_param("isi", $id, $category, $pr_id);
$result = $statementi->execute() ? 'Добавили новую категорию к уровню категории '.$pr_id.'.':'Ошибка записи';

echo $result;