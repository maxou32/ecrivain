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
						document.getElementById("action"+$chapter).checked=true;
					}
				</script>	
				<div >
				<?php
				for($i=0;$i<count($datas);$i++)
				{
					?>
					<div class="collection">
						<div class="collection-item">
							<DIV class="row">
								<h5 class="center"><?= $datas[$i]->getTitle() ?></h5>
								<div class="col s6 ">
									<?php 
									if(strlen($datas[$i]->getContent())>$params['nbCaracters']){
										$begin=substr($datas[$i]->getContent(),0,$params['nbCaracters']).'<a href="index.php?oneChapter/idchapter/'.$datas[$i]->getIdchapters().'">  (lire la suite...)</a>';
									}else{
										$begin='<a href="index.php?oneChapter/idchapter/'.$datas[$i]->getIdchapters().'">'.$datas[$i]->getContent().'</a>';
									}
									?>
									<p id="content"><?=$begin ?> </p>
								</div>
								<div class="col s6">
									<input name="<?=  $datas[$i]->getIdchapters()  ?>" type="hidden" id="<?= $datas[$i]->getIdchapters() ?>" value="<?=  $datas[$i]->getStatus_IdStatus()  ?>" />
									<div>
									<?php
										foreach ($params['status'] as $key => $value){
											?>
											<input name="<?= "R".$datas[$i]->getIdchapters() ?>" class="with-gap" type="radio" id="<?="valueChapters".$datas[$i]->getIdchapters().$key ?>" 
												<?php if($datas[$i]->getStatus_IdStatus()==$key){echo "checked";} ?> 
												onClick='javascript:changeStatus("<?= $datas[$i]->getIdchapters() ?>","<?=$key ?>")' />
											<label for="<?="valueChapters".$datas[$i]->getIdchapters().$key ?>"  >
											<?= $value ?></label>
											<?php
										}
									?>
									</div>
									<label for="<?= "number".$datas[$i]->getIdchapters() ?>">Numéro d'ordre du chapitre</label>
									<input name="<?=  "number".$datas[$i]->getIdchapters()  ?>" class="center" type="text" id="<?= "number".$datas[$i]->getIdchapters() ?>" value="<?=  $datas[$i]->getNumber()  ?>" />
								</div>
								<div >
									<input type="checkbox" name="actionAFaire[]" id="<?= "action".$datas[$i]->getIdchapters() ?>" value="<?= $datas[$i]->getIdchapters() ?>" />	
									<label for="<?= "action".$datas[$i]->getIdchapters() ?>">Nverif maj</label>
																	
								</div>

							</div>
						</div>
					</div>
					<?php 
				}
				?>
				</div>
				<span  class=" waves-effect waves-light btn-large blue">
				<input type="submit" name="sousAction" value="Mettre à jour"><i class="material-icons left">build</i>
				</span>
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


		
		