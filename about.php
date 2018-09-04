<?php
    // Inicio ================================
    
    // Verificar a sessão
    if(!isset($_SESSION['a'])){
        exit(); 
    }

    // Aceder á bd
    $configs = include('inc/config.php');
    echo $configs['NOME_BD']; 
?>


<p>About</p>

