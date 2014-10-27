// Include like PHP
function include(file) {
	if (typeof(file) == 'object') {
	   for (s in file) {
			if (typeof(file[s]) == 'string') include(file[s]);
		}
		return;
	}
	
	var head = document.getElementsByTagName('head')[0]; 
	
	var script = document.createElement('script'); 
	script.src = file + '.js';
	script.type = 'text/javascript';
	
	head.appendChild(script);
}

function load(target, url, text) {
	if (text != undefined) $(target).html('<div style="text-align:center;font-weight:900;font-size:19px;padding:20px;">' + text + '</div>');
	$('body').css('cursor','progress');
	$(target).load(url, function() { $('body').css('cursor','initial'); });
}

Date.prototype.yyyymmdd = function() {         
                                
        var yyyy = this.getFullYear().toString();                                    
        var mm = (this.getMonth()+1).toString(); // getMonth() is zero-based         
        var dd  = this.getDate().toString();             
                            
        return yyyy + '-' + (mm[1]?mm:"0"+mm[0]) + '-' + (dd[1]?dd:"0"+dd[0]);
   };  

function dateDay() {
	d = new Date();
	return d.yyyymmdd();
}