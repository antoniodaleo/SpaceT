<?php
    // Gestao do utilizador - Adicionar novo utilizadore =======
    // Verificar a sessão
    if(!isset($_SESSION['a'])){
        exit(); 
    }

    // Verificar permissoes. So entra aqui o administrador
    $erro_permissao = false; 
    if(!funcoes::Permissao(0)){
        $erro_permissao= true; 
    }

?>

 <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-8 card m-3 p-3 ">
                <h4 class="text-center">ADICIONAR NOVO UTILIZADOR</h4>
                <hr>
                <!--Formulario adicionar novo utilizador-->
                <form action="?a=utilizadores_adicionar" method="post">
                    <!-- Nome -->
                    <div class="form-group">
                        <label> Utilizador </label>
                        <input type="text" name="text_utilizador" class="form-control"
                        pattern=".{3,50}"
                        title="Entre 3 e 50 caracteres"  required>
                    </div>


                    <!--Password-->
                    <div class="form-group">
                        <label> Password </label>
                        <div class="row">
                            <div class="col">
                                <input type="password" id="txt_pass" name="text_password" class="form-control"
                                pattern=".{3,30}"
                                title="Entre 3 e 30 caracteres" required>
                            </div>
                            <div class="col">
                                <button type="button"  onclick="gerarPassword(10)" class="btn btn-primary">Gerar Password</button>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Nome -->
                    <div class="form-group">
                        <label> Utilizador </label>
                        <input type="text" name="text_nome" 
                        class="form-control"
                        pattern=".{3,50}"
                        title="Entre 3 e 50 caracteres"  required>
                    </div>
                     <!-- email -->
                     <div class="form-group">
                        <label> Email </label>
                        <input type="email" name="text_email" 
                        class="form-control"
                        pattern=".{3,50}"
                        title="Entre 3 e 50 caracteres"  
                        required>
                    </div>

                    <div class="text-center">
                        <a href="?a=utilizadores_gerir" class="btn btn-primary btn-size-150">Cancelar</a>
                        <button class="btn btn-primary btn-size-150">Criar Utilizador</button>
                    </div>
                    <hr>
                    <div class="text-center">
                        <button type="button" class="btn btn-primary btn-size-200" data-toggle="collapse"
                        data-target="#caixa_permissoes">
                            Definir permissoses
                        </button>
                    </div>
                    <div class="collapse" id="caixa_permissoes">
                        <div class="card p-3">
                            <p>Texto dentro da caixa collapsvavel</p>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>