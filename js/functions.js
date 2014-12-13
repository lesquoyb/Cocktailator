function hasMinMax(str, min, max) {
	return ((str.length > min) && (str.length < max));
}

function se_connecter(){
	var test = $(".middle_container")[0];
	test.load("/index.php");
}
