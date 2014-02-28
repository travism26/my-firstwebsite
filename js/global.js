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
function deletePost(var){
	//alert(postID);
	//postID = document.getElementById("post_id1").value;
	alert(var);
}