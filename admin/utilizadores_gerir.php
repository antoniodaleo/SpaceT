<?php
    // Gestao do utilizador - Adicionar novo================================
    // Verificar a sessão  71
    if(!isset($_SESSION['a'])){
        exit(); 
    }

    // Verificar permissoes. So entra aqui o administrador
    $erro_permissao = false; 
    if(!funcoes::Permissao(0)){
        $erro_permissao= true; 
    }

?>
    <?php if($erro_permissao): ?>
        <?php include('inc/sem_permissao.php') ?>   
    <?php else : ?>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col m-3 p-3 text-center">
                <h4 class="text-center">GESTÃO DE UTILIZADORES</h4>
                <div class="text_center">
                    <a href="?a=inicio" class="btn btn-primary btn-size-150">Voltar</a>
                    <a href="?a=utilizadores_adicionar" class="btn btn-primary btn-size-150">Novo utilizador</a>
                </div>

                <?php  //<!-- Tabela dos utilizadores na base de dadas-->  ?>
                <div class="row m-3 p-3">
                
                <table class="table">
                    <!-- Table head -->
                    <thead>
                        <th>Utilizador</th>
                        <th>Nome completo</th>
                        <th>Email</th>
                        <th>Ação</th>
                    </thead>
                    <?php
                        $gestor = new cl_gestorBD(); 
                        $dados_utilizadores= $gestor->EXE_QUERY(
                            'SELECT *FROM utilizadores'
                        ); 
                    ?>

                    <?php foreach ($dados_utilizadores as $utilizador ): ?>
                        <tr>
                            <td><?php echo $utilizador['utilizador']  ?></td>
                            <td><?php echo $utilizador['nome']  ?></td>
                            <td><?php echo $utilizador['email']  ?></td>
                            <td>
                                 <!-- dropdown -->
                                 <?php $id = $utilizador['id_utilizador']?>
                                <div class="dropdown">
                                    <i class="fa fa-cog"  id="d1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class=""></i> 
                                    </i>
                                    <div class="dropdown-menu" aria-labelledby="d1">
                                        <a class="dropdown-item" href="?a=editar_utilizador&id=<?php echo $id ?>"><i class="fa fa-edit"> </i> Editar utilizador</a>
                                        <a class="dropdown-item" href="?a=editar_permissoes&id=<?php echo $id ?>"><i class="fa fa-list"></i> Editar permissões</a>
                                        <a class="dropdown-item" href="?a=eliminar_utilizador&id=<?php echo $id ?>"> <i class="fa fa-trash"></i> Eliminar</a>
                                        
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach;   ?>

                   
                    

                </table>
               
                </div>
            </div>
           
        </div>
    </div>

<?php endif; ?>