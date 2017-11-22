/*controler for free actions

call of classes 
		Chapters
		Comments
		Users

listChapter 										//liste des chapitres
		instance classe chapitres
		retour liste des titres de chapitres + résumés
		appel vue listChaptersView
		
showOneChapter 										//presentation UN chapitre et ses commentaires
		instance classe chapitres
		instance classe commentaires
		retour UN résumé(id)
		retour DES commentaires(chapter.id)
		appel vue oneChapterView
		
addUser (name, email)							//creation compte utilisateur)
		instance classe utilisateur
		addUser (name, email,now(), none)	
		appel userView information et message résultat

	
		
		