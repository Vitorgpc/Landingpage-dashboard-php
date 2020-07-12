<div class="box-content">
    <h2><i class="fas fa-wrench"></i> Cadastrar Serviço</h2>
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
            <label>Detalhe o Serviço: </label>
            <textarea name="servico"></textarea>
        </div>
        <div class="form-group">
            <input type="hidden" name="order_id" value="0">
            <input type="hidden" name="nome_tabela" value="tb_site.servicos"/>
            <input type="submit" name="acao" value="Cadastrar!" />
        </div>
    </form>
</div>