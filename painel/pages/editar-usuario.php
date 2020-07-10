<div class="box-content">
    <h2><i class="fa fa-pencil"></i> Editar Usuario</h2>
    <form method="post" enctype="multipart/form-data">
        <?php
            if(isset($_POST['acao'])){
                $nome = $_POST['nome'];
                $senha = $_POST['password'];
                $imagem = $_FILES['imagem'];
                $imagem_atual = $_POST['imagem_atual'];
                $usuario = new Usuario();
                if($imagem['name'] != ''){
                    if(Painel::imagemValida($imagem)){
                        Painel::deleteFile($imagem_atual);
                        $imagem = Painel::uploadFile($imagem);
                        if($usuario->atualizarUsuario($nome, $senha, $imagem)) {
                            $_SESSION['img'] = $imagem;
                            Painel::alerta('sucesso', ' Atualização realizada com sucesso!');
                        } else{
                            Painel::alerta('erro', ' Ocorreu um erro ao atualizar');
                        }
                    } else{
                        Painel::alerta('erro', ' O formato da Imagem não é valido');
                    }
                } else{
                    $imagem = $imagem_atual;
                    if($usuario->atualizarUsuario($nome, $senha, $imagem)) {
                        Painel::alerta('sucesso', ' Atualização realizada com sucesso!');
                    } else{
                        Painel::alerta('erro', ' Ocorreu um erro ao atualizar');
                    }
                }
            }
        ?>

        <div class="form-group">
            <label>Nome: </label>
            <input type="text" name="nome" value="<?php echo $_SESSION['nome']; ?>" required/>
        </div>
        <div class="form-group">
            <label>Senha: </label>
            <input type="password" name="password" value="<?php echo $_SESSION['password']; ?>" required/>
        </div>
        <div class="form-group">
            <label>Imagem: </label>
            <input type="file" name="imagem"/>
            <input type="hidden" name="imagem_atual" value="<?php echo $_SESSION['img']; ?>"/>
        </div>
        <div class="form-group">
            <input type="submit" name="acao" value="Atualizar" />
        </div>
    </form>
</div>