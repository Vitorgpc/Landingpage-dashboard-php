<div class="box-content">
    <h2><i class="fas fa-plus-circle"></i>  Cadastrar Noticia</h2>
    <form method="post" enctype="multipart/form-data">
        <?php
            if(isset($_POST['acao'])){
                $categoria_id = $_POST['categoria_id'];
                $titulo = $_POST['titulo'];
                $conteudo = $_POST['conteudo'];
                $capa = $_FILES['capa'];
                
                if($titulo == '' || $conteudo == ''){
                    Painel::alerta('erro', ' Campos vazios nao sao permitidos');

                } else if($capa['tmp_name'] == ''){
                    Painel::alerta('erro', ' Selecione uma imagem');
                } else{
                    if(Painel::imagemValida($capa)){
                        $verifica = MySql::conectar()->prepare("SELECT * FROM `tb_site.noticias` WHERE titulo = ?");
                        $verifica->execute(array($titulo));
                        if($verifica->rowCount() == 0){
                            $imagem = Painel::uploadFile($capa);
                            $slug = Painel::generateSlug($titulo);
                            $arr = ['categoria_id'=>$categoria_id, 'titulo'=>$titulo, 'conteudo'=>$conteudo, 'capa'=>$imagem, 'slug'=>$slug, 'order_id'=>'0', 'nome_tabela'=>'tb_site.noticias'];
                            if(Painel::insert($arr)){
                                Painel::alerta('sucesso', ' O Cadastro da noticia foi realizado com sucesso');
                            }
                        } else{
                            Painel::alerta('erro', ' Ja existe uma noticia com esse nome');
                        }
                    } else{
                        Painel::alerta('erro', ' Selecione uma imagem valida');
                    }
                }
            }
        ?>

        <div class="form-group">
            <label>Categoria:</label>
            <select name="categoria_id">
                <?php
                    $categorias = Painel::selectAll('tb_site.categorias');
                    foreach ($categorias as $key => $value) {
                ?>
                <option value="<?php echo $value['id'] ?>"><?php echo $value['nome'] ?></option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group">
            <label>Titulo: </label>
            <input type="text" name="titulo" value="<?php recoverPost('titulo'); ?>"/>
        </div>
        <div class="form-group">
            <label>Conteudo: </label>
            <textarea name="conteudo"><?php recoverPost('conteudo'); ?></textarea>
        </div>
        <div class="form-group">
            <label>Imagem de Capa: </label>
            <input type="file" name="capa"/>
        </div>
        <div class="form-group">
            <input type="submit" name="acao" value="Cadastrar!" />
        </div>
    </form>
</div>