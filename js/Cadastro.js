$(function(){
	
	onLoad();
	
});

function onLoad(){
	
	$.getJSON( "../controller/SrvUsuario.php?listaCidades=true", function( data ) {
		 for ( var element in data) {
			$("#cidades").append('<option value="'+data[element].cidade_Cod+'">'+data[element].cidade_Nome+'</option>');
		}
	});
}