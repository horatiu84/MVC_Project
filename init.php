<?php

spl_autoload_register(function (string $class_name) {
    require "src/$class_name.php";
});

const ROOT = "/mysite/MVC_Project";