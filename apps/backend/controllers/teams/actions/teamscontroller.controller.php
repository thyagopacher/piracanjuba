<?php
class TeamsController extends DefaultBackEnd2Controller
{
	public $moduleName = "Teams";
	public $moduleDir = "teams";
	public function index($vars = null)
	{
		$this->pageTitle = "{List $this->moduleName}";
		
		$this->breadCrumb = array("/$this->moduleDir/index.php" => "{".$this->moduleName."}");
		
		$criteria = new FuriousSelectCriteria();
		$criteria->add("`cnt_team`.`status`", 9, FuriousExpressionsDB::NOT_EQUAL);
		$criteria->add("`cnt_team`.`status`", 8, FuriousExpressionsDB::NOT_EQUAL);
		
		$this->applyFilters($criteria, "`cnt_team`.`status`", "`cnt_team`.`name`");

		$this->doPagination("SelectionsModel", "itens", $criteria, $vars);
	}
	public function novo ( $vars = null )
	{
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
			$criteria->add("`cnt_team`.`id`", $newsID, FuriousExpressionsDB::EQUAL);
			$content = SelectionsModel::doSelect($criteria);
			$this->content = $content[0];
			
			
		} else {
			$this->breadCrumb["/$this->moduleDir/new.php"] = "{Add $this->moduleName}";
			
			$this->content = new Selections();
			$this->content->status = 8;
			$this->content->save();
			//$this->content->CNT_STS = 0;
		}
		
		
		if(Dispatcher::getPostValues("news"))
		{
			$values = Dispatcher::getPostValues("news");
			
			
			// Save Noticia
			foreach($values as $key => $value)
			{
				$this->content->$key = $value;
			}
			
			
			
			if(!$this->content->save())
			{
				$this->Errors = "{Save Error, try later}";
			} else {
				$this->Message = "{Content Saved}";
			}
			
			// Get Noticia ID
			$ID = $this->content->getID();
			
			
			//$this->content->generateJSON();
			//$this->content->generateJsonLists();
			
		}
		
		
		$this->action = $this->Editorial->getURL()."$this->moduleDir/edit.php?ID=".($this->content->getID());
	}
}
?>