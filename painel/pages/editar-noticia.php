<?php
    if(isset($_GET['id'])){
        $id = (int)$_GET['id'];
        $noticia = Painel::select('tb_site.noticias', 'id = ?', array($id));
    } else{
        Painel::alerta('erro', 'Você precisa passar o parametro ID.');
        die();
    }
?>

<div class="box-content">
    <h2><i class="fa fa-pencil"></i> Editar Noticia</h2>
    <form method="post" enctype="multipart/form-data">
        <?php
            if(isset($_POST['acao'])){
                $titulo = $_POST['titulo'];
                $conteudo = $_POST['conteudo'];
                $imagem = $_FILES['capa'];
                $imagem_atual = $_POST['imagem_atual'];
                if($imagem['name'] != ''){
                    if(Painel::imagemValida($imagem)){
                        Painel::deleteFile($imagem_atual);
                        $imagem = Painel::uploadFile($imagem);
                        $slug = Painel::generateSlug($titulo);
                        $arr = ['titulo'=>$titulo, 'conteudo'=>$conteudo, 'capa'=>$imagem, 'slug'=>$slug, 'id'=>$id, 'nome_tabela'=>'tb_site.noticias'];
                        Painel::update($arr);
                        $noticia = Painel::select('tb_site.noticias', 'id = ?', array($id));
                        Painel::alerta('sucesso', ' A Noticia foi editado com sucesso');
                    } else{
                        Painel::alerta('erro', ' O formato da Imagem não é valido');
                    }
                } else{
                    $imagem = $imagem_atual;
                    $slug = Painel::generateSlug($titulo);
                    $arr = ['titulo'=>$titulo, 'conteudo'=>$conteudo, 'capa'=>$imagem, 'slug'=>$slug, 'id'=>$id, 'nome_tabela'=>'tb_site.noticias'];
                    Painel::update($arr);
                    $noticia = Painel::select('tb_site.noticias', 'id = ?', array($id));
                    Painel::alerta('sucesso', ' A Noticia foi editado com sucesso');
                }
            }
        ?>

        <div class="form-group">
            <label>Nome: </label>
            <input type="text" name="titulo" value="<?php echo $noticia['titulo']; ?>" required/>
        </div>
        <div class="form-group">
            <label>Conteudo: </label>
            <textarea name="conteudo"><?php echo $noticia['conteudo']; ?></textarea>
        </div>
        <div class="form-group">
            <label>Imagem: </label>
            <input type="file" name="capa"/>
            <input type="hidden" name="imagem_atual" value="<?php echo $noticia['capa']; ?>"/>
        </div>
        <div class="form-group">
            <input type="submit" name="acao" value="Atualizar" />
        </div>
    </form>
</div>