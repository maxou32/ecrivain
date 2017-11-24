<!-- controler pour actions User connecté
call of classes 
		Chapters
		Comments
		Users
		
addOneChapter 	(title, resume, content)						//Ajout UN chapitre
		//verification user =admin
		instance classe chapitre
		ajout UN chapitre (title, resume, content, now())
		retour monChapitre
		appel oneChapterView (monChapitre)
		appel vue information et message résultat

updateOneChapter (title, resume, content)						//Modification UN chapitre
		//verification user =admin
		instance classe chapitre
		modification UN chapitre(title, resume, content, now())
		retour monChapitre
		appel vue oneChapterView (monChapitre)
		appel vue information et message résultat

deleteOneChapter (id)						//Modification UN chapitre
		//verification user =admin
		instance classe chapitre
		suppression UN chapitre(id)
		retour resultat
		appel vue oneChapterView (null)
		appel vue information et message résultat
		
validateComment(id) 						//Validation Un Commentaire
		//verification user =admin
		instance classe commentaire
		modification UN commentaire(id)
		appel vue information et message résultat


addComment(chapter.id, id, comment.content)	//Ajout commentaire
		//verification user connecté
		instance classe commentaires
		ajout UN commentaire(chapter.id, id, comment.content)
		retour monCommentaire
		appel vue UN chapitre (chapter.id)
		appel vue information et message résultat
		
updateComment(chapter.id, id, comment.content)	//Modification Un commentaire
		//verification user = auteur
		instance classe commentaires
		modif le commentaire(chapter.id, id, comment.content)
		retour LE commentaire
		appel vue UN chapitre
		appel vue information et message résultat

deleteComment(id)							//Suppression UN commentaire
		//verification user = auteur
		instance classe commentaires
		delete le commentaire (id)
		appel vue information et message résultat
		
validateuser(id)							//Validation compte Un utilisateur 
		//verification user = admin
		instance classe utilisateur
		modif  l'Utilisateur (id, validation)
		appel vue information et message résultat
		
deleteUser(id)								//Annulation compte Un utilisateur
		//verification user = admin
		instance classe utilisateur
		modif  l'Utilisateur (id, annulation)
		appel vue information et message résultat
		
updateUser (id, name, email)				//Modification compte Un utilisateur
		//verification user = utilisateur
		instance classe utilisateur
		modif  l'Utilisateur (id, update, name, email)
		appel vue information et message résultat
		
errorProcessing(error)						//traitement des erreurs
		appel vue information et message résultat (error)
-->