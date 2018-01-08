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
		
		<div class="formChapitre center">
			<form method="post" action="index.php?_validStatusChapters"  >
				<script language="javascript" type="text/javascript">
					function changeStatus($chapter,$status) {
						document.getElementById($chapter).value=$status;
					}
				</script>	
				<div class="collection">
				<?php
				for($i=0;$i<count($datas);$i++)
				{
					?>
					<div class="panel panel-default">
						<div class="row">
							<div class="col-lg-12 panel-heading">
								<?= $datas[$i]->getTitle() ?> <em id="dateCreation">rédigé le : <?= $datas[$i]->getDateFr() ?></em>
							</div>
							<div class="col-lg-8 panel-collapse collapse in">
								<?php 
								if(strlen($datas[$i]->getContent())>$params['nbCaracters']){
									$begin=substr($datas[$i]->getContent(),0,$params['nbCaracters']).'<a href="index.php?oneChapter/idchapter/'.$datas[$i]->getIdchapters().'">  (lire la suite...)</a>';
								}else{
									$begin='<a href="index.php?oneChapter/idchapter/'.$datas[$i]->getIdchapters().'">'.$datas[$i]->getContent().'</a>';
								}
								?>
								<p id="content"><?=$begin ?> </p>
							</div>
							<div class="col-lg-4 col s3">
								<input name="<?=  $datas[$i]->getIdchapters()  ?>" type="hidden" id="<?= $datas[$i]->getIdchapters() ?>" value="<?=  $datas[$i]->getStatus_IdStatus()  ?>" />
								<div class="btn-group" data-toggle="buttons">
								<?php
									foreach ($params['status'] as $key => $value){
										?>
										<label for="<?="valueChapters".$datas[$i]->getIdchapters().$key ?>" class="btn btn-success" >
										<input name="<?= "R".$datas[$i]->getIdchapters() ?>" class="with-gap" type="radio" id="<?="valueChapters".$datas[$i]->getIdchapters().$key ?>" <?php if($datas[$i]->getStatus_IdStatus()==$key){echo "checked";} ?> onClick='javascript:changeStatus("<?= $datas[$i]->getIdchapters() ?>","<?=$key ?>")' />
										<?= $value ?></label>
										<?php
									}
								?>
								</div>
								<br />
								<label for="<?= "number".$datas[$i]->getIdchapters() ?>">Numéro d'ordre du chapitre</label>
								<input name="<?=  "number".$datas[$i]->getIdchapters()  ?>" class="form-control" type="text" id="<?= "number".$datas[$i]->getIdchapters() ?>" value="<?=  $datas[$i]->getNumber()  ?>" />
							</div>
						
						</div>
					</div>
					<?php 
				}
				?>
				</div>
				<input type="submit" name="sousAction" value="Mettre à jour" class="btn btn-primary">
			</form>
			
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


		
		