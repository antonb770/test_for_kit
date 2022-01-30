<?
error_reporting(E_ALL);
ini_set('display_errors', 'On');
if (!session_id()) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="ru-RU">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Тестовое задание</title>
        <link href="css/style.css" rel="stylesheet" type='text/css'>
        <link rel="stylesheet" href="/font-awesome/css/font-awesome.min.css">
    </head>

    <body>
        <script src="js/scripts.js"></script>
        <div class="container">

        <?
            if (isset($_GET['auth'])) {
                if ($_GET['auth'] === 'true'){
        ?>
                    <div class="black-body">
                        <div class="black-body-dialog">
                            <div>
                                Введите имя пользователя
                                <input type="text" width="1" size="30" id="user_name" placeholder="Имя пользователя">
                            </div>
                            <div>
                                Введите пароль
                                <input type="password" width="3" size="30" id="user_password" placeholder="Пароль">
                            </div>
                            <div>
                                <a href="/"><i class="fa fa-times-circle-o fa-3x" aria-hidden="true"></i></a>
                                <a href="/"><i class="fa fa-check-circle-o fa-3x" aria-hidden="true" onclick="return autorization();"></i></a>
                            </div>
                        </div>
                    </div>
                    <script src="js/autorization.js"></script>
        <?
                } else {
                    if (isset($_SESSION['admin'])) {
                        unset($_SESSION['admin']);
                    }
                    header('Location: /');
                }
            exit;
            }
        ?>

            <div class="col-left">
                <div class="col-header">
                    <i class="fa fa-list-alt" aria-hidden="true"></i>
                    <span>Структура данных</span>
                </div>
                <div class="col-body" id="tree">
                    <div>
                        <a href="/">Свернуть все</a>
                    </div>
                    <?
                        $page = (isset($_SESSION['admin'])) ? 'admin' : 'public';
                        include_once ($_SERVER['DOCUMENT_ROOT'].'/include/'.$page.'.php');
                    ?>
                </div>
            </div>
            <div class="col-right">
                <div class="col-header">
                    <i class="fa fa-file-o" aria-hidden="true"></i>
                    <span>
                        <?=(isset($_SESSION['admin'])) ? 'Сообщения' : 'Описание элемента';?>
                    </span>
                </div>
                <div class="col-body" id="description">
                </div>
            </div>
        </div>
        <footer>
            <div class="col-left-footer">
                <a href="mailto: antonb770@mail.ru">
                    <i class="fa fa-envelope-o" aria-hidden="true"></i>
                    <span>Написать мне письмо</span>
                </a>
            </div>
            <div class="col-right-footer">
                <?
                    if (isset($_SESSION['admin'])) {
                        if ($_SESSION['admin']){
                            ?>
                            <a href="?auth=false">
                                <i class="fa fa-times-circle-o" aria-hidden="true"></i>
                                <span>Выход</span>
                            </a>
                <?      }
                    } else {
                ?>
                    <a href="?auth=true">
                        <i class="fa fa-user-circle" aria-hidden="true"></i>
                        <span>Авторизация</span>
                    </a>
                <? } ?>
            </div>
        </footer>
    </body>
</html>
