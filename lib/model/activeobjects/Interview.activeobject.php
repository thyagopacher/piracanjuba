<?php
	class Interview extends Conteudo {
		protected $activeModel = "InterviewModel";
		protected $FID = "CNT_ID";
		public function getCNTEMB()
		{
			return $this->returnKey("CNT_EMB");
		}
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
		
		public function generateSiteList()
		{
			$site = ProdutoModel::getOne($this->getCNTIPR());
			$site = $site[0];
			$site = $site->getSite();
			$siteID = $site->getPDTID();
			
			$t = $site->toJSON();
			
			$criteria = new FuriousSelectCriteria();
			$criteria->add("`cnt_conteudo`.`CNT_TIP`", "IT", FuriousExpressionsDB::EQUAL);
			$criteria->add("`cnt_conteudo`.`CNT_SIT`", $siteID, FuriousExpressionsDB::EQUAL);
			$criteria->add("`cnt_conteudo`.`CNT_STS`", 1, FuriousExpressionsDB::EQUAL);
			$criteria->add("`cnt_conteudo`.`CNT_DTA`", date("Y-m-d H:i:s"), FuriousExpressionsDB::MINOR_EQUAL);
			$criteria->addDescendingOrder("`cnt_conteudo`.`CNT_DTA`");
			$criteria->setLimit(1000);
			$news = InterviewModel::doSelect($criteria);
			$t->news = array();
			if($news[0])
			{
				foreach($news as $article)
				{
					$t->news[] = $article->toJSONLimited();
				}
			}
			Document::writeFile("json/SITE_{$siteID}_IT.json", json_encode($t));
		}
		public function generateJsonLists()
		{
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
			if(!Document::hasFile(APP_PATH_PREFIX."web/json/".substr("0000".$this->getCNTID(),-4,-2)))
			{
				Document::createDirectory(substr("0000".$this->getCNTID(),-4,-2), "json/");
			}
			if(!Document::hasFile("json/".substr("0000".$this->getCNTID(),-4,-2)."/".substr("00".$this->getCNTID(),-2)))
			{
				Document::createDirectory(substr("00".$this->getCNTID(),-2), "json/".substr("0000".$this->getCNTID(),-4,-2));
			}
			if(Document::hasFile("json/".substr("0000".$this->getCNTID(),-4,-2)."/".substr("00".$this->getCNTID(),-2)))
			{
				Document::writeFile("json/".substr("0000".$this->getCNTID(),-4,-2)."/".substr("00".$this->getCNTID(),-2)."/CNT_".($this->getCNTID()).".json", json_encode($news));
			}
			unset($news);
		}
	}
?>