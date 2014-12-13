
function ajouterCommentaire(){
	var aut = $('#auteur').val();
	var title = $('#nouvtitre').val();
	var com = $('#nouvCom').val();
	var cockt = $('#cocktail').val();
	
		$('.middle_container').load('_ajouterCom.php', { auteur: aut , titre : title, commentaire : com, cocktail : cockt });
	/*
	$.post('_ajouterCom.php', function({ auteur: aut , titre : title, commentaire : com, cocktail : cockt }){
		//callback
		$('.middle_container').load('/Cocktailator/cocktail.php',{id_cocktail : cockt });
    });
    */
}
