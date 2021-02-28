<?php
class DefaultBackEnd2Controller extends DefaultController {


	public function __construct($method, $params)
	{

		$configs = Configurator::getConfig("security");
		if(APP_NAME == "backend") {
			$this->EditorialID = Dispatcher::getEditorialID();
			$this->Editorial = ProdutoModel::getOne($this->EditorialID);

			$this->Editorial = $this->Editorial[0];
			$this->Site = $this->Editorial->getSite();

			$user = Dispatcher::getUserSession();
		}
		if(($configs['isSecure'] == true) && get_class($this) != "LoginController")
		{
			$ID = Dispatcher::getEditorialID();
			$user = Dispatcher::getUserSession();
			if(!$user->canAccess($ID))
			{
				$this->Unauthorized($params);
			}
		}
	}
	protected function applyFilters(&$criteria, $statusField, $titleField)
	{
		
		if(isset($_GET['publishedSearch']) || isset($_GET['notpublishedSearch']) || !empty($_GET['q']))
		{
			if(isset($_GET['publishedSearch']) && isset($_GET['notpublishedSearch']))
			{
				$published = addslashes($_GET['publishedSearch']);
				$notPublished = addslashes($_GET['notpublishedSearch']);
				
				$criteria->add($statusField, "({$published}, {$notPublished})", FuriousExpressionsDB::IN);
			} else {
				$fillters = array("q", "notpublishedSearch", "publishedSearch");
				
				foreach($fillters  as $field)
				{
					if(isset($_GET[$field])){
					
						$value = $_GET[$field];
				
						if(isset($value))
						{
							switch($field)
							{
								case "q":
									$criteria->add($titleField, addslashes("%".$value."%"), FuriousExpressionsDB::LIKE);
								break;
								default:
									$criteria->add($statusField, addslashes($value), FuriousExpressionsDB::EQUAL);
								break;
							}
					
						}
					}
				}
			}
			$this->filters = $_GET;
			unset($this->filters['page']);
			
		}
	}
	protected function updateEdtsRelations($ID, $edts, $type = "NT")
	{
		// Remove Existing Relations
		$categories = CategoriaconteudoModel::getContentRelations($ID);

		if(!empty($categories[0]))
		{

			foreach($categories as $categorie)
			{
				$categorie->unpublish();
			}
		}
		
		// Create New Relations
		if(is_array($edts))
		{
			foreach($edts as $edt):
				$relation = new Categoriaconteudo();
				$relation->CCL_CNT = $ID;
				$relation->CCL_CAT = $edt;
				$relation->CCL_TIP = $type;
				$relation->CCL_STS = 1;
				$relation->save();
			endforeach;
		} else {
			$relation = new Categoriaconteudo();
			$relation->CCL_CNT = $ID;
			$relation->CCL_CAT = $edts;
			$relation->CCL_TIP = $type;
			$relation->CCL_STS = 1;
			$relation->save();
		}
		
	}
	
	protected function updateImageRelation($contentID, $value = NULL, $thumb_type = "DTQ_THB") {
	
		$oldThumbRelations = ArquivoconteudoModel::getContentRelations($contentID, $thumb_type);
		if(!empty($oldThumbRelations[0]))
		{
			foreach($oldThumbRelations as $relation)
			{
				$relation->unpublished();
			}
		}
		if($value != NULL)
		{
			$relation = new Arquivoconteudo();
			$relation->ARC_ORD = 0;
			$relation->ARC_AID = $value;
			$relation->ARC_CID = $contentID;
			$relation->ARC_CTP = $thumb_type;
			$relation->ARC_TXT = "";
			$relation->ARC_STS = 1;
			$relation->save();
		}
		

	}
	
	
	protected function updateTagsRelations($ID, $tags)
	{
		// Remove Tags Relations
		$tagsOld = TagconteudoModel::getContentRelations($ID);
		if(!empty($tagsOld[0]))
		{
			foreach($tagsOld as $tag)
			{
				$tag->unpublish();
			}
		}
		// Create New Tag Relations
		foreach($tags as $tag):
			$relation = new Tagconteudo();
			$relation->CTA_CNT = $ID;
			$relation->CTA_TAG = $tag;
			$relation->CTA_STS = 1;
			$relation->save();
		endforeach;
	}

	protected function updateProdsRelations($ID, $tags)
	{


		// Remove Tags Relations
		$tagsOld = CategoriaconteudoModel::getContentRelations($ID);
		if(!empty($tagsOld[0]))
		{
			foreach($tagsOld as $tag)
			{
				$tag->unpublish();
			}
		}
		// Create New Tag Relations
		foreach($tags as $tag):
			$relation = new Tagconteudo();
			$relation->CTA_CNT = $ID;
			$relation->CTA_TAG = $tag;
			$relation->CTA_STS = 1;
			$relation->save();
		endforeach;
	}


