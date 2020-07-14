<?php
    $url = explode('/',$_GET['url']);
    if(!isset($url[2])){
        $categoria = MySql::conectar()->prepare("SELECT *  FROM `tb_site.categorias` WHERE slug = ?");
        $categoria->execute(array(@$url[1]));
        $categoria = $categoria->fetch();
?>

<section class="header-noticias">
    <div class="center">
        <h2><i class="far fa-newspaper"></i></h2>
        <h2>Acompanhe as ultimas <b>noticias do portal</b></h2>
    </div>
</section>

<section class="container-portal">
    <div class="center">
        <div class="sidebar">
            <div class="box-content-sidebar">
                <h3><i class="fa fa-search"></i> Realizar uma Busca:</h3>
                <form method="post">
                    <input type="text" name="parametro" placeholder="o que deseja procurar?" required/>
                    <input type="submit" name="buscar" value="Pesquisar!"/>
                </form>
            </div>
            <div class="box-content-sidebar">
                <h3><i class="fas fa-list-ul"></i> Selecione a Categoria:</h3>
                <form action="">
                    <select name="categoria">
                        <option value="" selected="">Todas as Categorias</option>
                        <?php
                            $categorias = MySql::conectar()->prepare("SELECT * FROM `tb_site.categorias` ORDER BY order_id ASC");
                            $categorias->execute();
                            $categorias = $categorias->fetchAll();
                            foreach ($categorias as $key => $value) {
                                
                        ?>
                        <option <?php if($value['slug'] == @$url[1]) echo 'selected'; ?> value="<?php echo $value['slug'] ?>"><?php echo $value['nome'] ?></option>
                        <?php } ?>
                    </select>
                </form>
            </div>
            <div class="box-content-sidebar">
                <h3><i class="fa fa-user"></i> Sobre o autor:</h3>
                <div class="autor-box-portal">
                    <div class="box-img-autor"></div>
                    <div class="texto-autor-portal text-center">
                        <?php 
                            $infoSite = MySql::conectar()->prepare("SELECT * FROM `tb_site.config`");
                            $infoSite->execute();
                            $infoSite = $infoSite->fetch();
                        ?>
                        <h3><?php echo $infoSite['nome_autor'] ?></h3>
                        <p><?php echo substr($infoSite['descricao'], 0, 350) ?></p>
                    </div>
                </div>
            </div>
        </div>

        <div class="conteudo-portal">
            <div class="topo-conteudo-portal">
                <?php 
                    $porPagina = 3;
                    if(@$categoria['nome'] == ''){
                        echo '<h2>Visualizando todos os Posts</h2>';
                    } else{
                        echo '<h2>Visualizando posts em <span>'.$categoria['nome'].'</span></h2>';
                    }

                    $query = "SELECT * FROM `tb_site.noticias` ";
                    if(@$categoria['nome'] != ''){
                        $categoria['id'] = (int)$categoria['id'];
                        $query.="WHERE categoria_id = $categoria[id]";
                    }

                    if(isset($_POST['parametro'])){
                        if(strstr($query, 'WHERE') !== false){
                            $busca = $_POST['parametro'];
                            $query.=" AND titulo LIKE '%$busca%'";
                        } else{
                            $busca = $_POST['parametro'];
                            $query.=" WHERE titulo LIKE '%$busca%'";
                        }
                    }

                    if(isset($_GET['pagina'])){
                        $pagina = (int)$_GET['pagina'];
                        $queryPg = ($pagina - 1) * $porPagina;
                        $query.=" ORDER BY id DESC LIMIT $queryPg, $porPagina";
                    } else{
                        $pagina = 1;
                        $query.=" ORDER BY id DESC LIMIT 0, $porPagina";
                    }

                    $sql = MySql::conectar()->prepare($query);
                    $sql->execute();
                    $noticias = $sql->fetchAll();
                ?>
            </div>
            <?php 
                foreach ($noticias as $key => $value) {
                    $sql = MySql::conectar()->prepare("SELECT `slug` FROM `tb_site.categorias` WHERE id = ?");
                    $sql->execute(array($value['categoria_id']));
                    $categoriaNome = $sql->fetch()['slug'];
            ?>
            <div class="box-single-conteudo">
                <h2><?php echo date('d/m/Y',strtotime($value['data'])); ?> - <?php echo $value['titulo']; ?></h2>
                <p><?php echo substr(strip_tags($value['conteudo']), 0, 450).'...'; ?></p>
                <a href="<?php echo INCLUDE_PATH; ?>noticias/<?php echo $categoriaNome; ?>/<?php echo $value['slug']; ?>">Leia Mais</a>
            </div>
            <?php } ?>
            
            <?php
                $query = "SELECT * FROM `tb_site.noticias`";
                if(@$categoria['nome'] != ''){
                    $categoria['id'] = (int)$categoria['id'];
                    $query.="WHERE categoria_id = $categoria[id]";
                }
                if(isset($_POST['parametro'])){
                    if(strstr($query, 'WHERE') !== false){
                        $busca = $_POST['parametro'];
                        $query.=" AND titulo LIKE '%$busca%'";
                    } else{
                        $busca = $_POST['parametro'];
                        $query.=" WHERE titulo LIKE '%$busca%'";
                    }
                }
                $totalPaginas = MySql::conectar()->prepare($query);
                $totalPaginas->execute();
                $totalPaginas = ceil($totalPaginas->rowCount() / $porPagina);
            ?>
            <div class="paginator">
                <?php
                    for($i = 1; $i <= $totalPaginas; $i++){
                        $catStr = (@$categoria['nome'] != '') ? '/'.$categoria['slug'] : '';
                        if($pagina == $i)
                            echo '<a href="'.INCLUDE_PATH.'noticias'.$catStr.'?pagina='.$i.'" class="active-page">'.$i.'</a>';
                        else
                            echo '<a href="'.INCLUDE_PATH.'noticias'.$catStr.'?pagina='.$i.'">'.$i.'</a>';
                    }
                ?>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</section>

<?php 
    } else{
        include('noticia-single.php');
    }     
?>