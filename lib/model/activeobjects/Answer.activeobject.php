<?php
	class Answer extends Conteudo {
		protected $activeModel = "AnswerModel";
		protected $FID = "CNT_ID";


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
			// // Tags
			// if(empty($this->tags[0]))
			// {
			// 	$this->getTags();
			// }
			//
			// if(!empty($this->tags[0]))
			// {
			// 	$site = ProdutoModel::getOne(Dispatcher::getEditorialID());
			// 	$site = $site[0];
			// 	$site = $site->getSite();
			//
			// 	$siteID = $site->getPDTID();
			//
			// 	foreach($this->tags as $tag)
			// 	{
			// 		$criteria = new FuriousSelectCriteria();
			// 		$criteria->addJoin(FuriousExpressionsDB::LEFT_JOIN, "cnt_conteudo_tag", "`cnt_conteudo_tag`.`CTA_CNT`", "`cnt_conteudo`.`CNT_ID`");
			// 		$criteria->add("`cnt_conteudo_tag`.`CTA_TAG`", $tag->getTAGID(), FuriousExpressionsDB::EQUAL);
			// 		$criteria->add("`cnt_conteudo_tag`.`CTA_STS`", 1, FuriousExpressionsDB::EQUAL);
			// 		$criteria->add("`cnt_conteudo`.`CNT_IPR`", $this->getCNTIPR(), FuriousExpressionsDB::EQUAL);
			// 		$criteria->add("`cnt_conteudo`.`CNT_TIP`", "FQ", FuriousExpressionsDB::EQUAL);
			// 		$criteria->add("`cnt_conteudo`.`CNT_STS`", 1, FuriousExpressionsDB::EQUAL);
			// 		//$criteria->add("`cnt_conteudo`.`CNT_DTA`", date("Y-m-d H:i:s"), FuriousExpressionsDB::MINOR_EQUAL);
			// 		$criteria->addDescendingOrder("`cnt_conteudo`.`CNT_DTA`");
			// 		$criteria->setLimit(1000);
			// 		$news = AnswerModel::doSelect($criteria);
			//
			// 		if(!empty($news[0])):
			// 			$tagStd = $tag->toJSON();
			//
			// 			$newsArr = array();
			// 			foreach($news as $article):
			// 				$newsArr[] = $article->toJSONLimited();
			// 			endforeach;
			//
			// 			$tagStd->news = $newsArr;
			//
			// 			$id = $tag->getTAGID();
			//
			//
			// 			if(!Document::hasFile(APP_PATH_PREFIX."web/json/".substr("0000".$id,-4,-2)))
			// 			{
			// 				Document::createDirectory(substr("0000".$id,-4,-2), "json/");
			// 			}
			// 			if(!Document::hasFile("json/".substr("0000".$id,-4,-2)."/".substr("00".$id,-2)))
			// 			{
			// 				Document::createDirectory(substr("00".$id,-2), "json/".substr("0000".$id,-4,-2));
			// 			}
			// 			if(Document::hasFile("json/".substr("0000".$id,-4,-2)."/".substr("00".$id,-2)))
			// 			{
			// 					Document::writeFile("json/".substr("0000".$id,-4,-2)."/".substr("00".$id,-2)."/TAG_{$siteID}_".($id)."_FQ.json", json_encode($tagStd));
			// 			}
			//
			//
			//
			// 		endif;
			// 	}
			// }
		}
		public function genereateEditorialListFile($edts, $siteID)
		{
			// if($edts->hasParent())
			// {
			// 	$parent = $edts->getParent();
			// 	$this->genereateEditorialListFile($parent, $siteID);
			// }
			//
			//
			// $ids = ("(\"" . join("\", \"",  array_keys($edts->renderChildrenIDSQuery())) . "\")");
			//
			// $t = $edts->toJSON();
			//
			// $criteria = new FuriousSelectCriteria();
			// $criteria->addJoin(FuriousExpressionsDB::LEFT_JOIN, "`cnt_categorias_conteudos`", "`cnt_categorias_conteudos`.`CCL_CNT`", "`cnt_conteudo`.`CNT_ID`");
			// $criteria->add("`cnt_categorias_conteudos`.`CCL_TIP`", "FQ", FuriousExpressionsDB::EQUAL);
			// $criteria->add("`cnt_categorias_conteudos`.`CCL_CAT`", $ids, FuriousExpressionsDB::IN);
			// $criteria->add("`cnt_categorias_conteudos`.`CCL_STS`", 1, FuriousExpressionsDB::EQUAL);
			// $criteria->add("`cnt_conteudo`.`CNT_SIT`", $siteID, FuriousExpressionsDB::EQUAL);
			// $criteria->add("`cnt_conteudo`.`CNT_STS`", 1, FuriousExpressionsDB::EQUAL);
			// //$criteria->add("`cnt_conteudo`.`CNT_DTA`", date("Y-m-d H:i:s"), FuriousExpressionsDB::MINOR_EQUAL);
			// $criteria->addDescendingOrder("`cnt_conteudo`.`CNT_DTA`");
			// $criteria->addGroupBy("`cnt_conteudo`.`CNT_ID`");
			// $criteria->setLimit(1000);
			// $news = AnswerModel::doSelect($criteria);
			//
			// $t->news = array();
			// if(!empty($news[0]))
			// {
			// 	foreach($news as $article)
			// 	{
			// 		$t->news[] = $article->toJSONLimited();
			// 	}
			//
			// }
			// $id = $edts->getCATID();
			//
			// if(!Document::hasFile(APP_PATH_PREFIX."web/json/".substr("0000".$id,-4,-2)))
			// {
			// 	Document::createDirectory(substr("0000".$id,-4,-2), "json/");
			// }
			// if(!Document::hasFile("json/".substr("0000".$id,-4,-2)."/".substr("00".$id,-2)))
			// {
			// 	Document::createDirectory(substr("00".$id,-2), "json/".substr("0000".$id,-4,-2));
			// }
			// if(Document::hasFile("json/".substr("0000".$id,-4,-2)."/".substr("00".$id,-2)))
			// {
			// 	return Document::writeFile("json/".substr("0000".$id,-4,-2)."/".substr("00".$id,-2)."/CAT_{$siteID}_".($id)."_FQ.json", json_encode($t));
			// }
			// return false;
		}
		public function generateEditorialLists()
		{
			// if(empty($this->editorials[0]))
			// {
			// 	$this->getEditorials();
			// }
			//
			// if(!empty($this->editorials[0]))
			// {
			// 	$site = ProdutoModel::getOne($this->getCNTIPR());
			// 	if(!empty($site[0]))
			// 	{
			// 		$site = $site[0];
			// 		$site = $site->getSite();
			//
			// 		$siteID = $site->getPDTID();
			//
			//
			// 		foreach($this->editorials as $edts)
			// 		{
			// 			$this->genereateEditorialListFile($edts, $siteID);
			// 		}
			// 	}
			//
			// }
		}
		public function generateSiteList()
		{
			// $site = ProdutoModel::getOne(Dispatcher::getEditorialID());
			// $site = $site[0];
			// $site = $site->getSite();
			// $siteID = $site->getPDTID();
			//
			// $t = $site->toJSON();
			//
			// $criteria = new FuriousSelectCriteria();
			// $criteria->add("`cnt_conteudo`.`CNT_TIP`", "FQ", FuriousExpressionsDB::EQUAL);
			// $criteria->add("`cnt_conteudo`.`CNT_SIT`", $siteID, FuriousExpressionsDB::EQUAL);
			// $criteria->add("`cnt_conteudo`.`CNT_STS`", 1, FuriousExpressionsDB::EQUAL);
			// $criteria->add("`cnt_conteudo`.`CNT_DTA`", date("Y-m-d H:i:s"), FuriousExpressionsDB::MINOR_EQUAL);
			// $criteria->addDescendingOrder("`cnt_conteudo`.`CNT_DTA`");
			// $criteria->setLimit(1000);
			// $news = AnswerModel::doSelect($criteria);
			// $t->news = array();
			// if(!empty($news[0])):
			// 	foreach($news as $article)
			// 	{
			// 		$t->news[] = $article->toJSONLimited();
			// 	}
			// endif;
			// Document::writeFile("json/SITE_{$siteID}_FQ.json", json_encode($t));
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
			$fto = $this->getDTQFTO();
			if($fto != false)
			{
				$news->thb_fto = $fto->toJSON();
			}
			return $news;
		}
		public function toJSON()
		{
			$news = new StdClass();
			foreach($this->getProperties() as $prop => $value)
			{
				$news->$prop = utf8_encode($value);
			}
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
			// Comments
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
			// $news = $this->toJSON();
			// if(!Document::hasFile(APP_PATH_PREFIX."web/json/".substr("0000".$this->getCNTID(),-4,-2)))
			// {
			// 	Document::createDirectory(substr("0000".$this->getCNTID(),-4,-2), "json/");
			// }
			// if(!Document::hasFile("json/".substr("0000".$this->getCNTID(),-4,-2)."/".substr("00".$this->getCNTID(),-2)))
			// {
			// 	Document::createDirectory(substr("00".$this->getCNTID(),-2), "json/".substr("0000".$this->getCNTID(),-4,-2));
			// }
			// if(Document::hasFile("json/".substr("0000".$this->getCNTID(),-4,-2)."/".substr("00".$this->getCNTID(),-2)))
			// {
			// 	Document::writeFile("json/".substr("0000".$this->getCNTID(),-4,-2)."/".substr("00".$this->getCNTID(),-2)."/CNT_".($this->getCNTID()).".json", json_encode($news));
			// }
			// unset($news);
		}
	}
?>
