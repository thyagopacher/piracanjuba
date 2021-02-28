<?php
class BibleController extends DefaultBackEnd2Controller
{
	public function index($vars = null)
	{
		$this->pageTitle = "{Online Bible}";
		$this->breadCrumb = array("/bible/index.php" => "{Online Bible}");
		
		
		$criteria = new FuriousSelectCriteria();
		if(!empty($_GET['q']))
		{
			$this->filters['q'] = $_GET['q'];
			$criteria->add("`biblia_livro`.`nome`", addslashes($_GET['q']."%"), FuriousExpressionsDB::LIKE);
		}
		if(!empty($_GET['test']))
		{
			$this->filters['test'] = $_GET['test'];
			$criteria->add("`biblia_livro`.`testamentoid`", addslashes($_GET['test']), FuriousExpressionsDB::EQUAL);
		}
		$this->doPagination("BooksModel", "itens", $criteria, $vars);
	}
	public function novo($vars = null)
	{
		if(!empty($_GET['ID']))
		{
			$this->tests = TestamentoModel::getAll();
			$item = BooksModel::getOne(addslashes($_GET['ID']));
			if(!empty($item[0]))
			{
				$this->item = $item[0];
			}
		}
		if(Dispatcher::getPostValues("book") && !empty($this->item))
		{
			$values = Dispatcher::getPostValues("book");
			if($values['livroid'] == $this->item->getlivroid())
			{
				foreach($values as $prop => $value)
				{
					$this->item->$prop = (Dispatcher::isAjax())?utf8_decode($value):$value;
				}
				$this->item->save();
			}
		}
	}
}
?>