<?php
// Setup =======INSERIR UTILIZADR AMNIN
    
    // Verificar a sessão
    if(!isset($_SESSION['a'])){
        exit(); 
    }


// INSERIR UTILIZADR AMNIN
    $gestor = new cl_gestorBD(); 
    $data = new DateTime(); 
    // Definição do parametros
    $parametros = [
        ':utilizador'=>'admin',
        ':palavra_passe'=>md5('admin'),
        ':nome'=>'administrador', 
        ':email'=>'admini@teste.com', 
        ':criado_em'=>$data->format('Y-m-d H:i:s'),
        ':atualizado_em'=>$data->format('Y-m-d H:i:s')  
    ];

  
    // Inserir o utilizador
    $gestor->EXE_NON_QUERY(
        'INSERT INTO utilizadores(utilizador, palavra_passe, nome, email , criado_em, atualizado_em)
        VALUES (:utilizador,:palavra_passe,:nome, :email,:criado_em,:atualizado_em)',$parametros
    );


   

?>

    <div class="alert alert-success text-center">Cliente cadastrado com sucesso</div>