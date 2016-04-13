setInterval(function(){ 
	$.get( "updates.php", function( data ) {
		//alert( data );
		if(data == "true")
			location.reload(true);	 
	});
}, 10000);

