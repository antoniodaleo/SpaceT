<?php 
    // PERFIL - MENU INICIAL

    // Verificar a sessão
    if(!isset($_SESSION['a'])){
        exit(); 
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

    <div class="container">
        <div class="row justify-content-center">
            <div class="card col m-3 p-3">
                <h4 class="text-center">PERFIL DO UTILIZADOR</h4>

                <!-- Dados do utilizidar -->
                <h5><i class="far fa-user"></i> <?php echo $dados[0]['nome'] ?></h5>
                <p><i class="fas fa-at"></i> <?php echo $dados[0]['email'] ?> </p>
                <a href="?a=perfil_alterar_password"><i class="fas fa-unlock-alt"></i> Alter password </a>
            </div>
        </div>
    </div>