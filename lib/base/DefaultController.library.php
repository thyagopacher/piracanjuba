<?php
	class DefaultController {

		public $layoutVars = array();
		public $renderizar = true;

		public function __construct()
		{
			if(APP_NAME != "backend")
			{
				$produtoModel =ProdutoModel::getOne(APP_DEFAULT_EDITORIAL);
				$this->site = $produtoModel[0];
			}
		}
		protected function generateJsonPath($id){
			return "json/".substr("0000".$id,-4,-2)."/".substr("00".$id,-2)."/";
		}
		protected function renderBreadcrumb($editorials, $json)
		{
			$breadCrumb = array("/" => "Home");

			if(!empty($editorials) && is_array($editorials))
			{
				foreach($editorials as $cat)
				{
					$json_cat = json_decode(file_get_contents(JSON_LOCATION.substr("0000".$cat['CAT_QTD'],-4,-2)."/".substr("00".$cat['CAT_QTD'],-2)."/PDT_1_".$cat['CAT_QTD'].".json"), true);
					if($cat['CAT_QTD'] == 9)
					{
						$breadCrumb[(utf8_decode($json_cat['PDT_URL']))] = utf8_decode($json_cat['PDT_NOM']);
						break;
					}
				}
				if(count($breadCrumb) < 2)
				{
					$cat = $editorials[0];
					$json_cat = json_decode(file_get_contents(JSON_LOCATION.substr("0000".$cat['CAT_QTD'],-4,-2)."/".substr("00".$cat['CAT_QTD'],-2)."/PDT_1_".$cat['CAT_QTD'].".json"), true);
					$breadCrumb[(utf8_decode($json_cat['PDT_URL']))] = utf8_decode($json_cat['PDT_NOM']);
				}

			}
			return $breadCrumb;
		}

		public function __call($method, $params)
		{
			$this->Error404();
		}
		public function Unauthorized($vars = null)
		{
			header("HTTP/1.1 401 Unauthorized");
			$this->pageTitle = "Acesso Negado";

			$this->renderView("default", "unauthorized", "html");
			$this->calledErrorPage = true;
		}
		public function verifyTemplateExists($method)
		{
			$class = get_class($this);
			if(View::hasViewFile($class, $method, Dispatcher::$calledFormat)){
				return true;
			}
			return false;
		}
		public function Error404()
		{
			header("HTTP/1.1 404 Not Found");
			$this->classes = array("errorPg red ");
			$this->bodyClasses = "home red error";


			$this->renderView("default", "error404", "html");
			$this->calledErrorPage = true;
		}
		public function setTemplate($template, $controller = null)
		{
			$this->useTemplate = $template;
			$this->templateController = $controller;

		}
		public function setLayout($layout)
		{
			$this->useLayout = $layout;
		}
		public function renderView($controller, $method, $format)
		{
			if(empty($this->calledErrorPage) ){
				$template = (isset($this->useTemplate))? $this->useTemplate : $method;
				$view = new View($this, $controller, $template, $format);
			}

		}
		public function __destruct(){
			if(method_exists($this, Dispatcher::$calledMethod))
			{
				$controller = (!empty($this->templateController))? $this->templateController : Dispatcher::$calledController;

				if($this->renderizar == true){
					$this->renderView($controller, Dispatcher::$calledMethod, Dispatcher::$calledFormat);
				}
			}
		}
		protected function proccessForm($form)
		{
			if(isset($form))
			{
				$values = Dispatcher::getPostValues($form->getName());
				$form->appendValues($values);
				$files = Dispatcher::getFiles($form->getName());
				if(isset($files) && $files != false){
					$form->appendFiles($files);
				}
				if($form->isValid())
				{
					$form->save();
				} else {
					$this->Errors = sprintf("<ul class=\"errors\">%s\n</ul>\n", $form->validationErrors());
					$this->Form = (string)$form;
				}
			}
		}
		protected function doPagination($modelClass, $outVarName, $criteria, $vars, $itensPerPage = 10)
		{
			$page = (isset($vars['GET']['page']) && (int)$vars['GET']['page'] != 0)? $vars['GET']['page'] : 0 ;
			$criteria->addCountRows();
			$criteria->setOffset(($page*$itensPerPage));
			$criteria->setLimit($itensPerPage);

			$itens = call_user_func("{$modelClass}::doPaginatedSelect", $criteria);
			$this->$outVarName = $itens['itens'];

			// Pagination Vars
			$this->paginationLink = preg_replace("/(\?|\&)page=([0-9]+)/i", "", $_SERVER['REQUEST_URI']);
			$this->paginationLink = (strpos($this->paginationLink, "?") === FALSE)?$this->paginationLink."?page=":$this->paginationLink."&page=";
			$this->totalItens = $itens['totalItens'];
			$this->totalPages = ceil($this->totalItens/$itensPerPage);
			$this->currentPage = $page;
			$this->startPagination = max(($this->currentPage-2),0);
			$this->endPagintation = min(($this->currentPage+2), $this->totalPages);
			$this->prevPage = (($this->currentPage-1) < 0)? NULL : (int)(($this->currentPage-1)+1);
			$this->nextPage = (($this->currentPage+2) > $this->totalPages)? NULL : (($this->currentPage+1)+1);

		}
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
			$this->prevPage = (($this->currentPage-1) < 0)? NULL : (int)(($this->currentPage-1)+1);
			$this->nextPage = (($this->currentPage+2) > $this->totalPages)? NULL : (($this->currentPage+1)+1);

		}
		public function initProdutoJson ($vars = NULL)
		{
			if(!empty( $vars['VARS']['ID'])){
				$id = $vars['VARS']['ID'];

				$this->items = $this->loadProduto($id);

				if(!empty($this->items)){
					if(empty($vars['NOSEO'])){
						if (!empty($this->items['PDT_TIT'])){
							$this->pageTitle = ($this->items['PDT_TIT']);
						}
						if (!empty($this->items['PDT_DES'])){
							$this->pageDescription = ($this->items['PDT_DES']);
						}
						if (!empty($this->items['PDT_KEY'])){
							$this->pageKeywords = ($this->items['PDT_KEY']);
						}
						if (!empty($this->items['PDT_OMN'])){
							$this->pageOminiture = ($this->items['PDT_OMN']);
						}
					}

					$this->bodyClasses = Slugfy(utf8_decode($this->items['PDT_NOM']));
					if((int)$this->items['PDT_PAI'] == 1 || (int)$this->items['PDT_ID'] == 1)
					{
						$this->initLogo($this->items);
					}

					$this->initBG($this->items);
					$this->initLogoPage($this->items);
				}
			}else{
				$this->Error404();
			}
		}
		public function loadProduto($id){
			$dir = Document::generateDirStructure($id);
			if(Document::hasFile($dir."PDT_".APP_DEFAULT_EDITORIAL."_{$id}.json")){
				 return json_decode(file_get_contents($dir."PDT_".APP_DEFAULT_EDITORIAL."_{$id}.json"), true);
			}
			return false;
		}
		public function initBG($produto){
			if(!empty($produto))
			{
				if(!empty($produto['menu']['bg']))
				{

					$id = $produto['menu']['bg']['ID'];
					$itens = $this->loadDTQ($id);
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
		public function loadCategoryJson ($vars = NULL)
		{
			//var_dump($vars);
			if(!empty($vars['VARS']['CAT_ID'])){
				$id = $vars['VARS']['CAT_ID'];
				$type = (!empty($vars['VARS']['TYPE']))?$vars['VARS']['TYPE']:"NT";
				$dir = Document::generateDirStructure($id);
				//var_dump($dir);
				if(Document::hasFile($dir."CAT_".APP_DEFAULT_EDITORIAL."_{$id}_{$type}.json")){
					$this->jsonCat = json_decode(file_get_contents($dir."CAT_".APP_DEFAULT_EDITORIAL."_{$id}_{$type}.json"), true);
					//var_dump($dir);
				}
			}
		}


		public function initConteudoJson ($vars = NULL)
		{
		//var_dump($vars);
			if(!empty( $vars['VARS']['ID'])){
				$id = $vars['VARS']['ID'];
				$dir = Document::generateDirStructure($id);

				if(Document::hasFile($dir."CNT_{$id}.json")){
					$this->content = json_decode(file_get_contents($dir."CNT_{$id}.json"), true);



							if($this->content['CNT_TIP'] == "TP"){
								if (!empty($this->content['CNT_TIT'])){
									$this->pageTitle = ("Saiba tudo sobre fórum ".$this->content['CNT_TIT']." - Rede Record");
								}
							}else{
								if (!empty($this->content['CNT_TIT'])){
									$this->pageTitle = ($this->content['CNT_TIT']." - Notícias - Marcelo Rezende - Rede Record");
								}
							}
						if (!empty($this->content['CNT_TIP'])){
							if($this->content['CNT_TIP'] == "NT"){
								$desc = "Leia todas as notícias exibidas pela Rede Record. Fique por dentro de tudo o que acontece no Brasil e no mundo.";
								$this->contentType = "noticia";
								$this->pageOminiture = "outros-r7:blogs:marcelo-rezende:noticias:noticia";
							}elseif($this->content['CNT_TIP'] == "GA"){
								$desc = "Veja fotos de Marcelo Rezende, exibidas pela Rede Record. Veja melhores momentos, entrevistas, dicas de viagens e culinária.";
								$this->contentType = "galeria";
								$this->pageOminiture = "outros-r7:blogs:marcelo-rezende:galeria";
							}elseif($this->content['CNT_TIP'] == "TP"){
								$desc = $this->content['CNT_TIT']." - Fóruns - Marcelo Rezende - Rede Record";
								$this->contentType = "forum";
								$this->pageOminiture = "outros-r7:blogs:marcelo-rezende:forum:topico";
							}elseif($this->content['CNT_TIP'] == "VD"){
								$desc = "Veja os vídeos de Marcelo Rezende, exibido pela Rede Record. Assista aos melhores momentos do programa, entrevistas, dicas de viagens e culinaria.";
								$this->contentType = "video";
								$this->pageOminiture = "outros-r7:blogs:marcelo-rezende:videos:video";
							}elseif($this->content['CNT_TIP'] == "7E"){
								$desc = "Veja os vídeos de Marcelo Rezende, exibido pela Rede Record. Assista aos melhores momentos do programa, entrevistas, dicas de viagens e culinaria.";
								$this->contentType = "7-erros";
								$this->pageOminiture = "outros-r7:blogs:marcelo-rezende:7-erros";
							}elseif($this->content['CNT_TIP'] == "MS"){
								$desc = "Veja os vídeos de Marcelo Rezende, exibido pela Rede Record. Assista aos melhores momentos do programa, entrevistas, dicas de viagens e culinaria.";
								$this->contentType = "home";
								$this->pageOminiture = "outros-r7:blogs:marcelo-rezende:cidade-alerta:marcelo-rezende-narra";
							}else{
								$desc = "Veja os vídeos de Marcelo Rezende, exibido pela Rede Record. Assista aos melhores momentos do programa, entrevistas, dicas de viagens e culinaria.";
								$this->contentType = "noticia";
								$this->pageOminiture = "outros-r7:blogs:marcelo-rezende:vinhos";
							}

							if (!empty($this->content['CNT_ID'])){
								$this->pageID = ($this->content['CNT_ID']);
							}
							$this->pageDescription = $desc;
						}

						$keywords = "violencia, cidade alerta, violencia urbana, crimes, criminalidade, casos de policia";
						$this->pageKeywords = $keywords;

				}
			}else{
			//	$this->Error404();
			}
		}


	}
?>
