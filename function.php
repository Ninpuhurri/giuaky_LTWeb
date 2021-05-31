<?php 
function getIndex($k, $default='')
{
    return isset($_GET[$k])?$_GET[$k]:$default;
}

function postIndex($k, $default='')
{
    return isset($_POST[$k])?$_POST[$k]:$default;
}