<?php
class FeaturedController extends DefaultBackEnd2Controller
{
	const THUMB_TYPE = "THB_DTQ";
	protected function getFeaturedConfigs($type)
	{

		$criteria = new FuriousSelectCriteria();
		$criteria->add("`w11_produto_menu`.`MNU_IPR`", $this->EditorialID, FuriousExpressionsDB::EQUAL);
		$criteria->add("`w11_produto_menu`.`MNU_TIP`", addslashes("{$type}/index"), FuriousExpressionsDB::EQUAL);
		$criteria->add("`w11_produto_menu`.`MNU_STS`", 1, FuriousExpressionsDB::EQUAL);
		$criteria->setLimit(1);
		$itens = ProdutomenuModel::doSelect($criteria);

		if(!empty($itens[0]))
		{
			$this->type = $type;
			// Set Configs
			$this->configs = $itens[0];
			return true;
		} else {
			//$this->Error404();
			return false;
		}
	}
	public function index($vars = null)
	{
		$type = $vars[0][3];

		$this->pageTitle = "{List Featured}";
		$this->breadCrumb = array("/{$type}/index.php" => "{Featured}");
		$this->type = $type;


		$this->getFeaturedConfigs($type);

		if(!empty($this->configs)){
			$limit = $this->configs->getMNUURL();

			if(!empty($limit))
			{

				$this->limit = $limit;
			}
		}

		$criteria = new FuriousSelectCriteria();
		$criteria->add("`cnt_destaques`.`DTQ_TIP`", addslashes($type), FuriousExpressionsDB::EQUAL);
		$criteria->add("`cnt_destaques`.`DTQ_EDT`", $this->EditorialID, FuriousExpressionsDB::EQUAL);
		$criteria->add("`cnt_destaques`.`DTQ_STS`", 9, FuriousExpressionsDB::NOT_EQUAL);
		$criteria->add("`cnt_destaques`.`DTQ_STS`", 8, FuriousExpressionsDB::NOT_EQUAL);
		$criteria->addDescendingOrder("`cnt_destaques`.`DTQ_INI`");
		$criteria->addDescendingOrder("`cnt_destaques`.`DTQ_ID`");



		$this->applyFilters($criteria, "`cnt_destaques`.`DTQ_STS`", "`cnt_destaques`.`DTQ_TIT`");


		$this->doPagination("DestaquesModel", "itens", $criteria, $vars, ((!empty($_GET['perPage']))?$_GET['perPage']:10));


	}
	public function edit($vars = null)
	{

		$type = $vars[0][3];
		$this->breadCrumb = array("{$type}/index.php" => "{Featured}");
		// Set Configs
		if($this->getFeaturedConfigs($type))
		{
			if($this->configs->getMNUCAT() == 1)
			{
				$criteria = new FuriousSelectCriteria();
				$criteria->add("`cnt_categorias`.`CAT_STS`", 1, FuriousExpressionsDB::EQUAL);
				$criteria->add("`cnt_categorias`.`CAT_PAI`", 0, FuriousExpressionsDB::EQUAL);

				$itens = CategoriasModel::doSelect($criteria);

				if(!empty($itens[0]))
				{
					$this->cats = array();

					foreach($itens as $item)
					{
						$this->cats[] = renderArrayOption($item);
					}
				}
			}




			// Set Content ID Variable
			$newsID = (!empty($_GET['ID']))?$_GET['ID']:false;
			$newsID = (!empty($_POST['featured']['DTQ_ID']))?$_POST['featured']['DTQ_ID']:$newsID;


			// Get Old Feature
			if($newsID != false)
			{
				// Get Content By ID
				$this->item = DestaquesModel::getOne($newsID);

				// If isn't empty itens returned
				if(!empty($this->item[0]))
				{
					// Set Content variable and set Page Title
					$this->content = $this->item[0];
					$this->pageTitle = "{Edit Featured}";
					$this->breadCrumb["{$type}/edit.php?ID=".$newsID] = "{Edit Featured}";

				} else {

					// Else Set 404 HTTP Error
					//$this->Error404();
					//return false;
				}

			// Else Create One to Edit
			} else {

				$this->content = new Destaques();
				$this->content->DTQ_TIT = "";
				$this->content->DTQ_SIT = $this->Site->PDT_ID;
				$this->content->DTQ_EDT = $this->EditorialID;
				$this->content->DTQ_TIP = $this->type;
				$this->content->DTQ_STS = 8;
				$this->content->DTQ_INI = date("Y-m-d H:i:s");
				$this->content->DTQ_FIM = date("Y-m-d H:i:s", (time()+(((60*60)*24)*356)));
				$this->content->save();
				//$this->content->DTQ_STS = 0;
				$this->pageTitle = "{New Featured}";
				$this->breadCrumb["{$type}/edit.php?ID=".$this->content->getID()] = "{New Featured}";
			}



			// IF Has Post['featured'] values

			if(Dispatcher::getPostValues("featured"))
			{
				// Set Values Array
				$values = Dispatcher::getPostValues("featured");
				$values["DTQ_INI"] = date("Y-m-d H:i:s",strtotime(str_replace("/", "-", $values["DTQ_INI"])));

				if(!empty($values['isNew'])){
					unset($values['isNew']);
				}

				if(!empty($values["DTQ_FIM"]))
				{
					$values["DTQ_FIM"] = date("Y-m-d H:i:s",strtotime(str_replace("/", "-", $values["DTQ_FIM"])));
				}
				if(!empty($values["DTQ_DTA"]))
				{
					$values["DTQ_DTA"] = date("Y-m-d H:i:s",strtotime(str_replace("/", "-", $values["DTQ_DTA"])));
				}
				// IF ID is set
				if(!empty($values["DTQ_ID"]))
				{
					if(isset($values['IMG_DTQ']))
					{
						$imgNews = $values['IMG_DTQ'];
						unset($values['IMG_DTQ']);
					}
					if(isset($values['IMG_DTQ2']))
					{
						$imgNews2 = $values['IMG_DTQ2'];
						unset($values['IMG_DTQ2']);
					}
					if(isset($values['IMG_DTQ3']))
					{
						$imgNews3 = $values['IMG_DTQ3'];
						unset($values['IMG_DTQ3']);
					}
					// Set values properties
					foreach($values as $key => $value)
					{
						$this->content->$key = $value;
					}

					// Save Content
					if($this->content->save()){
						$this->Message = "{Featured Saved}";
						// Save Image Relation
						if(!empty($imgNews))
						{
							$this->updateImageRelation($this->content->getID(), $imgNews, self::THUMB_TYPE);
						} else {
							$this->updateImageRelation($this->content->getID(), NULL, self::THUMB_TYPE);
						}
						if(!empty($imgNews2))
						{
							$this->updateImageRelation($this->content->getID(), $imgNews2, "THB_DTQ2");
						} else {
							$this->updateImageRelation($this->content->getID(), NULL, "THB_DTQ2");
						}
						if(!empty($imgNews3))
						{
							$this->updateImageRelation($this->content->getID(), $imgNews3, "THB_DTQ3");
						} else {
							$this->updateImageRelation($this->content->getID(), NULL, "THB_DTQ3");
						}
						 //$this->content->generateJSON();
					} else {
						$this->Errors = "{Save Error, try later}";
					}

				}

			}

		}
	}
	public function delete($vars = null)
	{
		$this->setTemplate("delete", "default");

		$type = $vars[0][3];


		// Set Configs
		if($this->getFeaturedConfigs($type))
		{
			$this->moduleDir = $this->type;

			$newsID = (!empty($_GET['ID']))?$_GET['ID']:false;
			if($newsID != false)
			{
					// Get Content By ID
					$this->item = DestaquesModel::getOne($newsID);

					// If isn't empty itens returned
					if(!empty($this->item[0]))
					{
						// Set Content variable and set Page Title
						$this->content = $this->item[0];
						if($this->content->delete())
						{
							//$this->content->generateJSON();
							$this->DeleteOk = true;
						}

					} else {
						//$this->Error404();
					}
			} else {
				//$this->Error404();
			}
		}
	}
	public function quick($vars = null)
	{
		$this->setTemplate("quick", "default");

		if(Dispatcher::getPostValues("quick")):
			$values = Dispatcher::getPostValues("quick");
			$values["DTQ_INI"] = date("Y-m-d H:i:s",strtotime(str_replace("/", "-", $values["DTQ_INI"])));

			if(!empty($values["DTQ_ID"])):
				$this->item = DestaquesModel::getOne($values["DTQ_ID"]);

				// If isn't empty itens returned
				if(!empty($this->item[0]))
				{
					// Set Content variable and set Page Title
					$this->content = $this->item[0];

					foreach($values as $key => $value):
						$this->content->$key = $value;
					endforeach;
					if(empty($values["DTQ_STS"]))
					{
						$this->content->DTQ_STS = 0;
					}

					if($this->content->save()):
						$this->success = true;
					endif;
				}
			endif;
		endif;
	}
	public function listAreas($vars = null)
	{
		if(!empty($_POST['EditorialID']))
		{
			$user = Dispatcher::getUserSession();

			$criteria = new FuriousSelectCriteria();
			$criteria->addJoin(FuriousExpressionsDB::LEFT_JOIN, "`w11_produto_menu_grupo`", "`w11_produto_menu_grupo`.`MSC_IMN`", "`w11_produto_menu`.`MNU_ID`");
			$criteria->add("`w11_produto_menu_grupo`.`MSC_IGR`", $user->getUSUGRP(), FuriousExpressionsDB::EQUAL);
			$criteria->add("`w11_produto_menu`.`MNU_IPR`", addslashes($_POST['EditorialID']), FuriousExpressionsDB::EQUAL);
			$criteria->add("`w11_produto_menu`.`MNU_TIP`", '^[a-z0-9]{2}[[.slash.]]|^[a-z0-9]{3}[[.slash.]]', FuriousExpressionsDB::REGEXP);
			$criteria->add("`w11_produto_menu`.`MNU_STS`", 1, FuriousExpressionsDB::EQUAL);
			//$criteria->setLimit(1);
			$itens = ProdutomenuModel::doSelect($criteria);
			if(!empty($itens[0]))
			{
				$this->itens = $itens;
			}
		}
	}
	public function configs($vars = null)
	{
		if(!empty($_POST['EditorialID']) && !empty($_POST['Tip']))
		{
			$user = Dispatcher::getUserSession();

			$criteria = new FuriousSelectCriteria();
			$criteria->addJoin(FuriousExpressionsDB::LEFT_JOIN, "`w11_produto_menu_grupo`", "`w11_produto_menu_grupo`.`MSC_IMN`", "`w11_produto_menu`.`MNU_ID`");
			$criteria->add("`w11_produto_menu_grupo`.`MSC_IGR`", $user->getUSUGRP(), FuriousExpressionsDB::EQUAL);
			$criteria->add("`w11_produto_menu`.`MNU_IPR`", addslashes($_POST['EditorialID']), FuriousExpressionsDB::EQUAL);
			$criteria->add("`w11_produto_menu`.`MNU_TIP`", addslashes($_POST['Tip']."/index"), FuriousExpressionsDB::EQUAL);
			$criteria->add("`w11_produto_menu`.`MNU_STS`", 1, FuriousExpressionsDB::EQUAL);
			$criteria->setLimit(1);
			$itens = ProdutomenuModel::doSelect($criteria);

			if(!empty($itens[0]))
			{
				$this->type = $_POST['Tip'];
				$this->EditorialID = $_POST['EditorialID'];
				$this->itens = $itens[0];
			}
		}
	}
}
?>
