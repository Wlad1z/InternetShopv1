<?php

spl_autoload_register(function($class){
    include 'classes/'. $class. '.php';
});
$PDO = PdoConnect::getInstance();

$categ = $PDO->PDO->query("
    SELECT * FROM `categories` WHERE parent_id = 0
");

function getCategChildren ($catId){
    $PDO = PdoConnect::getInstance();
    $child = $PDO->PDO->query("
        SELECT * FROM `categories`
        WHERE
        parent_id = '{$catId}'
    ");
    
    return createArrayChildren($child);


};

function createArrayChildren($child){
    if (!$child) return false;
    $arrayChild = array();
    while ($childrenInfo = $child->fetch()){
        $arrayChild[]= $childrenInfo;
    }
    
    return $arrayChild;
    
};

$categories = array();

while ($categoryInfo = $categ->fetch()){
    $categChildren = getCategChildren($categoryInfo['id']);
    
    if ($categChildren)
    $categoryInfo['children']=$categChildren;

    $categories[]=$categoryInfo;
}
