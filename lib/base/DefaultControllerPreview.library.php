<?php
	class DefaultControllerPreview extends DefaultController {

		public function initBG($produto){
			if(!empty($produto))
			{
				if(!empty($produto['menu']['bg']))
				{

					$id = $produto['menu']['bg']['ID'];
					$itens = $this->loadDTQ($id);
          // Preview
          if(!empty($_POST['featured'])){
      			$values = $_POST['featured'];
            if(!empty($this->items['items'][0]) && $this->items['items'][0]['DTQ_TIP'] == $values['DTQ_TIP']){
              $item = $this->items['items'][0];
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
    						$this->items['items'][0] = $item;
            }
          }
        }

					if(!empty($itens['items'][0])){
						$this->background = $itens['items'][0];
					} else {
						$produto = $this->loadProduto($produto['PDT_PAI']);
						if(!empty($produto))
						{
							$this->initBG($produto);
						}
					}
				} else {
					$produto = $this->loadProduto($produto['PDT_PAI']);
					if(!empty($produto))
					{
						$this->initBG($produto);
					}
				}

			}
		}
		public function initLogoPage($produto)
		{
			if(!empty($produto))
			{


				if(!empty($produto['menu']['lg']))
				{

					$id = $produto['menu']['lg']['ID'];
					$itens = $this->loadDTQ($id);
					if(!empty($itens['items'][0])){

						$this->logoPage = $itens['items'][0];
					} else {
						$produto = $this->loadProduto($produto['PDT_PAI']);
						if(!empty($produto))
						{
							$this->initLogoPage($produto);
						}
					}
				} else {
					$produto = $this->loadProduto($produto['PDT_PAI']);
					if(!empty($produto))
					{
						$this->initLogoPage($produto);
					}
				}

			}
		}
		public function initLogo($produto)
		{
			if(!empty($produto))
			{

				if(!empty($produto['menu']['lm']))
				{

					$id = $produto['menu']['lm']['ID'];
					$itens = $this->loadDTQ($id);
					if(!empty($itens['items'][0])){

						$this->logo = $itens['items'][0];
					} else {
						$produto = $this->loadProduto($produto['PDT_PAI']);
						if(!empty($produto))
						{
							$this->initLogo($produto);
						}
					}
				} else {
					$produto = $this->loadProduto($produto['PDT_PAI']);
					if(!empty($produto))
					{
						$this->initLogo($produto);
					}
				}

			}
		}
		public function loadDTQ($id)
		{
			$dir = Document::generateDirStructure($id);
			if(Document::hasFile($dir."DTQ_".APP_DEFAULT_EDITORIAL."_{$id}.json")){
				 return json_decode(file_get_contents($dir."DTQ_".APP_DEFAULT_EDITORIAL."_{$id}.json"), true);
			}
			return false;
		}
	}
?>
