<?
include_once ($_SERVER['DOCUMENT_ROOT'].'/config.php');
include_once ($_SERVER['DOCUMENT_ROOT'].'/include/functions.php');
include_once ($_SERVER['DOCUMENT_ROOT'].'/include/db_connect.php');

$query = "SELECT id, category, parent_category FROM category";
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
    <ul><?=showCat(getTree($tree))?></ul>
</div>


<script>
    var classtitle = document.getElementsByClassName("title"),
        classopen = document.getElementsByClassName("fa-plus-square-o");

    var showDescription = function() {
        let id = this.getAttribute("data-id");
        ajax("ajax/description.php?id=" + id);
    };

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

/* Описания категории */
    Array.from(classtitle).forEach(function(element) {
      element.addEventListener('click', showDescription);
    });

/* Открытие вложенных категорий */
    Array.from(classopen).forEach(function(element) {
      element.addEventListener('click', openCategory);
    });


</script>