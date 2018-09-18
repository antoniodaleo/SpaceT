<?php
// Setup =======INSERIR UTILIZADR AMNIN
    
    // Verificar a sessão
    if(!isset($_SESSION['a'])){
        exit(); 
    }



// INSERIR UTILIZADR AMNIN
    $gestor = new cl_gestorBD(); 

    // limpar dados utilizadore
    $gestor->EXE_NON_QUERY('DELETE FROM utilizadores'); 
    $gestor->EXE_NON_QUERY('ALTER TABLE utilizadors AUTO_INCREMENT=1'); 


    $data = new DateTime(); 
    // Definição do parametros
    $parametros = [
        ':utilizador'=>'admin',
        ':palavra_passe'=>md5('admin'),
        ':nome'=>'administrador', 
        ':email'=>'spacespaceteste@gmail.com', 
        ':permissoes'=>str_repeat('1',100), 
        ':criado_em'=>$data->format('Y-m-d H:i:s'),
        ':atualizado_em'=>$data->format('Y-m-d H:i:s')  
    ];

  
    // Inserir o utilizador
    $gestor->EXE_NON_QUERY(
        'INSERT INTO utilizadores(utilizador, palavra_passe, nome, email ,permissoes, criado_em, atualizado_em)
         VALUES (:utilizador,:palavra_passe,:nome, :email, :permissoes, :criado_em,:atualizado_em)',$parametros);

    // INSERIR UTILIZADOR ANTONIO 
    $parametros = [
        ':utilizador'=>'antonio',
        ':palavra_passe'=>md5('antonio'),
        ':nome'=>'antonio', 
        ':email'=>'antoniodaleo@outlook.com', 
        ':permissoes'=>'0'.str_repeat('1',99), 
        ':criado_em'=>$data->format('Y-m-d H:i:s'),
        ':atualizado_em'=>$data->format('Y-m-d H:i:s')  
    ]  ;


    // Inserir o utilizador
    $gestor->EXE_NON_QUERY(
        'INSERT INTO utilizadores(utilizador, palavra_passe, nome, email ,permissoes, criado_em, atualizado_em)
        VALUES (:utilizador,:palavra_passe,:nome, :email, :permissoes, :criado_em,:atualizado_em)',$parametros);
    

?>

    <div class="alert alert-success text-center">Cliente cadastrado com sucesso</div>