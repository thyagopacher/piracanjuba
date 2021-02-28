<?php
	class InternaBlock extends DefaultBlock
	{
		public function relacionado($vars = NULL){
			if(!empty($vars['related'])){
				$this->related = array();
				$i = 0;
				
				foreach($vars['related'] as $related){
					if($i > 1){
					break;
					}
					$this->related[] = $this->loadContent($related['ID']);										
					$i++;
				}
			}
		}
	}
?>