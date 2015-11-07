$(function(){
	
	onLoad();
});

function onLoad(){
	
	$.ajax({
		url : "../controller/SrvUsuario.php?listaRescentes=true",
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
		        "<td>"+produto.cidade+"</td>"+
		        "<td>"+produto.dtIn+"</td>"+
		        "<td>"+produto.dtOut+"</td>"+
		        "<td>"+produto.diaria+"</td>"+
	        "</tr>");	
};

function adicionaVooLista(produto){
	
	$("#listaVoos").append(
	        "<tr>"+
		        "<td>"+produto.origem+"</td>"+
		        "<td>"+produto.destino+"</td>"+
		        "<td>"+produto.data+"</td>"+
		        "<td>"+produto.preco+"</td>"+
	        "</tr>");	
};