	protected function updateCategoriasRelations($ID, $categorias, $tipo)
	{
		// Remove Tags Relations
		$categoriasOld = CategoriaconteudoModel::getContentTipoRelations($ID, $tipo);



		if(!empty($categoriasOld[0]))
		{

			foreach($categoriasOld as $cat)
			{

				$cat->unpublish();
			}

		}

		// Create New Tag Relations
		foreach($categorias as $categoria):
			$relation = new Categoriaconteudo();

			$relation->CCL_CNT = $ID;
			$relation->CCL_CAT = $categoria;
			$relation->CCL_TIP = $tipo;
			$relation->CCL_STS = 1;


			$relation->save();

		endforeach;
	}

	protected function updateProdsRelationss($ID, $produtos, $tipo)
	{
		// Remove Tags Relations
		$produtosOld = CategoriaconteudoModel::getContentTipoRelations($ID, $tipo);

		if(!empty($produtosOld[0]))
		{
			foreach($produtosOld as $prod)
			{
				$prod->unpublish();

			}
		}
		// Create New Tag Relations
		foreach($produtos as $produto):
			$relation = new Categoriaconteudo();

			$relation->CCL_CNT = $ID;
			$relation->CCL_CAT = $produto;
			$relation->CCL_TIP = $tipo;
			$relation->CCL_STS = 1;
			$relation->save();

		endforeach;
	}


	protected function updateTabelaRelations($ID, $tabelaNutricional)
	{
		// Remove Links Relations

		$tabelaNutricionalOld = TabelaNutricionalModel::getContentRelations($ID);
		if(!empty($tabelaNutricionalOld[0]))
		{
			foreach($tabelaNutricionalOld as $tab)
			{
				$tab->delete();
			}
		}

		if(!empty($tabelaNutricional)){
			// Create New Tag Relations
			foreach($tabelaNutricional as $linha):
				if(!empty($linha["tabela_valor_energetico"]) && !empty($linha["tabela_quantidade"]) && !empty($linha["tabela_porcentagem"]))
				{

					$tabela = new TabelaNutricional();
					$tabela->produto_id = $ID;
					$tabela->valor_energetico = $linha["tabela_valor_energetico"];
					$tabela->quantidade_porcao = $linha["tabela_quantidade"];
					$tabela->porcentagem_por_porcao = $linha["tabela_porcentagem"];
					$tabela->status = 1;
					$tabela->save();

				}
			endforeach;
		}
	}


	protected function updateLinksRelations($ID, $links)
	{
		// Remove Links Relations
		
		$linksOld = LinksModel::getContentRelations($ID);
		if(!empty($linksOld[0]))
		{
			foreach($linksOld as $link)
			{
				$link->unpublish();
			}
		}
		
		if(!empty($links)){
			// Create New Tag Relations
			foreach($links as $link):
				if(!empty($link["TXT"]))
				{
					$lnk = new Links();
					$lnk->LNK_CNT = $ID;
					$lnk->LNK_IPR = $this->EditorialID;
					$lnk->LNK_TIT = $link['TXT'];
					$lnk->LNK_LNK = (!empty($link['LNK']))?$link['LNK']:'';
					$lnk->LNK_STS = 1;
					$lnk->save();
				}
			endforeach;
		}
	}
	protected function createFeatureds($content)
	{
		if(Dispatcher::getPostValues("featured"))
		{
			$values = Dispatcher::getPostValues("featured");

			foreach($values as $EDT => $arr)
			{
				if(is_array($arr)):
					foreach($arr as $type => $dtq)
					{
						$criteria = new FuriousSelectCriteria();
						$criteria->add("`w11_produto_menu`.`MNU_IPR`", $EDT, FuriousExpressionsDB::EQUAL);
						$criteria->add("`w11_produto_menu`.`MNU_TIP`", addslashes("{$type}/index"), FuriousExpressionsDB::EQUAL);
						$criteria->add("`w11_produto_menu`.`MNU_STS`", 1, FuriousExpressionsDB::EQUAL);
						$criteria->setLimit(1);
						$itens = ProdutomenuModel::doSelect($criteria);

						if(!empty($itens[0]))
						{
							$dtq["DTQ_INI"] = date("Y-m-d H:i:s",strtotime(str_replace("/", "-", $dtq["DTQ_INI"])));
							if(!empty($dtq["DTQ_FIM"]))
							{
								$dtq["DTQ_FIM"] = date("Y-m-d H:i:s",strtotime(str_replace("/", "-", $dtq["DTQ_FIM"])));
							}
						
							$dest = new Destaques();
							foreach($dtq as $prop => $value)
							{
								$dest->$prop = $value;
							}
							$dest->DTQ_CID = $content->getCNTID();
							$dest->save();
						}
					}
				endif;
			}
			
		}
	}
}
?>