<?php
	class HomeController extends DefaultBackEnd2Controller
	{
		public function index($vars = null)
		{
			$ID = Dispatcher::getEditorialID();
			$user = Dispatcher::getUserSession();

			$editorial = ProdutoModel::getOne($ID);
			$editorial = $editorial[0];

			$this->siteSel = $editorial->getSite();


			// Editorial Itens
			$criteria = new FuriousSelectCriteria();
			$criteria->addJoin(FuriousExpressionsDB::LEFT_JOIN, "`w11_produto_menu_grupo`", "`w11_produto_menu_grupo`.`MSC_IMN`", "`w11_produto_menu`.`MNU_ID`");
			$criteria->add("`w11_produto_menu_grupo`.`MSC_IGR`", $user->getUSUGRP(), FuriousExpressionsDB::EQUAL);
			$criteria->add("`w11_produto_menu`.`MNU_IPR`", $ID, FuriousExpressionsDB::EQUAL);
			$criteria->add("`w11_produto_menu`.`MNU_STS`", 1, FuriousExpressionsDB::EQUAL);
			$criteria->addGroupBy("`w11_produto_menu`.`MNU_ID`");
			$menus = ProdutomenuModel::doSelect($criteria);

			$menusArr = array();

			if($ID != $this->siteSel->getPDTID())
			{

				// Site Itens
				$criteria = new FuriousSelectCriteria();
				$criteria->addJoin(FuriousExpressionsDB::LEFT_JOIN, "`w11_produto_menu_grupo`", "`w11_produto_menu_grupo`.`MSC_IMN`", "`w11_produto_menu`.`MNU_ID`");
				$criteria->add("`w11_produto_menu_grupo`.`MSC_IGR`", $user->getUSUGRP(), FuriousExpressionsDB::EQUAL);
				$criteria->add("`w11_produto_menu`.`MNU_IPR`", $this->siteSel->getPDTID(), FuriousExpressionsDB::EQUAL);
				$criteria->add("`w11_produto_menu`.`MNU_STS`", 1, FuriousExpressionsDB::EQUAL);
				$criteria->add("`w11_produto_menu`.`MNU_TIP`", '^([a-z]{2}[0-9]{1}|[a-z]{2})/index', FuriousExpressionsDB::NOT_REGEXP);
				$criteria->addAscendingOrder("`w11_produto_menu`.`MNU_GRP`");
				$criteria->addAscendingOrder("`w11_produto_menu`.`MNU_ORD`");
				$criteria->addGroupBy("`w11_produto_menu`.`MNU_ID`");

				$menus2 = ProdutomenuModel::doSelect($criteria);

				$menusArr = $menus2;

			}
			foreach($menus as $menu)
			{
				$menusArr[] = $menu;
			}
			$menus = $menusArr;

			$this->conts = array();
			if(!empty($menus[0]))
			{


				foreach($menus as $item)
				{
					if($item != NULL)
					{
						$link = $item->getMNUTIP();
						preg_match("/^([a-z0-9_-]+)\//i", $link, $matches);
						if(strlen($matches[1]) == "2")
						{
							if(file_exists(APP_PATH_PREFIX."apps/".APP_NAME."/controllers/featured/actions/featuredblock.block.php"))
							{
								$this->conts["featured"][] = array("EditorialID" => $ID, "MODULE" => $matches[1], "MENU" => $item);
							}
						}
						if(file_exists(APP_PATH_PREFIX."apps/".APP_NAME."/controllers/".$matches[1]."/actions/".$matches[1]."block.block.php"))
						{
							$this->conts[$matches[1]][] = array("EditorialID" => $ID, "MODULE" => $matches[1], "MENU" => $item);
						}
					}

				}
			}

		}




		public function redirect($vars = null)
		{
			$user = Dispatcher::getUserSession();

			$criteria = new FuriousSelectCriteria();
			$criteria->addJoin(FuriousExpressionsDB::LEFT_JOIN, "`w11_produto_grupo`", "`w11_produto_grupo`.`SEC_IPR`", "`w11_produto`.`PDT_ID`");
			$criteria->add("`w11_produto_grupo`.`SEC_IGR`", ((int)$user->getUSUGRP()), FuriousExpressionsDB::EQUAL);
			$criteria->add("`w11_produto`.`PDT_PAI`", 0, FuriousExpressionsDB::EQUAL);
			$criteria->add("`w11_produto`.`PDT_STS`", 1, FuriousExpressionsDB::EQUAL);
			$criteria->setLimit(1);

			$itens = ProdutoModel::doSelect($criteria);
			if(!empty($itens[0]))
			{
				$item = $itens[0];
				Dispatcher::forwardRaw($item->getURL());
			}
		}
		public function getPdtMenus($vars = null)
		{
			$user = Dispatcher::getUserSession();
			$criteria = new FuriousSelectCriteria();
			$criteria->addJoin(FuriousExpressionsDB::LEFT_JOIN, "`w11_produto_menu_grupo`", "`w11_produto_menu_grupo`.`MSC_IMN`", "`w11_produto_menu`.`MNU_ID`");
			$criteria->add("`w11_produto_menu`.`MNU_IPR`", addslashes($_GET['IPR']), FuriousExpressionsDB::EQUAL);
			$criteria->add("`w11_produto_menu`.`MNU_STS`", 1, FuriousExpressionsDB::EQUAL);
			$criteria->add("`w11_produto_menu_grupo`.`MSC_IGR`", $user->getUSUGRP(), FuriousExpressionsDB::EQUAL);
			$criteria->addAscendingOrder("`w11_produto_menu`.`MNU_GRP`");

		}
		public function tags($vars = null)
		{

			if(!empty($_GET["addTag"]))
			{
				$criteria = new FuriousSelectCriteria();
				$criteria->add("`cnt_tags`.`TAG_SLU`", addslashes(Slugfy(utf8_decode($_GET['addTag']))), FuriousExpressionsDB::EQUAL);
				$criteria->add("`cnt_tags`.`TAG_STS`", 1, FuriousExpressionsDB::EQUAL);
				$res = TagsModel::doSelect($criteria);

				if(empty($res[0]))
				{
					$tag = new Tags();
					$tag->TAG_NOM = addslashes(utf8_decode($_GET["addTag"]));
					$tag->TAG_SLU = addslashes(Slugfy(utf8_decode($_GET["addTag"])));
					$tag->TAG_STS = 1;
					$tag->save();
					//$tag->generateJSON();
				}
			}

			$criteria = new FuriousSelectCriteria();
			$criteria->add("`cnt_tags`.`TAG_STS`", 1, FuriousExpressionsDB::EQUAL);
			$criteria->add("`cnt_tags`.`TAG_NOM`", addslashes(utf8_decode($_GET["term"])."%"), FuriousExpressionsDB::LIKE);
			$criteria->addAscendingOrder("`cnt_tags`.`TAG_NOM`");
			$this->tags = TagsModel::doSelect($criteria);

		}


		public function categoria($vars = null)
		{

			if(!empty($_GET["categoria"]))
			{

				$criteria = new FuriousSelectCriteria();
				$criteria->add("CAT_NOM", addslashes(Slugfy(utf8_decode($_GET['categoria']))), FuriousExpressionsDB::EQUAL);
				$criteria->add("`cnt_categorias`.`CAT_TIP`", "REC", FuriousExpressionsDB::EQUAL);
				$criteria->add("CAT_STS", 1, FuriousExpressionsDB::EQUAL);

				$res = CategoriasModel::doSelect($criteria);


				if(empty($res[0]))
				{
					$categoria = new Categorias();
					$categoria->CAT_NOM = addslashes(utf8_decode($_GET["categoria"]));
					$categoria->CAT_TIP = $this->Site->getPDTID();
					$categoria->CAT_COR = "REC";
					$categoria->CAT_STS = 1;
					$categoria->save();
					//$tag->generateJSON();
				}
			}

			$criteria = new FuriousSelectCriteria();
			$criteria->add("`cnt_categorias`.`CAT_STS`", 1, FuriousExpressionsDB::EQUAL);
			$criteria->add("`cnt_categorias`.`CAT_COR`", "REC", FuriousExpressionsDB::EQUAL);
			$criteria->add("`cnt_categorias`.`CAT_NOM`", addslashes(utf8_decode($_GET["term"])."%"), FuriousExpressionsDB::LIKE);
			$criteria->addAscendingOrder("CAT_NOM");
			$this->tags = CategoriasModel::doSelect($criteria);

			$this->setTemplate('tags');

		}

		public function categoriaDicas($vars = null)
		{

			if(!empty($_GET["categoria"]))
			{


				$criteria = new FuriousSelectCriteria();
				$criteria->add("CAT_NOM", addslashes(Slugfy(utf8_decode($_GET['categoria']))), FuriousExpressionsDB::EQUAL);
				$criteria->add("`cnt_categorias`.`CAT_TIP`", "DICA", FuriousExpressionsDB::EQUAL);
				$criteria->add("CAT_STS", 1, FuriousExpressionsDB::EQUAL);

				$res = CategoriasModel::doSelect($criteria);


				if(empty($res[0]))
				{
					$categoria = new Categorias();
					$categoria->CAT_NOM = addslashes(utf8_decode($_GET["categoria"]));
					$categoria->CAT_TIP = $this->Site->getPDTID();
					$categoria->CAT_COR = "DICA";
					$categoria->CAT_STS = 1;
					$categoria->save();
					//$tag->generateJSON();
				}
			}

			$criteria = new FuriousSelectCriteria();
			$criteria->add("`cnt_categorias`.`CAT_STS`", 1, FuriousExpressionsDB::EQUAL);
			$criteria->add("`cnt_categorias`.`CAT_COR`", "DICA", FuriousExpressionsDB::EQUAL);
			$criteria->add("`cnt_categorias`.`CAT_NOM`", addslashes(utf8_decode($_GET["term"])."%"), FuriousExpressionsDB::LIKE);
			$criteria->addAscendingOrder("CAT_NOM");
			$this->tags = CategoriasModel::doSelect($criteria);

			$this->setTemplate('tags');

		}


		public function prod($vars = null)
		{

			if(!empty($_GET["receita"]))
			{

				$criteria = new FuriousSelectCriteria();
				$criteria->add("CNT_TIT", addslashes(Slugfy(utf8_decode($_GET['addTag']))), FuriousExpressionsDB::EQUAL);
				$criteria->add("`cnt_conteudo`.`CNT_TIP`", "PROD", FuriousExpressionsDB::EQUAL);
				$criteria->add("CAT_STS", 1, FuriousExpressionsDB::EQUAL);

				$res = ConteudoModel::doSelect($criteria);


				if(!empty($res[0]))
				{


					$produto = new Categoriaconteudo();
					$produto->CAT_NOM = addslashes(utf8_decode($_GET["addTag"]));
					$produto->CAT_TIP = $this->Site->getPDTID();
					$produto->CAT_COR = "REC";
					$produto->CAT_STS = 1;
					$produto->save();
					//$tag->generateJSON();
				}
			}

			$criteria = new FuriousSelectCriteria();
			$criteria->add("`cnt_conteudo`.`CNT_STS`", 1, FuriousExpressionsDB::EQUAL);
			$criteria->add("`cnt_conteudo`.`CNT_TIP`", "PROD", FuriousExpressionsDB::EQUAL);
			$criteria->add("`cnt_conteudo`.`CNT_TIT`", addslashes(utf8_decode($_GET["term"])."%"), FuriousExpressionsDB::LIKE);
			$criteria->addAscendingOrder("CNT_TIT");
			$this->tags = ConteudoModel::doSelect($criteria);
			$this->setTemplate('tags');

		}
		public function tabela($vars = null)
		{

			if(!empty($_GET['excluir']) && !empty($_GET['linha_id'])){
				if($_GET['excluir'] == 1){

					$linha_id = $_GET['linha_id'];

					$this->tabela = TabelaNutricionalModel::getOne(addslashes((int)$linha_id));
					if($this->tabela[0]){
						$table = $this->tabela[0];
						$table->delete();
					}
					exit;
					echo "DELETADO";

					//$this->setTemplate('tags');
				}
			}
			/*
			if(!empty($_GET['excluir_session']) && !empty($_GET['linha_id'])){
				if($_GET['excluir_session'] == 1){

					$linha_id = $_GET['linha_id'];
					unset($_SESSION['tabela_nutricional'][$linha_id]);

					echo "DELETADO";

				}
			}*/



				$tabela_valor_energetico = addslashes($_GET["tabela_valor_energetico"]);
				$tabela_quantidade = addslashes($_GET["tabela_quantidade"]);
				$tabela_porcentagem = addslashes($_GET["tabela_porcentagem"]);
				$produto_id = addslashes($_GET["produto_id"]);

				if(empty($_SESSION['count_tabela'])){
					$_SESSION['count_tabela'] = 1;
				}
				$count_tabela = $_SESSION['count_tabela'];
				$_SESSION['tabela_nutricional'][$count_tabela]['tabela_valor_energetico']= "$tabela_valor_energetico";
				$_SESSION['tabela_nutricional'][$count_tabela]['tabela_quantidade']= "$tabela_quantidade";
				$_SESSION['tabela_nutricional'][$count_tabela]['tabela_porcentagem']= "$tabela_porcentagem";
				$_SESSION['tabela_nutricional'][$count_tabela]['produto_id']= $produto_id;

				$tabela = new TabelaNutricional();
				$tabela->produto_id = $produto_id;
				$tabela->valor_energetico = utf8_decode($tabela_valor_energetico);
				$tabela->quantidade_porcao = utf8_decode($tabela_quantidade);
				$tabela->porcentagem_por_porcao = utf8_decode($tabela_porcentagem);
				$tabela->status = 1;

				if($tabela->save()){

					$criteria = new FuriousSelectCriteria();
					$criteria->add("`tabela_nutricional`.`produto_id`", $produto_id, FuriousExpressionsDB::EQUAL);
					$tabelaArr = array();
					$tabelaArr[] = $tabela;
					$this->tags = $tabelaArr;

					$_SESSION['count_tabela']++;
					$this->setTemplate('tabela');

				}




		}
	}
?>
