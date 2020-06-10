<?php
session_start();
if(!isset($_SESSION['connected'])){
    header('Location: ../login.php');
}
require '../bdd.php';
?>