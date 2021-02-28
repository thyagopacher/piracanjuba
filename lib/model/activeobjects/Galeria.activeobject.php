<?php
class Galeria extends Conteudo
{
	protected $activeModel = "GaleriaModel";
	protected $FID = "CNT_ID";
	public $fotos = array();
	public function save()
	{
		$save = parent::save();

		unset($this->tags);
		unset($this->editorials);
		unset($this->editorials);

		return $save;
	}
	public function getFotos(){
		$criteria = new FuriousSelectCriteria();
		//$criteria->addJoin(FuriousExpressionsDB::LEFT_JOIN, "`cnt_arquivos_conteudo`", "`cnt_arquivos_conteudo`.`ARC_AID`", "`cnt_arquivos`.`ARQ_ID`");
		$criteria->add("`cnt_arquivos_conteudo`.`ARC_CID`", $this->getID(), FuriousExpressionsDB::EQUAL);
		$criteria->add("`cnt_arquivos_conteudo`.`ARC_CTP`", "GA_IMG", FuriousExpressionsDB::EQUAL);
		$criteria->add("`cnt_arquivos_conteudo`.`ARC_STS`", 1, FuriousExpressionsDB::EQUAL);
		$criteria->addAscendingOrder("`cnt_arquivos_conteudo`.`ARC_ORD`");

		$this->fotos = ArquivoconteudoModel::doSelect($criteria);

	}
	public function toJSON()
	{
		$news = new StdClass();
		$props = $this->getProperties();
		foreach($props as $prop => $value)
		{
			$news->$prop = utf8_encode($value);
		}

		// Fotos
		if(empty($this->fotos[0]))
		{
			$this->getFotos();
		}
		if(!empty($this->fotos[0]))
		{
			$news->fotos = array();
			foreach($this->fotos as $foto)
			{
				$lnk = new StdClass();
				$news->fotos[] = $foto->toJSON();
			}
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

		$others = $this->getRelatedContent();
		if(!empty($others))
		{
			$news->related = $others;
		}

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

		//$criteria->add("`cnt_categorias_conteudos`.`CCL_TIP`", "GA", FuriousExpressionsDB::EQUAL);
		$criteria->add("`cnt_categorias_conteudos`.`CCL_CAT`", $ids, FuriousExpressionsDB::IN);
		$criteria->add("`cnt_categorias_conteudos`.`CCL_STS`", 1, FuriousExpressionsDB::EQUAL);
		$criteria->add("`cnt_conteudo`.`CNT_SIT`", $siteID, FuriousExpressionsDB::EQUAL);
		$criteria->add("`cnt_conteudo`.`CNT_STS`", 1, FuriousExpressionsDB::EQUAL);
		$criteria->add("`cnt_conteudo`.`CNT_DTA`", date("Y-m-d H:i:s"), FuriousExpressionsDB::MINOR_EQUAL);
		$criteria->addDescendingOrder("`cnt_conteudo`.`CNT_DTA`");
		$criteria->setLimit(1000);
		$news = GaleriaModel::doSelect($criteria);

		$t->news = array();
		if(!empty($news[0]))
		{
			foreach($news as $article)
			{
				$t->news[] = $article->toJSON();
			}

		}
		$id = $edts->getCATID();

		$dir = Document::renderDirStructure($id, APP_JSON_PATH);
		if($dir != false)
		{
			return Document::writeFile($dir."CAT_{$siteID}_".($id)."_NT.json", json_encode($t));
		}

		return false;
	}
	public function generateSiteList()
	{
		$site = ProdutoModel::getOne(Dispatcher::getEditorialID());
		$site = $site[0];
		$site = $site->getSite();
		$siteID = $site->getPDTID();

		$t = $site->toJSON();

		$criteria = new FuriousSelectCriteria();
		//$criteria->add("`cnt_conteudo`.`CNT_TIP`", "GA", FuriousExpressionsDB::EQUAL);
		$criteria->add("`cnt_conteudo`.`CNT_SIT`", $siteID, FuriousExpressionsDB::EQUAL);
		$criteria->add("`cnt_conteudo`.`CNT_STS`", 1, FuriousExpressionsDB::EQUAL);
		$criteria->add("`cnt_conteudo`.`CNT_DTA`", date("Y-m-d H:i:s"), FuriousExpressionsDB::MINOR_EQUAL);
		$criteria->addDescendingOrder("`cnt_conteudo`.`CNT_DTA`");
		$criteria->setLimit(1000);
		$news = GaleriaModel::doSelect($criteria);
		$t->news = array();
		if(!empty($news[0]))
		{
			foreach($news as $article)
			{
				$t->news[] = $article->toJSON();
			}
		}

		Document::writeFile(APP_JSON_PATH."SITE_{$siteID}.json", json_encode($t));
		$this->generateSiteGaleryList();
	}
	public function generateSiteGaleryList()
	{
		$site = ProdutoModel::getOne(Dispatcher::getEditorialID());
		$site = $site[0];
		$site = $site->getSite();
		$siteID = $site->getPDTID();

		$t = $site->toJSON();

		$criteria = new FuriousSelectCriteria();
		$criteria->add("`cnt_conteudo`.`CNT_TIP`", "GA", FuriousExpressionsDB::EQUAL);
		$criteria->add("`cnt_conteudo`.`CNT_SIT`", $siteID, FuriousExpressionsDB::EQUAL);
		$criteria->add("`cnt_conteudo`.`CNT_STS`", 1, FuriousExpressionsDB::EQUAL);
		$criteria->add("`cnt_conteudo`.`CNT_DTA`", date("Y-m-d H:i:s"), FuriousExpressionsDB::MINOR_EQUAL);
		$criteria->addDescendingOrder("`cnt_conteudo`.`CNT_DTA`");
		$criteria->setLimit(1000);
		$news = GaleriaModel::doSelect($criteria);
		$t->news = array();
		if(!empty($news[0]))
		{
			foreach($news as $article)
			{
				$t->news[] = $article->toJSON();
			}
		}
		Document::writeFile(APP_JSON_PATH."SITE_{$siteID}_GA.json", json_encode($t));
	}
	public function generateJsonLists()
	{
		$this->generateTagsJsonList();
		$this->generateEditorialLists();
		$this->generateSiteList();
	}
	/*
	public function ()
	{
		$this->generateTagsJsonList();
		$this->generateEditorialLists();
		$this->generateSiteList();
	}*/

	public function generateJSON()
		{
			$news = $this->toJSON();
			if(!Document::hasFile(APP_PATH_PREFIX."web/json/".substr("0000".$this->getCNTID(),-4,-2)))
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
