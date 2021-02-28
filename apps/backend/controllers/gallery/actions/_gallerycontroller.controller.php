<?php
class GalleryController extends DefaultBackEnd2Controller
{
	const THUMB_TYPE = "THB_CNT";
	public $moduleDir = "gallery";
	public function index($vars = null)
	{
		$this->pageTitle = "{List Galleries}";
		
		$this->breadCrumb = array("/gallery/index.php" => "{Gallery}");
		
		$criteria = new FuriousSelectCriteria();
		$criteria->add("`cnt_conteudo`.`CNT_TIP`", "GA", FuriousExpressionsDB::EQUAL);
		$criteria->add("`cnt_conteudo`.`CNT_STS`", 9, FuriousExpressionsDB::NOT_EQUAL);
		$criteria->add("`cnt_conteudo`.`CNT_IPR`", $this->EditorialID, FuriousExpressionsDB::EQUAL);
		$criteria->addDescendingOrder("`cnt_conteudo`.`CNT_DTA`");
		
		$this->applyFilters($criteria, "`cnt_conteudo`.`CNT_STS`", "`cnt_conteudo`.`CNT_TIT`");

		$this->doPagination("GaleriaModel", "itens", $criteria, $vars);
	}
	public function novo($vars = null)
	{
		$this->pageTitle = "{Add Gallery}";
		$this->breadCrumb = array("/gallery/index.php" => "{Gallery}");
		
		$newsID = null;
		if(!empty($_GET["ID"]))
		{
			$newsID = $_GET["ID"];
		}
		if(!empty($_POST["gallery"]["CNT_ID"]))
		{
			$newsID = $_POST["gallery"]["CNT_ID"];
		}
		if(Dispatcher::getPostValues("gallery"))
		{
			
			$edts = array();
			$tags = array();
			$links = array();
			$imgsRel = array();
			$imgNews = "";
			
			$values = Dispatcher::getPostValues("gallery");			
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
			
			if(!empty($values["IMG_REL"]))
			{
				$imgsRel = $values["IMG_REL"];
				unset($values["IMG_REL"]);
			}
						
			// Save Noticia
			$noticia = new Galeria();
			$noticia->CNT_CMT = 0;
			foreach($values as $key => $value)
			{
				$noticia->$key = $value;
			}
			
			if(!$noticia->save())
			{
				$this->Errors = "{Save Error, try later}";
			} else {
				$this->Message = "{Gallery Saved}";
			}
			
			// Get Noticia ID
			$ID = $noticia->getCNTID();
			
			
			if(!empty($edts[0]))
			{
				// Update Editorial Relations
				$this->updateEdtsRelations($ID, $edts, "GA");
			}
			if(!empty($tags[0]))
			{
				// Update Tags Relations
				$this->updateTagsRelations($ID, $tags);
			}
			if(!empty($imgsRel))
			{
				$this->updateGalsRelations($ID, $imgsRel);
			}
			/*
			if(!empty($links[0]))
			{
				// Update Links Relations
				$this->updateLinksRelations($ID, $links);
			}
			*/
			// Save Image Relation
			if(!empty($imgNews))
			{
				$this->updateImageRelation($ID, $imgNews, self::THUMB_TYPE);
			}
			
			$this->createFeatureds($this->content);
			
			
			$noticia->generateJSON();
			$noticia->generateJsonLists();
			
		}
		
		if($newsID != null)
		{
			$this->breadCrumb["/gallery/new.php"] = "{Edit Gallery}";
			$this->pageTitle = "{Edit Gallery}";
			$content = GaleriaModel::getOne(addslashes($newsID));
			$this->content = $content[0];

			
		} else {
			$this->breadCrumb["/gallery/new.php"] = "{Add Gallery}";
			
			$this->content = new Galeria();
			$this->content->CNT_SIT  = $this->Site->getPDTID();
			$this->content->CNT_IPR  = $this->EditorialID;
			$this->content->CNT_TIP = "GA";
			$this->content->CNT_STS = 9;
			$this->content->CNT_DTA = date("Y-m-d H:i:s");
			$this->content->save();
			$this->content->CNT_STS = 0;
		}
		$this->action = $this->Editorial->getURL()."gallery/edit.php?ID=".($this->content->getCNTID());
	}
	public function delete($vars = null)
	{
		$this->setTemplate("delete", "default");
		$this->pageTitle = "{Delete Gallery}";
		$this->breadCrumb = array("/gallery/index.php" => "{Gallery}");
		if(!empty($_GET["ID"]))
		{
			$content = GaleriaModel::getOne(addslashes($_GET["ID"]));
			$this->content = $content[0];
			if($this->content->delete())
			{
				$this->DeleteOk = true;
			}
		} else {
			$this->Error404();
		}
	}
	private function updateGalsRelations($ID, $imgsRel)
	{
		
		$oldThumbRelations = ArquivoconteudoModel::getContentRelations($ID, "GA_IMG");
		if(!empty($oldThumbRelations[0]))
		{
			foreach($oldThumbRelations as $relation)
			{
				$relation->unpublished();
			}
		}
		foreach($imgsRel["IMG_ID"] as $key => $IMG_ID)
		{
			$relation = new Arquivoconteudo();
			$relation->ARC_ORD = $key;
			$relation->ARC_AID = $IMG_ID;
			$relation->ARC_CID = $ID;
			$relation->ARC_CTP = "GA_IMG";
			$relation->ARC_TIT = $imgsRel["IMG_TIT"][$key];
			$relation->ARC_TXT = $imgsRel["IMG_TXT"][$key];
			$relation->ARC_STS = 1;
			$relation->save();
		}
	}
}
?>