<?php
require "../template/header.php";
        session_unset();
    	session_destroy();
        alert('Vous êtes déconnectés');
        sleep(2);
        header("Location: ../pages/accueil.php");
?>

