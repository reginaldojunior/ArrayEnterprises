$(document).ready(function(){



	function getParam(n){
	     return (location.search.match(new RegExp(n + '=([^?&=]+)')) || [])[1] || '';
	}
	setInterval(function(){
		var acao = 'atualizar_blog';
		var id = getParam('id');
		//alert(id);
		$.ajax({
				type: "post",
				dataType: "json",
				url: "../requisicoes.php",
				async: true,
				data: {acao: acao, id_usuario: id},				
				error: function(x){
					//console.log(x);
					//alert("Não Foi !");
				},
				success: function(x){
					$("#posts").html(x).show( "slow" );
				}
		});
	},2000);

})