<?php
session_start();
 require_once 'class_user.php';
 $session = new USER();
 if(!$session->is_loggedin())
 {
 $session->redirect('index.php');
 }else{
 session_destroy();
 }
