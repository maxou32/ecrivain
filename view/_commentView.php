<?php 
	namespace web_max\ecrivain\view;
	
class _CommentView {	
	private $comment;
	
	public function __construct($comment){
		$this->comment=$comment;
	}
	public function show(){

		//ob_start(); 
		//echo"<br /><pre> charge comment ";print_r($this->comment);echo"</pre>";

		?>

		<div id="barrecomment" class ="formBook ">
			<div>
				
			<?php
				for($i=0;$i<count($this->comment["comment"]);$i++)
				{
					?>
					<div class="row">
						<p class="col s6 left-align"><?= $this->comment["comment"][$i]->getName() ; ?> </p>
						<p class="col s6 right-align"><i><?= $this->comment["comment"][$i]->getCommentDate(); ?></i></p>
					</div>
					<?=$this->comment["comment"][$i]->getContent() ?><br />
					<form method="post" action="index.php?signalComment/comment/<?=$this->comment["comment"][$i]->getIdcomments()?>" name="MessageSignale">
						<a href="index.php?signalComment/comment/<?=$this->comment["comment"][$i]->getIdcomments()."/val/1/chap/".$this->comment["params"]["chap"]?>" class="waves-effect waves-light btn messageSignal orange"><i class="material-icons left">report_problem</i>Signaler</a>
					</form>
					<div class="divider"></div>
					<?php
				}
			?>
			</div>								
		</div>
		<?php

		//$commentView=ob_get_clean();
		//return $commentView;
	}
}