<?php
class PlayersController extends DefaultBackEnd2Controller
{
	public $moduleName = "Players";
	public $moduleDir = "players";
	public $moduleTable = "cnt_players";
	public $moduleModel = "PlayersModel";
	public function index ( $vars = null )
	{
		$this->setTemplate("index", "default");
		
		$this->pageTitle = "{List $this->moduleName}";
		
		$this->breadCrumb = array("/$this->moduleDir/index.php" => "{".$this->moduleName."}");
		
		$criteria = new FuriousSelectCriteria();
		$criteria->add("`{$this->moduleTable}`.`status`", 9, FuriousExpressionsDB::NOT_EQUAL);
		$criteria->add("`{$this->moduleTable}`.`status`", 8, FuriousExpressionsDB::NOT_EQUAL);
		
		$this->applyFilters($criteria, "`{$this->moduleTable}`.`status`", "`{$this->moduleTable}`.`name`");

		$this->doPagination("$this->moduleModel", "itens", $criteria, $vars);
	}
	public function novo ( $vars = null )
	{
		$criteria = new FuriousSelectCriteria();
		$criteria->add("`cnt_team`.`status`", 1, FuriousExpressionsDB::EQUAL);
		$selections = SelectionsModel::doSelect($criteria);
		if(!empty($selections[0]))
		{
			$this->selections = array("" => "Selecione uma seleחדo");
			foreach($selections as $sel)
			{
				$this->selections[$sel->getID()] = $sel->getName();
			}
		} else {
			$this->selections = array();
		}
		
		
		$this->pageTitle = "{Add $this->moduleName}";
		$this->breadCrumb = array("/$this->moduleDir/index.php" => "{".$this->moduleName."}");
		
		$newsID = null;
		if(!empty($_GET["ID"]))
		{
			$newsID = $_GET["ID"];
		}
		if(!empty($_POST["news"]["id"]))
		{
			$newsID = $_POST["news"]["id"];
		}
		
		if($newsID != null)
		{
			$this->breadCrumb["/$this->moduleDir/new.php"] = "{Edit $this->moduleName}";
			$this->pageTitle = "{Edit $this->moduleName}";
			$criteria = new FuriousSelectCriteria();
			$criteria->add("`{$this->moduleTable}`.`id`", $newsID, FuriousExpressionsDB::EQUAL);
			$content = PlayersModel::doSelect($criteria);
			$this->content = $content[0];
			
			
		} else {
			$this->breadCrumb["/$this->moduleDir/new.php"] = "{Add $this->moduleName}";
			
			$this->content = new Players();
			$this->content->status = 8;
			$this->content->save();
			//$this->content->CNT_STS = 0;
		}
		
		
		if(Dispatcher::getPostValues("news"))
		{
			$imgNews = "";
			$values = Dispatcher::getPostValues("news");
			//$values["age"] = date("Y-m-d H:i:s",strtotime(str_replace("/", "-", $values["birthday"])));
			//unset($values["birthday"]);
			$values["age"] = (int)$values["birthday"];
			unset($values["birthday"]);
			
			
			if(isset($values["IMG_DTQ"]))
			{
				$imgNews = $values["IMG_DTQ"];
				unset($values["IMG_DTQ"]);
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
				$ID = $this->content->getID();
				$this->Message = "{Content Saved}";
				if(!empty($imgNews))
				{
					$this->updateImageRelation($ID, $imgNews, "THB_PLA");
				}
			}
			
			// Get Noticia ID
			$ID = $this->content->getID();
			
			
			
			
			
			
			//$this->content->generateJSON();
			//$this->content->generateJsonLists();
			
		}
		
		
		$this->action = $this->Editorial->getURL()."$this->moduleDir/edit.php?ID=".($this->content->getID());
	}
	public function delete($vars = null)
	{
		$this->setTemplate("delete", "default");
		
		$this->pageTitle = "{Delete News}";
		$this->breadCrumb = array("/players/index.php" => "{Players}");
		if(!empty($_GET["ID"]))
		{
			$content = PlayersModel::getOne(addslashes($_GET["ID"]));
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