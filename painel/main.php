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
                <a <?php selecionadoMenu('cadastrar-depoimento'); ?> href="<?php echo INCLUDE_PATH_PAINEL ?>cadastrar-depoimento">Cadastrar Depoimento</a>
                <a <?php selecionadoMenu('cadastrar-servico'); ?> href="<?php echo INCLUDE_PATH_PAINEL ?>cadastrar-servico">Cadastrar Serviço</a>
                <a <?php selecionadoMenu('cadastrar-slide'); ?> href="">Cadastrar Slides</a>
                <h2>Gestão</h2>
                <a <?php selecionadoMenu('listar-depoimentos'); ?> href="<?php echo INCLUDE_PATH_PAINEL ?>listar-depoimentos">Listar Depoimentos</a>
                <a <?php selecionadoMenu('listar-servicos'); ?> href="<?php echo INCLUDE_PATH_PAINEL ?>listar-servicos">Listar Serviços</a>
                <a <?php selecionadoMenu('listar-slides'); ?> href="">Listar Slides</a>
                <h2>Admnistração do Painel</h2>
                <a <?php selecionadoMenu('editar-usuario'); ?> href="<?php echo INCLUDE_PATH_PAINEL ?>editar-usuario">Editar Usuario</a>
                <a <?php selecionadoMenu('adicionar-usuario'); ?> <?php verificaPermissao(2); ?> href="<?php echo INCLUDE_PATH_PAINEL ?>adicionar-usuario">Adicionar Usuarios</a>
                <h2>Configuração Geral</h2>
                <a <?php selecionadoMenu('editar-site'); ?> href="">Editar Site</a>
            </div>
        </div>
    </aside> 
    <header>
        <div class="center">
            <div class="menu-btn">
                <i class="fa fa-bars"></i>
            </div>
            <div class="loggout">
                <a <?php if(@$_GET['url'] == ''){ ?> style="background: #60727a; padding: 14px 15px 10px 15px;"<?php } ?> href="<?php echo INCLUDE_PATH_PAINEL ?>"><i class="fa fa-home"></i><span> Pagina inicial</span></a>
                <a href="<?php echo INCLUDE_PATH_PAINEL ?>?loggout"><i class="fas fa-power-off"></i><span> Sair</span></a>
            </div>
            <div class="clear"></div>
        </div>
    </header>
    <div class="content">
        <?php Painel::carregarPagina(); ?>
    </div>
    <script src="<?php echo INCLUDE_PATH ?>js/jquery.js"></script>
    <script src="<?php echo INCLUDE_PATH_PAINEL ?>js/jquery.mask.js"></script>
    <script src="<?php echo INCLUDE_PATH_PAINEL ?>js/main.js"></script>
</body>
</html>