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


    //funcoes::DestroiSessao(); 
    
    // Verificar o login
    
    if(!funcoes::VerificarLogin()){
        // Casos especiais 
        $routes_especiais = [
            'recuperar_password',
            'setup',
            'setup_criar_bd',
            'setup_inserir_utilizador'
        ];
        // Bypass sistema normal
        if(!in_array($a, $routes_especiais)){
            $a='login'; 
        }

    }
    
    // Barra do Utilizador
    include_once('users/barra_utilizador.php'); 


    switch($a){
        // Apresentar login
        case 'login':     include_once('users/login.php'); break;  
        // Apresentar Logout
        case 'logout':  include_once('users/logout.php'); break;
        // Recuperar password
        case 'recuperar_password': include_once('users/recuperar_password.php'); break; 
        // Perfil
        case 'perfil':  include_once('users/perfil/perfil_menu.php'); break; 
        // Alterar Password
        case 'perfil_alterar_password':  include_once('users/perfil/perfil_alterar_password.php'); break; 
        // Alterar Email
        case 'perfil_alterar_email':  include_once('users/perfil/perfil_alterar_email.php'); break; 
        
        //Opcões do administrador
        case 'utilizadores_gerir':      include_once('admin/utilizadores_gerir.php'); break; 

        // Apresentar a pagina inicial
        case 'inicio':    include_once('inicio.php'); break;  
        // Apresenta a pagina acerca de
        case 'about':     include_once('about.php'); break;
        // Abre o menu do Setup
        case 'setup':     include_once('setup/setup.php'); break; 
        // Setup - criar base de dados
        case 'setup_criar_bd': include_once('setup/setup_criar_bd.php'); break;
        // Setup - inserir utilizador
        case 'setup_inserir_utilizador';  include_once('setup/setup_inserir_utilizador.php'); break; 
        // Formulario novo utilizador
        case 'utilizadores_adicionar': include_once('admin/utilizadores_adicionar.php'); break;
    }


?>

