<?php
session_start();

// инициализация переменных сессии

if (!isset($_SESSION['values']))
{
    $_SESSION['values']['txtLogin'] = '';
    $_SESSION['values']['txtPassword'] = '';
    $_SESSION['values']['selBthMonth'] = '';
    $_SESSION['values']['txtBthDay'] = '';
    $_SESSION['values']['txtBthYear'] = '';
    $_SESSION['values']['txtEmail'] = '';
    $_SESSION['values']['txtPhone'] = '';
    $_SESSION['values']['chkReadTerms'] = '';
}

$_SESSION['errors']['txtLogin'] = 'hidden';
$_SESSION['errors']['txtPassword'] = 'hidden';
$_SESSION['errors']['selBthMonth'] = 'hidden';
$_SESSION['errors']['txtBthDay'] = 'hidden';
$_SESSION['errors']['txtBthYear'] = 'hidden';
$_SESSION['errors']['country'] = 'hidden';
$_SESSION['errors']['city'] = 'hidden';
$_SESSION['errors']['txtEmail'] = 'hidden';
$_SESSION['errors']['txtPhone'] = 'hidden';
$_SESSION['errors']['chkReadTerms'] = 'hidden';
$_SESSION['errors']['Login'] = 'hidden';
$_SESSION['errors']['Password'] = 'hidden';
$_SESSION['errors']['onlyEighteen'] = 'hidden';

if (!isset($_SESSION['sid']))
{
    $_SESSION['sid'] = '';     
}
