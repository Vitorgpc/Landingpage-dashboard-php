<div class="box-content">
    <h2><i class="fas fa-plus-circle"></i>  Cadastrar Slide</h2>
    <form method="post" enctype="multipart/form-data">
        <?php
            if(isset($_POST['acao'])){
                $nome = $_POST['nome'];
                $imagem = $_FILES['imagem'];
                if($nome == ''){
                    Painel::alerta('erro', ' Preencha o campo de Nome');
                } else{
                    if(Painel::imagemValida($imagem) == false) {
                        Painel::alerta('erro', ' O formato especificado nao esta correto');
                    } else{
                        include('../classes/lib/WideImage.php');
                        $imagem = Painel::uploadFile($imagem);
                        WideImage::load('uploads/'.$imagem)->resize(100)->saveToFile('uploads/'.$imagem);
                        $arr = ['nome'=>$nome, 'slide'=>$imagem, 'order_id'=>'0', 'nome_tabela'=>'tb_site.slides'];
                        Painel::insert($arr);
                        Painel::alerta('sucesso', ' O cadastro do Slide foi realizado com sucesso');
                    }
                }  
            }
        ?>

        <div class="form-group">
            <label>Nome do slide: </label>
            <input type="text" name="nome" />
        </div>
        <div class="form-group">
            <label>Imagem: </label>
            <input type="file" name="imagem"/>
        </div>
        <div class="form-group">
            <input type="submit" name="acao" value="Cadastrar!" />
        </div>
    </form>
</div>