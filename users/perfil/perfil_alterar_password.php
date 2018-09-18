<?php
     // PERFIL - MENU INICIAL

    // Verificar a sessão
    if(!isset($_SESSION['a'])){
        exit(); 
    }



    //Define o erro
    $erro = false; 
    $mensagem = '';
    $successo = false; 
    // Verifica se foi feito um post
    if($_SERVER['REQUEST_METHOD'] == 'POST'){

        // Busca os valores inseridos nos inputs
        $password_atual =$_POST['text_password_atual'];
        $password_nova1 =$_POST['text_password_nova_1'];
        $password_nova2 =$_POST['text_password_nova_2'];

        // Verificacoes ========================
        $gestor = new cl_gestorBD();
        // Verifica se a password atual está correta
        $parametros = [
            ':id_utilizador'   =>$_SESSION['id_utilizador'], 
            ':palavra_passe'   =>md5($password_atual) 
        ];

        $dados = $gestor->EXE_QUERY(
            'SELECT id_utilizador, palavra_passe FROM utilizadores
             WHERE  id_utilizador = :id_utilizador
             AND palavra_passe = :palavra_passe',$parametros);

        if(count($dados) == 0)
        {   
            $erro = true; 
            $mensagem = 'A password atual nao coincide';
        }
        
        if(!$erro){
            // Verificar se a 2 pass novas coincidem
            if($password_nova1 != $password_nova2){
                $erro = true; 
                $mensagem = 'A nova pass nao coincidem';

            }
        }
        // Atualizar a pass na bd
        if(!$erro){
            $data_atualizacao = new DateTime(); 
            $parametros = [
                ':id_utilizador'   =>$_SESSION['id_utilizador'], 
                ':palavra_passe'   =>md5($password_nova1),
                ':atualizado_em'   =>$data_atualizacao->format('Y-m-d H:i:s')
            ];

            $gestor->EXE_NON_QUERY(
                'UPDATE utilizadores SET
                palavra_passe = :palavra_passe, 
                atualizado_em = :atualizado_em
                WHERE id_utilizador =:id_utilizador'
                ,$parametros);

                $successo = true; 
                $mensagem = 'Password atualizada com sucesso'; 

                //LOG
                funcoes::CriarLOG('Utilizador '.$_SESSION['nome'].' alterou a sua password.',$_SESSION['nome']);
        }


        /*
        1. A password atual tem que ser igual a da bd
        2. Password nova 1 tem quer = a p nova 2
        3. Alterar pass na bd
        nota: Cuidado com o MD5!!!
        */
    }


?>

    <?php if($erro) :  ?>
        <div class="alert alert-danger text-center">
            <?php echo $mensagem; ?>   
        </div><!-- End container--> 
    <?php endif;  ?> 
    
    <?php if($successo) : ?>
        <div class="alert alert-success text-center">
            <?php echo $mensagem ?>
        </div>
    <?php endif; ?>
            
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

       

    
      