<?php
function __autoload($name){
    include './class/'.$name.'.class.php';
}
$zhangsan = new book();
