$(function() {

    $("#menuHotel").click(function(){
		addLoadRequisicoes();
    });
    
    $(document).on('focus',".dtEntrada,.dtSaida", function(){
        $(this).datepicker({
			dateFormat: "yy-mm-dd"
        });
    });
    
    onLoad();
 
});

function onLoad(){
	
	$.get( "../controller/SrvUsuario.php?countItems=true", function( data ) {
		$("#countItems").text(data);
	});
	addHeadersLista();
	addLoadRequisicoes();
	
}

/* function addHotelSelected(element){
	
	var id = element.dataset.id;
	
	$.ajax({
		url : "../controller/SrvUsuario.php?addHotel=true",
		data : { hotel : id , dtIn : $("#dtIn_" +id ).val() , dtOut : $("#dtOut_" +id ).val()},
		type : "POST",
		dataType : "text",
		success : function(data){
			$("#countItems").text(data);
		},
		error : function(){}		
	});
} */



function addHeadersLista(){
	$("#headListaProdutos tr").remove();
	
	$("#headListaProdutos").append(
				"<tr>"+
					'<th><input type="text" id="titulo" class="form-control"></input></th>'+
					//'<th><input type="text" id="prioridade" class="form-control"></input></th>'+
					'<th><select id="prioridade" class="form-control">'+
							'<option value = "" selected>Todas Prioridades</option>'+
							'<option value = "1">1 - Emergencial</option>'+
							'<option value = "2">2 - Urgente</option>'+
							'<option value = "3">3 - Importante</option>'+
							'<option value = "4">4 - Normal</option>'+
							'<option value = "5">5 - Baixa</option>'+
					'</select></th>'+
					'<th><select id="status" class="form-control">'+
							'<option value = "" selected>Todos Status</option>'+
							'<option value = "ANDAMENTO">Andamento</option>'+
							'<option value = "INICIAL">Inicial</option>'+
							'<option value = "CONCLUÍDA">Concluída</option>'+
							'<option value = "INATIVA">Inativa</option>'+
							'<option value = "EXCLUÍDA">Excluída</option>'+
					'</select></th>'+
					'<th><input type="text" id="data_atualizacao" class="form-control"></input></th>'+
					'<th><button type="button" id="btnBuscaReq" class="btn btn-default">Busca</button><button type="button" id="btnLimpaBusca" class="btn btn-default">Limpa</button></th>'+
					'<th></th>'+
					'<th></th>'+				
				"</tr>"+
	        	"<tr>"+
					"<th>Titulo</th>"+
					"<th>Prioridade</th>"+
					"<th>Status</th>"+
					"<th>Data de Atualização</th>"+
					"<th>Detalhes</th>"+
				"</tr>");
	
	$("#btnBuscaReq").bind("click", addLoadRequisicoes);
	$("#btnLimpaBusca").bind("click", limpaBusca);
}

function limpaBusca(){
	$("#titulo").val('');
	$("#prioridade").val('');
	$("#status").val('');
	 $("#data_atualizacao").val('');
	addLoadRequisicoes();
}

function addLoadRequisicoes(){
	
	$("#lista tr").remove();
	$.ajax({
		url : "../controller/SrvRequisicoes.php?listaRequisicoes=true",
		data : {
			titulo : $("#titulo").val() , 
			prioridade : $("#prioridade").val(), 
			status : $("#status").val(), 
			data_atualizacao : $("#data_atualizacao").val() 
		},
		type : 'POST',
		dataType : 'json',
		success : function(data){
			console.log(data);
			for ( var element in data) {
				 createItemRequisicao(data[element]);
			}
		},
		error : function(jqXHR,  textStatus, errorThrown){
		alert("erro no ajax");
		console.log(textStatus, errorThrown);
		console.log(jqXHR);		
		}
	});
}


function createItemRequisicao(requisicao){
	
	$("#lista").append(
	        "<tr>"+
		        "<td>"+requisicao.titulo+"</td>"+
		        "<td>"+requisicao.prioridade+"</td>"+
		        "<td>"+requisicao.status+"</td>"+
		        "<td>"+requisicao.data_atualizacao+"</td>"+	
		        '<td><button type="button" data-id = "'+requisicao.id_requisicao+'" onclick="editarRequisicao(this)" class="btn btn-primary btn-xs ">Detalhes</button></td>'+	
	        "</tr>");	
};

function editarRequisicao(element){
	document.listarequisicao.action="../view/Requisicao.php?edita=true&id_requisicao="+element.dataset.id;
	document.forms.items.submit();
};


