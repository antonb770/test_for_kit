<?php
function getTree($dataset) {
    $tree = [];
    foreach ($dataset as $id => &$node) {
        if ($node['parent'] == 0){
            $tree[$id] = &$node;
        }else{
            $dataset[$node['parent']]['childs'][$id] = &$node;
        }
    }
    return $tree;
}

/* Публичная часть */
function tplMenu($category){
    $plus = (isset($category['childs'])) ? ' <span class="hand"><i class="fa fa-plus-square-o" aria-hidden="true"></i></span>' : '';

    $hd = ($category['parent'] != 0) ? 'class="hide"' : '';
    $menu = '<li '.$hd.'>
        <span title="'. $category['title'] .'" class="title" data-id="'.$category['id'].'">'.
        $category['title'].'</span>'.$plus;

        if(isset($category['childs'])){
            $menu .= '<ul>'.showCat($category['childs']) .'</ul>';
        }
    $menu .= '</li>';
    return $menu;
}

function showCat($data){
    $string = '';
    foreach($data as $item){
        $string .= tplMenu($item);
    }
    return $string;
}

/* Админка */
function tplMenuAdmin($category){
    $plus = (isset($category['childs'])) ? ' <span class="hand"><i class="fa fa-plus-square-o" aria-hidden="true"></i></span>' : '';
    $hd = ($category['parent'] != 0) ? 'class="hide"' : '';
    $menu = '<li '.$hd.'>'.
            '<input class="category-edit" data-id="'.$category['id'].'" value="'.$category['title'].'" placeholder="Введите название">'.
            ' <span class="hand category-delete" data-id="'.$category['id'].'" title="Удалить">'.
            '<i class="fa fa-trash" aria-hidden="true"></i></span>'.
            ' <span class="hand category-decription" data-id="'.$category['id'].'" title="Редактировать описание">'.
            '<i class="fa fa-file-text-o" aria-hidden="true"></i></span>'.
            ' <span class="hand category-insert" data-id="'.$category['id'].'" title="Добавить объект на этот уровень дерева">'.
            '<i class="fa fa-list" aria-hidden="true"></i></span>'.
            ' <span class="hand category-change" data-id="'.$category['id'].'" data-tl="'.$category['title'].'" title="Изменить родителя">'.
            '<i class="fa fa-folder-open-o" aria-hidden="true"></i></span>'.$plus;

        if(isset($category['childs'])){
            $menu .= '<ul>'.showCatAdmin($category['childs']) .'</ul>';
        }
    $menu .= '</li>';
    return $menu;
}

function showCatAdmin($data){
    $string = '';
    foreach($data as $item){
        $string .= tplMenuAdmin($item);
    }
    return $string;
}