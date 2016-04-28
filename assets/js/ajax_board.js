setInterval(function(){ 
	$.get( "updates.php", function( data ) {
		//alert( data );
		if(data)
			location.reload(true);	 
	});
}, 10000);

 