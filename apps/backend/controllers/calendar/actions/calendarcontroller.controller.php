<?php
class CalendarController extends DefaultBackEnd2Controller
{
	const THUMB_TYPE = "THB_CNT";
	public $moduleName = "{Calendar}";
	public $moduleDir = "calendar";
	
	public function index($vars = null)
	{
		$this->pageTitle = "{List Calendar}";
		
		$this->breadCrumb = array("/calendar/index.php" => "{Calendar}");
		
		$criteria = new FuriousSelectCriteria();
		$criteria->add("`cnt_conteudo`.`CNT_TIP`", "CA", FuriousExpressionsDB::EQUAL);
		$criteria->add("`cnt_conteudo`.`CNT_STS`", "(9, 8)", FuriousExpressionsDB::NOT_IN);
		$criteria->add("`cnt_conteudo`.`CNT_IPR`", $this->Site->getPDTID(), FuriousExpressionsDB::EQUAL);
		$criteria->addDescendingOrder("`cnt_conteudo`.`CNT_DTA`");
		
		
		if(!empty($_GET['q']))
		{
			$criteria->add("`cnt_conteudo`.`CNT_TIT`", addslashes($_GET['q']."%"), FuriousExpressionsDB::LIKE);
		}
		
		if(!empty($_GET['start_period']))
		{
			$date = strtotime(str_replace("/", "-", $_GET['start_period']));
			$difH = (int)(date("H", $date));
			$difH = (($difH*60)*60);
			$difM = (int)(date("i", $date));
			$difM = (($difM*60));
			$dif = $difH + $difM;
			$nDate = $date - $dif;
			$this->filters['start_period'] = date("d/m/Y", $nDate);
			
			$criteria->add("`cnt_conteudo`.`CNT_DTF`", addslashes(date("Y/m/d H:i:s", $nDate)), FuriousExpressionsDB::GREATER_THAN);
		}
		
		if(!empty($_GET['end_period']))
		{
			$date = strtotime(str_replace("/", "-", $_GET['end_period']));
			$difH = 23 - (int)(date("H", $date));
			$difH = (($difH*60)*60);
			$difM = 59 - (int)(date("i", $date));
			$difM = (($difM*60));
			$dif = $difH + $difM;
			$nDate = $date + $dif;
			$this->filters['end_period'] = date("d/m/Y", $nDate);
			
			$criteria->add("`cnt_conteudo`.`CNT_DTF`", addslashes(date("Y/m/d H:i:s", $nDate)), FuriousExpressionsDB::MINOR_THAN);
		}
		
		
		$this->doPagination("AgendaModel", "itens", $criteria, $vars);
	}
	public function novo($vars = null)
	{
		$this->pageTitle = "{Add Event}";
		$this->breadCrumb = array("/calendar/index.php" => "{Event}");
			
		if(!empty($_GET['ID']))
		{
			$content = AgendaModel::getOne(addslashes((int)$_GET['ID']));
			if(!empty($content[0]))
			{
				$this->content = $content[0];
			}
		} else {
			$this->content = new Agenda();
			$this->content->CNT_STS = 8;
			$this->content->CNT_DTA = date("Y-m-d H:i:s");
			$this->content->CNT_SIT  = $this->Site->getPDTID();
			$this->content->CNT_IPR  = $this->Site->getPDTID();
			$this->content->save();
			
		}
		if(Dispatcher::getPostValues("calendar"))
		{
			$imgNews = "";
			
			$values = Dispatcher::getPostValues("calendar");
			$values["CNT_DTA"] = date("Y-m-d H:i:s",strtotime(str_replace("/", "-", $values["CNT_DTA"])));
			$values["CNT_DTF"] = date("Y-m-d H:i:s",strtotime(str_replace("/", "-", $values["CNT_DTF"])));
			
			
			
			if(isset($values["IMG_DTQ"]))
			{
				$imgNews = $values["IMG_DTQ"];
				unset($values["IMG_DTQ"]);
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
				$this->Message = "{Event Saved}";
			}
			
			// Get Noticia ID
			$ID = $this->content->getCNTID();
			
			
			// Save Image Relation
			if(!empty($imgNews))
			{
				$this->updateImageRelation($ID, $imgNews, self::THUMB_TYPE);
			}
			
			//$this->content->generateJSON();
			//$this->content->generateJsonLists();
			
		}
		
		$this->action = $this->Editorial->getURL()."calendar/edit.php?ID=".($this->content->getCNTID());
	}
}
?>