<?php
    //Barra do utilizador ================================
    // Verificar a sessão
    if(!isset($_SESSION['a'])){
        exit(); 
    }

    $nome_utilizador = 'Nenhum utilizador ativo';
    $classe = 'barra_utilizador_inativo'; 
    //  Verifica se existe sessão
    if(funcoes::VerificarLogin()){
        $nome_utilizador= $_SESSION['nome'];
        $classe = 'barra_utilizador_ativo';
    }

    ?>

    
        <div class="barra_utilizadores">
            <span class="<?php echo $classe ?>"> <i class="fas fa-user"></i> <?php  echo $nome_utilizador ?></span> 
            
            <?php if(funcoes::VerificarLogin()): ?>
                &nbsp|&nbsp<a href="?a=logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
            <?php endif; ?>
            
            
        </div>
 