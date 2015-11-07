$(function(){
	
	onLoad();
});

function onLoad(){
	
	atualizaTotal();
	
	$.get( "../controller/SrvUsuario.php?countItems=true", function( data ) {
		$("#countItems").text(data);
	});
	
	$.ajax({
		url : "../controller/SrvUsuario.php?listaItemsCarrinho=true",
		type : "POST",
		dataType : "json",
		success : function(data){
			 for ( var element in data.hotel) {
				 adicionaHotelLista(data.hotel[element]);
			}
			 for ( var element in data.voo) {
				 adicionaVooLista(data.voo[element]);
			}
		},
		error : function(){}		
	});
	
}

function adicionaHotelLista(produto){
	
	$("#listaHoteis").append(
	        "<tr>"+
		        "<td>"+produto.nome+"</td>"+
		        "<td>"+produto.diaria+"</td>"+
		        "<td>"+produto.dtIn+"</td>"+
		        "<td>"+produto.dtOut+"</td>"+
		        '<td><button type="button" data-id = "'+produto.id+'" onclick="removeHotelSelected(this)" class="btn btn-danger btn-xs">Remove</button></td>'+
	        "</tr>");	
};

function adicionaVooLista(produto){
	
	$("#listaVoos").append(
	        "<tr>"+
		        "<td>"+produto.origem+"</td>"+
		        "<td>"+produto.destino+"</td>"+
		        "<td>"+produto.data+"</td>"+
		        "<td>"+produto.preco+"</td>"+
		        '<td><button type="button" data-id = "'+produto.id+'" onclick="removeVooSelected(this)" class="btn btn-danger btn-xs">Remove</button></td>'+
	        "</tr>");	
};

function removeHotelSelected(element){
	
	$.ajax({
		url : "../controller/SrvUsuario.php?removeHotel=true",
		data : { hotel : element.dataset.id },
		type : "POST",
		dataType : "text",
		success : function(data){
			$("#countItems").text(data);
			
			var par = $(element).parent().parent(); //tr
		    par.remove();
		},
		error : function(){}		
	});
}

function removeVooSelected(element){
	
	$.ajax({
		url : "../controller/SrvUsuario.php?removeVoo=true",
		data : { voo : element.dataset.id },
		type : "POST",
		dataType : "text",
		success : function(data){
			$("#countItems").text(data);
		},
		error : function(){}		
	});
}

function atualizaTotal(){
	$.getJSON( "../controller/SrvUsuario.php?total=true", function( data ) {
		$("#total").text(data);
	});
	
};
	