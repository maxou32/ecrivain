<?php 
	//namespace web_max\ecrivain;
	
class _CudChapterView extends View
{	

	public function __construct($template){
		$this->template ='template.php';

	}
	
	public function show($params,$datas){
		echo 'début chapter view';
		ob_start(); 
		?>
		<form method="post" action="index.php?action=updateOneChapter&amp;Idchapters=<?= $chapter->getIdchapters()?>" class="formChapitre">
			<?php   
				$monFieldsChapter= new _fieldsChapter(NULL);
				$fieldsView=$monFieldsChapter->show(NULL,NULL);
			?>
			<?= $fieldsView ?>
			<input type="submit" value="Enregistrer les changements" />
		</form>

		<?php
		$contentView=ob_get_clean(); 
		$menuView="";
		$asideView=$this->asideView;		
		$captionMessage = $this->captionMessage;
		$message=$this->message;
		$footerView=$this->renderBottom();	
		echo 'contentview '.contentView;
		
		$monTemplate= new template(NULL,$asideView,$footerView,$contentView);
		$monTemplate->show();	
	}
}	

