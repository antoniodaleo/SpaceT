<?php
    // Inicio ================================
    
    // Verificar a sessão
    if(!isset($_SESSION['a'])){
        exit(); 
    }


?>

<div class="conteiner-fluid pdg-20 ">
    <!-- Botão para aceder ao setup-->
    <div class="text-center">
        <a href="?a=setup" class="btn btn-secondary ">Setup</a>
    </div>
</div>