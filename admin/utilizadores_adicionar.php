<?php
    // Gestao do utilizador - Adicionar novo utilizadore =======
    // Verificar a sessão  Aula 70
    if(!isset($_SESSION['a'])){
        exit(); 
    }

    // Verificar permissoes. So entra aqui o administrador
    $erro_permissao = false; 
    if(!funcoes::Permissao(0)){
        $erro_permissao= true; 
    }

    $gestor = new cl_gestorBD(); 
    $erro= false; 
    $mensagem = '';
    $successo = false; 


    if($_SERVER['REQUEST_METHOD']== 'POST'){
        // vAI BUSCAR VALOR DO FORMULARIO
        $utilizador =    $_POST['text_utilizador']; 
        $password  =     $_POST['text_password']; 
        $nome_completo = $_POST['text_nome'];
        $email =         $_POST['text_email']; 

        //Permissoes
        //var_dump($permissoes);
        $total_permissoes = (count(include('inc/permissoes.php'))); 
        $permissoes =[]; 
        if(isset($_POST['check_permissao'])){

            $permissoes = $_POST['check_permissao']; 
        }
        $permissoes_finais = ''; 
        for($i=0; $i < 100 ; $i++){
            if($i<$total_permissoes){
                if(in_array($i, $permissoes)){
                    $permissoes_finais.='1';
                }else{
                    $permissoes_finais.= '0';
                }
                     
            }else{
                $permissoes_finais.='1';
            }
            
        }
         
       // echo $permissoes_finais;
       // Verifica os dados na base de dados
        $parametros = [
            ':utilizador' => $utilizador 
        ];

        $dtemp = $gestor->EXE_QUERY('SELECT utilizador 
                                    FROM utilizadores 
                                    WHERE utilizador = :utilizador', $parametros);

        if(count($dtemp)!=0){
            $erro = true; 
            $mensagem = 'ja existe utilizador com mesmo nome'; 
        }

        //Verifica se esiste outro utlizador com o mesmo email 
        if(!$erro){
            $parametros = [
                ':email' => $email
            ];
            $dtemp = $gestor->EXE_QUERY('SELECT email 
                                        FROM utilizadores 
                                        WHERE utilizador = :email', $parametros);

            if(count($dtemp)!=0){
                $erro = true; 
                $mensagem = 'ja existe utilizador com mesma email'; 
            }
         
        }

       // Inserir no banco o utilizador
       if(!$erro){
           $parametros = [
                ':utilizador' => $utilizador, 
                ':palavra_passe' =>md5($password),
                ':nome' => $nome_completo, 
                ':email' => $email, 
                ':permissoes' => $permissoes_finais,
                ':criado_em' => DATAS::DataHoraAtualBD(),  
                ':atualizado_em' => DATAS::DataHoraAtualBD() 
           ];

           $gestor-> EXE_NON_QUERY('INSERT INTO utilizadores 
                        (utilizador, palavra_passe, nome, email , permissoes, criado_em, atualizado_em) 
                        VALUES 
                        (:utilizador, :palavra_passe,:nome, :email, :permissoes,:criado_em , :atualizado_em)'
                        ,$parametros);
                    // Enviar o email para o novo utilizador
                    $mensagem = [
                        $email, 
                        'SPACET - Criacao de nova conta do utilizador',  
                        "<p> Foi criada a nova conta do utlizador com os seg dados</p><p>Utilizador : $utilizador</p><p>Password : $password</p>"
                    ];

                    $mail = new emails();
                    $mail->EnviarEmail($mensagem);


                      echo '<div class="alert alert-success text-center">Utilizador adicionado com sucesso </div>';

       }
       // 


    }
?>
  <!-- Apresenta o erro no caso de existir -->  
 <?php
    if($erro){
        echo '<div class="alert alert-danger text-center">'.$mensagem.'</div>';
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
                    <div class="text-center m-3">
                        <button type="button" class="btn btn-primary btn-size-200" data-toggle="collapse"
                        data-target="#caixa_permissoes">
                            Definir permissoses
                        </button>
                    </div>
                    <!-- Caixa permissoes -->
                    <div class="collapse" id="caixa_permissoes">
                        <div class="card p-3 caixa_permissoes">
                            <?php
                                $permissoes = include('inc/permissoes.php');
                                $id = 0; 
                                foreach($permissoes as $permissao){ ?>
                                
                                <div class="checkbox">
                                    <label for="">
                                        <input type="checkbox" name="check_permissao[]" 
                                        id="check_permissao" value="<?php echo $id ?>">
                                        <span class="permissao-titulo"> <?php echo $permissao['permissao'] ?> </span>
                                    </label><br>
                                    <p class="permissao-sumario"> <?php echo $permissao['sumario'] ?></p>
                                </div>
                                    
                            <?php $id++; } ?>
                            <!-- Todas o nenhuma -->
                            <div>
                                <a href="#" onclick="checkTodos(); return false">Todas</a> <a href="#" onclick="checkNunhumas(); return false">Nenhuma</a> 
                            </div>           
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>