<?php 
spl_autoload_register(function ($class) {
    // Get all the files in the folder src that end with .php
    require_once BASEPATH.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR. $class . '.php';
});
?>