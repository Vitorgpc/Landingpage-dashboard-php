<?php 
    verificaPermissaoPagina(2);
?>

<div class="box-content">
    <h2><i class="fas fa-file-alt"></i> Cadastrar Depoimento</h2>
    <form method="post">
        <?php
            if(isset($_POST['acao'])){
                if(Painel::insert($_POST)){
                    Painel::alerta('sucesso', ' O cadastro foi realizado com sucesso');
                } else{
                    Painel::alerta('erro', ' Campos vazios nao sao permitidos');
                }
            }
        ?>

        <div class="form-group">
            <label>Nome da pessoa: </label>
            <input type="text" name="nome" />
        </div>
        <div class="form-group">
            <label>Depoimento: </label>
            <textarea name="depoimento"></textarea>
        </div>
        <div class="form-group">
			<label>Data:</label>
			<input formato="data" type="text" name="data">
		</div>
        <div class="form-group">
            <input type="hidden" name="nome_tabela" value="tb_site.depoimentos"/>
            <input type="submit" name="acao" value="Cadastrar!" />
        </div>
    </form>
</div>