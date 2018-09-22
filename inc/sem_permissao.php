<?php

    if(!isset($_SESSION['a'])){
        exit(); 
    }

?>

 <div class="container">
            <div class="row justify-content-center">
                <div class="col m-3 p-3 text-center">
                    <h1><i class="fas fa-exclamation-triangle" ></i></h1>
                    <p class="text-center">Nao tem permissao para essa funcionalidade</p>
                    <a href="?a=inicio" class="btn btn-primary btn-size-150">Voltar</a>
                    <!-- FALTA FAZER-->
                </div>
            </div>
        </div>