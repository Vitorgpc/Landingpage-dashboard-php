<?php
    if(isset($_GET['id'])){
        $id = (int)$_GET['id'];
        $servicos = Painel::select('tb_site.servicos', 'id = ?', array($id));
    } else{
        Painel::alerta('erro', 'Você precisa passar o parametro ID.');
        die();
    }
?>

<div class="box-content">
    <h2><i class="fa fa-pencil"></i> Editar Serviço</h2>
    <form method="post">
        <?php
            if(isset($_POST['acao'])){
                if(Painel::update($_POST)){
                    Painel::alerta('sucesso', ' O Serviço foi editado com sucesso');
                    $servicos = Painel::select('tb_site.servicos', 'id = ?', array($id));
                } else{
                    Painel::alerta('erro', ' Campos vazios nao sao permitidos.');
                }
            }
        ?>
        <div class="form-group">
            <label>Serviço: </label>
            <textarea name="servico"><?php echo $servicos['servico']; ?></textarea>
        </div>
        <div class="form-group">
            <input type="hidden" name="nome_tabela" value="tb_site.servicos"/>
            <input type="hidden" name="id" value="<?php echo $id; ?>"/>
            <input type="submit" name="acao" value="Cadastrar!" />
        </div>
    </form>
</div>