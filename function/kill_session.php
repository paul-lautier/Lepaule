<?php
function deconnect () : void {
    unset($_SESSION['connected']);
    session_destroy();
} 
?>