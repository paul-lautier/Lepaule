<?php
require './function/kill_session.php';
deconnect();
header('Location: index.php');
?>