<?php 
	namespace web_max\ecrivain\view;
	
class _AsideView {	
	private $aside;
	
	public function __construct($aside){
		$this->aside=$aside;
	}
	public function show(){

		//ob_start(); 
		//echo"<br /><pre> charge ASIDE ";print_r($this->aside);echo"</pre>";

		?>

		<aside id="barreAside" class ="formBook ">
			<div>
				<h4><?= htmlspecialchars($this->aside["aside"]["title"])?></h4>
			<?php
				for($i=0;$i<count($this->aside["aside"]["value"]);$i++)
				{
					?>
					<p class="hide"><?= htmlspecialchars($this->aside["aside"]["value"][$i]["ref1"]) ; ?> </p>
					<h5  class="left-align"><?= htmlspecialchars($this->aside["aside"]["value"][$i]["ref2"]); ?></h5>
					<?php
					if(strlen($this->aside["aside"]["value"][$i]["content"])>$this->aside["nbCaracters"]/3){
						$begin=substr($this->aside["aside"]["value"][$i]["content"],0,$this->aside["nbCaracters"]/3).'</p><a href="index.php?oneChapter/idchapter/'.$this->aside["aside"]["value"][$i]["ref1"].'">  (lire la suite...)</a>';
					}else{
						$begin='<a href="index.php?oneChapter/idchapter/'.$this->aside["aside"]["value"][$i]["ref1"].'">'.$this->aside["aside"]["value"][$i]["content"].'</a>';
					}
					echo  "<bockquote>".$begin."</bockquote>"; 
					
					?>
					<h6 class="right-align"><i><?= htmlspecialchars($this->aside["aside"]["value"][$i]["detail1"]) ;?></i></h6><br />
					<div class="divider"></div>
					<?php
				}
			?>
			</div>								
		</aside>
			
		<?php

		//$asideView=ob_get_clean();
		//return $asideView;
	}
}
