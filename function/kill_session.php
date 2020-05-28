<?php
function deconnect () : void {
    session_start();
    session_unset();
    unset($_SESSION['connected']);
    session_destroy();

} 
?>