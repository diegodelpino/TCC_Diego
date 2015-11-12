$(function(){
	var editMode  =  $("#edita").val(); 
		if(editMode){
			onLoad();
		}
	$("#botaoAlteraUsuario").click(function(){
	alteraUsuario();
	});
});

function onLoad(){
	
	$.getJSON( "../controller/SrvUsuario.php?buscaPorId=true",{id_usuario : $("#id_usuario").val()}, function( data ) {
		 for ( var element in data) {
			$("#cidades").append('<option value="'+data[element].cidade_Cod+'">'+data[element].cidade_Nome+'</option>');
		}
	});
	
	
	
	
	$.ajax({
		url : "../controller/SrvUsuario.php?buscaPorId=true",
		type : "POST",
		data  :{id_usuario : $("#id_usuario").val()},
		dataType : "json",
		success : function(data){
		//searches the object on the screen by the given id and sets data if it founds the given data.id on the json received
		$('#nome').val(data.nome);
		$('#cpf').val(data.cpf);
		$('#unidade').val(data.unidade);
		$('#telefone').val(data.telefone);
		$('#login').val(data.login);
		$('#senha').val(data.senha);
		
		},
		error : function(){}		
	});
}

function alteraUsuario(){
	$.ajax({
	  url : "../controller/SrvUsuario.php?alteraUsuario=true",
	  type : "POST",
	  data : {
		id_usuario : $("#id_usuario").val(),  
		nome : $("#nome").val(),
		telefone : $("#telefone").val(),
		cpf : $("#cpf").val(),
		unidade : $("#unidade").val(),
		login : $("#login").val(),
		senha : $("#senha").val()
	  },
	  dataType : "text",
	  success : function(data){
		alert("Salvo com sucesso");
	  },
	  error : function(){}  
	 });
	 
}