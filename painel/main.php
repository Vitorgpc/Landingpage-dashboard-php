<?php
    if(isset($_GET['loggout'])){
        Painel::loggout();
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH_PAINEL ?>css/style.css">
    <script src="https://kit.fontawesome.com/51ef95673f.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;700&display=swap" rel="stylesheet">
    <title>Painel de controle</title>
</head>
<body>
    <aside>
        <div class="menu-wraper">
            <div class="box-usuario">
                <?php
                    if($_SESSION['img'] == ''){
                ?>
                    <div class="avatar-usuario">
                        <i class="fa fa-user"></i>
                    </div>
                <?php }else { ?>
                    <div class="imagem-usuario">
                        <img src="<?php echo INCLUDE_PATH_PAINEL ?>uploads/<?php echo $_SESSION['img']; ?>" />
                    </div>
                <?php } ?>
                <div class="nome-usuario">
                    <p><?php echo $_SESSION['nome'] ?></p>
                    <p><?php echo pegaCargo($_SESSION['cargo']); ?></p>
                </div>
            </div>
            <div class="itens-menu">
                <h2>Cadastro</h2>
                <a href="<?php echo INCLUDE_PATH_PAINEL ?>cadastrar-depoimento">Cadastrar Depoimento</a>
                <a href="">Cadastrar Serviço</a>
                <a href="">Cadastrar Slides</a>
                <h2>Gestão</h2>
                <a href="">Listar Depoimentos</a>
                <a href="">Listar Serviços</a>
                <a href="">Listar Slides</a>
                <h2>Admnistração do Painel</h2>
                <a href="<?php echo INCLUDE_PATH_PAINEL ?>editar-usuario">Editar Usuario</a>
                <a href="">Adicionar Usuarios</a>
                <h2>Configuração Geral</h2>
                <a href="">Editar</a>
            </div>
        </div>
    </aside> 
    <header>
        <div class="center">
            <div class="menu-btn">
                <i class="fa fa-bars"></i>
            </div>
            <div class="loggout">
                <a href="<?php echo INCLUDE_PATH_PAINEL ?>"><i class="fas fa-home"></i><span> Pagina inicial</span></a>
                <a href="<?php echo INCLUDE_PATH_PAINEL ?>?loggout"><i class="fas fa-power-off"></i><span> Sair</span></a>
            </div>
            <div class="clear"></div>
        </div>
    </header>
    <div class="content">
        <?php Painel::carregarPagina(); ?>
    </div>
    <script src="<?php echo INCLUDE_PATH ?>js/jquery.js"></script>
    <script src="<?php echo INCLUDE_PATH_PAINEL ?>js/main.js"></script>
</body>
</html>