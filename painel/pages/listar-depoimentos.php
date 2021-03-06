<?php
    if(isset($_GET['excluir'])){
        $idExcluir = (int)$_GET['excluir'];
        Painel::deletar('tb_site.depoimentos', $idExcluir);
        Painel::redirect(INCLUDE_PATH_PAINEL.'listar-depoimentos');
    } else if(isset($_GET['order']) && isset($_GET['id'])){
        Painel::orderItem('tb_site.depoimentos', $_GET['order'], $_GET['id']);
    }

    $paginaAtual = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
    $porPagina = 4;
    
    $depoimentos = Painel::selectAll('tb_site.depoimentos', ($paginaAtual - 1) * $porPagina, $porPagina);
?>

<div class="box-content">
    <h2><i class="fas fa-copy"></i> Depoimentos Cadastrados</h2>
    <div class="wraper-table">
        <table>
            <tr>
                <td>Nome da Pessoa</td>
                <td>Depoimento</td>
                <td>Data</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <?php
                foreach ($depoimentos as $key => $value) {
                    
            ?>
                <tr>
                    <td><?php echo $value['nome']; ?></td>
                    <td><?php echo $value['depoimento']; ?></td>
                    <td><?php echo $value['data']; ?></td>
                    <td><a href="<?php echo INCLUDE_PATH_PAINEL ?>editar-depoimento?id=<?php echo $value['id']; ?>" class="btn edit"><i class="fa fa-pencil"></i> Editar</a></td>
                    <td><a actionBtn="delete" href="<?php echo INCLUDE_PATH_PAINEL ?>listar-depoimentos?excluir=<?php echo $value['id']; ?>" class="btn delete"><i class="fa fa-times"></i> Deletar</a></td>
                    <td><a class="btn order" href="<?php echo INCLUDE_PATH_PAINEL ?>listar-depoimentos?order=up&id=<?php echo $value['id']; ?>"><i class="fa fa-angle-up"></i></a></td>
                    <td><a class="btn order" href="<?php echo INCLUDE_PATH_PAINEL ?>listar-depoimentos?order=down&id=<?php echo $value['id']; ?>"><i class="fa fa-angle-down"></i></a></td>
                </tr>
            <?php } ?>
        </table>
    </div>
    <div class="paginacao">
        <?php
            $totalPaginas = ceil(count(Painel::selectAll('tb_site.depoimentos')) / $porPagina);
            
            for($i = 1; $i <= $totalPaginas; $i++){
                if($i == $paginaAtual){
                    echo '<a class="page-selected" href="'.INCLUDE_PATH_PAINEL.'listar-depoimentos?pagina='.$i.'">'.$i.'</a>';
                } else{
                    echo '<a href="'.INCLUDE_PATH_PAINEL.'listar-depoimentos?pagina='.$i.'">'.$i.'</a>';
                }
                
            }
        ?>
    </div>
</div>