<?php
namespace web_max\ecrivain;
	require_once('D:\perso\maxou\oPENCLASSROOM\04_Php_MySQL\TP_XX\ecrivain\view\View.php');
	
class AddChapterView extends View
{
	public function __construct($avecParam){
		$this->template ='template.php';
		$this->avecParam=$avecParam;
	}
	public function show($params,$datas){
		$title="Voyage en Alaska"; 
		ob_start(); 
		$menuView=$this->renderTop();
		?>
		<form method="post" action="index.php?action=addOneChapter" class="formChapitre">
			<input id="title" name="title" type="text" placeholder="Le titre du chapitre" 
				   required /><br />
			<textarea id="resume" name="resume" rows="4" 
					  placeholder="Le résumé du chapitre" required></textarea><br />
			<textarea id="content" name="content" rows="20" 
					  placeholder="Le chapitre" required></textarea><br />
			<input id="auteur" name="auteur" type="text" placeholder="L'auteur" 
				   required /><br />
			
			<input type="submit" value="Insérer dans le livre" />

			
		</form>

		<?php
		$footerView=$this->renderBottom();
		$captionMessage = $this->captionMessage;
		$message=$this->message;
		$asideView=$this->asideView;		
		
		$contentView=ob_get_clean(); 
		include_once ('D:\perso\maxou\oPENCLASSROOM\04_Php_MySQL\TP_XX\ecrivain\view\template.php');
	
	}
}
