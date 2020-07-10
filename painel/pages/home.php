<?php
    $usuariosOnline = Painel::listarUsuariosOnline();
?>
<div class="box-content left w100">
    <h2><i class="fa fa-home"></i> Painel de Controle - <?php echo NOME_EMPRESA ?></h2>
    <div class="box-metricas">
        <div class="box-metrica-single">
            <div class="box-metrica-wraper">
                <h2>Usuarios Online</h2>
                <p><?php echo count($usuariosOnline); ?></p>
            </div>
        </div>
        <div class="box-metrica-single">
            <div class="box-metrica-wraper">
                <h2>Total de Visitas</h2>
                <p>100</p>
            </div>
        </div>
        <div class="box-metrica-single">
            <div class="box-metrica-wraper">
                <h2>Visitas Hoje</h2>
                <p>3</p>
            </div>
        </div>
    </div>
</div>
<div class="box-content left w100">
    <h2><i class="fa fa-user"></i> Usuarios Online</h2>
    <div class="table-responsive">
        <div class="row">
            <div class="col">
                <span>IP</span>
            </div>
            <div class="col">
                <span>Última Ação</span>
            </div>
            <div class="clear"></div>
        </div>
        <?php
            foreach($usuariosOnline as $key => $value){

        ?>
            <div class="row">
                <div class="col">
                    <span><?php echo $value['ip'] ?></span>
                </div>
                <div class="col">
                    <span><?php echo date('d/m/Y H:i:s', strtotime($value['ultima_acao'])) ?></span>
                </div>
                <div class="clear"></div>
            </div>
        <?php
            }
        ?>
    </div>
</div>