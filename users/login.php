<?php
    // Formulario do login
    if(!isset($_SESSION['a'])){
        exit(); 
    }

    
    $erro = false; 
    $mensagem = '';
    // Verificar se foi feito um post
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        //verificar se os dados do login estao corretos
        $gestor = new cl_gestorBD(); 
        
        $parametros = [
            ':utilizador'   => $_POST['text_utilizador'],
            ':palavra_passe' => md5($_POST['text_password']) 
        ]; 

        // Procurar o meu utilizador na base de dados
        $dados = $gestor->EXE_QUERY(
            'SELECT*FROM utilizadores 
            WHERE utilizador = :utilizador
            AND palavra_passe = :palavra_passe',$parametros);
        
        if(count($dados) == 0){
            //Login invalidos
            $erro = true; 
            $mensagem = 'Dados de login invalidos.';
        } else {
            // Inicia a sessão
            funcoes::IniciarSessao($dados); 
            echo 'ok';
        }
    }
?>

 <div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-4 card m-3 p-3">
           
            <form action="?a=login" method="post">
                <div class="form-group">
                    <input type="text" name="text_utilizador" class="form-control" placeholder="Utilizador">
                </div>
                <div class="form-group">
                    <input type="password" name="text_password" class="form-control" placeholder="Password">
                </div>
                <div class="form-group text-center">
                    <button role="submit" class="btn btn-primary btn-size-150">Login</button>
                </div>
            </form>

            <div class="text-center">
                <a href="?a=recuperar_password">Recuperar password</a>
            </div>

        </div>        
    </div>
</div>