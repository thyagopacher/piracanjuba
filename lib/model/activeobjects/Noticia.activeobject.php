<?php
	class Noticia extends Conteudo {
		protected $activeModel = "NoticiaModel";
		protected $FID = "CNT_ID";


		public function getCNTEMB2()
		{
			return $this->returnKey("CNT_EMB2");
		}
		public function save()
		{
			// Save Content
			$save = parent::save();

			/*
			if($save)
			{
				$this->generateJSON();
				$this->generateJsonLists();
			}
			*/

			unset($this->tags);
			unset($this->editorials);
			unset($this->editorials);

			return $save;
		}
		public function generateTagsJsonList()
		{
			// Tags
			if(empty($this->tags[0]))
			{
				$this->getTags();
			}

			if(!empty($this->tags[0]))
			{
				$site = ProdutoModel::getOne($this->getCNTIPR());
				$site = $site[0];
				$site = $site->getSite();

				$siteID = $site->getPDTID();

				foreach($this->tags as $tag)
				{
					$criteria = new FuriousSelectCriteria();
					$criteria->addJoin(FuriousExpressionsDB::LEFT_JOIN, "cnt_conteudo_tag", "`cnt_conteudo_tag`.`CTA_CNT`", "`cnt_conteudo`.`CNT_ID`");
					$criteria->add("`cnt_conteudo_tag`.`CTA_TAG`", $tag->getTAGID(), FuriousExpressionsDB::EQUAL);
					$criteria->add("`cnt_conteudo_tag`.`CTA_STS`", 1, FuriousExpressionsDB::EQUAL);
					$criteria->add("`cnt_conteudo`.`CNT_IPR`", $this->getCNTIPR(), FuriousExpressionsDB::EQUAL);
					$criteria->add("`cnt_conteudo`.`CNT_TIP`", "FQ", FuriousExpressionsDB::NOT_EQUAL);
					$criteria->add("`cnt_conteudo`.`CNT_STS`", 1, FuriousExpressionsDB::EQUAL);
					//$criteria->add("`cnt_conteudo`.`CNT_DTA`", date("Y-m-d H:i:s"), FuriousExpressionsDB::MINOR_EQUAL);
					$criteria->addDescendingOrder("`cnt_conteudo`.`CNT_DTA`");
					$criteria->setLimit(1000);
					$news = NoticiaModel::doSelect($criteria);

					$tagStd = $tag->toJSON();
					$newsArr = array();
					if(!empty($news[0])):



						foreach($news as $article):
							$newsArr[] = $article->toJSONLimited();
						endforeach;
					endif;
					$tagStd->news = $newsArr;
					$id = $tag->getTAGID();


					if(!Document::hasFile(APP_JSON_PATH.substr("0000".$id,-4,-2)))
					{
						Document::createDirectory(substr("0000".$id,-4,-2), APP_JSON_PATH);
					}
					if(!Document::hasFile(APP_JSON_PATH.substr("0000".$id,-4,-2)."/".substr("00".$id,-2)))
					{
						Document::createDirectory(substr("00".$id,-2), APP_JSON_PATH.substr("0000".$id,-4,-2));
					}
					if(Document::hasFile(APP_JSON_PATH.substr("0000".$id,-4,-2)."/".substr("00".$id,-2)))
					{
							Document::writeFile(APP_JSON_PATH.substr("0000".$id,-4,-2)."/".substr("00".$id,-2)."/TAG_{$siteID}_".($id).".json", json_encode($tagStd));
					}

				}
			}
		}
		public function genereateEditorialListFile($edts, $siteID)
		{
			if($edts->hasParent())
			{
				$parent = $edts->getParent();
				$this->genereateEditorialListFile($parent, $siteID);
			}


			$ids = ("(\"" . join("\", \"",  array_keys($edts->renderChildrenIDSQuery())) . "\")");

			$t = $edts->toJSON();

			$criteria = new FuriousSelectCriteria();
			$criteria->addJoin(FuriousExpressionsDB::LEFT_JOIN, "`cnt_categorias_conteudos`", "`cnt_categorias_conteudos`.`CCL_CNT`", "`cnt_conteudo`.`CNT_ID`");
			//$criteria->add("`cnt_categorias_conteudos`.`CCL_TIP`", "NT", FuriousExpressionsDB::EQUAL);
			$criteria->add("`cnt_categorias_conteudos`.`CCL_CAT`", $ids, FuriousExpressionsDB::IN);
			$criteria->add("`cnt_categorias_conteudos`.`CCL_STS`", 1, FuriousExpressionsDB::EQUAL);
			$criteria->add("`cnt_conteudo`.`CNT_SIT`", $siteID, FuriousExpressionsDB::EQUAL);
			$criteria->add("`cnt_conteudo`.`CNT_STS`", 1, FuriousExpressionsDB::EQUAL);
			//$criteria->add("`cnt_conteudo`.`CNT_DTA`", date("Y-m-d H:i:s"), FuriousExpressionsDB::MINOR_EQUAL);
			$criteria->addDescendingOrder("`cnt_conteudo`.`CNT_DTA`");
			$criteria->addGroupBy("`cnt_conteudo`.`CNT_ID`");
			$criteria->setLimit(1000);
			$news = NoticiaModel::doSelect($criteria);

			$t->news = array();
			if(!empty($news[0]))
			{
				foreach($news as $article)
				{
					$t->news[] = $article->toJSONLimited();
				}

			}
			$id = $edts->getCATID();

			if(!Document::hasFile(APP_JSON_PATH.substr("0000".$id,-4,-2)))
			{
				Document::createDirectory(substr("0000".$id,-4,-2), APP_JSON_PATH);
			}
			if(!Document::hasFile(APP_JSON_PATH.substr("0000".$id,-4,-2)."/".substr("00".$id,-2)))
			{
				Document::createDirectory(substr("00".$id,-2), APP_JSON_PATH.substr("0000".$id,-4,-2));
			}
			if(Document::hasFile(APP_JSON_PATH.substr("0000".$id,-4,-2)."/".substr("00".$id,-2)))
			{
				return Document::writeFile(APP_JSON_PATH.substr("0000".$id,-4,-2)."/".substr("00".$id,-2)."/CAT_{$siteID}_".($id)."_NT.json", json_encode($t));
			}
			return false;
		}
		public function generateEditorialLists()
		{
			if(empty($this->editorials[0]))
			{
				$this->getEditorials();
			}

			if(!empty($this->editorials[0]))
			{
				$site = ProdutoModel::getOne($this->getCNTIPR());
				if(!empty($site[0]))
				{
					$site = $site[0];
					$site = $site->getSite();

					$siteID = $site->getPDTID();


					foreach($this->editorials as $edts)
					{
						$this->genereateEditorialListFile($edts, $siteID);
					}
				}

			}
		}
		public function generateSiteNewsList()
		{
			$site = ProdutoModel::getOne($this->getCNTIPR());
			$site = $site[0];
			$site = $site->getSite();
			$siteID = $site->getPDTID();

			$t = $site->toJSON();

			$criteria = new FuriousSelectCriteria();
			$criteria->add("`cnt_conteudo`.`CNT_TIP`", "NT", FuriousExpressionsDB::EQUAL);
			$criteria->add("`cnt_conteudo`.`CNT_SIT`", $siteID, FuriousExpressionsDB::EQUAL);
			$criteria->add("`cnt_conteudo`.`CNT_STS`", 1, FuriousExpressionsDB::EQUAL);
			$criteria->add("`cnt_conteudo`.`CNT_DTA`", date("Y-m-d H:i:s"), FuriousExpressionsDB::MINOR_EQUAL);
			$criteria->addDescendingOrder("`cnt_conteudo`.`CNT_DTA`");
			$criteria->setLimit(1000);
			$news = NoticiaModel::doSelect($criteria);
			$t->news = array();
			foreach($news as $article)
			{
				$t->news[] = $article->toJSONLimited();
			}
			Document::writeFile(APP_JSON_PATH."SITE_{$siteID}_NT.json", json_encode($t));
		}
		public function generateSiteList()
		{
			$site = ProdutoModel::getOne($this->getCNTIPR());
			$site = $site[0];
			$site = $site->getSite();
			$siteID = $site->getPDTID();

			$t = $site->toJSON();

			$criteria = new FuriousSelectCriteria();
			//$criteria->add("`cnt_conteudo`.`CNT_TIP`", "NT", FuriousExpressionsDB::EQUAL);
			$criteria->add("`cnt_conteudo`.`CNT_SIT`", $siteID, FuriousExpressionsDB::EQUAL);
			$criteria->add("`cnt_conteudo`.`CNT_STS`", 1, FuriousExpressionsDB::EQUAL);
			$criteria->add("`cnt_conteudo`.`CNT_DTA`", date("Y-m-d H:i:s"), FuriousExpressionsDB::MINOR_EQUAL);
			$criteria->addDescendingOrder("`cnt_conteudo`.`CNT_DTA`");
			$criteria->setLimit(1000);
			$news = NoticiaModel::doSelect($criteria);
			$t->news = array();
			foreach($news as $article)
			{
				$t->news[] = $article->toJSONLimited();
			}
			Document::writeFile(APP_JSON_PATH."SITE_{$siteID}.json", json_encode($t));
			$this->generateSiteNewsList();
		}
		public function generateJsonLists()
		{
			$this->generateTagsJsonList();
			$this->generateEditorialLists();
			$this->generateSiteList();
		}
		public function toJSONLimited()
		{
			$news = new StdClass();
			foreach($this->getProperties() as $prop => $value)
			{
				$news->$prop = utf8_encode($value);
			}
			$news->URL = $this->getURL();
			$fto = $this->getDTQFTO();
			if($fto != false)
			{
				$news->thb_fto = $fto->toJSON();
			}
			// Tags
			if(empty($this->tags[0]))
			{
				$this->getTags();
			}
			if(!empty($this->tags[0]))
			{
				$news->tags = array();
				foreach($this->tags as $tag)
				{
					$t = new StdClass();
					foreach($tag->getProperties() as $prop => $value)
					{
						$t->$prop = utf8_encode($value);
					}
					$news->tags[] = $t;
				}
			}
			$ftoEmb1 = $this->getDTQFTO("THB_EMB1");
			if($ftoEmb1 != false)
			{
				$news->fto_emb1 = $ftoEmb1->toJSON();
			}
			$ftoEmb2 = $this->getDTQFTO("THB_EMB2");
			if($ftoEmb2 != false)
			{
				$news->fto_emb2 = $ftoEmb2->toJSON();
			}

			$news->totComments = $this->getApprovedComments();
			return $news;
		}
		public function toJSON()
		{
			$news = new StdClass();
			foreach($this->getProperties() as $prop => $value)
			{
				$news->$prop = utf8_encode($value);
			}
			$news->URL = $this->getURL();

			// Links
			if(empty($this->links[0]))
			{
				$this->getLinks();
			}
			if(!empty($this->links[0]))
			{
				$news->links = array();
				foreach($this->links as $link)
				{
					$lnk = new StdClass();
					foreach($link->getProperties() as $prop => $value)
					{
						$lnk->$prop = utf8_encode($value);
					}
					$news->links[] = $lnk;
				}
			}
			// Related Content
			$others = $this->getRelatedContent();
			if(!empty($others))
			{
				$news->related = $others;
			}


			// Tags
			if(empty($this->tags[0]))
			{
				$this->getTags();
			}
			if(!empty($this->tags[0]))
			{
				$news->tags = array();
				foreach($this->tags as $tag)
				{
					$t = new StdClass();
					foreach($tag->getProperties() as $prop => $value)
					{
						$t->$prop = utf8_encode($value);
					}
					$news->tags[] = $t;
				}
			}
			// Categorias
			if(empty($this->editorials[0]))
			{
				$this->getEditorials();
			}
			if(!empty($this->editorials[0]))
			{
				$news->editorials = array();
				foreach($this->editorials as $edts)
				{
					$t = new StdClass();
					foreach($edts->getProperties() as $prop => $value)
					{
						$t->$prop = utf8_encode($value);
					}
					$news->editorials[] = $t;
				}
			}
			// Foto
			$fto = $this->getDTQFTO();
			if($fto != false)
			{
				$news->thb_fto = $fto->toJSON();
			}

			$ftoEmb1 = $this->getDTQFTO("THB_EMB1");
			if($ftoEmb1 != false)
			{
				$news->fto_emb1 = $ftoEmb1->toJSON();
			}
			$ftoEmb2 = $this->getDTQFTO("THB_EMB2");
			if($ftoEmb2 != false)
			{
				$news->fto_emb2 = $ftoEmb2->toJSON();
			}
			// Comments
			$news->totComments = $this->getApprovedComments();

			$comments = $this->getComments();
			$news->comments = array();
			if(!empty($comments[0]))
			{
				foreach($comments as $comment)
				{
					$news->comments[] = $comment->toJSON();
				}
			}


			return $news;
		}
		public function generateJSON()
		{
			$news = $this->toJSON();
			if(!Document::hasFile(APP_JSON_PATH.substr("0000".$this->getCNTID(),-4,-2)))
			{
				Document::createDirectory(substr("0000".$this->getCNTID(),-4,-2), APP_JSON_PATH);
			}
			if(!Document::hasFile(APP_JSON_PATH.substr("0000".$this->getCNTID(),-4,-2)."/".substr("00".$this->getCNTID(),-2)))
			{
				Document::createDirectory(substr("00".$this->getCNTID(),-2), APP_JSON_PATH.substr("0000".$this->getCNTID(),-4,-2));
			}
			if(Document::hasFile(APP_JSON_PATH.substr("0000".$this->getCNTID(),-4,-2)."/".substr("00".$this->getCNTID(),-2)))
			{
				Document::writeFile(APP_JSON_PATH.substr("0000".$this->getCNTID(),-4,-2)."/".substr("00".$this->getCNTID(),-2)."/CNT_".($this->getCNTID()).".json", json_encode($news));
			}
			unset($news);
		}
	}
?>