<?php
require_once 'ClassAutoLoad.php';

$mailCnt = [
    'name_from' => 'ICS C Community',
    'email_from' => 'no-reply@icsccommunity.com',
    'name_to' => 'Receiver Name',
    'email_to' => 'receiver@example.com',
    'subject' => 'Welcome to ICS C Community',
    'body' => 'This is a new semester. <b>Let\'s make the most of it!</b>'
];

$ObjSendMail->Send_Mail($conf, $mailCnt);