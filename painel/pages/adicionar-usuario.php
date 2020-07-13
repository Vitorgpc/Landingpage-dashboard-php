<?php 
    verificaPermissaoPagina(2);
?>

<div class="box-content">
    <h2><i class="fa fa-user-plus"></i> Adicionar Usuario</h2>
    <form method="post" enctype="multipart/form-data">
        <?php
            if(isset($_POST['acao'])){
                $login = $_POST['login'];
                $nome = $_POST['nome'];
                $senha = $_POST['password'];
                $imagem = $_FILES['imagem'];
                $cargo = $_POST['cargo'];

                if($login == ''){
                    Painel::alerta('erro', ' Preencha o campo de login');
                } else if($nome == '') {
                    Painel::alerta('erro', ' Preencha o campo de nome');
                } else if($senha == '') {
                    Painel::alerta('erro', ' Preencha o campo de senha');
                } else if($cargo == '') {
                    Painel::alerta('erro', ' Escolha um cargo para o usuario');
                } else if($imagem['name'] == '') {
                    Painel::alerta('erro', ' Escolha uma imagem de perfil');
                } else{
                    if($cargo >= $_SESSION['cargo']) {
                        Painel::alerta('erro', ' Você precisa selecionar um cargo menor que o seu!');
                    } else if(Painel::imagemValida($imagem) == false) {
                        Painel::alerta('erro', ' O formato especificado nao esta correto');
                    } else if(Usuario::userExists($login)) {
                        Painel::alerta('erro', ' O Login já existe');
                    } else{
                        $usuario = new Usuario();
                        include('../classes/lib/WideImage.php');
                        $imagem = Painel::uploadFile($imagem);
                        WideImage::load('uploads/'.$imagem)->resize(100)->saveToFile('uploads/'.$imagem);
                        $usuario->cadastrarUsuario($login, $senha, $imagem, $nome, $cargo);
                        Painel::alerta('sucesso', ' O cadastro foi realizado com sucesso');
                    }
                }  
            }
        ?>

        <div class="form-group">
            <label>Login: </label>
            <input type="text" name="login" />
        </div>
        <div class="form-group">
            <label>Nome: </label>
            <input type="text" name="nome" />
        </div>
        <div class="form-group">
            <label>Senha: </label>
            <input type="password" name="password" />
        </div>
        <div class="form-group">
            <label>Cargo: </label>
            <select name="cargo">
                <?php
                    foreach (Painel::$cargos as $key => $value) {
                        if($key < $_SESSION['cargo']){ 
                            echo '<option value="'.$key.'">'.$value.'</option>';
                        }
                    }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label>Imagem: </label>
            <input type="file" name="imagem"/>
        </div>
        <div class="form-group">
            <input type="submit" name="acao" value="Cadastrar!" />
        </div>
    </form>
</div>