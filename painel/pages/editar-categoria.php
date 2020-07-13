<?php
    if(isset($_GET['id'])){
        $id = (int)$_GET['id'];
        $categoria = Painel::select('tb_site.categorias', 'id = ?', array($id));
    } else{
        Painel::alerta('erro', 'Você precisa passar o parametro ID.');
        die();
    }
?>

<div class="box-content">
    <h2><i class="fa fa-pencil"></i> Editar Categoria</h2>
    <form method="post">
        <?php
            if(isset($_POST['acao'])){
                $slug = Painel::generateSlug($_POST['nome']);
                $arr = array_merge($_POST,array('slug'=>$slug));
                $verificar = MySql::conectar()->prepare("SELECT * FROM `tb_site.categorias` WHERE nome = ? AND id != ?");
                $verificar->execute(array($_POST['nome'], $id));
                if($verificar->rowCount() == 1){
                    Painel::alerta('erro', ' Já existe uma categoria com este nome!');
                } else{
                    if(Painel::update($arr)){
                        Painel::alerta('sucesso', ' O Categoria foi editado com sucesso');
                        $categoria = Painel::select('tb_site.categorias', 'id = ?', array($id));
                    } else{
                        Painel::alerta('erro', ' Campos vazios nao sao permitidos.');
                    }
                }   
            }
        ?>
        <div class="form-group">
            <label>Nome da categoria: </label>
            <input type="text" name="nome" value="<?php echo $categoria['nome']; ?>"/>
        </div>
        <div class="form-group">
            <input type="hidden" name="nome_tabela" value="tb_site.categorias"/>
            <input type="hidden" name="id" value="<?php echo $id; ?>"/>
            <input type="submit" name="acao" value="Cadastrar!" />
        </div>
    </form>
</div>