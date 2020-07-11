$(function(){

	var open  = true;
	var windowSize = $(window)[0].innerWidth;

	var targetSizeMenu = (windowSize <= 400) ? 200 : 300;

	if(windowSize <= 768){
		$('aside').css('width','0').css('padding','0');
		open = false;
	}

	$('.menu-btn').click(function(){
		if(open){
			//O menu está aberto, precisamos fechar e adaptar nosso conteudo geral do painel
			$('aside').animate({'width':0,'padding':0},function(){
				open = false;
			});
			$('.content,header').css('width','100%');
			$('.content,header').animate({'left':0},function(){
				open = false;
			});
		}else{
			//O menu está fechado
			$('aside').css('display','block');
			$('aside').animate({'width':targetSizeMenu+'px','padding':'10px 0'},function(){
				open = true;
			});
			if(windowSize > 768)
				$('.content,header').css('width','calc(100% - 300px)');
				$('.content,header').animate({'left':targetSizeMenu+'px'},function(){
				open = true;
			});
		}
	})

	$(window).resize(function(){
		windowSize = $(window)[0].innerWidth;
		targetSizeMenu = (windowSize <= 400) ? 200 : 300;
		if(windowSize <= 768){
			$('aside').css('width','0').css('padding','0');
			$('.content,header').css('width','100%').css('left','0');
			open = false;
		}else{
			$('aside').animate({'width':targetSizeMenu+'px','padding':'10px 0'},function(){
				open = true;
			});

			$('.content,header').css('width','calc(100% - 300px)');
			$('.content,header').animate({'left':targetSizeMenu+'px'},function(){
			open = true;
			});
		}

	})

	$('[formato=data]').mask('99/99/9999');

	$('[actionBtn=delete]').click(function(){
		var txt;
		var r = confirm("Deseja Excluir o registro");
		if(r == true){
			return true;
		} else{
			return false;
		}
	})
})