<div class="box-content">
    <h2><i class="fas fa-plus-circle"></i>  Cadastrar Categoria</h2>
    <form method="post" enctype="multipart/form-data">
        <?php
            if(isset($_POST['acao'])){
                $nome = $_POST['nome'];
                if($nome == ''){
                    Painel::alerta('erro', ' Preencha o campo de Nome');
                } else{
                    $slug = Painel::generateSlug($nome);
                    $arr = ['nome'=>$nome, 'slug'=>$slug, 'order_id'=>'0', 'nome_tabela'=>'tb_site.categorias'];
                    Painel::insert($arr);
                    Painel::alerta('sucesso', ' O cadastro da Categoria foi realizado com sucesso');
                }  
            }
        ?>

        <div class="form-group">
            <label>Nome da categoria: </label>
            <input type="text" name="nome" />
        </div>
        <div class="form-group">
            <input type="submit" name="acao" value="Cadastrar!" />
        </div>
    </form>
</div>