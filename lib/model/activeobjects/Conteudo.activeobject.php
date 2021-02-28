<?php
	class Conteudo extends ActiveObject {
		protected $activeModel = "ConteudoModel";
		protected $FID = "CNT_ID";
		protected $links = array();
		protected $tags = array();
		protected $editorials = array();
		protected $approvedTotal;
		public function getID()
		{
			return $this->getCNTID();
		}
		public function getCNTID()
		{
			return $this->returnKey("CNT_ID");
		}
		public function getCNTEMB()
		{
			return $this->returnKey("CNT_EMB");
		}
		public function getCNTSIT()
		{
			return $this->returnKey("CNT_SIT");
		}
		public function getCNTLOC()
		{
			return $this->returnKey("CNT_LOC");
		}

		public function getCNTIPR()
		{
			return $this->returnKey("CNT_IPR");
		}

		public function getCNTTIP()
		{
			return $this->returnKey("CNT_TIP");
		}

		public function getCNTDTA()
		{
			return $this->returnKey("CNT_DTA");
		}

		public function getCNTTIS()
		{
			return $this->returnKey("CNT_TIS");
		}

		public function getCNTTIT()
		{
			//return (APP_NAME == 'frontend')?$this->returnKey("CNT_TIT"):htmlentities($this->returnKey("CNT_TIT"));
			return $this->returnKey("CNT_TIT");
		}

		public function getCNTOLH()
		{
			return (APP_NAME == 'frontend')?$this->returnKey("CNT_OLH"):htmlentities($this->returnKey("CNT_OLH"));
		}

		public function getCNTTXT()
		{
			return (APP_NAME == 'frontend')?$this->returnKey("CNT_TXT"):htmlentities($this->returnKey("CNT_TXT"));
		}

		public function getCNTRES()
		{
			return (APP_NAME == 'frontend')?$this->returnKey("CNT_RES"):htmlentities($this->returnKey("CNT_RES"));
		}

		public function getCNTFT1()
		{
			return $this->returnKey("CNT_FT1");
		}

		public function getCNTFT1_()
		{
			return $this->returnKey("CNT_FT1_");
		}

		public function getCNTRDT()
		{
			return htmlentities($this->returnKey("CNT_RDT"));
		}

		public function getCNTEMA()
		{
			return htmlentities($this->returnKey("CNT_EMA"));
		}

		public function getCNTCHV()
		{
			return $this->returnKey("CNT_CHV");
		}

		public function getCNTCMT()
		{
			return ($this->returnKey("CNT_CMT") == 1)?true:false;
		}
		public function getCNTCMD()
		{
			return $this->returnKey("CNT_CMD");
		}

		public function getCNTCKY()
		{
			return $this->returnKey("CNT_CKY");
		}

		public function getCNTTAG()
		{
			return $this->returnKey("CNT_TAG");
		}

		public function getCNTCAT()
		{
			return $this->returnKey("CNT_CAT");
		}

		public function getCNTENQ()
		{
			return $this->returnKey("CNT_ENQ");
		}

		public function getCNTCTT()
		{
			return $this->returnKey("CNT_CTT");
		}

		public function getCNTPAI()
		{
			return $this->returnKey("CNT_PAI");
		}

		public function getCNTEST()
		{
			return $this->returnKey("CNT_EST");
		}

		public function getCNTSTS()
		{
			return $this->returnKey("CNT_STS");
		}
		public function getStatus()
		{
			return $this->getCNTSTS();
		}
		public function getDTA()
		{
			return $this->getCNTDTA();
		}
		public function getCNTNOT()
		{
			return $this->returnKey("CNT_NOT");
		}
		public function getCNTVOT()
		{
			return $this->returnKey("CNT_VOT");
		}
		public function getURL()
		{
			$tp = $this->getCNTTIP();
			$data = strtotime($this->getCNTDTA());
			$titSlug = ($this->getCNTTIT())?Slugfy(html_entity_decode($this->getCNTTIT())):"{untitled}";
			$id = $this->getCNTID();

			$site = ProdutoModel::getOne($this->getCNTSIT());
			if(!empty($site[0]))
			{
				$site = $site[0];
				$url = $site->getPDTURL();
			} else {
				$url = "/";
			}

			if(substr($url, -1) != "/"){
				$url .= "/";
			}

			switch($tp)
			{
				case "NT":
					return "{$url}{news_url}/".(date("Y/m/d/", $data))."{$titSlug}-{$id}.html";
				break;
				case "GA":
					return "{$url}{gallery_url}/".(date("Y/m/d/", $data))."{$titSlug}-{$id}.html";
				break;
				case "CA":
					return "{$url}{calendar_url}/".(date("Y/m/d/", $data))."{$titSlug}-{$id}.html";
				break;
				case "7E":
					return "{$url}{sevengame_url}/".(date("Y/m/d/", $data))."{$titSlug}-{$id}.html";
				break;
				case "QZ":
					return "{$url}{quiz_url}/".(date("Y/m/d/", $data))."{$titSlug}-{$id}.html";
				break;
				case "REC":
					return "{$url}{receipts_url}/"."{$titSlug}-{$id}";
				break;
				case "PROD":
					return "{$url}{products_url}/"."{$titSlug}-{$id}";
					break;
				case "AN":
					return "{$url}a-piracanjuba/anos/"."{$titSlug}-{$id}";
				break;
				case "DN":
					return "{$url}dicas-de-nutricao/"."{$titSlug}-{$id}";
				break;
			}

			return (date("Y/m/d/", $data))."{$titSlug}-{$id}.html";
		}
		public function getURLADM()
		{
			$tp = $this->getCNTTIP();
			//$data = strtotime($this->getCNTDTA());
			//$titSlug = Slugfy($this->getCNTTIT());
			$id = $this->getCNTID();

			$ipr = $this->getCNTIPR();
			$prod = ProdutoModel::getOne($ipr);
			$url = "";
			if(!empty($prod[0]))
			{
				$ipr = $prod[0];
				$url = $ipr->getURL();
			}



			switch($tp)
			{
				case "NT":
					return str_replace("//", "/", $url."/news/edit.php?ID=".$id);
				break;
				case "GA":
					return str_replace("//", "/", $url."/gallery/edit.php?ID=".$id);
				break;
			}
			return false;
		}
		public function getDTQFTO($THUMB_TYPE = "THB_CNT")
		{
			$criteria = new FuriousSelectCriteria();
			$criteria->addJoin(FuriousExpressionsDB::LEFT_JOIN, "`cnt_arquivos_conteudo`", "`cnt_arquivos_conteudo`.`ARC_AID`", "`cnt_arquivos`.`ARQ_ID`");
			$criteria->add("`cnt_arquivos_conteudo`.`ARC_CID`", $this->getID(), FuriousExpressionsDB::EQUAL);
			$criteria->add("`cnt_arquivos_conteudo`.`ARC_CTP`", $THUMB_TYPE, FuriousExpressionsDB::EQUAL);
			$criteria->add("`cnt_arquivos_conteudo`.`ARC_STS`", 1, FuriousExpressionsDB::EQUAL);
			$criteria->addAscendingOrder("`cnt_arquivos_conteudo`.`ARC_ORD`");

			$imgCnt = ArquivoModel::doSelect($criteria);

			if(!empty($imgCnt[0]))
			{
				return $imgCnt[0];
			}
			return false;
		}
		public function getProperties()
		{
			return $this->params;
		}
		public function save()
		{
		  return parent::save();
		}
		public function delete()
		{
			$this->params['CNT_STS'] = 9;
			return $this->save();
		}


		public function getLinks()
		{
			if(empty($this->links))
			{
				$EditorialID = Dispatcher::getEditorialID();

				$criteria = new FuriousSelectCriteria();
				//$criteria->add("`cnt_conteudo_link`.`LNK_IPR`", addslashes($EditorialID), FuriousExpressionsDB::EQUAL);
				$criteria->add("`cnt_conteudo_link`.`LNK_CNT`", $this->getCNTID(), FuriousExpressionsDB::EQUAL);
				$criteria->add("`cnt_conteudo_link`.`LNK_STS`", 1, FuriousExpressionsDB::EQUAL);

				$this->links = LinksModel::doSelect($criteria);
			}
			return $this->links;
		}
		public function getRelatedContent()
		{
			$criteria = new FuriousSelectCriteria();
			$criteria->addJoin(FuriousExpressionsDB::LEFT_JOIN, "`cnt_conteudo_tag`", "`cnt_conteudo_tag`.`CTA_CNT`", "`cnt_conteudo`.`CNT_ID`");
			$criteria->add("`cnt_conteudo`.`CNT_STS`", 1, FuriousExpressionsDB::EQUAL);

			$tags = $this->getTags();
			$vals = array();

			if(!empty($tags[0]))
			{
				foreach($tags as $tag){
					$vals[] = "'".$tag->getTAGID()."'";
				}
			}
			$criteria->add("`cnt_conteudo_tag`.`CTA_TAG`", "(".(implode(", ", $vals)).")",FuriousExpressionsDB::IN);
			$criteria->add("`cnt_conteudo_tag`.`CTA_CNT`", $this->getCNTID() , FuriousExpressionsDB::NOT_EQUAL);
			$criteria->add("`cnt_conteudo_tag`.`CTA_STS`", 1 , FuriousExpressionsDB::EQUAL);



			$criteria->addDescendingOrder("`cnt_conteudo`.`CNT_DTA`");
			$criteria->addGroupBy("`cnt_conteudo`.`CNT_ID`");
			$criteria->setLimit(10);
			$content = ConteudoModel::doSelect($criteria);

			$arr = array();

			if(!empty($content[0]))
			{
				foreach($content as $cont)
				{
					$s = new StdClass();
					$s->ID = utf8_encode($cont->getCNTID());
					$arr[] = $s;
				}

			}

			if(count($arr) > 0)
			{
				return $arr;
			}
			return false;
		}
		// Busca Thumb
		public function getCNTFTO()
		{
			$oldThumbRelations = ArquivoconteudoModel::getContentRelations($this->getCNTID(), "THB_CNT");

			if(!empty($oldThumbRelations[0]))
			{
				return $oldThumbRelations[0];
			}
			return false;
		}
		public function getTags()
		{
			if(empty($this->tags))
			{
				$EditorialID = Dispatcher::getEditorialID();

				$criteria = new FuriousSelectCriteria();
				$criteria->addJoin(FuriousExpressionsDB::LEFT_JOIN, "`cnt_conteudo_tag`", "`cnt_conteudo_tag`.`CTA_TAG`", "`cnt_tags`.`TAG_ID`");
				$criteria->add("`cnt_conteudo_tag`.`CTA_CNT`", $this->getCNTID(), FuriousExpressionsDB::EQUAL);
				$criteria->add("`cnt_conteudo_tag`.`CTA_STS`", 1, FuriousExpressionsDB::EQUAL);

				$this->tags = TagsModel::doSelect($criteria);
			}
			return $this->tags;
		}

		public function getCategorias()
		{
			if(empty($this->categorias))
			{
				$criteria = new FuriousSelectCriteria();
				$criteria->addJoin(FuriousExpressionsDB::LEFT_JOIN, "`cnt_categorias_conteudos`", "`cnt_categorias_conteudos`.`CCL_CAT`", "`cnt_categorias`.`CAT_ID`");
				$criteria->add("`cnt_categorias_conteudos`.`CCL_CNT`", $this->getCNTID(), FuriousExpressionsDB::EQUAL);
				$criteria->add("`cnt_categorias_conteudos`.`CCL_STS`", 1, FuriousExpressionsDB::EQUAL);

				$this->categorias = CategoriasModel::doSelect($criteria);
			}
			return $this->categorias;
		}

		public function getProds($tipo = "PROD")
		{
			if(empty($this->produtos))
			{
				$criteria = new FuriousSelectCriteria();
				$criteria->addJoin(FuriousExpressionsDB::LEFT_JOIN, "`cnt_categorias_conteudos`", "`cnt_categorias_conteudos`.`CCL_CAT`", "`cnt_conteudo`.`CNT_ID`");
				$criteria->add("`cnt_categorias_conteudos`.`CCL_CNT`", $this->getCNTID(), FuriousExpressionsDB::EQUAL);
				$criteria->add("`cnt_categorias_conteudos`.`CCL_TIP`", "$tipo", FuriousExpressionsDB::EQUAL);
				$criteria->add("`cnt_categorias_conteudos`.`CCL_STS`", 1, FuriousExpressionsDB::EQUAL);

				$this->produtos = ConteudoModel::doSelect($criteria);


			}
			return $this->produtos;
		}

		public function getProdsDicas()
		{
			if(empty($this->produtos))
			{
				$criteria = new FuriousSelectCriteria();
				$criteria->addJoin(FuriousExpressionsDB::LEFT_JOIN, "`cnt_categorias_conteudos`", "`cnt_categorias_conteudos`.`CCL_CAT`", "`cnt_conteudo`.`CNT_ID`");
				$criteria->add("`cnt_categorias_conteudos`.`CCL_CNT`", $this->getCNTID(), FuriousExpressionsDB::EQUAL);
				$criteria->add("`cnt_categorias_conteudos`.`CCL_TIP`", "DICA", FuriousExpressionsDB::EQUAL);
				$criteria->add("`cnt_categorias_conteudos`.`CCL_STS`", 1, FuriousExpressionsDB::EQUAL);
				$criteria->add("`cnt_conteudo`.`CNT_STS`", 1, FuriousExpressionsDB::EQUAL);

				$this->produtos = ConteudoModel::doSelect($criteria);
			}
			return $this->produtos;
		}


		public function getTabela(){

			if(empty($this->tabelaNutricional))
			{
				$criteria = new FuriousSelectCriteria();
				$criteria->add("`tabela_nutricional`.`produto_id`", $this->getCNTID(), FuriousExpressionsDB::EQUAL);
				$criteria->add("`tabela_nutricional`.`status`", 9, FuriousExpressionsDB::NOT_EQUAL);
				$this->tabelaNutricional = TabelaNutricionalModel::doSelect($criteria);

			}
			return $this->tabelaNutricional;
		}

		public function getEditorials()
		{
			if(empty($this->editorials[0]))
			{
				$EditorialID = Dispatcher::getEditorialID();


				$criteria = new FuriousSelectCriteria();
				$criteria->addJoin(FuriousExpressionsDB::LEFT_JOIN, "`cnt_categorias_conteudos`", "`cnt_categorias_conteudos`.`CCL_CAT`", "`cnt_categorias`.`CAT_ID`");

				$criteria->add("`cnt_categorias`.`CAT_STS`", 1, FuriousExpressionsDB::EQUAL);
				//$criteria->add("`cnt_categorias`.`CAT_TIP`", addslashes($EditorialID), FuriousExpressionsDB::EQUAL);
				$criteria->add("`cnt_categorias_conteudos`.`CCL_STS`", 1, FuriousExpressionsDB::EQUAL);
				$criteria->add("`cnt_categorias_conteudos`.`CCL_CNT`", $this->getCNTID(), FuriousExpressionsDB::EQUAL);

				$this->editorials = CategoriasModel::doSelect($criteria);

			}
			return $this->editorials;
		}
		public function getCategories($cor = "CAT_EDT")
		{
			if(empty($this->editorials[0]))
			{
				$EditorialID = Dispatcher::getEditorialID();


				$criteria = new FuriousSelectCriteria();
				$criteria->addJoin(FuriousExpressionsDB::LEFT_JOIN, "`cnt_categorias_conteudos`", "`cnt_categorias_conteudos`.`CCL_CAT`", "`cnt_categorias`.`CAT_ID`");

				$criteria->add("`cnt_categorias`.`CAT_STS`", 1, FuriousExpressionsDB::EQUAL);
				$criteria->add("`cnt_categorias`.`CAT_COR`", $cor, FuriousExpressionsDB::EQUAL);
				$criteria->add("`cnt_categorias_conteudos`.`CCL_STS`", 1, FuriousExpressionsDB::EQUAL);
				$criteria->add("`cnt_categorias_conteudos`.`CCL_CNT`", $this->getCNTID(), FuriousExpressionsDB::EQUAL);

				$this->editorials = CategoriasModel::doSelect($criteria);

			}
			return $this->editorials;
		}
		public function getComments($parent = NULL)
		{
			$criteria = new FuriousSelectCriteria();
			$criteria->addJoin(FuriousExpressionsDB::LEFT_JOIN, "`cnt_conteudo`", "`cnt_conteudo`.`CNT_ID`", "`cnt_conteudo_msg`.`MSG_CNT`");
			$criteria->add("`cnt_conteudo_msg`.`MSG_CNT`", $this->getCNTID(), FuriousExpressionsDB::EQUAL);
			$criteria->add("`cnt_conteudo_msg`.`MSG_STS`", 1, FuriousExpressionsDB::EQUAL);

			if($parent != NULL)
			{
				$criteria->add("`cnt_conteudo_msg`.`MSG_PAI`", $parent, FuriousExpressionsDB::EQUAL);
			} else {
				$criteria->add("`cnt_conteudo_msg`.`MSG_PAI`", "", FuriousExpressionsDB::IS_NULL);
			}

			$criteria->addDescendingOrder("`cnt_conteudo_msg`.`MSG_DTA`");
			$itens = ComentariosModel::doSelect($criteria);

			if(!empty($itens[0]))
			{
				foreach($itens as $item){
					$id = $item->getMSGID();
					$item->children = $this->getComments($id);
				}
				return $itens;
			}
			return false;
		}
		public function getEstado(){
			$est = $this->getCNTCKY();
			if(!empty($est)){
				$estado = EstadoModel::getOne($est);
				return $estado[0];
			}
			return false;
		}
		public function getApprovedComments()
		{
			if(!empty($this->approvedTotal))
			{
				return $this->approvedTotal;
			}
			$criteria = new FuriousSelectCriteria();
			$criteria->addJoin(FuriousExpressionsDB::LEFT_JOIN, "`cnt_conteudo`", "`cnt_conteudo`.`CNT_ID`", "`cnt_conteudo_msg`.`MSG_CNT`");
			$criteria->add("`cnt_conteudo_msg`.`MSG_CNT`", $this->getCNTID(), FuriousExpressionsDB::EQUAL);
			$criteria->add("`cnt_conteudo_msg`.`MSG_STS`", 1, FuriousExpressionsDB::EQUAL);
			//$criteria->addDescendingOrder("`cnt_conteudo_msg`.`MSG_DTA`");
			$this->approvedTotal = ComentariosModel::count($criteria);

			return $this->approvedTotal;
		}
		public function generateTagsJsonList()
		{
			// Tags
			if(empty($this->tags[0]))
			{
				$this->getTags();
			}
			if(!empty($this->tags[0]))
			{
				$site = ProdutoModel::getOne(Dispatcher::getEditorialID());
				$site = $site[0];
				$site = $site->getSite();

				$siteID = $site->getPDTID();

				foreach($this->tags as $tag)
				{
					$tagStd = $tag->toJSON();
					$id = $tag->getTAGID();


					$criteria = new FuriousSelectCriteria();
					$criteria->addJoin(FuriousExpressionsDB::LEFT_JOIN, "cnt_conteudo_tag", "`cnt_conteudo_tag`.`CTA_CNT`", "`cnt_conteudo`.`CNT_ID`");
					$criteria->add("`cnt_conteudo_tag`.`CTA_TAG`", $tag->getTAGID(), FuriousExpressionsDB::EQUAL);
					$criteria->add("`cnt_conteudo_tag`.`CTA_STS`", 1, FuriousExpressionsDB::EQUAL);
					$criteria->add("`cnt_conteudo`.`CNT_IPR`", $this->getCNTIPR(), FuriousExpressionsDB::EQUAL);
					$criteria->add("`cnt_conteudo`.`CNT_TIP`", "NT", FuriousExpressionsDB::EQUAL);
					$criteria->add("`cnt_conteudo`.`CNT_TIP`", "FQ", FuriousExpressionsDB::NOT_EQUAL);
					$criteria->add("`cnt_conteudo`.`CNT_STS`", 1, FuriousExpressionsDB::EQUAL);
					$criteria->add("`cnt_conteudo`.`CNT_DTA`", date("Y-m-d H:i:s"), FuriousExpressionsDB::MINOR_EQUAL);
					$criteria->addDescendingOrder("`cnt_conteudo`.`CNT_DTA`");
					$criteria->setLimit(1000);
					$news = NoticiaModel::doSelect($criteria);
					if(!empty($news[0])):
						$newsArr = array();
						foreach($news as $article):
							$newsArr[] = $article->toJSONLimited();
						endforeach;

						$tagStd->news = $newsArr;
					endif;

					$criteria = new FuriousSelectCriteria();
					$criteria->addJoin(FuriousExpressionsDB::LEFT_JOIN, "cnt_conteudo_tag", "`cnt_conteudo_tag`.`CTA_CNT`", "`cnt_conteudo`.`CNT_ID`");
					$criteria->add("`cnt_conteudo_tag`.`CTA_TAG`", $tag->getTAGID(), FuriousExpressionsDB::EQUAL);
					$criteria->add("`cnt_conteudo_tag`.`CTA_STS`", 1, FuriousExpressionsDB::EQUAL);
					$criteria->add("`cnt_conteudo`.`CNT_IPR`", $this->getCNTIPR(), FuriousExpressionsDB::EQUAL);
					$criteria->add("`cnt_conteudo`.`CNT_TIP`", "GA", FuriousExpressionsDB::EQUAL);
					$criteria->add("`cnt_conteudo`.`CNT_TIP`", "FQ", FuriousExpressionsDB::NOT_EQUAL);
					$criteria->add("`cnt_conteudo`.`CNT_STS`", 1, FuriousExpressionsDB::EQUAL);
					$criteria->add("`cnt_conteudo`.`CNT_DTA`", date("Y-m-d H:i:s"), FuriousExpressionsDB::MINOR_EQUAL);
					$criteria->addDescendingOrder("`cnt_conteudo`.`CNT_DTA`");
					$criteria->setLimit(1000);
					$news = GaleriaModel::doSelect($criteria);
					if(!empty($news[0])):


						$newsArr = array();
						foreach($news as $article):
							$newsArr[] = $article->toJSONLimited();
						endforeach;

						$tagStd->galerias = $newsArr;
					endif;


					$dir = Document::renderDirStructure($id, APP_JSON_PATH);
					if($dir != false)
					{
						Document::writeFile($dir."TAG_{$siteID}_".($id).".json", json_encode($tagStd));
					}

				}
			}
		}
		public function toJSONLimited()
		{
			$news = new StdClass();
			foreach($this->getProperties() as $prop => $value)
			{
				$news->$prop = utf8_encode($value);
			}
			$fto = $this->getDTQFTO();
			if($fto != false)
			{
				$news->thb_fto = $fto->toJSON();
			}
			$news->totComments = $this->getApprovedComments();
			return $news;
		}
	}
?>
