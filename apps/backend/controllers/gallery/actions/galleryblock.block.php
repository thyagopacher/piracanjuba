<?php
class GalleryBlock extends DefaultBlock
{
	public function images($vars = null)
	{
		$this->initVars($vars);
		
		$criteria = new FuriousSelectCriteria();
		$criteria->add("`cnt_arquivos_conteudo`.`ARC_CID`", $this->content->getID(), FuriousExpressionsDB::EQUAL);
		$criteria->add("`cnt_arquivos_conteudo`.`ARC_CTP`", "GA_IMG", FuriousExpressionsDB::EQUAL);
		$criteria->add("`cnt_arquivos_conteudo`.`ARC_STS`", 1, FuriousExpressionsDB::EQUAL);
		$this->itens = ArquivoconteudoModel::doSelect($criteria);
	}
	public function index()
	{
		
	}
}
?>