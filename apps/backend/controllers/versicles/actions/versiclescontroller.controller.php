<?php
class VersiclesController extends DefaultBackEnd2Controller
{
	public function index($vars = null)
	{
		$this->pageTitle = "{Online Bible}";
		$this->breadCrumb = array("/versicles/index.php" => "{Versicles}");
		
		$books = BooksModel::getAll();
		
		if(!empty($books[0]))
		{
			$this->books = $books;
		}
		
		$criteria = new FuriousSelectCriteria();
		if(!empty($_GET['q']))
		{
			$this->filters['q'] = $_GET['q'];
			$criteria->add("`biblia_texto`.`texto`", addslashes($_GET['q']."%"), FuriousExpressionsDB::LIKE);
		}
		if(!empty($_GET['livro']))
		{
			$this->filters['livro'] = $_GET['livro'];
			$criteria->add("`biblia_texto`.`livroid`", addslashes($_GET['livro']), FuriousExpressionsDB::EQUAL);
		}
		if(!empty($_GET['cap']))
		{
			$this->filters['cap'] = $_GET['cap'];
			$criteria->add("`biblia_texto`.`capitulo`", addslashes($_GET['cap']), FuriousExpressionsDB::EQUAL);
		}
		if(!empty($_GET['ver']))
		{
			$this->filters['ver'] = $_GET['ver'];
			$criteria->add("`biblia_texto`.`versiculo`", addslashes($_GET['ver']), FuriousExpressionsDB::EQUAL);
		}
		
		$this->doPagination("BibliaModel", "itens", $criteria, $vars);
	}
	public function novo($vars = null)
	{
		$this->books = BooksModel::getAll();
		if(!empty($_GET["ID"]))
		{
			$txt = BibliaModel::getOne(addslashes($_GET['ID']));
			if(!empty($txt[0]))
			{
				$this->item = $txt[0];
			}
			
			if(Dispatcher::getPostValues("text"))
			{
				$values = Dispatcher::getPostValues("text");
				if($values['textoid'] == $this->item->gettextoid())
				{
					$itm = clone $this->item;
					
					foreach($values as $prop => $value)
					{
						$itm->$prop = (Dispatcher::isAjax())?utf8_decode($value):$value;
					}
					
					if($itm->save())
					{
						$this->sts = TRUE;
						$this->item = null;
						$this->item = $itm;
					} else {
						$this->sts = FALSE;
						$this->error = "{Save Error, try later}";
					}
				}
			}
		}
	}
}
?>