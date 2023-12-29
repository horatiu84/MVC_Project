<?php

spl_autoload_register(function (string $class_name) {
   // var_dump("src/".str_replace("\\","/",$class_name).".php");
    require "src/".str_replace("\\","/",$class_name).".php";
});

const ROOT = "/mysite/MVC_Project";