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
					<div class="list-group-item">
						<div class="row">
							<p class="col-gl-6 col s6 left-align"><?= $this->comment["comment"][$i]->getName() ; ?> </p>
							<p class="col-gl-6 col s6 right-align"><i><?= $this->comment["comment"][$i]->getCommentDate(); ?></i></p>
						</div>
						<blockquote><?=$this->comment["comment"][$i]->getContent() ?></blockquote>
						<form method="post" action="index.php?signalComment/comment/<?=$this->comment["comment"][$i]->getIdcomments()?>" name="MessageSignale">
							<span  class=" waves-effect waves-light btn orange">
								<input type="submit" name="sousAction" value="Signaler"><i class="material-icons left">warning</i>
							</span>
						</form>
					</div>
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
