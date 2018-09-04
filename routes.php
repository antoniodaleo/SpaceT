<?php
    // Routes ================================
    
    // Verificar a sessão
    if(!isset($_SESSION['a'])){
        exit(); 
    }

    $a = 'inicio';
    if(isset($_GET['a'])){
        $a = $_GET['a'];

    }

    switch($a){
        // Apresentar a pagina inicial
        case 'inicio':    include_once('inicio.php'); break;  
        // Apresenta a pagina acerca de
        case 'about':     include_once('about.php'); break;
        // Abre o menu do Setup
        case 'setup':     include_once('setup/instalacao.php'); break; 

    }


?>

