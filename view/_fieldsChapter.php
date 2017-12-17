	<?php 
	//namespace web_max\ecrivain;
	//require_once('D:\perso\maxou\oPENCLASSROOM\04_Php_MySQL\TP_XX\ecrivain\view\View.php');
	
class _fieldsChapter extends View
{	

	public function __construct($template){
		$this->template =$template;
	}
	
	public function show($params,$datas){
		ob_start(); 
		?>
			<input id="title" name="title" type="text" placeholder="Le titre du chapitre" 
				required /><br />
			<textarea id="content" name="content" rows="20" 
				placeholder="Le chapitre" required></textarea><br />
			<input id="auteur" name="author" type="text" placeholder="L'auteur" 
				required /><br />
		<?php
		$fieldsView=ob_get_clean(); 
		return $fieldsView;
	}
}