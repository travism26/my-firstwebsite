$('input#name-submit').on('click', function() {
	var name = $('input#name').val();
	//alert(name);
	if ($.trim(name) != '') {
		//alert(1);
		$.post('ajax/usernames.php', {name:name}, function(data){
			//alert(data);
		});
	};
});

function getUsername(value){
	//alert(1);
	$.post("search.php", {partialName: value}, function(data){
		$("#results").html(data);
	});
}