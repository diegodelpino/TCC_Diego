$(function(){
	
	var editMode  =  $("#edita").val(); 
		if(editMode){
			onLoad();
		}
	$("#botaoAlteraRequisicao").click(function(){
	alteraRequisicao();
	});

});

function onLoad(){
	
/* 	$.getJSON( "../controller/SrvAlteraReq.php?listaCidades=true", function( data ) {
		 for ( var element in data) {
			$("#cidades").append('<option value="'+data[element].cidade_Cod+'">'+data[element].cidade_Nome+'</option>');
		}
	});
	 */
	$.ajax({
		url : "../controller/SrvRequisicoes.php?buscaRequisicaoPorId=true",
		type : "POST",
		data  :{id_usuario : $("#id_usuario").val()},
		dataType : "json",
		success : function(data){
		$('#titulo').val(data.titulo);
		$('#descricao').val(data.descricao);
		$('#detalhes').val(data.detalhes);
		$('#prioridade').val(data.prioridade);
		//TODO:como carregar a lista de categorias?
		//TODO:como associar os fornecedores?
		},
		error : function(){}		
	});
}

function alteraRequisicao(){
	$.ajax({
	  url : "../controller/SrvAlteraReq.php?alteraRequisicao=true",
	  type : "POST",
	  data : {
		titulo : $("#titulo").val(),  
		descricao : $("#descricao").val(),
		detalhes : $("#detalhes").val(),
		prioridade : $("#prioridade").val(),
		//TODO:como carregar a lista de categorias?
		//TODO:como associar os fornecedores?
	  },
	  dataType : "text",
	  success : function(data){
		alert("Salvo com sucesso");
	  },
	  error : function(){}  
	 });
	 
}