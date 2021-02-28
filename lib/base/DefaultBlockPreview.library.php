<?php
class DefaultBlockPreview extends DefaultBlock {
	public function initJsonDtq($vars = NULL){
		if(!empty( $vars['ID'])){
			$id = $vars['ID'];
			$dir = Document::generateDirStructure($id);
			if(Document::hasFile($dir."DTQ_".APP_DEFAULT_EDITORIAL."_{$id}.json")){
				$this->items = json_decode(file_get_contents($dir."DTQ_".APP_DEFAULT_EDITORIAL."_{$id}.json"), true);
			}
		}
		//var_dump($this->items);

		if(!empty($_POST['featured']) && !empty($_POST['featured']['DTQ_TIP'])){
			$values = $_POST['featured'];


			if(!empty($this->items['items'][0]) && $this->items['items'][0]['DTQ_TIP'] == $values['DTQ_TIP']){



				foreach($this->items['items'] as $index => $item)
				{
					if($item['DTQ_ID'] == $values['DTQ_ID']){
						if(!empty($values['IMG_DTQ'])){
							$file = ArquivoModel::getOne($values['IMG_DTQ']);
							if(!empty($file[0])){
								$file = $file[0];
								$relation = new Arquivoconteudo();
								$relation->ARC_AID = $values['IMG_DTQ'];
								$relation->ARC_CID = $item['DTQ_ID'];
								$relation->ARC_CTP = "THB_DTQ";
								$relation->ARC_TIT = "";
								$relation->ARC_TXT = "";
								$relation->ARC_STS = 1;

								$item['dtq_fto'] = json_decode(json_encode($relation->toJSON()), true);
							}


						}
						foreach($values as $key => $value){
							$item[$key] = $value;
						}
						$this->items['items'][$index] = $item;


					}
				}



			}

		}
	}
}
?>
