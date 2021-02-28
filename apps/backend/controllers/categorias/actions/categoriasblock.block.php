<?php
class CategoriasBlock extends DefaultBlock
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

	public function imageBox($vars = null)
	{

		$this->image = null;

		$this->initVars($vars);

		$this->title = (!empty($vars['TITLE']))?$vars['TITLE']:"{Image Thumb}";
		$this->addText = (!empty($vars['ADD_TEXT']))?$vars['ADD_TEXT']:"Adicionar Thumb";
		$this->removeText = (!empty($vars['REMOVE_TEXT']))?$vars['REMOVE_TEXT']:"Remover Imagem Thumb";

		if(!empty($vars["CONTENT"]) && !empty($vars["THUMB_TYPE"]))
		{
			$this->content = $vars["CONTENT"];

			$criteria = new FuriousSelectCriteria();
			$criteria->addJoin(FuriousExpressionsDB::LEFT_JOIN, "`cnt_arquivos_conteudo`", "`cnt_arquivos_conteudo`.`ARC_AID`", "`cnt_arquivos`.`ARQ_ID`");
			$criteria->add("`cnt_arquivos_conteudo`.`ARC_CID`", $this->content->getID(), FuriousExpressionsDB::EQUAL);
			$criteria->add("`cnt_arquivos_conteudo`.`ARC_CTP`", $vars["THUMB_TYPE"], FuriousExpressionsDB::EQUAL);
			$criteria->add("`cnt_arquivos_conteudo`.`ARC_STS`", 1, FuriousExpressionsDB::EQUAL);
			$criteria->addAscendingOrder("`cnt_arquivos_conteudo`.`ARC_ORD`");

			$this->imgCnt = ArquivoModel::doSelect($criteria);

		}
		if(!empty($vars["FILE_ID"])){
			$id = $vars["FILE_ID"];
			$this->imgCnt = ArquivoModel::getOne($id);
		}
		$this->fName = (!empty($vars['FIELD_NAME']))?$vars['FIELD_NAME']:"IMG_DTQ";
	}
}
?>