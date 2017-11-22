/* view of one chapter with comments

affichage titre du blog

affichage menu

transformation écran en variable (ob_start)

titre de la page : chapter.title (h2 et protégé)
		affichage chapter.date (italique et protégé)
		affichage chapter.content (p et protégé)

boucle sur liste des commentaires
	
		affichage comment.author (h3 et protégé)
		affichage comment.date (italique et protégé)
		affichage comment.content (p et protégé)
		positionnnement btnAdd, btnUpdate, btnDelete
		
fin boucle (close cursor)

stockage variable (ob_get_clean)

appel templateOneChapter


		
		