<?php
class SevenerrorsController extends DefaultBackEnd2Controller 
{
	const THUMB_TYPE = "THB_CNT";
	public $moduleDir = "sevenerrors";
	public function index($vars = null)
	{
		$this->pageTitle = "{List 7 errors game}";
		$this->breadCrumb = array("/sevenerrors/index.php" => "{7 errors game}");
		
		$criteria = new FuriousSelectCriteria();
		$criteria->add("`cnt_conteudo`.`CNT_TIP`", "7E", FuriousExpressionsDB::EQUAL);
		$criteria->add("`cnt_conteudo`.`CNT_STS`", "9", FuriousExpressionsDB::NOT_EQUAL);
		$criteria->add("`cnt_conteudo`.`CNT_STS`", "8", FuriousExpressionsDB::NOT_EQUAL);
		$criteria->addDescendingOrder("`cnt_conteudo`.`CNT_DTA`");
		
		$this->applyFilters($criteria, "`cnt_conteudo`.`CNT_STS`", "`cnt_conteudo`.`CNT_TIT`");
		
		$this->doPagination("SevengameModel", "itens", $criteria, $vars);
	}
	public function novo($vars = null)
	{
		if(!empty($_GET['ID']))
		{
			$item = SevengameModel::getOne(addslashes($_GET['ID']));
			if(!empty($item[0]))
			{
				$this->content = $item[0];
			}
		} else {
			$this->content = new Sevengame();
			$this->content->CNT_TIP = '7E';
			$this->content->CNT_SIT = APP_DEFAULT_EDITORIAL;
			$this->content->CNT_IPR = APP_DEFAULT_EDITORIAL;
			$this->content->CNT_STS = 8;
			$this->content->CNT_DTA = date("Y-m-d H:i:s");
			$this->content->save();
		}
		if(empty($this->content))
		{
			$this->Error404();
			return false;
		}
		if(Dispatcher::getPostValues("seven"))
		{	$edts = array();
			$tags = array();
			$links = array();
			$imgNews = "";
			$img1 = "";
			$img2 = "";
			$coords = "";
			
			$values = Dispatcher::getPostValues("seven");
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
			if(isset($values["IMG1"]))
			{
				$img1 = $values["IMG1"];
				unset($values["IMG1"]);
			}
			if(isset($values["IMG2"]))
			{
				$img2 = $values["IMG2"];
				unset($values["IMG2"]);
			}
			if(!empty($values["CNT_LINK"]))
			{
				$links = $values["CNT_LINK"];
				unset($values["CNT_LINK"]);
			}
			if(!empty($values["COORDS"]))
			{
				$coords = $values["COORDS"];
				unset($values["COORDS"]);
			}			
			
			$this->content->CNT_CMT = 0;
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
			if(!empty($links[0]))
			{
				// Update Links Relations
				$this->updateLinksRelations($ID, $links);
			}
			// Save Image Relation
			if(!empty($imgNews))
			{
				$this->updateImageRelation($ID, $imgNews, self::THUMB_TYPE);
			}
			
			$criteria = new FuriousSelectCriteria();
			$criteria->add("`cnt_conteudo_7erros`.`ER7_CNT`", $ID, FuriousExpressionsDB::EQUAL);
			$criteria->add("`cnt_conteudo_7erros`.`ER7_STS`", "1", FuriousExpressionsDB::EQUAL);
			$it = SevenerrorsModel::doSelect($criteria);
			if(!empty($it[0]))
			{
				foreach($it as $re){
					$re->delete();
				}
			}
			if(!empty($ID))
			{
				$imgGame = new Sevenerrors();
				$imgGame->ER7_CNT = $ID;
				$imgGame->ER7_STS = 1;

				if(!empty($img1)){
					$imgGame->ER7_IMG1 = $img1;
				}
				if(!empty($img2)){
					$imgGame->ER7_IMG2 = $img2;
				}
				if(!empty($coords))
				{
					foreach($coords as $index => $coord)
					{
						$prop = "ER7_CO".($index+1);
						$imgGame->$prop = $coord;
					}
				}

				$imgGame->save();
			}
			
			
			//$this->content->generateJSON();
			//$this->content->generateJsonLists();
		}
	}
	
	public function delete($vars = null)
	{
		$this->setTemplate("delete", "default");
		
		$this->pageTitle = "Deletar Game";
		$this->breadCrumb = array("/sevenerrors/index.php" => "7 Erros");
		if(!empty($_GET["ID"]))
		{
			$content = SevengameModel::getOne(addslashes($_GET["ID"]));
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