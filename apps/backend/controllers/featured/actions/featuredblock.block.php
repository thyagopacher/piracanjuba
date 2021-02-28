<?php
class FeaturedBlock extends DefaultBlock
{
	static $site;
	/*

	public function index($params = null)
	{
		$this->EditorialID = $params["EditorialID"];


		$editorial = ProdutoModel::getOne($this->EditorialID);
		$editorial = $editorial[0];
		if(empty(self::$site) )
		{
			self::$site = $editorial->getSite();
		}
		$this->user = Dispatcher::getUserSession();
		$this->siteSel = self::$site;
		$this->module = $params['MODULE'];




		// User can Create News?
		$criteria = new FuriousSelectCriteria();
		$criteria->addJoin(FuriousExpressionsDB::LEFT_JOIN, "`w11_produto_menu_grupo`", "`w11_produto_menu_grupo`.`MSC_IMN`", "`w11_produto_menu`.`MNU_ID`");
		$criteria->add("`w11_produto_menu_grupo`.`MSC_IGR`", ((int)$this->user->getUSUGRP()), FuriousExpressionsDB::EQUAL);
		$criteria->add("`w11_produto_menu`.`MNU_IPR`", $this->siteSel->getPDTID(), FuriousExpressionsDB::EQUAL);
		$criteria->add("`w11_produto_menu`.`MNU_STS`", 1, FuriousExpressionsDB::EQUAL);
		$criteria->add("`w11_produto_menu`.`MNU_TIP`", "news/index", FuriousExpressionsDB::EQUAL);
		$criteria->addAscendingOrder("`w11_produto_menu`.`MNU_GRP`");
		$criteria->addAscendingOrder("`w11_produto_menu`.`MNU_ORD`");
		$criteria->addGroupBy("`w11_produto_menu`.`MNU_ID`");

		$contentItens = ProdutomenuModel::doSelect($criteria);
		if(!empty($contentItens[0]))
		{
			$this->contentItens = $contentItens[0];
		}

		// Get Featured
		$criteria = new FuriousSelectCriteria();
		$criteria->add("`w11_produto_menu`.`MNU_IPR`", $this->EditorialID, FuriousExpressionsDB::EQUAL);
		$criteria->add("`w11_produto_menu`.`MNU_TIP`", $this->module."/index",FuriousExpressionsDB::EQUAL);
		$criteria->add("`w11_produto_menu`.`MNU_STS`", 1,FuriousExpressionsDB::EQUAL);
		$itens = ProdutomenuModel::doSelect($criteria);
		var_dump("".$criteria);
		if(!empty($itens[0]))
		{
			$this->itens = $itens[0];
		}
		// Scheduled Content
		if(!empty($this->itens))
		{
			$criteria = new FuriousSelectCriteria();
			$criteria->add("`cnt_destaques`.`DTQ_EDT`", $this->itens->getMNUIPR(), FuriousExpressionsDB::EQUAL);
			$criteria->add("`cnt_destaques`.`DTQ_TIP`", $this->module, FuriousExpressionsDB::EQUAL);
			$criteria->add("`cnt_destaques`.`DTQ_STS`", "1", FuriousExpressionsDB::EQUAL);
			$criteria->add("`cnt_destaques`.`DTQ_INI`", date("Y-m-d H:i:s"), FuriousExpressionsDB::GREATER_THAN);
			$schedule = DestaquesModel::doSelect($criteria);
			if(!empty($schedule[0]))
			{
				$this->schedule = $schedule;
			}
		}
	}
	*/
	public function index($params = null)
	{
		$this->EditorialID = $params["EditorialID"];


		$editorial = ProdutoModel::getOne($this->EditorialID);
		$editorial = $editorial[0];
		if(empty(self::$site) )
		{
			self::$site = $editorial->getSite();
		}
		$this->user = Dispatcher::getUserSession();
		$this->siteSel = self::$site;
		$this->module = $params['MODULE'];

		if(!empty($params['MENU']))
		{

			// Menu
		 	$this->itens = $params['MENU'];

			// Schedule
			$criteria = new FuriousSelectCriteria();
			$criteria->add("`cnt_destaques`.`DTQ_EDT`", $this->itens->getMNUIPR(), FuriousExpressionsDB::EQUAL);
			$criteria->add("`cnt_destaques`.`DTQ_TIP`", $this->module, FuriousExpressionsDB::EQUAL);
			$criteria->add("`cnt_destaques`.`DTQ_STS`", "1", FuriousExpressionsDB::EQUAL);
			$criteria->add("`cnt_destaques`.`DTQ_INI`", date("Y-m-d H:i:s"), FuriousExpressionsDB::GREATER_THAN);
			$schedule = DestaquesModel::doSelect($criteria);
			if(!empty($schedule[0]))
			{
				$this->schedule = $schedule;
			}

			// User can Create News?
			$criteria = new FuriousSelectCriteria();
			$criteria->addJoin(FuriousExpressionsDB::LEFT_JOIN, "`w11_produto_menu_grupo`", "`w11_produto_menu_grupo`.`MSC_IMN`", "`w11_produto_menu`.`MNU_ID`");
			$criteria->add("`w11_produto_menu_grupo`.`MSC_IGR`", ((int)$this->user->getUSUGRP()), FuriousExpressionsDB::EQUAL);
			$criteria->add("`w11_produto_menu`.`MNU_IPR`", $this->siteSel->getPDTID(), FuriousExpressionsDB::EQUAL);
			$criteria->add("`w11_produto_menu`.`MNU_STS`", 1, FuriousExpressionsDB::EQUAL);
			$criteria->add("`w11_produto_menu`.`MNU_TIP`", "news/index", FuriousExpressionsDB::EQUAL);
			$criteria->addAscendingOrder("`w11_produto_menu`.`MNU_GRP`");
			$criteria->addAscendingOrder("`w11_produto_menu`.`MNU_ORD`");
			$criteria->addGroupBy("`w11_produto_menu`.`MNU_ID`");

			$contentItens = ProdutomenuModel::doSelect($criteria);
			if(!empty($contentItens[0]))
			{
				$this->contentItens = $contentItens[0];
			}

		}


	}
}
?>