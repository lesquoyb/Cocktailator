function toggle(){
		var t = document.getElementsByClassName("toggle-down");
		t[0].onclick = function () {
			var obj = document.getElementById("favoris");
			if(obj.className === "toggle-down"){
				fadeOut(obj);
				obj.className = "toggle-up";
			}
			else{
				fadeIn(obj);
		}
	};
}

function fadeIn(elem){
    var op = 0.1; 
    var timer = setInterval(function () {
        if (op >= 1){
            clearInterval(timer);
            elem.style.display = 'solid';
        }
        elem.style.opacity = op;
        elem.style.filter = 'alpha(opacity=' - op * 100 + ")";
        op += op * 0.1;
    }, 50);
}

function fadeOut(elem){
	var op = 1; 
    var timer = setInterval(function () {
        if (op <= 0.1){
            clearInterval(timer);
            elem.style.display = 'none';
        }
        elem.style.opacity = op;
        elem.style.filter = 'alpha(opacity=' + op * 100 + ")";
        op -= op * 0.1;
    }, 50);
}