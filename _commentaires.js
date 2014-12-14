function dump(obj) {
    var out = '';
    for (var i in obj) {
        out += i + ": " + obj[i] + "\n";
    }
    return out;
}

    



function ajouterCommentaire(){
	var aut = $('#auteur').val();
	var title = $('#nouvtitre').val();
	var com = $('#nouvCom').val();
	var cockt = $('#cocktail').val();


	$('.middle_container').load('/Cocktailator/cocktail.php',{ auteur: aut , titre : title, commentaire : com, id_cocktail : cockt });

}
