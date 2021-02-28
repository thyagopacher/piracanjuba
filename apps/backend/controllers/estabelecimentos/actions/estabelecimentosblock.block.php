<?php
class EstabelecimentosBlock extends DefaultBlock
{
	public function estadoBox($params = null)
	{
		$criteria = new FuriousSelectCriteria();
		$criteria->addAscendingOrder("nome");
		$this->estados = EstadoModel::doSelect($criteria);
		$this->estadoEscolhido = $params['CONTENT']->CNT_CKY;

	}

	public function produtoBox($vars = null)
	{
		$method = (!empty($vars['METHOD']))?$vars['METHOD']:"getProds";
		$this->initVars($vars);
		$this->produtos = $this->content->$method("PROD_EST");
	}

}
?>