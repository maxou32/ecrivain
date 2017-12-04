<?php 
	namespace web_max\ecrivain;
	require_once('D:\perso\maxou\oPENCLASSROOM\04_Php_MySQL\TP_XX\ecrivain\view\View.php');
	
class UpdateChapterView extends View
{	

	public function __construct($avecParam){
		$this->template ='template.php';
		$this->avecParam=$avecParam;
	}
	public function show($params,$datas){
		ob_start(); 
		?>
		<form method="post" action="index.php?action=updateOneChapter&amp;Idchapters=<?= $chapter->getIdchapters()?>" class="formChapitre">
			<?php   
				require ('D:\perso\maxou\oPENCLASSROOM\04_Php_MySQL\TP_XX\ecrivain\view\_fieldsChapter.php'); 
			?>
			
			<input type="submit" value="Enregistrer les changements" />

			
		</form>

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

