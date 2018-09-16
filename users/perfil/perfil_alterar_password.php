<?php
     // PERFIL - MENU INICIAL

    // Verificar a sessão
    if(!isset($_SESSION['a'])){
        exit(); 
    }



?>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col card m-3 p-3 ">
                <h3 class="text-center">Titulo</h3>
                <hr>
                    <!-- formulário -->
                    <form action="?a=perfil_alterar_password" method="post">

                    <div class="col-sm-4 offset-sm-4 justify-content-center">
                        <div class="form-group">
                            <label>Password atual:</label>
                            <input type="text" 
                                class="form-control" 
                                name="text_password_atual"
                                >
                        </div>
                    </div>

                    <div class="col-sm-4 offset-sm-4 justify-content-center">
                        <div class="form-group">
                            <label>Nova password:</label>
                            <input type="text" 
                                class="form-control" 
                                name="text_password_nova_1"
                                required title="No minimo 3 caracteres e no maximo 20."
                                pattern = ".{3,20}"
                                >
                        </div>
                    </div>

                    <div class="col-sm-4 offset-sm-4 justify-content-center">
                        <div class="form-group">
                            <label>Repetir a nova password:</label>
                            <input type="text" 
                                class="form-control" 
                                name="text_password_nova_2"
                                required title="No minimo 3 caracteres e no maximo 20."
                                pattern = ".{3,20}"
                                >
                        </div>
                    </div>

                    <div class="text-center">
                        <a href="?a=perfil" class="btn btn-primary btn-size-150">Voltar</a>
                        <button role="submit" class="btn btn-primary btn-size-150">Alterar</button>                    
                    </div>

                    </form>
                
                
            </div> 
        </div><!-- End row-->
    </div><!-- End container-->    
           
      