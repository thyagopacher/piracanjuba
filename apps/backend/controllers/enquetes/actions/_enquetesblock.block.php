<?php
class EnquetesBlock extends DefaultBlock
{
	static $site;
	public function index($params = null)
	{
		/*$this->EditorialID = $params["EditorialID"];
		
		$editorial = MenuModel::getOne($this->EditorialID);
		$editorial = $editorial[0];*/
		if(empty(self::$site))
		{
			self::$site = $editorial->getSite();
		}
		
		$this->siteSel = self::$site;
		
		$this->menu = $params["MENU"];
	}
	public function nowContent($params = null)
	{
		$this->siteSel = self::$site;
		$this->user = Dispatcher::getUserSession();
		
		/*
		$criteria = new FuriousSelectCriteria();
		$criteria->addJoin(FuriousExpressionsDB::LEFT_JOIN, "`w11_produto_menu_grupo`", "`w11_produto_menu_grupo`.`MSC_IMN`", "`w11_produto_menu`.`MNU_ID`");
		$criteria->add("`w11_produto_menu_grupo`.`MSC_IGR`", ((int)$this->user->getUSUGRP()), FuriousExpressionsDB::EQUAL);
		$criteria->add("`w11_produto_menu`.`MNU_IPR`", $this->siteSel->getPDTID(), FuriousExpressionsDB::EQUAL);
		$criteria->add("`w11_produto_menu`.`MNU_STS`", 1, FuriousExpressionsDB::EQUAL);
		$criteria->addComplexFilter("`w11_produto_menu`.`MNU_TIP`", "gallery/index", FuriousExpressionsDB::EQUAL, "`w11_produto_menu`.`MNU_TIP`", "news/index", FuriousExpressionsDB::EQUAL, FuriousExpressionsDB::SQL_OR);
		$criteria->addAscendingOrder("`w11_produto_menu`.`MNU_GRP`");
		$criteria->addAscendingOrder("`w11_produto_menu`.`MNU_ORD`");
		$criteria->addGroupBy("`w11_produto_menu`.`MNU_ID`");
		
		$contentItens = ProdutomenuModel::doSelect($criteria);
		if(!empty($contentItens[0]))
		{
			$this->contentItens = array();
			foreach($contentItens as $item)
			{
				$this->contentItens[$item->getMNUTIP()] = $item;
			}
		}
		*/
		
		$criteria = new FuriousSelectCriteria();
		$criteria->add("`enquetes`.`status`", "1", FuriousExpressionsDB::EQUAL);
		
		$this->news = EnqueteModel::doCount($criteria);
		
	}
	public function notPublished($params = null)
	{
		$this->siteSel = self::$site;
		$this->user = Dispatcher::getUserSession();
		
		$criteria = new FuriousSelectCriteria();
		$criteria->add("`enquetes`.`status`", "0", FuriousExpressionsDB::EQUAL);
		$criteria->setLimit(10);
		$this->itens = EnqueteModel::doSelect($criteria);
	}
	/*
	public function relatedFiles($vars = null)
	{
		$this->initVars($vars);
		
		$criteria = new FuriousSelectCriteria();
		$criteria->add("`cnt_arquivos_conteudo`.`ARC_CID`", $this->content->getID(), FuriousExpressionsDB::EQUAL);
		$criteria->add("`cnt_arquivos_conteudo`.`ARC_CTP`", "REL_FILE", FuriousExpressionsDB::EQUAL);
		$criteria->add("`cnt_arquivos_conteudo`.`ARC_STS`", 1, FuriousExpressionsDB::EQUAL);
		$this->itens = ArquivoconteudoModel::doSelect($criteria);
	}*/
}
?>