<?php
	class HomeBlock extends DefaultBlock
	{
		static $site;

		public function userspace($vars = null)
		{
			$this->user = Dispatcher::getUserSession();
		}
		public function siteSelector($vars = null)
		{
			$this->user = Dispatcher::getUserSession();
			$this->EditorialID = Dispatcher::getEditorialID();

			$editorial = ProdutoModel::getOne($this->EditorialID);
			$editorial = $editorial[0];
			if(empty(self::$site))
			{
				self::$site = $editorial->getSite();
			}

			$this->siteSel = self::$site;



			$criteria = new FuriousSelectCriteria();
			$criteria->addJoin(FuriousExpressionsDB::LEFT_JOIN, "`w11_produto_grupo`", "`w11_produto_grupo`.`SEC_IPR`", "`w11_produto`.`PDT_ID`");
			$criteria->add("`w11_produto_grupo`.`SEC_IGR`", ((int)$this->user->getUSUGRP()), FuriousExpressionsDB::EQUAL);
			$criteria->add("`w11_produto`.`PDT_PAI`", 0, FuriousExpressionsDB::EQUAL);
			//$criteria->add("`w11_produto`.`PDT_STS`", 1, FuriousExpressionsDB::EQUAL);
			$criteria->addComplexFilter("`w11_produto`.`PDT_STS`", 1, FuriousExpressionsDB::EQUAL, "`w11_produto`.`PDT_STS`", 3, FuriousExpressionsDB::EQUAL, FuriousExpressionsDB::SQL_OR);
			$criteria->addAscendingOrder("`w11_produto`.`PDT_ORD`");
			$this->itens = ProdutoModel::doSelect($criteria);
			//var_dump((string)$criteria);
		}
		public function EditorialMenus($vars = null)
		{
			$this->user = Dispatcher::getUserSession();
			$this->EditorialID = Dispatcher::getEditorialID();
			$this->Editorial = ProdutoModel::getOne(Dispatcher::getEditorialID());
			$this->Editorial = $this->Editorial[0];
			if(empty(self::$site))
			{
				self::$site = $this->Editorial->getSite();
			}

			$this->siteSel = self::$site;

			$criteria = new FuriousSelectCriteria();
			$criteria->addJoin(FuriousExpressionsDB::LEFT_JOIN, "`w11_produto_grupo`", "`w11_produto_grupo`.`SEC_IPR`", "`w11_produto`.`PDT_ID`");
			$criteria->add("`w11_produto_grupo`.`SEC_IGR`", ((int)$this->user->getUSUGRP()), FuriousExpressionsDB::EQUAL);
			$criteria->add("`w11_produto`.`PDT_ID`", $this->siteSel->getPDTID(), FuriousExpressionsDB::EQUAL);
			$criteria->add("`w11_produto`.`PDT_PAI`", 0, FuriousExpressionsDB::EQUAL);
			$criteria->add("`w11_produto`.`PDT_STS`", 1, FuriousExpressionsDB::EQUAL);
			$criteria->add("`w11_produto`.`PDT_URL`", "", FuriousExpressionsDB::NOT_EQUAL);
			$criteria->addAscendingOrder("`w11_produto`.`PDT_ORD`");
			$itens = ProdutoModel::doSelect($criteria);
			$this->itens = array();
			foreach($itens as $item):
				$this->itens += renderArrayOption($item, 0, false);
			endforeach;
		}
		public function Menu($vars = null)
		{

			$this->user = Dispatcher::getUserSession();
			$this->EditorialID = Dispatcher::getEditorialID();

			$this->editorial = ProdutoModel::getOne($this->EditorialID);
			$this->editorial = $this->editorial[0];
			if(empty(self::$site))
			{
				self::$site = $this->editorial->getSite();
			}

			$this->siteSel = self::$site;

			$this->pageParams = Dispatcher::getCurrentPageVars();


			if(!empty($this->pageParams[0][3]))
			{

				$criteria = new FuriousSelectCriteria();
				$criteria->add("`w11_produto_menu`.`MNU_TIP`", addslashes($this->pageParams[0][3]."/index"), FuriousExpressionsDB::LIKE);
				if($this->pageParams[0][3] != "gallery" && $this->pageParams[0][3] != "news" && $this->pageParams[0][3] != "calendar")
				{
					$criteria->add("`w11_produto_menu`.`MNU_IPR`", $this->EditorialID, FuriousExpressionsDB::EQUAL);
				}
				$criteria->add("`w11_produto_menu`.`MNU_STS`", 1, FuriousExpressionsDB::EQUAL);

				$selectedMenu = ProdutomenuModel::doSelect($criteria);
				if(!empty($selectedMenu))
				{
					$this->selectedMenu = $selectedMenu[0];
				}
			}


			$this->itens = array();
			if($this->EditorialID != $this->siteSel->getPDTID())
			{
				$criteria = new FuriousSelectCriteria();
				$criteria->addJoin(FuriousExpressionsDB::LEFT_JOIN, "`w11_produto_menu_grupo`", "`w11_produto_menu_grupo`.`MSC_IMN`", "`w11_produto_menu`.`MNU_ID`");
				$criteria->add("`w11_produto_menu_grupo`.`MSC_IGR`", ((int)$this->user->getUSUGRP()), FuriousExpressionsDB::EQUAL);
				$criteria->add("`w11_produto_menu`.`MNU_IPR`", $this->siteSel->getPDTID(), FuriousExpressionsDB::EQUAL);
				$criteria->add("`w11_produto_menu`.`MNU_STS`", 1, FuriousExpressionsDB::EQUAL);

				$criteria->add("`w11_produto_menu`.`MNU_TIP`", "('news/index', 'gallery/index', 'calendar/index')", FuriousExpressionsDB::IN);

				$criteria->addAscendingOrder("`w11_produto_menu`.`MNU_GRP`");
				$criteria->addAscendingOrder("`w11_produto_menu`.`MNU_ORD`");
				$criteria->addGroupBy("`w11_produto_menu`.`MNU_ID`");
				$contentItens = ProdutomenuModel::doSelect($criteria);
				foreach($contentItens as $item)
				{
					$this->itens[] = $item;
				}
			}

			$criteria = new FuriousSelectCriteria();
			$criteria->addJoin(FuriousExpressionsDB::LEFT_JOIN, "`w11_produto_menu_grupo`", "`w11_produto_menu_grupo`.`MSC_IMN`", "`w11_produto_menu`.`MNU_ID`");
			$criteria->add("`w11_produto_menu_grupo`.`MSC_IGR`", ((int)$this->user->getUSUGRP()), FuriousExpressionsDB::EQUAL);
			$criteria->add("`w11_produto_menu`.`MNU_IPR`", $this->EditorialID, FuriousExpressionsDB::EQUAL);
			$criteria->add("`w11_produto_menu`.`MNU_STS`", 1, FuriousExpressionsDB::EQUAL);
			$criteria->addAscendingOrder("`w11_produto_menu`.`MNU_GRP`");
			$criteria->addAscendingOrder("`w11_produto_menu`.`MNU_ORD`");
			$criteria->addGroupBy("`w11_produto_menu`.`MNU_ID`");
			$itens = ProdutomenuModel::doSelect($criteria);

			foreach($itens as $item)
			{
				$this->itens[] = $item;
			}
		}
		public function breadCrumb($vars = null)
		{

			$EditorialID = Dispatcher::getEditorialID();
			$editorial = ProdutoModel::getOne($EditorialID);
			$editorial = $editorial[0];
			$this->links = array();

			$edtURL = $editorial->getURL();
			$this->links[$edtURL] = $editorial->getPDTNOM();

			if(!empty($vars["VARS"]))
			{
				foreach($vars["VARS"] as $link => $name)
				{
					$this->links[$edtURL.$link] = $name;
				}
			}

		}
		public function editorialsBox($vars = null)
		{
			$this->selecteds = array();

			$edtsType = (!empty($vars["CATEGORY_TYPE"]))?$vars["CATEGORY_TYPE"]:"CAT_EDT";

			if(!empty($vars["CONTAINER"]))
			{
				$this->container = $vars["CONTAINER"];

				$EditorialID = Dispatcher::getEditorialID();

				if(empty(self::$site))
				{
					$Editorial = ProdutoModel::getOne($EditorialID);
					$Editorial = $Editorial[0];

					self::$site = $Editorial->getSite();
				}



				$criteria = new FuriousSelectCriteria();
				$criteria->add("`cnt_categorias`.`CAT_TIP`", self::$site->getPDTID(), FuriousExpressionsDB::EQUAL);
				$criteria->add("`cnt_categorias`.`CAT_COR`", $edtsType, FuriousExpressionsDB::EQUAL);
				$criteria->add("`cnt_categorias`.`CAT_STS`", 1, FuriousExpressionsDB::EQUAL);
				$criteria->add("`cnt_categorias`.`CAT_PAI`", 0, FuriousExpressionsDB::EQUAL);
//				$criteria->add("`cnt_categorias`.`CAT_PAI`", NULL, FuriousExpressionsDB::NOT_EQUAL);
				$this->itens = CategoriasModel::doSelect($criteria);



				if(!empty($vars['OPTION']) && !empty($this->itens[0]))
				{
					$this->option = array();

					foreach($this->itens as $item)
					{
						$this->option += renderArrayOption($item);
					}
				}
			}
			if(!empty($vars["CONTENT"]))
			{
				$content = $vars["CONTENT"];
				$editorials  = $content->getEditorials();


				if(!empty($editorials[0]))
				{
					foreach($editorials as $editorial):
						$this->selecteds[] = $editorial->getCATID();
					endforeach;
				}
			}
		}

		public function publishBox($vars = null)
		{
			$this->statusFieldName = $vars["STATUS_FIELD"];
			$this->statuses = array("1" => "Publicado", "0" => "Rascunho", "9" => "Deletado");
			$this->hasDate = (isset($vars['HAS_DATE']))?$vars['HAS_DATE']:true;
			$this->initVars($vars);
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
		public function tagsBox($vars = null)
		{
			$this->initVars($vars);
			$this->tags = $this->content->getTags();
		}
		public function featuredBox ($vars = null)
		{
			$this->initVars($vars);

			$user = Dispatcher::getUserSession();

			$criteria = new FuriousSelectCriteria();
			$criteria->addJoin(FuriousExpressionsDB::LEFT_JOIN, "`w11_produto_grupo`", "`w11_produto_grupo`.`SEC_IPR`", "`w11_produto`.`PDT_ID`");
			$criteria->add("`w11_produto`.`PDT_PAI`", 0, FuriousExpressionsDB::EQUAL);
			$criteria->add("`w11_produto`.`PDT_STS`", 1, FuriousExpressionsDB::EQUAL);
			$criteria->add("`w11_produto_grupo`.`SEC_IGR`", $user->getUSUGRP(), FuriousExpressionsDB::EQUAL);

			$sites = ProdutoModel::doSelect($criteria);
			$this->itens = array();

			foreach($sites as $site)
			{
				$this->itens += renderArrayOption($site);
			}

		}
		public function linksBox($vars = null)
		{
			$this->initVars($vars);
			$this->title = (!empty($vars['BOX_TITLE']))?$vars['BOX_TITLE']:"Links Relacionados";

			$this->labels['TITLE'] = 'Texto';
			if(empty($vars['NOT_SHOWLINK'])):
				$this->labels['LINK'] = 'Link';
			endif;
			$this->labels['ADD_BUTTON'] = 'Add';
			$this->labels['REMOVE_BUTTON'] = 'Remover';

			if(!empty($vars['LABELS']))
			{

				if(!empty($vars['LABELS']['TITLE']))
				{
					$this->labels['TITLE'] = $vars['LABELS']['TITLE'];
				}
				if(!empty($vars['LABELS']['LINK']))
				{
					$this->labels['LINK'] = $vars['LABELS']['LINK'];
				}
				if(!empty($vars['LABELS']['ADD_BUTTON']))
				{
					$this->labels['ADD_BUTTON'] = $vars['LABELS']['ADD_BUTTON'];
				}
				if(!empty($vars['LABELS']['REMOVE_BUTTON']))
				{
					$this->labels['REMOVE_BUTTON'] = $vars['LABELS']['REMOVE_BUTTON'];
				}
			}

			$links = $this->content->getLinks();
			if(!empty($links[0]))
			{
				$this->links = $links;
			}
		}
		public function relcontentBox($vars = null)
		{
			$this->initVars($vars);
		}

		public function produtoBox($vars = null)
		{


			$method = (!empty($vars['METHOD']))?$vars['METHOD']:"getProds";
			$this->initVars($vars);
			$this->produtos = $this->content->$method();
		}
	}
?>
