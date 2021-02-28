<?php
	class Categoriaconteudo extends ActiveObject {
		protected $activeModel = "CategoriaconteudoModel";
		protected $FID = "CCL_ID";

		public function getCCLID()
		{
			return $this->returnKey("CCL_ID");
		}

		public function getCCLCNT()
		{
			return $this->returnKey("CCL_CNT");
		}

		public function getCCLCAT()
		{
			return $this->returnKey("CCL_CAT");
		}

		public function getCCLTIP()
		{
			return $this->returnKey("CCL_TIP");
		}

		public function getCCLSTS()
		{
			return $this->returnKey("CCL_STS");
		}

		public function getProperties()
		{
			return $this->params;
		}
		public function unpublish()
		{
			$this->params["CCL_STS"] = 9;


			return $this->save();

			$content = ConteudoModel::getOne($this->returnKey("CCL_CNT"));

			if($content[0]){
				$cont = $content[0];
				$type = $cont->getCNTTIP();
				$criteria = new FuriousSelectCriteria();
				$criteria->addJoin(FuriousExpressionsDB::LEFT_JOIN, "cnt_categorias_conteudos", "`cnt_categorias_conteudos`.`CCL_CNT`", "`cnt_conteudo`.`CNT_ID`");
				$criteria->add("`cnt_categorias_conteudos`.`CCL_CAT`", $this->returnKey("CCL_CAT"), FuriousExpressionsDB::EQUAL);
				//$criteria->add("`cnt_conteudo`.`CNT_STS`", 1, FuriousExpressionsDB::EQUAL);
				$criteria->add("`cnt_conteudo`.`CNT_TIP`", $type, FuriousExpressionsDB::EQUAL);
				$criteria->setLimit(1);
				switch($type){
					case "VD":
						$content = VideoModel::doSelect($criteria);
					break;
					case "GA":
						$content = GaleriaModel::doSelect($criteria);
					break;
					case "7E":
						$content = SevengameModel::doSelect($criteria);
					break;
					case "TP":
						$content = TopicsModel::doSelect($criteria);
					break;
					default:
						$content = NoticiaModel::doSelect($criteria);
					break;
				}
				if($content[0]){
					$cont = $content[0];
					$cont->generateEditorialLists();
				}
			}
		}
		public function save()
		{
		 	return parent::save();
		}
	}
?>
