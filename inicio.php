<?php
    // Inicio ================================
    
    // Verificar a sessão
    if(!isset($_SESSION['a'])){
        exit(); 
    }


?>

<p>Inicio</p>
<a href="?a=about">Acerca de |</a>
<a href="?a=setup"> Setup</a>