<?php
class dicasnutricaoBlock extends DefaultBlock
{
	static $site;
	public function nowContent($params = null)
	{
		$this->siteSel = self::$site;
		$this->user = Dispatcher::getUserSession();


		$criteria = new FuriousSelectCriteria();
		$criteria->addJoin(FuriousExpressionsDB::LEFT_JOIN, "`w11_produto_menu_grupo`", "`w11_produto_menu_grupo`.`MSC_IMN`", "`w11_produto_menu`.`MNU_ID`");
		$criteria->add("`w11_produto_menu_grupo`.`MSC_IGR`", ((int)$this->user->getUSUGRP()), FuriousExpressionsDB::EQUAL);
		$criteria->add("`w11_produto_menu`.`MNU_IPR`", $this->siteSel->getPDTID(), FuriousExpressionsDB::EQUAL);
		$criteria->add("`w11_produto_menu`.`MNU_STS`", 1, FuriousExpressionsDB::EQUAL);
		$criteria->addComplexFilter("`w11_produto_menu`.`MNU_TIP`", "gallery/index", FuriousExpressionsDB::EQUAL, "`w11_produto_menu`.`MNU_TIP`", "receitas/index", FuriousExpressionsDB::EQUAL, FuriousExpressionsDB::SQL_OR);
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


		$criteria = new FuriousSelectCriteria();
		$criteria->add("`cnt_conteudo`.`CNT_IPR`", $this->siteSel->getPDTID(), FuriousExpressionsDB::EQUAL);
		$criteria->add("`cnt_conteudo`.`CNT_TIP`", "NT", FuriousExpressionsDB::EQUAL);
		$criteria->add("`cnt_conteudo`.`CNT_STS`", "1", FuriousExpressionsDB::EQUAL);

		$this->news = ConteudoModel::doCount($criteria);

		$criteria = new FuriousSelectCriteria();
		$criteria->add("`cnt_conteudo`.`CNT_IPR`", $this->siteSel->getPDTID(), FuriousExpressionsDB::EQUAL);
		$criteria->add("`cnt_conteudo`.`CNT_TIP`", "GA", FuriousExpressionsDB::EQUAL);
		$criteria->add("`cnt_conteudo`.`CNT_STS`", "1", FuriousExpressionsDB::EQUAL);

		$this->galeries = ConteudoModel::doCount($criteria);

		$criteria = new FuriousSelectCriteria();
		$criteria->add("`cnt_conteudo`.`CNT_IPR`", $this->siteSel->getPDTID(), FuriousExpressionsDB::EQUAL);
		$criteria->add("`cnt_conteudo`.`CNT_TIP`", "PO", FuriousExpressionsDB::EQUAL);
		$criteria->add("`cnt_conteudo`.`CNT_STS`", "1", FuriousExpressionsDB::EQUAL);

		$this->polls = ConteudoModel::doCount($criteria);

		$criteria = new FuriousSelectCriteria();
		$criteria->add("`cnt_conteudo_msg`.`MSG_IPR`", $this->siteSel->getPDTID(), FuriousExpressionsDB::EQUAL);
		$criteria->add("`cnt_conteudo_msg`.`MSG_CNT`", 19480, FuriousExpressionsDB::NOT_EQUAL);
		$this->allComments = MensagensModel::doCount($criteria);

		$criteria = new FuriousSelectCriteria();
		$criteria->add("`cnt_conteudo_msg`.`MSG_IPR`", $this->siteSel->getPDTID(), FuriousExpressionsDB::EQUAL);
		$criteria->add("`cnt_conteudo_msg`.`MSG_CNT`", 19480, FuriousExpressionsDB::NOT_EQUAL);
		$criteria->add("`cnt_conteudo_msg`.`MSG_STS`", "1", FuriousExpressionsDB::EQUAL);
		$this->approvedComments = MensagensModel::doCount($criteria);

		$criteria = new FuriousSelectCriteria();
		$criteria->add("`cnt_conteudo_msg`.`MSG_IPR`", $this->siteSel->getPDTID(), FuriousExpressionsDB::EQUAL);
		$criteria->add("`cnt_conteudo_msg`.`MSG_CNT`", 19480, FuriousExpressionsDB::NOT_EQUAL);
		$criteria->add("`cnt_conteudo_msg`.`MSG_STS`", "9", FuriousExpressionsDB::EQUAL);
		$this->excludedComments = MensagensModel::doCount($criteria);

		$criteria = new FuriousSelectCriteria();
		$criteria->add("`cnt_conteudo_msg`.`MSG_IPR`", $this->siteSel->getPDTID(), FuriousExpressionsDB::EQUAL);
		$criteria->add("`cnt_conteudo_msg`.`MSG_CNT`", 19480, FuriousExpressionsDB::NOT_EQUAL);
		$criteria->add("`cnt_conteudo_msg`.`MSG_STS`", "0", FuriousExpressionsDB::EQUAL);
		$this->penddantComments = MensagensModel::doCount($criteria);

	}
	public function notPublished($params = null)
	{
		$this->siteSel = self::$site;
		$this->user = Dispatcher::getUserSession();

		$criteria = new FuriousSelectCriteria();
		$criteria->add("`cnt_conteudo`.`CNT_IPR`", $this->siteSel->getPDTID(), FuriousExpressionsDB::EQUAL);
		$criteria->add("`cnt_conteudo`.`CNT_TIP`", "NT", FuriousExpressionsDB::EQUAL);
		$criteria->add("`cnt_conteudo`.`CNT_STS`", "0", FuriousExpressionsDB::EQUAL);
		$criteria->setLimit(10);
		$this->itens = NoticiaModel::doSelect($criteria);
	}



	public function produtoBox($vars = null)
	{

		$this->initVars($vars);
		$this->produtos = $this->content->getProdsDicas();


	}


	public function categoriaBox($vars = null)
	{

		$this->initVars($vars);
		$this->produtos = $this->content->getCategories("DICAS");


	}

}
?>
