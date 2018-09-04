<?php
    // Inicio ================================
    
    // Verificar a sessão
    if(!isset($_SESSION['a'])){
        exit(); 
    }

    // Aceder á bd
    $gestor =new cl_gestorBD(); 
?>


<p>About</p>

