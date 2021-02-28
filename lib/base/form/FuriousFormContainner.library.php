<?php
abstract class FuriousFormContainner extends FuriousFormElement
{
	protected function renderContents($i = NULL){
		$html = "";
		
		
		foreach($this->widgets as $widget)
		{
			
			if($i != NULL)
			{
				//print_r("passou");
				$widget->setFormContainer($this->formName, $i);
			}
			$html .= str_replace("\n", "\n\t", $widget);
		}
		return $html;
	}
	public function addWidget($widget){
		$widget->setFormContainer($this->formName);
		$this->widgets[$widget->getName()] = $widget;
	}
	public function addWidgets(array $widgets){
		foreach($widgets as $widget)
		{
			$this->addWidget($widget);
		}
	}
}
?>