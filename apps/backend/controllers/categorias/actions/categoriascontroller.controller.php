<?php
	class CategoriasController extends DefaultBackEnd2Controller
	{
		const THUMB_TYPE = "THB_CNT";
		public $moduleName = "Categorias";
		public $moduleDir = "categorias";
		public function index($vars = null)
		{

			$type = $vars['VARS']['TYPE'];
			$this->type = $type;

			$this->pageTitle = "Listar Categorias";

			$this->breadCrumb = array("/categorias/$type/index.php" => "Categorias");

			$criteria = new FuriousSelectCriteria();
			$criteria->add("`cnt_categorias`.`CAT_COR`", "$type", FuriousExpressionsDB::EQUAL);
			$criteria->add("`cnt_categorias`.`CAT_STS`", 9, FuriousExpressionsDB::NOT_EQUAL);
			$criteria->add("`cnt_categorias`.`CAT_STS`", 8, FuriousExpressionsDB::NOT_EQUAL);
			$criteria->add("`cnt_categorias`.`CAT_TIP`", $this->Site->getPDTID(), FuriousExpressionsDB::EQUAL);
			$criteria->addDescendingOrder("`cnt_categorias`.`CAT_NOM`");

			$this->applyFilters($criteria, "`cnt_categorias`.`CAT_STS`", "`cnt_categorias`.`CAT_NOM`");


			$this->doPagination("CategoriasModel", "itens", $criteria, $vars);
		}
		public function novo($vars = null)
		{
			$type = $vars['VARS']['TYPE'];
			$this->type = $type;

			$configs = Configurator::init();
			$fileFormats = array_keys($configs->getViewConfig("imageFormats"));
			$this->fileFormats = array("" => "Selecione um tamanho");
			foreach($fileFormats as $value){
				$this->fileFormats[$value] = $value;
			}


			$this->linksTitle = (Dispatcher::getEditorialID() == 12)?"Ingredientes":'Links Relacionados';
			$this->linksShow = (Dispatcher::getEditorialID() == 12)?TRUE:FALSE;

			$this->pageTitle = "Adicionar Categorias";
			$this->breadCrumb = array("categorias/$type/index.php" => "Categorias");

			$newsID = null;
			if(!empty($_GET["ID"]))
			{
				$newsID = $_GET["ID"];
			}
			if(!empty($_POST["news"]["CAT_ID"]))
			{
				$newsID = $_POST["news"]["CAT_ID"];
			}

			if($newsID != null)
			{
				$this->breadCrumb["/categorias/$type/new.php"] = "Editar Categoria";
				$this->pageTitle = "Editar Categoria";
				$content = CategoriasModel::getOne(addslashes($newsID));
				$this->content = $content[0];


			} else {

				$this->breadCrumb["/categorias/$type/new.php"] = "Cadastrar Categoria";

				$this->content = new Categorias();
				$this->content->CAT_COR = "$type";
				$this->content->CAT_TIP = $this->Site->getPDTID();
				$this->content->CAT_STS = 1;
				//$this->content->CAT_DTA = date("Y-m-d H:i:s");
				//$this->content->save();
				//$this->content->CNT_STS = 0;

			}


			if(Dispatcher::getPostValues("categoria"))
			{

				$imgNews = NULL;
				$imgNews2 = NULL;
				$imgNews3 = NULL;

				$values = Dispatcher::getPostValues("categoria");
				$valueIMG = Dispatcher::getPostValues("news");



				if(isset($valueIMG["IMG_DTQ"]))
				{
					$imgNews = $valueIMG["IMG_DTQ"];
					unset($valueIMG["IMG_DTQ"]);
				}

				// Save Noticia

				foreach($values as $key => $value)
				{
					$this->content->$key = $value;
				}

				if(!$this->content->save())
				{
					$this->Errors = "{Save Error, try later}";
				} else {

					$this->Message = "Categoria Gravada";
				}

				// Get Noticia ID
				$ID = $this->content->getCATID();


				// Save Image Relation
				$this->updateImageRelation($ID, $imgNews, "CAT");

/*				$this->updateImageRelation($ID, $imgNews2, "THB_EMB1");
				$this->updateImageRelation($ID, $imgNews3, "THB_EMB2");*/



			}


			$this->action = $this->Editorial->getURL()."categorias/$this->type/edit.php?ID=".($this->content->getCATID());
		}
		public function delete($vars = null)
		{


			$this->setTemplate("delete", "default");

			$this->pageTitle = "Deletar categoria";

			if(!empty($_GET["ID"]))
			{
				$content = CategoriasModel::getOne(addslashes($_GET["ID"]));
				$this->content = $content[0];
				if($this->content->delete())
				{
					$this->DeleteOk = true;
					$type =$vars['VARS']['TYPE'];
					/*/adm/1-piracanjuba/categorias/prod/*/

					$url = $this->Editorial->getURL()."categorias/".$type."/index.php";
					Dispatcher::forwardRaw($url);

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
