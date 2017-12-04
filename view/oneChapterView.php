<?php 
	namespace web_max\ecrivain;
	require_once('D:\perso\maxou\oPENCLASSROOM\04_Php_MySQL\TP_XX\ecrivain\view\View.php');
	
class OneChaptersView extends View
{	

	public function __construct($avecParam){
		$this->template ='template.php';
		$this->avecParam=$avecParam;
	}
	
	public function show($params,$datas){
		if ($this->avecParam){
			$this->params=$params;
			$resultControl=$this->renderOption();
					}
		$title="Voyage en Alaska"; 
		ob_start();  
		$menuView=$this->renderTop();
		$asideView=$this->renderAside()
		?>
		
		<h1> Mon voyage en Alaska </h1>
		<div class ="chapter">	

			<h2> <?= htmlspecialchars($datas->getTitle()) ?> </h2> 
			<p><em id="dateCreation">rédigé le : <?= htmlspecialchars($datas->getDateFr()) ?></em></p>
			<p id="resume"><?= htmlspecialchars($datas	->getContent()) ?> </p>	
			<div>
				<?php 
					if($resultControl){	
				?>
					<form method="post" action="index.php?action=deleteChapter&amp;Idchapters=<?= $datas->getIdchapters()?>" class="formChapitre">
						<input type="submit" value="Supprimer le chapitre en cours">
					</form>
					<form method="post" action="index.php?action=askUpdateChapter&amp;Idchapters=<?= $datas->getIdchapters()?>" class="formChapitre">
						<input type="submit" value="Modifier le contenu du chapitre">
					</form>
				
				<?php } ?>
			</div>	
		</div>
		<?php 

		$asideView=$this->asideView;		
		$captionMessage = $this->captionMessage;
		$message=$this->message;
		$footerView=$this->renderBottom();	
		require('D:\perso\maxou\oPENCLASSROOM\04_Php_MySQL\TP_XX\ecrivain\view\_footerView.php');
		$contentView=ob_get_clean();  

		include_once ('D:\perso\maxou\oPENCLASSROOM\04_Php_MySQL\TP_XX\ecrivain\view\template.php');
			
	}
}

		
		