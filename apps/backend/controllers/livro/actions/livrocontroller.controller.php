<?php
class LivroController extends DefaultBackEnd2Controller
{
	public $moduleDir = "livro";
	public function getMenuConfig(){
		$criteria = new FuriousSelectCriteria();
		$criteria->add("`w11_produto_menu`.`MNU_IPR`", Dispatcher::getEditorialID(), FuriousExpressionsDB::EQUAL);
		$criteria->add("`w11_produto_menu`.`MNU_TIP`", 'livro/index', FuriousExpressionsDB::EQUAL);
		$criteria->add("`w11_produto_menu`.`MNU_STS`", 1, FuriousExpressionsDB::EQUAL);
		$criteria->setLimit(1);
		$config = ProdutomenuModel::doSelect($criteria);
		if(!empty($config[0]))
		{
			$this->config = $config[0];
			return true;
		}
		return false;
	}









	public function novo($vars = null)
	{
		$this->pageTitle = "{List Book}";
		$this->breadCrumb = array("/livro/index.php" => "{Book}");

		$this->arqConfig = ($this->getMenuConfig())?$this->config->getMNUURL():67;

		if(!empty($_GET['ID'])){
			$content = MensagensModel::getOne($_GET['ID']);

			//var_dump($content);
			if($content[0])
			{
					$this->content = $content[0];

					if(Dispatcher::getPostValues("news"))
					{


						$values = Dispatcher::getPostValues("news");

						$values["CNT_DTA"] = date("Y-m-d H:i:s",strtotime(str_replace("/", "-", $values["CNT_DTA"])));
						// Save Noticia
						foreach($values as $key => $value)
						{

							if($key == "CNT_DTA"){
								$key = "MSG_DTA";
							}
							$this->content->$key = $value;
						}
						//var_dump(!$this->content->save());
						if(!$this->content->save())
						{
							$this->Errors = "{Save Error, try later}";
						} else {
							$this->Message = "{Saved}";
							$news = NoticiaModel::getOne($this->content->getMSGCNT());
							if($news[0]){
								$news = $news[0];
								$news->generateJSON();
							}
							//$this->content->generateJSON();
						}
					}
			}
		}

		$this->action = $this->Editorial->getURL()."livro/edit.php?ID=".($this->content->getMSGID());
	}







	public function index($vars = null)
	{
		$this->pageTitle = "{List Book}";
		$this->breadCrumb = array("/livro/index.php" => "{Book}");

		$this->arqConfig = ($this->getMenuConfig())?$this->config->getMNUURL():67;


		$criteria = new FuriousSelectCriteria();
		$criteria->addJoin(FuriousExpressionsDB::LEFT_JOIN, "`cnt_conteudo`", "`cnt_conteudo`.`CNT_ID`", "`cnt_conteudo_msg`.`MSG_CNT`");
		$criteria->add("`cnt_conteudo_msg`.`MSG_CNT`", $this->arqConfig, FuriousExpressionsDB::EQUAL);
		$criteria->addDescendingOrder("`cnt_conteudo_msg`.`MSG_DTA`");

		if(!empty($_GET['q']))
		{
			$criteria->add("`cnt_conteudo_msg`.`MSG_TIT`", addslashes($_GET['q']."%"), FuriousExpressionsDB::LIKE);
			$this->filters['q'] = $_GET['q'];
		}

		if(!empty($_GET['start_period']))
		{
			$date = strtotime(str_replace("/", "-", $_GET['start_period']));
			$difH = (int)(date("H", $date));
			$difH = (($difH*60)*60);
			$difM = (int)(date("i", $date));
			$difM = (($difM*60));
			$dif = $difH + $difM;
			$nDate = $date - $dif;
			$this->filters['start_period'] = date("d/m/Y", $nDate);

			$criteria->add("`cnt_conteudo_msg`.`MSG_DTA`", addslashes(date("Y/m/d H:i:s", $nDate)), FuriousExpressionsDB::GREATER_THAN);
		}

		if(!empty($_GET['end_period']))
		{
			$date = strtotime(str_replace("/", "-", $_GET['end_period']));
			$difH = 23 - (int)(date("H", $date));
			$difH = (($difH*60)*60);
			$difM = 59 - (int)(date("i", $date));
			$difM = (($difM*60));
			$dif = $difH + $difM;
			$nDate = $date + $dif;
			$this->filters['end_period'] = date("d/m/Y", $nDate);

			$criteria->add("`cnt_conteudo_msg`.`MSG_DTA`", addslashes(date("Y/m/d H:i:s", $nDate)), FuriousExpressionsDB::MINOR_THAN);
		}

		$criteria->add("`cnt_conteudo_msg`.`MSG_STS`", 9, FuriousExpressionsDB::NOT_EQUAL);

		// Generate Page
		$this->doPagination("UploadsModel", "itens", $criteria, $vars);
	}
	public function delete ($vars = null)
	{
		$this->setTemplate("delete", "default");
		$this->pageTitle = "{Delete Book}";
		$this->breadCrumb = array("/livro/index.php" => "{Book}");
		if(!empty($_GET["ID"]))
		{
			$content = UploadsModel::getOne(addslashes($_GET["ID"]));
			$this->content = $content[0];
			if($this->content->delete())
			{
				$this->DeleteOk = true;
			}
		} else {
			$this->Error404();
		}
	}
	public function download($vars = null)
	{

		$this->arqConfig = ($this->getMenuConfig())?$this->config->getMNUURL():67;


		$criteria = new FuriousSelectCriteria();
		$criteria->addJoin(FuriousExpressionsDB::LEFT_JOIN, "`cnt_conteudo`", "`cnt_conteudo`.`CNT_ID`", "`cnt_conteudo_msg`.`MSG_CNT`");
		$criteria->add("`cnt_conteudo_msg`.`MSG_CNT`", $this->arqConfig, FuriousExpressionsDB::EQUAL);
		$criteria->addDescendingOrder("`cnt_conteudo_msg`.`MSG_DTA`");
		$criteria->add("`cnt_conteudo_msg`.`MSG_STS`", 9, FuriousExpressionsDB::NOT_EQUAL);

		$this->items = UploadsModel::doSelect($criteria);

	}
}
?>
