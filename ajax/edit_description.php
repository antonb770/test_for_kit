<?
if (!isset($_GET['id']) || !isset($_GET['description'])) {
	exit ('Нет данных!');
}

$id = intval($_GET['id']);

$description = strip_tags(strval($_GET['description']));
$id_ds = 0;
/*
echo $id." ".$description;
exit;
*/
include_once $_SERVER['DOCUMENT_ROOT'].'/config.php';
include_once ($_SERVER['DOCUMENT_ROOT'].'/include/db_connect.php');

$query = "SELECT id FROM description_category WHERE id=?";
if (!($statement = $db->prepare($query))) {
    exit('Error query (description_category)');
}
$statement->bind_param("i", $id);
$statement->execute();

while ($statement->fetch()) {
    $statement->close();
    $query = "UPDATE description_category SET description=? WHERE id=?";
    if (!($statementu = $db->prepare($query))) {
        exit('Error query UPDATE (description_category)');
    }
    $statementu->bind_param("si", $description, $id);
    $result = $statementu->execute() ? 'Описание категории '.$id.' успешно изменено.':'Ошибка записи UPDATE';
    exit($result);
}

$statement->close();
$query = "INSERT INTO description_category (id, description) VALUES (?,?)";
if (!($statementi = $db->prepare($query))) {
    exit('Error query INSERT (description_category)');
}
$statementi->bind_param("is", $id, $description);
$result = $statementi->execute() ? 'Добавили описание к категории '.$id.'.':'Ошибка записи INSERT';

echo $result;

