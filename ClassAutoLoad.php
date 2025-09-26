<?php
require_once 'conf.php'; // Include configuration file

// Directories to search for class files
$directories = ["Forms", "Layouts", "Globals", "Proc", "Fncs"];

// Autoload classes from specified directories
spl_autoload_register(function ($className) use ($directories) {
    foreach ($directories as $directory) {
        $filePath = __DIR__ . "/$directory/" . $className . '.php';
        if (file_exists($filePath)) {
            require_once $filePath;
            return;
        }
    }
});

// Instantiate objects
$ObjSendMail = new SendMail();
$ObjForm = new forms();
$ObjLayout = new layouts();

$ObjAuth = new Auth($conf);
$ObjFncs = new fncs();


$ObjAuth->signup($conf, $ObjFncs, $lang, $ObjSendMail);