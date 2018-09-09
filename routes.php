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


    funcoes::DestroiSessao(); 
    
    // Verificar o login
    if(!funcoes::VerificarLogin()){
        $a='login'; 
    }


    switch($a){
        // Apresentar login
        case 'login':     include_once('users/login.php'); break;      
        // Apresentar a pagina inicial
        case 'inicio':    include_once('inicio.php'); break;  
        // Apresenta a pagina acerca de
        case 'about':     include_once('about.php'); break;
        // Abre o menu do Setup
        case 'setup':     include_once('setup/setup.php'); break; 
        // Setup - criar base de dados
        case 'setup_criar_bd': include_once('setup/setup.php'); break;
        // Setup - inserir utilizador
        case 'setup_inserir_utilizador';  include_once('setup/setup_inserir_utilizador.php'); break; 

    }


?>

