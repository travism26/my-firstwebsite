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

	//this will set the <div> tags to an empty string if there is no input
	if (value =="") {
		var errorMsg = "";
		document.getElementById("results").innerHTML = errorMsg
	};
	if ($.trim(value) != '') {
		$.post("search.php", {partialName: value}, function(data){
			$("#results").html(data);
		});
	};
}