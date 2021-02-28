<?php
	
	class EnquetesController extends DefaultBackEnd2Controller
	{
		const THUMB_TYPE = "THB_ENQ";
		public $moduleName = "Enquetes";
		public $moduleDir = "enquetes";
		/*
		private function loadParents($type){
		
			$criteria = new FuriousSelectCriteria();
			$criteria->add("`w11_produto_menu`.`MNU_TIP`", addslashes("{$type}/index"), FuriousExpressionsDB::EQUAL);
			$criteria->add("`w11_produto_menu`.`MNU_STS`", 1, FuriousExpressionsDB::EQUAL);
			$criteria->setLimit(1);
			$itens = EnqueteModel::doSelect($criteria);
			//var_dump($itens);
			if(!empty($itens[0]))
			{
				$this->type = $type;
				// Set Configs
				$this->configs = $itens[0];
				return true;
			} else {
				//$this->Error404();
				return false;
			}
		
		
			$criteria = new FuriousSelectCriteria();
			//$criteria->add("`enquetes`.`pai`", 0, FuriousExpressionsDB::EQUAL);
			$criteria->add("`enquetes`.`status`", 9, FuriousExpressionsDB::NOT_EQUAL);
			$criteria->add("`enquetes`.`status`", 8, FuriousExpressionsDB::NOT_EQUAL);		
			$criteria->add("`enquetes`.`site_id`", $this->Site->getPDTID(), FuriousExpressionsDB::EQUAL);
			
			$this->applyFilters($criteria, "`enquetes`.`status`", "`enquetes`.`name`");			
			
			//$this->doPagination("MenuModel", "itens", $criteria, $vars);			
			
			$this->itens = EnqueteModel::doSelect($criteria);
			/*
			$this->itens = array();
			foreach($itens as $item):
				$this->itens += renderArrayOption2($item, 0, true, true);
			endforeach;
		}*/
		
		public function index($vars = null)
		{
			$this->pageTitle = "Lista de Enquete";
			$this->breadCrumb = array("/enquetes/index.php" => "Enquete");
			
		
		
			$criteria = new FuriousSelectCriteria();
			//$criteria->add("`enquetes`.`pai`", 0, FuriousExpressionsDB::EQUAL);
			$criteria->add("`enquetes`.`status`", 9, FuriousExpressionsDB::NOT_EQUAL);
			$criteria->add("`enquetes`.`status`", 8, FuriousExpressionsDB::NOT_EQUAL);		
			$criteria->add("`enquetes`.`site_id`", $this->Site->getPDTID(), FuriousExpressionsDB::EQUAL);
			
			//$this->applyFilters($criteria, "`enquetes`.`status`", "`enquetes`.`name`");			
			
			//$this->doPagination("MenuModel", "itens", $criteria, $vars);			
			
			$this->itens = EnqueteModel::doSelect($criteria);
			//var_dump($this->itens);
			//echo($criteria);
			/*$this->itens = array();
			foreach($itens as $item):
				$this->itens += $item;
			endforeach;*/
			
			
			
		}
		public function novo($vars = null)
		{
			$this->pageTitle = "Adicionar Enquete";
			$this->breadCrumb = array("enquetes/index.php" => "Enquete");
			
			$newsID = null;
			if(!empty($_GET["ID"]))
			{
				$newsID = $_GET["ID"];
			}
			if(!empty($_POST["menu"]["ID"]))
			{
				$newsID = $_POST["menu"]["ID"];
			}
			/*
			$this->loadParents();
			$this->labels = array("" => "Selecione um item");
			foreach($this->itens as $ID => $item){
				if($ID != $newsID){
					$this->labels[$ID] = $item->name; 
				}			
			}*/
			
			if($newsID != null)
			{
				$this->breadCrumb["enquetes/new.php"] = "{Edit} Enquete";
				$this->pageTitle = "{Edit} Enquete";
				$content = EnqueteModel::getOne(addslashes($newsID));
				$this->content = $content[0];

				
			} else {
				$this->breadCrumb["enquetes/new.php"] = "{Add} Enquete";
				
				$this->content = new Enquete();
				$this->content->site_id = $this->Site->getPDTID();
				$this->content->status = 8;
				$this->content->save();
			}
			
			
			if(Dispatcher::getPostValues("menu"))
			{
				//$edts = array();				
				$values = Dispatcher::getPostValues("menu");
				//unset($values["CNT_DTA"]);
				
				//var_dump($values);
				//var_dump($values['file_id']);
				if(isset($values['file_id']))
				{
					$imgNews = $values['file_id'];
					unset($values['file_id']);
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
					$this->Message = "Enquete Salva";
					if(!empty($imgNews))
					{
						$this->updateImageRelation($this->content->getID(), $imgNews, self::THUMB_TYPE);
					} else {
						$this->updateImageRelation($this->content->getID(), NULL, self::THUMB_TYPE);
					}
					//$this->content->generateJSON();
				}
				
				
				// Get Noticia ID
				//$ID = $this->content->getID();
				
				
			}
			
			
			$this->action = $this->Editorial->getURL()."enquetes/edit.php?ID=".($this->content->getID());
		}
		public function delete($vars = null)
		{
			$this->setTemplate("delete", "default");
			
			$this->pageTitle = "{Delete} Enquete";
			$this->breadCrumb = array("enquetes/index.php" => "Enquete");
			if(!empty($_GET["ID"]))
			{
				$content = EnqueteModel::getOne(addslashes($_GET["ID"]));
				$this->content = $content[0];
				
				if($this->content->delete())
				{
					//$this->content->generateJSON();
					$this->DeleteOk = true;
				}
			} else {
				$this->Error404();
			}
		}
	}
?>