<?php
class ProdutoController extends DefaultBackEnd2Controller
{
	public function renderPDT($vars = null)
	{
		if(!empty($_GET['ID']))
		{
			$id = $_GET['ID'];
			$produto = ProdutoModel::getOne($id);
			if(!empty($produto[0]))
			{
				$pdt = $produto[0];
				$pdt->generatePDTJSON();
				$this->ID = $id;
			}
		}
	}
}
?>