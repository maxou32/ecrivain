<?php 
namespace web_max\ecrivain\View;
use web_max\ecrivain\view\View;
use web_max\ecrivain\view\Template;
	
class _TheBookView extends View
{	

	public function __construct($template){
		$this->template =$template;
	}
	public function show($params,$datas){
		ob_start();  			
		
		?>
		<div class ="formChapitre">
			

		<div class="carousel-item" href="<?= $datas->getNumber() ?>">
		<h3><?= $datas->getTitle() ?></h3>

		<em id="dateCreation">rédigé le : <?= $datas->getDateFr() ?></em>
			<?= $datas->getContent() ?>

		</div>
		
		<ul class="pagination center">
		<?php 
		for($i=0;$i<$params["nbChapters"];$i++)
		{
			$j=$i+1;
			?>
			<li class="waves-effect"><a href="index.php?_TheBookView/chap/<?= $j?>"><?=  $j ?></a>
		<?php 
		}
		?>

		</div>
		<?php
		//$title="Voyage en Alaska"; 
		$contentView=ob_get_clean(); 		
		$menuView=$this->renderTop();
		$asideView="";		
		$captionMessage = $this->captionMessage;
		$message=$this->message;
		$footerView=$this->renderBottom();	

		$monTemplate= new template($menuView,$asideView,$footerView,$contentView);
		$monTemplate->show(NULL,NULL);
	}
}	


		
		