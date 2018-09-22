<?php 
    // PERFIL - MENU INICIAL

    // Verificar a sessão
    if(!isset($_SESSION['a'])){
        exit(); 
    }

    $erro = false; 
    $mensagem='';

    // Verifica permissoes acesso ao sistema
    if(!funcoes::Permissao(0)){
        $erro = true; 
        $mensagem = 'Nao tem permissao'; 
    }

    // Vai buscar todas as informacoes do utilizador
    $gestor = new cl_gestorBD(); 
    $parametros = [
        ':id_utilizador' => $_SESSION['id_utilizador']
    ];
    $dados = $gestor->EXE_QUERY(
        'SELECT * FROM utilizadores 
        WHERE id_utilizador = :id_utilizador', $parametros);
        
?>
    <?php if($erro):?>
        <div class="text-center">
            <h3><?php echo $mensagem ?></h3>
            <a href="?a=inicio" class="btn btn-primary btn-size-150">Voltar</a>
        </div>
    <?php else: ?>


    <div class="container">
        <div class="row justify-content-center">
            <div class="card col m-3 p-3">
                <h4 class="text-center">PERFIL DO UTILIZADOR</h4>

                <!-- Dados do utilizidar -->
                <h5><i class="far fa-user"></i> <?php echo $dados[0]['nome'] ?></h5>
                <p><i class="fas fa-at"></i> <?php echo $dados[0]['email'] ?> </p>
            </div>
        </div>

        <div class="text-center">
            <a href="?a=inicio" class="btn btn-primary btn-size-150 m-3">Voltar</a>
        </div>
    </div>

    <?php endif?>