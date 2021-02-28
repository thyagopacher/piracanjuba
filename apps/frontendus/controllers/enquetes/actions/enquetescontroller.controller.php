<?php
class EnquetesController extends DefaultController{
	protected function doPaginationJSON( $count, $vars, $itensPerPage = 10)
	{
		$page = (isset($vars['GET']['page']) && (int)$vars['GET']['page'] != 1)? $vars['GET']['page'] : 1 ;
		
		// Pagination Vars
		$this->paginationLink = preg_replace("/(\?|\&)page=([0-9]+)/i", "", $_SERVER['REQUEST_URI']);
		$this->paginationLink = (strpos($this->paginationLink, "?") === FALSE)?$this->paginationLink."?page=":$this->paginationLink."&page=";
		$this->totalItens = $count;
		$this->totalPages = ceil($count/$itensPerPage);
		
		$this->currentPage = $page;
		$this->startItem = ($page-1) * $itensPerPage;
		$this->endItem = $this->startItem + $itensPerPage;
		
		$this->startPagination = max(($this->currentPage-2), 1);
		$this->endPagintation = min(($this->currentPage+2), $this->totalPages);
		$this->prevPage = (($this->currentPage-1) < 1)? NULL : (int)(($this->currentPage-1));
		$this->nextPage = (($this->currentPage+1) > $this->totalPages)? NULL : (($this->currentPage+1));
		
	}
    public function enquetes($vars = NULL){
	
		
		$this->bodyId = "interna";
		
		
		$dir = Document::generateDirStructure(APP_DEFAULT_EDITORIAL);
		if(Document::hasFile($dir."ENQUETES_".APP_DEFAULT_EDITORIAL.".json")){
			$this->itens =  json_decode(file_get_contents($dir."ENQUETES_".APP_DEFAULT_EDITORIAL.".json"), true);	
			
			//var_dump($this->itens);
			$this->totalItens = count($this->itens['items']);
			$this->currentPage =(!empty($_GET['page']))?((int)$_GET['page']):0;
			$itensPerPage = 4;	
			
			$this->doPaginationJSON(count($this->itens['items']), $vars, $itensPerPage);
			
		}
	
		
		
		
	}
	public function interna($vars = NULL){
		$this->bodyId = "interna";		
		$ID = $vars['VARS']['ID'];
		
		if(!empty($_POST['enquete'])){
			$op = $_POST['enquete'];
			
			$criteria = new FuriousSelectCriteria();
			$criteria->add("`enquetes`.`id`", $ID, FuriousExpressionsDB::EQUAL);
			$lista = EnqueteModel::doSelect($criteria);
			
			if(!empty($lista[0])){
				$item = $lista[0];
				switch($_POST['enquete']['op']){
					case "op1":
						$item->voto1 = ($item->getVoto1())+1;
					break;
					case "op2":
						$item->voto2 = ($item->getVoto2())+1;
					break;
					case "op3":
						$item->voto3 = ($item->getVoto3())+1;
					break;
					case "op4":
						$item->voto4 = ($item->getVoto4())+1;
					break;
					case "op5":
						$item->voto5 = ($item->getVoto5())+1;
					break;
				}
				
				if($item->save()){
					$item->generateJSON();
					$this->Message = "<strong>Voto efetuado com sucesso!</strong>";
				}
				
			}else{
				$this->errors[] = "Voto não efetuado.";
			}
		}
		
		$dir = Document::generateDirStructure(APP_DEFAULT_EDITORIAL);
		if(Document::hasFile($dir."ENQUETES_".APP_DEFAULT_EDITORIAL.".json")){
			$this->itens =  json_decode(file_get_contents($dir."ENQUETES_".APP_DEFAULT_EDITORIAL.".json"), true);	
			
			foreach ($this->itens['items'] as $item) {
				if($item['id'] == $ID){
					$this->enquete = $item;					
				}
			}
		}
		
	}
}
?>