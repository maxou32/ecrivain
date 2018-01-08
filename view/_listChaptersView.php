<?php 
namespace web_max\ecrivain\View;
use web_max\ecrivain\view\View;
use web_max\ecrivain\view\Template;
	
class _ListChaptersView extends View
{	

	public function __construct($template){
		$this->template =$template;
	}
	public function show($params,$datas){
		ob_start();  			
		
		?>
		<div id="center">
			<div  id="monaccordeon" class="panel-group col-lg-12">
			<?php
			$nbCaracters=$params['nbCaracters'];
			//echo "nbCaracters =" .$nbCaracters;
			for($i=0;$i<count($datas);$i++)
			{
				?>
					<div class="panel panel-default">
						<div class="panel panel-info">
							<div class="panel-heading">
								<h3 class="panel-title">
									<a href="#<?= $datas[$i]->getIdchapters() ?>" data-parent="#monaccordeon" data-toggle="collapse"><img src="public/media/baleine.jpg" alt="baleine" class="circle miniImage">
									<?= $datas[$i]->getTitle() ?>
									</a>
								</h3>
							</div>
							<div id="<?= $datas[$i]->getIdchapters() ?>" class="panel-collapse collapse">
								<em id="dateCreation">rédigé le : <?= $datas[$i]->getDateFr() ?></em>
								<?php 
								if(strlen($datas[$i]->getContent())>$nbCaracters){
									$begin=substr($datas[$i]->getContent(),0,$nbCaracters).'<a href="index.php?oneChapter/idchapter/'.$datas[$i]->getIdchapters().'">  (lire la suite...)</a>';
								}else{
									$begin='<a href="index.php?oneChapter/idchapter/'.$datas[$i]->getIdchapters().'">'.$datas[$i]->getContent().'</a>';
								}
								?>
								<p id="content"><?=$begin ?> </p>
							</div>
						</div
					</div>
				<?php 
			}
			?>
			</div>
		</div>
		<?php
		//$title="Voyage en Alaska"; 
		$contentView=ob_get_clean(); 		
		$menuView=$this->renderTop();
		$asideView=Null;		
		$captionMessage = $this->captionMessage;
		$message=$this->message;
		$footerView=$this->renderBottom();	

		$monTemplate= new template($menuView,$asideView,$footerView,$contentView);
		$monTemplate->show(NULL,NULL);
	}
}	


		
		