<?php 
namespace web_max\ecrivain\View;
use web_max\ecrivain\view\View;
use web_max\ecrivain\view\Template;
	
class _AdminChaptersView extends View{	
	public function __construct($template){
		$this->template =$template;
	}

	public function show($params,$datas){		
		ob_start(); 
		
		//echo"<PRE>";print_r($datas);echo"</PRE>";
		?>
		
		<div id="center">
			<form method="post" action="index.php?_validStatusChapters"  >
				<script language="javascript" type="text/javascript">
					function changeStatus($chapter,$status) {
						document.getElementById($chapter).value=$status;
					}
				</script>	
				<ul class="collection">
				<?php
				for($i=0;$i<count($datas);$i++)
				{
					?>
					<li class="collection-item">
						<div class="row">
							<div class="col s12"><?= $datas[$i]->getTitle() ?> <em id="dateCreation">rédigé le : <?= $datas[$i]->getDateFr() ?></em>
							</div>
							<div class="col s9">
								<?php 
								if(strlen($datas[$i]->getContent())>$params['nbCaracters']){
									$begin=substr($datas[$i]->getContent(),0,$params['nbCaracters']).'<a href="index.php?oneChapter/idchapter/'.$datas[$i]->getIdchapters().'">  (lire la suite...)</a>';
								}else{
									$begin='<a href="index.php?oneChapter/idchapter/'.$datas[$i]->getIdchapters().'">'.$datas[$i]->getContent().'</a>';
								}
								?>
								<p id="content"><?=$begin ?> </p>
							</div>
							<div class="col s3">
								<input name="<?=  $datas[$i]->getIdchapters()  ?>" type="hidden" id="<?= $datas[$i]->getIdchapters() ?>" value="<?=  $datas[$i]->getStatus_IdStatus()  ?>" />
								<?php
									foreach ($params['status'] as $key => $value){
										?>
										
										<input name="<?= "R".$datas[$i]->getIdchapters() ?>" class="with-gap" type="radio" id="<?="valueChapters".$datas[$i]->getIdchapters().$key ?>" <?php if($datas[$i]->getStatus_IdStatus()==$key){echo "checked";} ?> onClick='javascript:changeStatus("<?= $datas[$i]->getIdchapters() ?>","<?=$key ?>")' />
										<label for="<?="valueChapters".$datas[$i]->getIdchapters().$key ?>"  ><?= $value ?></label>
										<?php
										
									}
									
								?>
								<br />
								<label for="<?= "number".$datas[$i]->getIdchapters() ?>">Numéro d'ordre du chapitre</label>
								<input name="<?=  "number".$datas[$i]->getIdchapters()  ?>" type="text" id="<?= "number".$datas[$i]->getIdchapters() ?>" value="<?=  $datas[$i]->getNumber()  ?>" />
							</div>
						
						</div>
					</li>
					<?php 
				}
				?>
				</ul>
				<input type="submit" name="sousAction" value="Mettre à jour" class="button">
			</form>
			
		</div>
		<?php
		//$title="Voyage en Alaska"; 
		$contentView=ob_get_clean(); 		
		$menuView=$this->renderTop();
		$asideView=$this->asideView;		
		$captionMessage = $this->captionMessage;
		$message=$this->message;
		$footerView=$this->renderBottom();	

		$monTemplate= new template($menuView,$asideView,$footerView,$contentView);
		$monTemplate->show(NULL,NULL);
	}
}	


		
		