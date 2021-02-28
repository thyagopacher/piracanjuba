<?php
	class RepresentantesController extends DefaultBackEnd2Controller
	{
		const THUMB_TYPE = "THB_CNT";
		public $moduleName = "Representantes";
		public $moduleDir = "representantes";
		public function index($vars = null)
		{

			$this->pageTitle = "Listar Representantes";

			$this->breadCrumb = array("/representantes/index.php" => "Representantes");

			$criteria = new FuriousSelectCriteria();
			$criteria->add("`cnt_conteudo`.`CNT_TIP`", "REP", FuriousExpressionsDB::EQUAL);
			$criteria->add("`cnt_conteudo`.`CNT_STS`", 9, FuriousExpressionsDB::NOT_EQUAL);
			$criteria->add("`cnt_conteudo`.`CNT_STS`", 8, FuriousExpressionsDB::NOT_EQUAL);
			$criteria->add("`cnt_conteudo`.`CNT_IPR`", $this->Site->getPDTID(), FuriousExpressionsDB::EQUAL);
			$criteria->addDescendingOrder("`cnt_conteudo`.`CNT_DTA`");


			$this->applyFilters($criteria, "`cnt_conteudo`.`CNT_STS`", "`cnt_conteudo`.`CNT_TIT`");


			$this->doPagination("NoticiaModel", "itens", $criteria, $vars);
		}
		public function novo($vars = null)
		{
			$this->pageTitle = "Adicionar Representante";
			$this->breadCrumb = array("representantes/index.php" => "Representantes");

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
				$this->breadCrumb["/representantes/new.php"] = "Editar Representante";
				$this->pageTitle = "Editar Representante";
				$content = NoticiaModel::getOne(addslashes($newsID));
				$this->content = $content[0];
				$this->content->CNT_TIP = "REP";

			} else {
				$this->breadCrumb["/representantes/new.php"] = "Adicionar Representante";

				$this->content = new Noticia();
				$this->content->CNT_SIT  = $this->Site->getPDTID();
				$this->content->CNT_IPR  = $this->Site->getPDTID();
				$this->content->CNT_TIP = "REP";
				$this->content->CNT_STS = 8;
				$this->content->CNT_DTA = date("Y-m-d H:i:s");
				$this->content->save();
				//$this->content->CNT_STS = 0;
			}


			if(Dispatcher::getPostValues("news"))
			{

				$edts = array();
				$tags = array();
				$links = array();
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
				if(!empty($values["cnt_tags"]))
				{
					$tags = $values["cnt_tags"];
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

				if(!empty($values["cnt_prods"]))
				{
					$prods = $values["cnt_prods"];
					unset($values["cnt_prods"]);
					if(!empty($values["cnt_tags"])) {
						$prods = array_merge($prods, $values["cnt_tags"]);
					}
					unset($values["cnt_tags"]);

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
					$this->Message = "Representante Cadastrado";
				}

				// Get Noticia ID
				$ID = $this->content->getCNTID();
				if (!empty($edts[0])) {
					// Update Editorial Relations
					$this->updateEdtsRelations($ID, $edts, "PROD");
				}
				if(empty($prods)){
					$prods=array();
				}
				$this->updateProdsRelationss($ID, $prods, 'PROD');

				// Save Featured
				$this->createFeatureds($this->content);

				//$this->content->generateJSON();
//				$this->content->generateJsonLists();

			}

			$this->action = $this->Editorial->getURL()."representantes/edit.php?ID=".($this->content->getCNTID());

		}
		public function delete($vars = null)
		{
			$this->setTemplate("delete", "default");

			$this->pageTitle = "Representante deletado";
			$this->breadCrumb = array("representantes/index.php" => "Representantes");
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
