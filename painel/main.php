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
        </div>
    </aside> 
    <header>
        <div class="center">
            <div class="menu-btn">
                <i class="fa fa-bars"></i>
            </div>
            <div class="loggout">
                <a href="<?php echo INCLUDE_PATH_PAINEL ?>?loggout"><i class="fas fa-power-off"></i><span> Sair</span></a>
            </div>
            <div class="clear"></div>
        </div>
    </header>
    <div class="content">
        <div class="box-content left w100">
            
        </div>
        <!--<div class="box-content left w100">
            
        </div>
        <div class="box-content left w50">
            
        </div>
        <div class="box-content right w50">
            
        </div>-->
        <div class="clear"></div>
    </div>
    <script src="<?php echo INCLUDE_PATH ?>js/jquery.js"></script>
    <script src="<?php echo INCLUDE_PATH_PAINEL ?>js/main.js"></script>
</body>
</html>