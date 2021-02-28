<?php
	class VideosController extends DefaultBackEnd2Controller
	{
		const THUMB_TYPE = "THB_CNT";
		public $moduleName = "Videos";
		public $moduleDir = "videos";
		public function index($vars = null)
		{
			$this->pageTitle = "{List Videos}";

			$this->breadCrumb = array("videos/index.php" => "{Videos}");

			$criteria = new FuriousSelectCriteria();
			$criteria->add("`cnt_conteudo`.`CNT_TIP`", "VD", FuriousExpressionsDB::EQUAL);
			$criteria->add("`cnt_conteudo`.`CNT_STS`", 9, FuriousExpressionsDB::NOT_EQUAL);
			$criteria->add("`cnt_conteudo`.`CNT_STS`", 8, FuriousExpressionsDB::NOT_EQUAL);
			$criteria->add("`cnt_conteudo`.`CNT_IPR`", $this->Site->getPDTID(), FuriousExpressionsDB::EQUAL);
			$criteria->addDescendingOrder("`cnt_conteudo`.`CNT_DTA`");


			$this->applyFilters($criteria, "`cnt_conteudo`.`CNT_STS`", "`cnt_conteudo`.`CNT_TIT`");


			$this->doPagination("VideoModel", "itens", $criteria, $vars);
		}
		public function novo($vars = null)
		{
			$this->pageTitle = "{Add Video}";
			$this->breadCrumb = array("videos/index.php" => "{Videos}");

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
				$this->breadCrumb["/videos/new.php"] = "{Edit Video}";
				$this->pageTitle = "{Edit News}";
				$content = VideoModel::getOne(addslashes($newsID));
				$this->content = $content[0];


			} else {
				$this->breadCrumb["/videos/new.php"] = "{Add Video}";

				$this->content = new Video();
				$this->content->CNT_SIT  = $this->Site->getPDTID();
				$this->content->CNT_IPR  = $this->Site->getPDTID();
				$this->content->CNT_TIP = "VD";
				$this->content->CNT_STS = 8;
				$this->content->CNT_DTA = date("Y-m-d H:i:s");
				var_dump($this->content->save());
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

				// Save Featured
				$this->createFeatureds($this->content);

				//$this->content->generateJSON();
				//$this->content->generateJsonLists();

			}


			$this->action = $this->Editorial->getURL()."videos/edit.php?ID=".($this->content->getCNTID());
		}
		public function delete($vars = null)
		{
			$this->setTemplate("delete", "default");

			$this->pageTitle = "{Delete Video}";
			$this->breadCrumb = array("videos/index.php" => "{Videos}");
			if(!empty($_GET["ID"]))
			{
				$content = VideoModel::getOne(addslashes($_GET["ID"]));
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
