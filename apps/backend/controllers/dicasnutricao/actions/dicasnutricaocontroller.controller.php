<?php
	class DicasNutricaoController extends DefaultBackEnd2Controller
	{
		const THUMB_TYPE = "THB_CNT";
		public $moduleName = "Dicas de nutriçaõ";
		public $moduleDir = "dicasnutricao";
		public function index($vars = null)
		{

			$this->pageTitle = "Listar Dicas";

			$this->breadCrumb = array("/dicasnutricao/index.php" => "Dicas de Nutrição");

			$criteria = new FuriousSelectCriteria();
			$criteria->add("`cnt_conteudo`.`CNT_TIP`", "DN", FuriousExpressionsDB::EQUAL);
			$criteria->add("`cnt_conteudo`.`CNT_STS`", 9, FuriousExpressionsDB::NOT_EQUAL);
			$criteria->add("`cnt_conteudo`.`CNT_STS`", 8, FuriousExpressionsDB::NOT_EQUAL);
			$criteria->add("`cnt_conteudo`.`CNT_IPR`", $this->Site->getPDTID(), FuriousExpressionsDB::EQUAL);
			$criteria->addDescendingOrder("`cnt_conteudo`.`CNT_DTA`");


			$this->applyFilters($criteria, "`cnt_conteudo`.`CNT_STS`", "`cnt_conteudo`.`CNT_TIT`");


			$this->doPagination("NoticiaModel", "itens", $criteria, $vars);
		}
		public function novo($vars = null)
		{


			$configs = Configurator::init();
			$fileFormats = array_keys($configs->getViewConfig("imageFormats"));
			$this->fileFormats = array("" => "Selecione um tamanho");
			foreach($fileFormats as $value){
				$this->fileFormats[$value] = $value;
			}

			
			$this->linksTitle = (Dispatcher::getEditorialID() == 12)?"Ingredientes":'Links Relacionados';
			$this->linksShow = (Dispatcher::getEditorialID() == 12)?TRUE:FALSE;

			$this->pageTitle = "Adicionar Dicas";
			$this->breadCrumb = array("dicasnutricao/index.php" => "Dicas de Nutrição");

			$newsID = null;
			if(!empty($_GET["ID"]))
			{
				$newsID = $_GET["ID"];
			}
			if(!empty($_POST["news"]["CNT_ID"]))
			{
				$newsID = $_POST["news"]["CNT_ID"];
			}

			if($newsID != null)
			{
				$this->breadCrumb["/dicasnutricao/new.php"] = "Editar Dica";
				$this->pageTitle = "Editar Dica";
				$content = NoticiaModel::getOne(addslashes($newsID));
				$this->content = $content[0];


			} else {
				$this->breadCrumb["/dicasnutricao/new.php"] = "Adicionar Dica";

				$this->content = new Noticia();
				$this->content->CNT_SIT  = $this->Site->getPDTID();
				$this->content->CNT_IPR  = $this->Site->getPDTID();
				$this->content->CNT_TIP = "DN";
				$this->content->CNT_STS = 8;
				$this->content->CNT_DTA = date("Y-m-d H:i:s");
				//$this->content->save();
				//$this->content->CNT_STS = 0;
			}



			if(Dispatcher::getPostValues("news"))
			{

				$edts = array();
				$tags = array();
				$links = array();
				$categorias = array();
				$prods = array();
				$imgNews = NULL;
				$imgNews2 = NULL;
				$imgNews3 = NULL;

				$values = Dispatcher::getPostValues("news");
				$values["CNT_DTA"] = date("Y-m-d H:i:s",strtotime(str_replace("/", "-", $values["CNT_DTA"])));



				if(!empty($values["EDT_CATS"]))
				{
					$edts = $values["EDT_CATS"];
					unset($values["EDT_CATS"]);
				}

				if(!empty($values["cnt_cats"]))
				{
					$categorias = $values["cnt_cats"];
					unset($values["cnt_cats"]);
				}

				if(!empty($values["cnt_prods"]))
				{
					$prods = $values["cnt_prods"];
					unset($values["cnt_prods"]);
					if(!empty($values["cnt_tags"])) {
						$prods = array_merge($prods, $values["cnt_tags"]);
					}

					unset($values["cnt_tags"]);

				}
				if(isset($values["IMG_DTQ"]))
				{
					$imgNews = $values["IMG_DTQ"];
					unset($values["IMG_DTQ"]);
				}
				if(isset($values["IMG_DTQ2"]))
				{
					$imgNews2 = $values["IMG_DTQ2"];
					unset($values["IMG_DTQ2"]);
				}
				if(isset($values["IMG_DTQ3"]))
				{
					$imgNews3 = $values["IMG_DTQ3"];
					unset($values["IMG_DTQ3"]);
				}

				if(!empty($values["CNT_LINK"]))
				{
					$links = $values["CNT_LINK"];
					unset($values["CNT_LINK"]);
				}

				// Save Noticia
				$this->content->CNT_CMT = 0;


				foreach($values as $key => $value)
				{
					$this->content->$key = $value;
				}

				if(!$this->content->save())
				{
					$this->Errors = "{Save Error, try later}";
				} else {
					$this->Message = "Dica Salva";
				}


				// Get Noticia ID
				$ID = $this->content->getCNTID();


				if(!empty($edts[0]))
				{
					// Update Editorial Relations
					$this->updateEdtsRelations($ID, $edts);
				}

				if(!empty($tags[0]))
				{
					// Update Tags Relations
					$this->updateTagsRelations($ID, $tags);
				}

				if(!empty($prods[0])){
					$this->updateProdsRelationss($ID, $prods, 'DICA');
				}

				if(!empty($categorias[0])){


					$this->updateProdsRelationss($ID, $prods, 'DICA_CAT');

				}
				if(!empty($links[0]))
				{
					// Update Links Relations
					$this->updateLinksRelations($ID, $links);
				}
				// Save Image Relation
				$this->updateImageRelation($ID, $imgNews, self::THUMB_TYPE);
				$this->updateImageRelation($ID, $imgNews2, "THB_EMB1");
				$this->updateImageRelation($ID, $imgNews3, "THB_EMB2");


				// Save Featured
				$this->createFeatureds($this->content);

				//$this->content->generateJSON();
				//$this->content->generateJsonLists();

			}

			$this->action = $this->Editorial->getURL()."dicasnutricao/edit.php?ID=".($this->content->getCNTID());
		}
		public function delete($vars = null)
		{
			$this->setTemplate("delete", "default");

			$this->pageTitle = "Deletar Dica";
			$this->breadCrumb = array("dicasnutricao/index.php" => "Dicas de Nutrição");
			if(!empty($_GET["ID"]))
			{
				$content = NoticiaModel::getOne(addslashes($_GET["ID"]));
				$this->content = $content[0];
				if($this->content->delete())
				{
					$this->DeleteOk = true;
				}
			} else {
				$this->Error404();
			}
		}
		public function quick($vars = null)
		{
			$this->setTemplate("quick", "default");

			if(Dispatcher::getPostValues("quick")):
				$values = Dispatcher::getPostValues("quick");
				$values["CNT_DTA"] = date("Y-m-d H:i:s",strtotime(str_replace("/", "-", $values["CNT_INI"])));

				if(!empty($values["CNT_ID"])):
					$this->item = DestaquesModel::getOne($values["CNT_ID"]);

					// If isn't empty itens returned
					if(!empty($this->item[0]))
					{
						// Set Content variable and set Page Title
						$this->content = $this->item[0];

						foreach($values as $key => $value):
							$this->content->$key = $value;
						endforeach;
						if(empty($values["CNT_STS"]))
						{
							$this->content->CNT_STS = 0;
						}

						if($this->content->save()):
							$this->success = true;
						endif;
					}
				endif;
			endif;
		}
	}
?>
