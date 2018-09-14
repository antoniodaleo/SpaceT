<?php
    // RECUPERAR SENHA
    // Formulario do login
    if(!isset($_SESSION['a'])){
        exit(); 
    }

    $erro = false; 
    $mensagem = '';

    // Verificar se esiste Post
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $text_email = $_POST['text_email']; 
        //Criar o objeto da base de dados
        $gestor = new cl_gestorBD(); 
        //Parametros
        $parametros = [
            ':email' =>$text_email
        ];
        //Pesquisar na bd para verificar se existe conta de utilizador com este email
        $dados = $gestor->EXE_QUERY(
            'SELECT*FROM utilizadores WHERE email = :email',$parametros
        );

        //Verificar se foi encontrado email
        if(count($dados) == 0){
            $erro = true; 
            $mensagem = 'Não foi encontrado conta de utilizador com esse email';
        }
        // Nao caso nao tem erro , foi encontrada a email
        else{
            //Recuperar password
            $nova_password = funcoes::CriarCodigoAlfanumerio(10);
            
            // enviar email
            echo $nova_password;
            
            // Alterar a senha na bd
            $id_utilizador = $dados[0]['id_utilizador']; 
            $parametros = [
                ':id_utilizador' =>$id_utilizador, 
                ':palavra_passe' =>md5($nova_password)

            ];

            // Atualizazao na bd
            $gestor->EXE_NON_QUERY(
                'UPDATE utilizadores SET palavra_passe = :palavra_passe 
                 WHERE id_utilizador = :id_utilizador', $parametros);

        }
    }



    /*
        - FORMULARIO QUE PERMITE COLOCAR UM ENDERECO DE EMAIL
        - SUBMETER O FORMULARIO E PROCURAR O ENDERECO DE EMAIL NA TABELA DOS UTILIZADORES
        - SE FOR ENCONTRADO UM EMAIL , REFORMULAR A PASSWORD E EVNIAR EMAIL PARA O USUARIO/UTILIZADOR
        - INFORMA QUAL É A NOVA PASSWORD
        
    */


?>
<?php if($erro): ?>
    <div class="alert alert-danger text-center">
        <?php echo $mensagem ?>
    </div>
<?php endif; ?>

<div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-4 card m-3 p-3">
            
                <form action="?a=recuperar_password" method="post">
                    <div class="text-center">
                        <h2>Recuperar</h2>
                        <p>Colaque aqui o seu endereço email</p>
                    </div>
                    <div class="form-group">
                        <input type="email" name="text_email" class="form-control" placeholder="Email" required>
                    </div>
                   
                    <div class="form-group text-center">
                        <a href="?a=inicio" class="btn btn-primary btn-size-150">Cancelar</a>
                        <button role="submit" class="btn btn-primary btn-size-150">Recuperar</button>
                    </div>
                </form>

                <div class="text-center">
                    <a href="?a=recuperar_password">Recuperar password</a>
                </div>

            </div>        
        </div>
    </div>