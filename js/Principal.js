$(function() {
 
    $("#addHotel").click(function(){
    	addHotelSelected();
    });
    
    $("#addVoo").click(function(){
    	addVooSelected();
    });
   
    $("#removeHotel").click(function(){
    	removeHotelSelected();
    });
    
    $("#removeVoo").click(function(){
    	removeVooSelected();
    });
    
    $("#menuHotel").click(function(){
    	addHotel();
    	addLoadHotel();
    });
    
    $("#menuVoo").click(function(){
    	addVoo();
    	addLoadVoo();
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
	
	addHotel();
	addLoadHotel();
	
}

function addHotelSelected(element){
	
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
}

function addVooSelected(element){
	
	var id = element.dataset.id;

	$.ajax({
		url : "../controller/SrvUsuario.php?addVoo=true",
		data : { voo : id , dtIn : $("#dtIn_" +id ).val()},
		type : "POST",
		dataType : "text",
		success : function(data){
			$("#countItems").text(data);
		},
		error : function(){}		
	});
}

function addHotel(){
	$("#headListaProdutos tr").remove();
	
	$("#headListaProdutos").append(
				"<tr>"+
					'<th><input type="text" id="nomeHotel" class="form-control"></input></th>'+
					'<th><input type="text" id="cidadeOrigem" class="form-control"></input></th>'+
					'<th><select id="categoria" class="form-control">'+
							'<option selected>Todos</option>'+
							'<option>Luxo</option>'+
							'<option>Básico</option>'+
					'</select></th>'+
					'<th><input type="number" style="width : 90px;" id="preco" class="form-control" min="0" pattern="[0-9]{10}"></input></th>'+
					'<th><button type="button" id="btnSearchHotel" class="btn btn-default">Searh</button><button type="button" id="btnSearchClear" class="btn btn-default">Limpa</button></th>'+
					'<th></th>'+
					'<th></th>'+				
				"</tr>"+
	        	"<tr>"+
					"<th>Nome</th>"+
					"<th>Cidade</th>"+
					"<th>Categoria</th>"+
					"<th>Valor</th>"+
					"<th>Entrada</th>"+
					"<th>Saída</th>"+
					"<th></th>"+				
				"</tr>");
	
	$("#btnSearchHotel").bind("click", addLoadHotel);
	$("#btnSearchClear").bind("click", limpaBusca);
}

function limpaBusca(){
	$("#cidadeOrigem").val('');
	$("#nomeHotel").val('');
	$("#categoria").val('');
	 $("#preco").val('');
	 
	addLoadHotel();
}

function addLoadHotel(){
	
	$("#lista tr").remove();
	
	$.ajax({
		url : "../controller/SrvHotel.php?listaHotel=true",
		data : {cidadeOrigem : $("#cidadeOrigem").val() , nomeHotel : $("#nomeHotel").val(), categoria : $("#categoria").val(), preco : $("#preco").val() },
		type : 'POST',
		dataType : 'json',
		success : function(data){
			for ( var element in data) {
				 createItemHotel(data[element]);
			}
		},
		error : function(){
			
		}
	});
}


function addVoo(){
	$("#headListaProdutos tr").remove();
	
	$("#headListaProdutos").append(
	        	"<tr>"+
					"<th>Origem</th>"+
					"<th>Destino</th>"+
					"<th>Data</th>"+
					"<th>Preço</th>"+
					"<th></th>"+	
				"</tr>");
	
	
}

function addLoadVoo(){
	$("#lista tr").remove();
	
	$.getJSON( "../controller/SrvVoo.php?listaVoo=true", function( data ) {
		 for ( var element in data) {
			 createItemVoo(data[element]);
		}
	});
}

function createItemHotel(produto){
	
	$("#lista").append(
	        "<tr>"+
		        "<td>"+produto.hotel_Nome+"</td>"+
		        "<td>"+produto.hotel_Cidade+"</td>"+
		        "<td>"+produto.hotel_Categoria+"</td>"+
		        "<td>"+produto.hotel_Diaria+"</td>"+	
		        '<td><input type="text" id="dtIn_'+produto.hotel_Cod+'" class="dtEntrada"></td>'+
		        '<td><input type="text" id="dtOut_'+produto.hotel_Cod+'" class="dtSaida"></td>'+
		        '<td><button type="button" data-id = "'+produto.hotel_Cod+'" onclick="addHotelSelected(this)" class="btn btn-primary btn-xs ">Add</button></td>'+	
	        "</tr>");	
};

function createItemVoo(produto){
	
	$("#lista").append(
	        "<tr>"+
		        "<td>"+produto.voo_CidadeOrigem+"</td>"+
		        "<td>"+produto.voo_CidadeDestino+"</td>"+
		        "<td>"+produto.voo_Data+"</td>"+
		        "<td>"+produto.voo_Preco+"</td>"+	
		        "<td></td>"+
		        '<td><button type="button" data-id = "'+produto.voo_Cod+'" onclick="addVooSelected(this)" class="btn btn-primary btn-xs ">Add</button></td>'+	
	        "</tr>");
	
};
