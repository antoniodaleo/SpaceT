<?php
     // PERFIL - ALTERAR EMAIL

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

        // Busca o valor inseridos nos inputs
        $novo_email =$_POST['text_novo_email'];
        

        // Verificacoes ========================
        $gestor = new cl_gestorBD();
        // Verifica se a password atual está correta
        $parametros = [
            ':id_utilizador'   =>$_SESSION['id_utilizador'], 
            ':email'   =>$novo_email 
        ];

        $dados = $gestor->EXE_QUERY(
            'SELECT id_utilizador, email FROM utilizadores
             WHERE  id_utilizador <> :id_utilizador
             AND email = :email', $parametros);

        if(count($dados) != 0)
        {  // Outro utilizador com o mesmo email 
            $erro = true; 
            $mensagem = 'Já existe a email atual ja existe';
        }
        
        // Atualizar a pass na bd
        if(!$erro){
            $data_atualizacao = new DateTime(); 
            $parametros = [
                ':id_utilizador'  =>$_SESSION['id_utilizador'], 
                ':email'   =>  $novo_email,
                ':atualizado_em'   =>$data_atualizacao->format('Y-m-d H:i:s')
            ];

            $gestor->EXE_NON_QUERY(
                'UPDATE utilizadores SET
                email = :email, 
                atualizado_em = :atualizado_em
                WHERE id_utilizador =:id_utilizador'
                ,$parametros);

                $successo = true; 
                $mensagem = 'Email atualizada com sucesso'; 

                //Atualiza email
                $_SESSION['email'] =$novo_email;

                //LOG
                funcoes::CriarLOG('Utilizador '.$_SESSION['nome'].' alterou a sua email.',$_SESSION['nome']);
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
                                <!-- Apresenta email atual -->
                                <div>Email atual: <?php echo $_SESSION['email'] ?></div>

                            <hr>
                                <!-- formulário -->
                                <form action="?a=perfil_alterar_email" method="post">

                                <div class="col-sm-4 offset-sm-4 justify-content-center">
                                    <div class="form-group">
                                        <label>Novo Email:</label>
                                        <input type="email" 
                                            class="form-control" 
                                            name="text_novo_email"
                                            required title="No minimo 5 e no maximo 50 caracteres"
                                            pattern=".{5,50}"
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
