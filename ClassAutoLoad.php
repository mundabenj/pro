<?php
require_once 'conf.php'; // Include configuration file
require_once dirname(__FILE__) . DIRECTORY_SEPARATOR . "Includes/dbConnection.php";
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

/* Create the DB Connection */
$SQL = New dbConnection($conf['db_type'], $conf['db_host'], $conf['db_name'], $conf['db_user'], $conf['db_pass'], $conf['db_port']);
// print'<pre>'; print_r($SQL); print'</pre>';


// Instantiate objects
$ObjSendMail = new SendMail();
$ObjForm = new forms();
$ObjLayout = new layouts();

$ObjAuth = new Auth($conf);
$ObjFncs = new fncs();


$ObjAuth->signup($conf, $ObjFncs, $lang, $ObjSendMail, $SQL);