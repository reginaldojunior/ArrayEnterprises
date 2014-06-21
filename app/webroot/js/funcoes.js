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
				url: "/usuario/novo_cadastro",
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
						$("#nome").css("border-color","green");
						$("#email").css("border-color","green");
						$("#senha").css("border-color","green");
						$("#cadastrar").html("Faça seu login").removeClass("btn btn-primary").addClass("btn btn-success");
						$("#panel").removeClass("panel panel-default").addClass("panel panel-success");
						$("#alertCadastrar").css("display","block").html("Cadastro efetuado com sucesso, por favor faça o login.");
						console.log(x);
					}else{
						console.log("Erro: " + x);
					}
				}
			});
		}
	});

	$("#editar").click(function(){
		var email = $("#email").val();
		var nome = $("#nome").val();
		var senha = $("#senha").val();
		alert(nome);
		//verificar as variaveis digitadadas
		if(senha != '' && senha.length > 5 && nome != ''){
			//da o comando post
			$.ajax({
				type: "post",
				dataType: "json",
				url: "/usuario/editar_cadastro",
				async: true,
				data: {
					email: email,
					nome: nome,
					senha: senha
				},				
				error: function(x){
					console.log(x);
					//alert("Não Foi !");
				},
				success: function(x){
					console.log(x);
					if(x == true){						
						location.href="../home/logado"
						console.log(x);
					}else{
						console.log("Erro: " + x);
					}
				}
			});
		}else{
			alert("entrou aki");
		}
	});

	$("#logar").click(function(){
		//pega os dados dos input para passa na viariavel
		var email = $("#login_email").val();
		var senha = $("#login_senha").val();

		//verificar as variaveis digitadadas
		if(senha != '' && senha.length > 5 && email.indexOf("@") >= 0 && email.indexOf(".") >= 0){
			//da o comando post
			$.ajax({
				type: "post",
				dataType: "json",
				url: "/usuario/login/"+email+"/"+senha,
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
						location.href="home/logado"
						console.log(x);
					}else{
						console.log("Erro: " + x);
					}
				}
			});
		}
	});

	$("#email").bind("input keyup paste", function(){
		var email = $(this).val();

			$.ajax({
				type: "post",
				dataType: "json",
				url: "/usuario/verificar_email_ajax",
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

	$("#postar").click(function(){
		var msg = $("#msg").val();

		$.ajax({
				type: "post",
				dataType: "json",
				url: "/postagem/cadastrar_post",
				async: true,
				data: {msg: msg},				
				error: function(x){
					//console.log(x);
					//alert("Não Foi !");
				},
				success: function(x){
					$("#comentarios").append(x).fadeIn();
				}
		});
	});

	setInterval(function(){
		$.ajax({
				type: "post",
				dataType: "json",
				url: "/postagem/atualizar_posts",
				async: true,
				data: {},				
				error: function(x){
					console.log(x);
					alert("Não Foi !" + x);
				},
				success: function(x){
					console.log(x);
					$("#comentarios").append(x);
				}
		});
	},10000);

});