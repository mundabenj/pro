<?php
require 'ClassAutoLoad.php';

$mailCnt = [
    'name_from' => 'BBIT Systems Admin',
    'mail_from' => 'noreply@bbit.com',
    'name_to' => 'Mazziq Studios',
    'mail_to' => 'mazziqstudios@gmail.com',
    'subject' => 'Welcome to BBIT Enterprise',
    'body' => 'This is a new semester <b>Let\'s get started!</b>'
];

$ObjSendMail->Send_Mail($conf, $mailCnt);