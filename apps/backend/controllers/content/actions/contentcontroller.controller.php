<?php
class ContentController extends DefaultBackEnd2Controller
{
	public function loadContent($vars = null)
	{
		if(!empty($_GET['term']))
		{
			$criteria = new FuriousSelectCriteria();
			$criteria->add("`cnt_conteudo`.`CNT_TIT`", addslashes("%".$_GET["term"]."%"), FuriousExpressionsDB::LIKE);
			$criteria->add("`cnt_conteudo`.`CNT_STS`", 1, FuriousExpressionsDB::EQUAL);
			$this->itens = ConteudoModel::doSelect($criteria);
			
			
		}
		
	}
}
?>