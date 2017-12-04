<?php 
	namespace web_max\ecrivain;
	require_once('D:\perso\maxou\oPENCLASSROOM\04_Php_MySQL\TP_XX\ecrivain\view\View.php');
	
class ListChaptersView extends View
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

		<h1> Mon voyage en Alaska </h1>

		<?php
		for($i=0;$i<count($datas);$i++)
		{
			?>
			<div class ="chapter">	

				<h2 id="title"> <?= htmlspecialchars($datas[$i]->getTitle()) ?> </h2> 
				
				<p><em id="dateCreation">rédigé le : <?= htmlspecialchars($datas[$i]->getDateFr()) ?></em></p>
				<p id="resume"><?= htmlspecialchars($datas[$i]->getResume()) ?> 
					<a href='index.php?action=oneChapter&amp;Idchapters=<?= $datas[$i]->getIdchapters() ?>'>  (lire la suite...)</a>
				</p>
				
			</div>
			
			<?php 
			
		}
		$asideView=$this->asideView;		
		$captionMessage = $this->captionMessage;
		$message=$this->message;
		$footerView=$this->renderBottom();	
		require('D:\perso\maxou\oPENCLASSROOM\04_Php_MySQL\TP_XX\ecrivain\view\_footerView.php');
		$contentView=ob_get_clean(); 
		include_once ('D:\perso\maxou\oPENCLASSROOM\04_Php_MySQL\TP_XX\ecrivain\view\template.php');
		//require ('D:\perso\maxou\oPENCLASSROOM\04_Php_MySQL\TP_XX\ecrivain\view\template.php'); 
	}
}	


		
		