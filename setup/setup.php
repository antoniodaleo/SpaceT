<?php
    // Setup ================================
    
    // Verificar a sessão
    if(!isset($_SESSION['a'])){
        exit(); 
    }    


    // Verifica se esta definido na URL
    $a = '';
    if(isset($_GET['a'])){ 
        $a = $_GET['a'];
    }
    

    // Route do setup
    switch ($a){
        case 'setup_criar_bd';
            include('setup_criar_bd.php');
           
        // Executa os procedimento para criaacao de base de dados
            break;
        
        case 'setup_inserir_utilizador';
            include('setup_inserir_utilizador.php');
            
        // Inserir utilizadores
            break;
    }

    
    
?>

<div class="conteiner-fluid pdg-20">
   
    <!-- Botão para aceder ao setup-->
    <div class="text-center">
    <h2>SETUP</h2>
        <p><a href="?a=setup_criar_bd" class="btn btn-secondary btn-size-250">Criar Bd</a></p>
        <p><a href="?a=setup_inserir_utilizador" class="btn btn-secondary btn-size-240">Inserir utilizador</a></p>
        
        <hr>
        <p><a href="?a=inicio" class="btn btn-secondary btn-size-150">Voltar</a></p>
    
    </div>
</div>
