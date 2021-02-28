<?php
	class ForumController extends DefaultBackEnd2Controller
	{
		const THUMB_TYPE = "THB_CNT";
		public $moduleName = "{Forum}";
		public $moduleDir = "forum";
		public function index($vars = null)
		{
			$this->pageTitle = "{List Forum}";

			$this->breadCrumb = array("/{$this->moduleDir}/index.php" => "{$this->moduleName}");

			$criteria = new FuriousSelectCriteria();
			$criteria->add("`cnt_conteudo`.`CNT_TIP`", "TP", FuriousExpressionsDB::EQUAL);
			$criteria->add("`cnt_conteudo`.`CNT_STS`", 9, FuriousExpressionsDB::NOT_EQUAL);
			$criteria->add("`cnt_conteudo`.`CNT_STS`", 8, FuriousExpressionsDB::NOT_EQUAL);
			$criteria->add("`cnt_conteudo`.`CNT_IPR`", $this->Site->getPDTID(), FuriousExpressionsDB::EQUAL);
			$criteria->addDescendingOrder("`cnt_conteudo`.`CNT_DTA`");


			$this->applyFilters($criteria, "`cnt_conteudo`.`CNT_STS`", "`cnt_conteudo`.`CNT_TIT`");


			$this->doPagination("TopicsModel", "itens", $criteria, $vars);
		}
		public function novo($vars = null)
		{
			$this->pageTitle = "{Add {$this->moduleName}}";
			$this->breadCrumb = array("/{$this->moduleDir}/index.php" => "{$this->moduleName}");

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
				$this->breadCrumb["/{$this->moduleDir}/new.php"] = "{Edit $this->moduleName}";
				$this->pageTitle = "{Edit {$this->moduleName}}";
				$content = TopicsModel::getOne(addslashes($newsID));
				$this->content = $content[0];


			} else {
				$this->breadCrumb["/{$this->moduleDir}/new.php"] = "{Add $this->moduleName}";

				$this->content = new Topics();
				$this->content->CNT_SIT  = $this->Site->getPDTID();
				$this->content->CNT_IPR  = $this->Site->getPDTID();
				$this->content->CNT_TIP = "TP";
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
				$imgNews = "";

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
				if(!empty($values["CNT_LINK"]))
				{
					$links = $values["CNT_LINK"];
					unset($values["CNT_LINK"]);
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
					$this->Message = "{{$this->moduleName} Saved}";
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

				// Save Featured
				$this->createFeatureds($this->content);

				//$this->content->generateJSON();
				//$this->content->generateJsonLists();

			}


			$this->action = str_replace("//", "/", $this->Editorial->getURL()."/{$this->moduleDir}/edit.php?ID=".($this->content->getCNTID()));
		}
		public function delete($vars = null)
		{
			$this->setTemplate("delete", "default");

			$this->pageTitle = "{Delete {$this->moduleName}}";
			$this->breadCrumb = array("/{$this->moduleDir}/index.php" => "{$this->moduleName}");
			if(!empty($_GET["ID"]))
			{
				$content = TopicsModel::getOne(addslashes($_GET["ID"]));
				$this->content = $content[0];
				if($this->content->delete())
				{
					$this->DeleteOk = true;
					//$this->content->generateJsonLists();
				}
			} else {
				$this->Error404();
			}
		}
	}
?>
