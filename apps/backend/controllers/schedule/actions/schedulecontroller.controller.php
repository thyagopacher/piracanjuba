<?php
class ScheduleController extends DefaultBackEnd2Controller 
{
	public $moduleName = "Schedule";
	public $moduleDir = "schedule";
	public $moduleTable = "cnt_calendar";
	public $moduleModel = "ScheduleModel";
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
			$this->selections = array("" => "Selecione uma sele��o");
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
			$content = ScheduleModel::doSelect($criteria);
			$this->content = $content[0];
			
			
		} else {
			$this->breadCrumb["/$this->moduleDir/new.php"] = "{Add $this->moduleName}";
			
			$this->content = new Schedule();
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