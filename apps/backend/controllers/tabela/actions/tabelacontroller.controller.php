<?php
	class TabelaController extends DefaultBackEnd2Controller
	{
		const THUMB_TYPE = "THB_CNT";
		public $moduleName = "Tabela";
		public $moduleDir = "tabela";
		public function index($vars = null)
		{

      $this->ID = $vars['VARS']['ID'];

			$this->pageTitle = "{List Tabela}";

			$this->breadCrumb = array("tabela/".$this->ID."/index.php" => "{Tabela}");

			$criteria = new FuriousSelectCriteria();
			$criteria->add("`tabela_nutricional`.`produto_id`", $this->ID,FuriousExpressionsDB::EQUAL);


			$this->doPagination("TabelaNutricionalModel", "itens", $criteria, $vars, 500);
		}
		public function novo($vars = null)
		{
      $this->ID = $vars['VARS']['ID'];

			$this->linksTitle = (Dispatcher::getEditorialID() == 12)?"Ingredientes":'Links Relacionados';
			$this->linksShow = (Dispatcher::getEditorialID() == 12)?TRUE:FALSE;

			$this->pageTitle = "{Add Tabela}";
			$this->breadCrumb = array("tabela/{$this->ID}/index.php" => "{Tabela}");

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
				$this->breadCrumb["tabela/{$this->ID}/new.php"] = "{Edit Tabela}";
				$this->pageTitle = "{Edit Tabela}";
				$content = TabelaNutricionalModel::getOne(addslashes($newsID));
				$this->content = $content[0];


			} else {
				$this->breadCrumb["tabela/{$this->ID}/new.php"] = "{Add Tabela}";

				$this->content = new TabelaNutricional();
				$this->content->produto_id  = $this->ID;
				$this->content->status = 8;

				$this->content->save();
				//$this->content->CNT_STS = 0;
			}


			if(Dispatcher::getPostValues("news"))
			{

				$values = Dispatcher::getPostValues("news");



				foreach($values as $key => $value)
				{
					$this->content->$key = $value;
				}

				if(!$this->content->save())
				{
					$this->Errors = "{Save Error, try later}";
				} else {
					$this->Message = "{News Saved}";
				}



				//$this->content->generateJSON();
				//$this->content->generateJsonLists();

			}


			$this->action = $this->Editorial->getURL()."tabela/{$this->ID}/edit.php?ID=".($this->content->getID());
		}
		public function delete($vars = null)
		{
      	  	$this->ID = $vars['VARS']['ID'];
			//$this->setTemplate("delete", "default");

			$this->pageTitle = "{Delete Tabela}";
			$this->breadCrumb = array("tabela/{$this->ID}/index.php" => "{Tabela}");
			$this->linkLista = $this->Editorial->getURL() . "tabela/{$this->ID}/index.php";
			if(!empty($_GET["ID"]))
			{
				$content = TabelaNutricionalModel::getOne(addslashes($_GET["ID"]));
				$this->content = $content[0];
				if($this->content->delete())
				{
					$this->DeleteOk = true;
				}
			} else {
				$this->Error404();
			}
		}

	}
?>
