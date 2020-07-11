<?php
    if(isset($_GET['id'])){
        $id = (int)$_GET['id'];
        $depoimento = Painel::select('tb_site.depoimentos', 'id = ?', array($id));
    } else{
        Painel::alerta('erro', 'Você precisa passar o parametro ID.');
        die();
    }
?>

<div class="box-content">
    <h2><i class="fa fa-pencil"></i> Editar Depoimento</h2>
    <form method="post">
        <?php
            if(isset($_POST['acao'])){
                if(Painel::update($_POST)){
                    Painel::alerta('sucesso', ' O Depoimento foi editado com sucesso');
                    $depoimento = Painel::select('tb_site.depoimentos', 'id = ?', array($id));
                } else{
                    Painel::alerta('erro', ' Campos vazios nao sao permitidos.');
                }
            }
        ?>

        <div class="form-group">
            <label>Nome da pessoa: </label>
            <input type="text" name="nome" value="<?php echo $depoimento['nome']; ?>" />
        </div>
        <div class="form-group">
            <label>Depoimento: </label>
            <textarea name="depoimento"><?php echo $depoimento['depoimento']; ?></textarea>
        </div>
        <div class="form-group">
			<label>Data:</label>
			<input formato="data" type="text" name="data" value="<?php echo $depoimento['data']; ?>">
		</div>
        <div class="form-group">
            <input type="hidden" name="nome_tabela" value="tb_site.depoimentos"/>
            <input type="hidden" name="id" value="<?php echo $id; ?>"/>
            <input type="submit" name="acao" value="Cadastrar!" />
        </div>
    </form>
</div>