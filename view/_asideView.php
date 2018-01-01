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
				<h5><?= $this->aside["title"]?></h5>
			<?php
				for($i=0;$i<count($this->aside["value"]);$i++)
				{
					?>
					<p class="hide"><?= $this->aside["value"][$i]["ref1"] ; ?> </p>
					<h6  class="left-align"><?= $this->aside["value"][$i]["ref2"]; ?></h6>
					<?php
					if(strlen($this->aside["value"][$i]["content"])>$this->aside["nbCaracters"]/3){
						$begin=substr($this->aside["value"][$i]["content"],0,$this->aside["nbCaracters"]/3).'<a href="index.php?oneChapter/idchapter/'.$this->aside["value"][$i]["ref1"].'">  (lire la suite...)</a>';
					}else{
						$begin='<a href="index.php?oneChapter/idchapter/'.$this->aside["value"][$i]["ref1"].'">'.$this->aside["value"][$i]["content"].'</a>';
					}
					echo $begin."<br />"; 
					?>

					<p  class="right-align"><i><?= $this->aside["value"][$i]["detail1"] ;?></i></p><br />
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
