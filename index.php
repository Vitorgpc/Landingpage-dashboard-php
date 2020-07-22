<?php include('config.php');?>
<?php Site::updateUsuarioOnline(); ?>
<?php Site::contador(); ?>
<?php 
    $infoSite = MySql::conectar()->prepare("SELECT * FROM `tb_site.config`");
    $infoSite->execute();
    $infoSite = $infoSite->fetch();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="palavras chaves do meu site">
    <meta name="description" content="Descrição do meu WebSite">
    <title><?php echo $infoSite['titulo'] ?></title>
    <link rel="stylesheet" href="<?php echo INCLUDE_PATH;?>css/style.css">
    <link rel="icon" href="<?php echo INCLUDE_PATH;?>favicon.ico" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/51ef95673f.js" crossorigin="anonymous"></script>
</head>
<body>
<base base="<?php echo INCLUDE_PATH; ?>" />
	<?php
		$url = isset($_GET['url']) ? $_GET['url'] : 'home';
		switch ($url) {
			case 'depoimentos':
				echo '<target target="depoimentos" />';
				break;

			case 'servicos':
				echo '<target target="servicos" />';
				break;
		}
	?>
	<div class="sucesso">Formulário enviado com sucesso!</div>
	<div class="erro">E-mail nao foi enviado</div>
	<div class="overlay-loading">
		<img src="<?php echo INCLUDE_PATH ?>images/ajax-loader.gif" />
	</div><!--overlay-loading-->

	<header>
		<div class="center">
			<div class="logo left"><a href="/Projetos_Curso/Projeto_01/">Logomarca</a></div><!--logo-->
			<nav class="desktop right">
				<ul>
					<li><a href="<?php echo INCLUDE_PATH; ?>">Home</a></li>
					<li><a href="<?php echo INCLUDE_PATH; ?>depoimentos">Depoimentos</a></li>
					<li><a href="<?php echo INCLUDE_PATH; ?>servicos">Serviços</a></li>
					<li><a href="<?php echo INCLUDE_PATH; ?>noticias">Noticias</a></li>
					<li><a realtime="contato" href="<?php echo INCLUDE_PATH; ?>contato">Contato</a></li>
				</ul>
			</nav>
			 <nav class="mobile right">
			 	<div class="botao-menu-mobile">
			 		<i class="fa fa-bars" aria-hidden="true"></i>
			 	</div>
				<ul>
					<li><a href="<?php echo INCLUDE_PATH; ?>">Home</a></li>
					<li><a href="<?php echo INCLUDE_PATH; ?>depoimentos">Depoimentos</a></li>
					<li><a href="<?php echo INCLUDE_PATH; ?>servicos">Serviços</a></li>
					<li><a href="<?php echo INCLUDE_PATH; ?>noticias">Noticias</a></li>
					<li><a realtime="contato" href="<?php echo INCLUDE_PATH; ?>contato">Contato</a></li>
				</ul>
			</nav>
		<div class="clear"></div><!--clear-->
		</div><!--center-->
	</header>

	<div class="container-principal">
	<?php

		if(file_exists('pages/'.$url.'.php')){
			include('pages/'.$url.'.php');
		}else{
			//Podemos fazer o que quiser, pois a página não existe.
			if($url != 'depoimentos' && $url != 'servicos'){
				$urlPar = explode('/', $url)[0];
				if($urlPar != 'noticias'){
					$pagina404 = true;
					include('pages/404.php');
				} else{
					include('pages/noticias.php');
				}
			}else{
				include('pages/home.php');	
			}
		}

	?>

	</div><!--container-principal-->

	<footer <?php if(isset($pagina404) && $pagina404 == true) echo 'class="fixed"'; ?>>
		<div class="center">
			<p>Todos os direitos reservados</p>
		</div><!--center-->
	</footer>

	<script src="<?php echo INCLUDE_PATH; ?>js/jquery.js"></script>
	<script src="<?php echo INCLUDE_PATH; ?>js/constants.js"></script>
	<script src='https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyDHPNQxozOzQSZ-djvWGOBUsHkBUoT_qH4'></script>
	<script src="<?php echo INCLUDE_PATH; ?>js/scripts.js"></script>
	<script src="<?php echo INCLUDE_PATH; ?>js/slider.js"></script>

	<?php 
		if(is_array($url) && strstr($url[0],'noticias') !== false){
	?>
		<script>
			$(function(){
				$('select').change(function(){
					location.href=include_path+"noticias/"+$(this).val();
				});
			})
		</script>
	<?php } ?>

	<?php
		if($url == 'contato'){
	?>
	<?php } ?>
	<script src="<?php echo INCLUDE_PATH; ?>js/formularios.js"></script>
</body>
</html>