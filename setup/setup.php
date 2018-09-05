<?php
    // Setup ================================
    
    // Verificar a sessão
    if(!isset($_SESSION['a'])){
        exit(); 
    }    


    // Verifica se esta definido na URL
    if(isset($_GET['a'])){ 
        $a = $_GET['a'];
    }
    

    // Route do setup
    switch ($a){
        case 'setup_criar_bd';
            include('setup_criar_bd.php');
            echo 'Base de dados criada'; 
        // Executa os procedimento para criaacao de base de dados
            break;
        
        default:

            break;
    }

    
    
?>

<div class="conteiner-fluid pdg-20">
   
    <!-- Botão para aceder ao setup-->
    <div class="text-center">
    <h2>SETUP</h2>
        <p><a href="?a=setup_criar_bd" class="btn btn-secondary btn-size-250">Criar Bd</a></p>
        <p><a href="" class="btn btn-secondary btn-size-250">Inserir Usuario</a></p>
        
        <hr>
        <p><a href="?a=inicio" class="btn btn-secondary btn-size-150">Voltar</a></p>
    
    </div>
</div>
