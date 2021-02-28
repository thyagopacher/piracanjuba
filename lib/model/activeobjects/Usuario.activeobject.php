<?php
	class Usuario extends ActiveObject {
		protected $activeModel = "UsuarioModel";
		protected $FID = "USU_ID";
		public function getUSUID()
		{
			return $this->returnKey("USU_ID");
		}

		public function getUSUGRP()
		{
			return $this->returnKey("USU_GRP");
		}

		public function getUSUNOM()
		{
			return $this->returnKey("USU_NOM");
		}

		public function getUSUEMA()
		{
			return $this->returnKey("USU_EMA");
		}

		public function getUSUDPT()
		{
			return $this->returnKey("USU_DPT");
		}

		public function getUSULOG()
		{
			return $this->returnKey("USU_LOG");
		}

		public function getUSUSEN()
		{
			return $this->returnKey("USU_SEN");
		}

		public function getUSUTIP()
		{
			return $this->returnKey("USU_TIP");
		}

		public function getUSUSTS()
		{
			return $this->returnKey("USU_STS");
		}
		public function getUSUFB()
		{
			return $this->returnKey("USU_FB");
		}
		public function getUSUFBIM()
		{
			return $this->returnKey("USU_FBIM");
		}

		public function getProperties()
		{
			return $this->params;
		}
		public function canAccess($ID)
		{
			$criteria = new FuriousSelectCriteria();
			$criteria->addJoin(FuriousExpressionsDB::LEFT_JOIN, "`w11_produto_grupo`", "`w11_produto_grupo`.`SEC_IPR`", "`w11_produto`.`PDT_ID`");
			$criteria->add("`w11_produto_grupo`.`SEC_IGR`", $this->getUSUGRP(), FuriousExpressionsDB::EQUAL);
			$criteria->add("`w11_produto`.`PDT_ID`", ((int)$ID), FuriousExpressionsDB::EQUAL);
			//$criteria->add("`w11_produto`.`PDT_STS`", 1, FuriousExpressionsDB::EQUAL);
			$criteria->addComplexFilter("`w11_produto`.`PDT_STS`", 1, FuriousExpressionsDB::EQUAL, "`w11_produto`.`PDT_STS`", 3, FuriousExpressionsDB::EQUAL, FuriousExpressionsDB::SQL_OR);
			
			$products = ProdutoModel::doSelect($criteria);
					
			if(!empty($products[0]))
			{
				return true;
			}
			return false;
			
		}
		public function getProdutosPerms($parent_id = null)
		{
			$criteria = new FuriousSelectCriteria();
			$criteria->addJoin(FuriousExpressionsDB::LEFT_JOIN, "`w11_produto_grupo`", "`w11_produto_grupo`.`SEC_IPR`", "`w11_produto`.`PDT_ID`");
			
			$criteria->add("`w11_produto_grupo`.`SEC_IGR`", $this->getUSUGRP(), FuriousExpressionsDB::EQUAL);
			if(!empty($parent_id))
			{
				$criteria->add("`w11_produto`.`PDT_PAI`", $parent_id, FuriousExpressionsDB::EQUAL);
			}
			$criteria->add("`w11_produto`.`PDT_STS`", 1, FuriousExpressionsDB::EQUAL);
			
			$products = ProdutoModel::doSelect($criteria);
			
			return $products;
		}
		public function getMenuPerms($produto)
		{
			$criteria = new FuriousSelectCriteria();
			$criteria->addJoin(FuriousExpressionsDB::LEFT_JOIN, "`w11_produto_menu_grupo`", "`w11_produto_menu_grupo`.`MSC_IMN`", "`w11_produto_menu`.`MNU_ID`");
			
			$criteria->add("`w11_produto_menu_grupo`.`MSC_IGR`", $this->getUSUGRP(), FuriousExpressionsDB::EQUAL);
			$criteria->add("`w11_produto_menu`.`MNU_IPR`", $produto, FuriousExpressionsDB::EQUAL);
			
			$menus = ProdutomenuModel::doSelect($criteria);
			
			return $menus;
		}
		
		public function delete()
		{
			$this->params['USU_STS'] = 9;
			$this->save();
		}
		public function toJSON()
		{
			$ret = new StdClass();
			$ret->id = $this->getUSUID();
			$ret->name = utf8_encode($this->getUSUNOM());
			$ret->email = utf8_encode($this->getUSUEMA());
			$ret->fb = $this->getUSUFB();
			$ret->fbImg = $this->getUSUFBIM();
			return $ret;
		}
	}
?>