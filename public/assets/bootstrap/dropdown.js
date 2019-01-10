$('#campus').change(event => {
	$.get('/api/campus/${event.target.value}/subjects', function(res,cam) {
    	$('#subjects').empty();
    	res.foreach(element => {
        	$('#subjects').append('<option value=${element.id}> ${element.name} </option>');
		});
	});
});
    

