<?php 
namespace web_max\ecrivain\view;
use web_max\ecrivain\view\View;
	
class _ListView extends View
{	

	public function __construct($template){
		$this->template =$template;
	}
	
	public function getList($list){
		$this->list=$list;
	}
	public function show($params,$datas){


		ob_start();
		?>
		<?= $params["listCaption"] ?>
		<select name='<?= $params["listName"] ?>' id="<?= $params["listId"] ?>">
			<?php
			
			foreach ($datas as $key => $value)
			{
			?>
				<option value="<?= $key ?>"> <?=$value?></option>
			<?php
			}
			?>			
		</select>
	
		<?php

		$listView=ob_get_clean(); 
		return $listView;  
	}
}