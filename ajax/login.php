<?
if (!session_id()) session_start();

if (!isset($_GET['user_name']) || !isset($_GET['user_password'])) {
	exit ('Нет данных!');
}

include_once $_SERVER['DOCUMENT_ROOT'].'/config.php';
include_once ($_SERVER['DOCUMENT_ROOT'].'/include/db_connect.php');

$name = strval($_GET['user_name']);
$password = openssl_encrypt(strval($_GET['user_password']), "AES-192-CBC", ENCRYP_KEY);

$query = "SELECT name FROM users WHERE name=? AND password=?";
if (!($statement = $db->prepare($query))) {
    exit('Error query (users)');
}
$statement->bind_param("ss", $name, $password);
$statement->execute();
$statement->bind_result($result_name);
while ($statement->fetch()) {
    $_SESSION['admin'] = true;
    exit ('777');
}
if (isset($_SESSION['admin'])) {
    unset($_SESSION['admin']);
}
echo 'false';