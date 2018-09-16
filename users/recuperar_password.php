<?php
    // RECUPERAR SENHA
    // Formulario do login
    if(!isset($_SESSION['a'])){
        exit(); 
    }

    $erro = false; 
    $mensagem = '';
    $mensagem_enviada= false; 

    // Verificar se esiste Post
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $text_email = $_POST['text_email']; 
        echo '<p>'.$text_email.'</p>' ; 
        //Criar o objeto da base de dados
        $conn = new cl_gestorBD(); 
        //Parametros
        $parametros = [
            ':email' =>$text_email
        ];
        //Pesquisar na bd para verificar se existe conta de utilizador com este email
        $robo = $conn->EXE_QUERY('SELECT * FROM utilizadores WHERE email = :email',$parametros);
         
        
        //Verificar se foi encontrado email
        if(count($robo) == 0){
            $erro = true; 
            $mensagem = 'Não foi encontrado conta de utilizador com esse email';
        }
        // Nao caso nao tem erro , foi encontrada a email
        else{
            //Recuperar password
            $nova_password = funcoes::CriarCodigoAlfanumerio(10);
            $mensagem_enviada= false;
            // enviar email
            $email = new emails(); 
            // preparacao dos dados do email
            $temp = [
                $robo[0]['email'], 
                'SPACET - Recuperação de password',
                '<h3>SPACET</h3><h4>RECUPERACAO DA SENHA</h4><p>'.$nova_password.'</p>'
            ];

            $mensagem_enviada = $email->EnviarEmail($temp);
            
            $test = $robo[0]['id_utilizador']; 
            echo '<p>Numero id: '.$test.'</p>';
            // Alterar a senha na bd

            if($mensagem_enviada){
            
                $id_utilizador = $robo[0]['id_utilizador']; 
                echo '<p>Numero id: '.$id_utilizador.'</p>';

                $parametros = [
                    ':id_utilizador' =>$id_utilizador, 
                    ':palavra_passe' =>md5($nova_password)
                
                ];

                // Atualizazao na bd
                
                $conn->EXE_NON_QUERY(
                    'UPDATE utilizadores SET palavra_passe = :palavra_passe 
                    WHERE id_utilizador = :id_utilizador', $parametros);
                    echo '<p>Password recuperada com sucesso: '.$nova_password.'</p>';
                    echo '<p>Numero id: '.$test.'</p>';
            }else{
                $erro= true; 
                $mensagem ='ATENÇÃO : O email não foi enviada com sucesso'; 
            }    
        }
    }



    /*
        - FORMULARIO QUE PERMITE COLOCAR UM ENDERECO DE EMAIL
        - SUBMETER O FORMULARIO E PROCURAR O ENDERECO DE EMAIL NA TABELA DOS UTILIZADORES
        - SE FOR ENCONTRADO UM EMAIL , REFORMULAR A PASSWORD E EVNIAR EMAIL PARA O USUARIO/UTILIZADOR
        - INFORMA QUAL É A NOVA PASSWORD
    */




?>

<?php if($mensagem_enviada == false) :  ?>

    <!-- Apresentação de erro-->
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

<?php else : ?>
        <!-- Apresentação da mensagem de sucesso-->
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-md-4 card m-3 p-3 text-center">
                    <h2>RECUPERAÇÃO COM SUCESSO</h2>
                    <p>A recuperaçao da password foi efetuada com sucesso, consulta 
                    a sua caixa de email para conhecer a sua password</p>
                    
                    <div class="text-center">
                        <a href="?a=inicio" class="btn btn-primary btn-size-150"> Cancelar </a>
                    </div>
                </div> 
            </div>
        </div>

<?php endif ?>