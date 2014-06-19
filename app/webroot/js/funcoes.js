$(document).ready(function(){

	$("#cadastrar").click(function(){
		//pega os dados dos input para passa na viariavel
		var nome  = $("#nome").val();
		var email = $("#email").val();
		var senha = $("#senha").val();

		//verificar as variaveis digitadadas
		if(nome != '' && senha != '' && senha.length > 5 && email.indexOf("@") >= 0 && email.indexOf(".") >= 0){
			//da o comando post
			$.ajax({
				type: "post",
				dataType: "json",
				url: "usuario/novo_cadastro",
				async: true,
				data: {
					acao: 'inserir',
					nome: nome,
					email: email,
					senha: senha
				},				
				error: function(x){
					console.log(x);
					//alert("Não Foi !");
				},
				success: function(x){
					console.log(x);
					if(x == true){						
						$("#deslogado").fadeOut();
						$("#logado").css("display","blocker");
						console.log(x);
					}else{
						console.log("Erro: " + x);
					}
				}
			});
		}else{
			$("#nome_cadastro").attr('placeholder','Insira seu nome').css("border-color","#069").val();
			$("#email_cadastro").attr('placeholder','Email invalido').css("border-color","#069").val();
			$("#senha_cadastro").attr('placeholder','Sua senha precisa de 6 caracteres ou mais').css("border-color","#069").val();
		}
	});


	$("#logar").click(function(){
		//pega os dados dos input para passa na viariavel
		var email = $("#login_email").val();
		var senha = $("#login_senha").val();
		alert(email);
		//verificar as variaveis digitadadas
		if(senha != '' && senha.length > 5 && email.indexOf("@") >= 0 && email.indexOf(".") >= 0){
			//da o comando post
			$.ajax({
				type: "post",
				dataType: "json",
				url: "usuario/login/"+email+"/"+senha,
				async: true,
				data: {
					email: email,
					senha: senha
				},				
				error: function(x){
					console.log(x);
					//alert("Não Foi !");
				},
				success: function(x){
					console.log(x);
					if(x == true){						
						$("#deslogado").fadeOut();
						$("#logado").css("display","blocker");
						console.log(x);
					}else{
						console.log("Erro: " + x);
					}
				}
			});
		}else{
			$("#nome_cadastro").attr('placeholder','Insira seu nome').css("border-color","#069").val();
			$("#email_cadastro").attr('placeholder','Email invalido').css("border-color","#069").val();
			$("#senha_cadastro").attr('placeholder','Sua senha precisa de 6 caracteres ou mais').css("border-color","#069").val();
		}
	});



	$("#email").bind("input keyup paste", function(){
		var email = $(this).val();

			$.ajax({
				type: "post",
				dataType: "json",
				url: "usuario/verificar_email_ajax",
				async: true,
				data: {email: email},				
				error: function(x){
					console.log(x);
					//alert("Não Foi !");
				},
				success: function(x){
					console.log(x);
					if(x == false){

					}else{						
						$("#email").attr('placeholder','Email Já Cadastrado').val("");
					}
				}
			});
	});



	/*setInterval(function(){
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
	},2000);*/

});