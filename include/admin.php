<?
if (!isset($_SESSION['admin'])) {
    header('Location: /');
    exit;
}

include_once ($_SERVER['DOCUMENT_ROOT'].'/config.php');
include_once ($_SERVER['DOCUMENT_ROOT'].'/include/functions.php');
include_once ($_SERVER['DOCUMENT_ROOT'].'/include/db_connect.php');

$query = "SELECT id, category, parent_category FROM category ";
if (!($statement = $db->prepare($query))) {
    exit('Error query (category)');
}
$statement->execute();
$statement->bind_result($id, $category, $parent_category);

$tree = [];
while ($statement->fetch()) {
    $tree[$id] =   [
                    'id' => $id,
                    'title' => $category,
                    'parent' => $parent_category
                ];
}
$statement->close();
?>
<div class="accordion">
    <ul id="root">
        <li>
         <span class="hand category-insert" data-id="null" title="Добавить объект на первый уровень">
            Добавить объект на верхний уровень <i class="fa fa-list" aria-hidden="true"></i>
        </span>
        </li>
    <?=showCatAdmin(getTree($tree))?>
    </ul>
</div>


<script>
    var classedit = document.getElementsByClassName("category-edit"),
        classdelete = document.getElementsByClassName("category-delete"),
        classinsert = document.getElementsByClassName("category-insert"),
        classeditd = document.getElementsByClassName("category-decription"),
        classchange = document.getElementsByClassName("category-change"),
        classopen = document.getElementsByClassName("fa-plus-square-o");

    var editCategory = function() {
        let id = this.getAttribute("data-id"),
        category = this.value;

        if (category.length < 1 || category.length > 128) {
           alert('Не допустимое имя категории!');
           window.location = '/';
           return false;
        }

        ajax("ajax/edit.php?id=" + id + "&category="+category.trim());
    };

    var deleteCategory = function() {
        if (!confirm("Вы действительно хотите удалить категорию?")) {
            return false;
        }
        let id = this.getAttribute("data-id");

        ajax("ajax/delete.php?id=" + id);
        alert('Категория удалена!');
        window.location = '/';
    };

    var editDescription = function() {
        let id = this.getAttribute("data-id"),
            desc = document.getElementById('description');
        desc.innerHTML = '';
        ajax("ajax/description.php?id=" + id);
        desc.innerHTML =
            '<input id="id_desc" value="'+id+'" hidden>'+
            '<div contenteditable="true" id="edit-description" title="Введите описание">'+desc.innerHTML+'</div>'+
            '<span class="hand" title="Сохранить описание"><i class="fa fa-check-circle-o fa-3x" aria-hidden="true" onclick="saveDescription()"></i></span>';

    };

    function saveDescription(){
        let id = document.getElementById('id_desc').value,
            desc = document.getElementById('edit-description').innerHTML;

        if (id.length < 1) {
           return false;
        }
        ajax("ajax/edit_description.php?id="+id+"&description="+desc);
    }

    var insertCategory = function() {
        let id = this.getAttribute("data-id");

        document.getElementById('description').innerHTML =
            '<input id="id_desc" value="'+id+'" hidden>'+
            '<div><input id="insert-category" placeholder="Введите название"></div>'+
            '<small>* Описание к категории (объекту) вы можете добавить/изменить позже ( <i class="fa fa-file-text-o" aria-hidden="true"></i> ). '+
            'По умолчанию описание не создается.</small><br>'+
            '<span class="hand" title="Сохранить описание"><i class="fa fa-check-circle-o fa-3x" aria-hidden="true" onclick="saveInsertCategory()"></i></span>';
    };

    function saveInsertCategory(){
        let id = document.getElementById('id_desc').value,
            category = document.getElementById('insert-category').value;

        if (category.length < 1 || category.length > 128) {
           alert('Не допустимое имя категории!');
           return false;
        }

        ajax("ajax/insert.php?id="+id+"&category="+category);
        alert('Категория добавлена!');
        window.location = '/';
    }

    var changeCategory = function() {
        let id = this.getAttribute("data-id"),
            ht = this.getAttribute("data-tl");

        document.getElementById('description').innerHTML =
            '<input id="id_desc" value="'+id+'" hidden>'+
            '<div>Выберите новую категорию для '+ht+'</div>'+
            '<select id="change-category">'+
            '<option selected value="0">Верхний уровень</option>'+
            <?
            foreach ($tree as $k) {
                echo '\'<option value="'.$k['id'].'">'.$k['title'].'</option>\'+';
            }
            ?>
            '</select><br>'+
            '<span class="hand" title="Сменить родителя"><i class="fa fa-check-circle-o fa-3x" aria-hidden="true" onclick="saveChangeCategory()"></i></span>';
    };

    function saveChangeCategory(){
        let id = document.getElementById('id_desc').value,
            newparent = document.getElementById('change-category').value;

        ajax("ajax/change.php?id="+id+"&newparent="+newparent);

        alert('Родительская категория изменена!');
        window.location = '/';
    }



    var openCategory = function() {
        let prt = this.parentNode.parentNode,
            not = 'ul li ul li';

        document.getElementById('description').innerHTML = '';

        while(1){
            prt.querySelectorAll('ul>li:not('+not+' *)').forEach(n => {
                n.classList.remove('hide');
            });
            if (prt.querySelectorAll('ul>li:not('+not+' *)').length == 0) {
                not += ' ul li';
            } else {
                break;
            }
        }

    };

/* Редактирование категории */
    Array.from(classedit).forEach(function(element) {
      element.addEventListener('change', editCategory);
    });

/* Удаление категории */
    Array.from(classdelete).forEach(function(element) {
      element.addEventListener('click', deleteCategory);
    });

/* Создание категории (Добавить объект на этот уровень дерева) */
    Array.from(classinsert).forEach(function(element) {
      element.addEventListener('click', insertCategory);
    });

/* Изменить родителя категории */
    Array.from(classchange).forEach(function(element) {
      element.addEventListener('click', changeCategory);
    });

/* Редактирование описания категории */
    Array.from(classeditd).forEach(function(element) {
      element.addEventListener('click', editDescription);
    });

/* Открытие вложенных категорий */
    Array.from(classopen).forEach(function(element) {
      element.addEventListener('click', openCategory);
    });

</script>