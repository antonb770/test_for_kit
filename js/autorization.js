/* Авторизация */
function autorization(){
    let user_name = document.getElementById("user_name").value,
        user_password = document.getElementById("user_password").value;
    if (user_name.length == 0) {
        alert('Введите имя пользователя!');
        return false;
    } else if(user_password.length == 0) {
        alert('Введите пароль!');
        return false;
    }
    const request = new XMLHttpRequest();
    const url = "ajax/login.php?user_name=" + user_name +
                "&user_password=" + user_password;
    request.open('GET', url, false);
    request.setRequestHeader('Content-Type', 'application/x-www-form-url');
    request.addEventListener("readystatechange", () => {
        if (request.readyState === 4 && request.status === 200) {
            if (request.responseText == "777") {
                window.location = '/';
                return true;
            } else {
                alert('Не верный логин/пароль!');
            }
        }
    });
    request.send();
    return false;
}