<?php
class GroupsController extends DefaultBackEnd2Controller
{
	public function index($vars = null)
	{
		$criteria = new FuriousSelectCriteria();
		$criteria->add("`w11_grupo`.`GRP_STS`", 1, FuriousExpressionsDB::EQUAL);
		//$criteria->add("`w11_grupo`.`GRP_STS`", 1, FuriousExpressionsDB::EQUAL);
		$this->doPagination("GrupoModel", "itens", $criteria, $vars);
	}
	
	public function delete($vars = null)
	{
		$this->setTemplate("delete", "default");
		$this->pageTitle = "{Delete Group}";
		$this->breadCrumb = array("/groups/index.php" => "{Groups}");
		
		
		
		if(!empty($_GET['ID']))
		{
			$item = GrupoModel::getOne($_GET['ID']);
			if(!empty($item[0]))
			{
				$item = $item[0];
				if($item->delete())
				{
					$this->DeleteOk = true;
				}
				
			} else {
				$this->Error404();
			}
		}
	}
	// New or Edit
	public function novo($vars = null)
	{
		
		$criteria = new FuriousSelectCriteria();
		$criteria->add("`w11_produto`.`PDT_PAI`", 0, FuriousExpressionsDB::EQUAL);
		$criteria->addComplexFilter("`w11_produto`.`PDT_STS`", 1, FuriousExpressionsDB::EQUAL, "`w11_produto`.`PDT_STS`", 3, FuriousExpressionsDB::EQUAL, FuriousExpressionsDB::SQL_OR);
		$this->sites = ProdutoModel::doSelect($criteria);
		
		$this->profilePerms = array("PRODUTOS" => array(), "MENUS" => array());
		
		$ID = null;
		if(!empty($_GET['ID']))
		{
			$ID = ((int)$_GET['ID']);
			$content = GrupoModel::getOne(addslashes($ID));
			if(!empty($content[0]))
			{
				$this->content = $content[0];
				
			}
		} else {
			$content = new Grupo();
			$content->GRP_STS = 1;
			if($content->save())
			{
				$this->content = $content;
			}
		}
		$this->action = $this->Editorial->getURL()."groups/edit.php?ID=".($this->content->getGRPID());
		
		if(Dispatcher::getPostValues("groups"))
		{
			
			$criteria = new FuriousSelectCriteria();
			$criteria->add("`w11_produto_grupo`.`SEC_IGR`", $this->content->getGRPID(), FuriousExpressionsDB::EQUAL);
			$allPerms = ProdutogrupoModel::doSelect($criteria);
			
			if(!empty($allPerms[0]))
			{
				foreach($allPerms as $perm)
				{
					$perm->delete();
				}
			}
			
			$criteria = new FuriousSelectCriteria();
			$criteria->add("`w11_produto_menu_grupo`.`MSC_IGR`", $this->content->getGRPID(), FuriousExpressionsDB::EQUAL);
			$allPerms = SecuritymenuModel::doSelect($criteria);
			
			if(!empty($allPerms[0]))
			{
				foreach($allPerms as $perm)
				{
					$perm->delete();
				}
			}
			
			
			$values = Dispatcher::getPostValues("groups");
			
			$sites = array();
			if(!empty($values['sites'])):
				$sites = $values['sites'];
				unset($values['sites']);
			endif; 
			
			$edts = array();
			if(!empty($values['EDTS'])):
				$edts = $values['EDTS'];
				unset($values['EDTS']);
			endif; 
			
			$menu = array();
			if(!empty($values['menu'])):
				$menu = $values['menu'];
				unset($values['menu']);
			endif;
			
			foreach($values as $prop => $value)
			{
				$this->content->$prop = $value;
			}
			
			$this->content->save();
			
			foreach($sites as $site => $value)
			{
				$perm = new Produtogrupo();
				$perm->SEC_IGR = $this->content->getGRPID();
				$perm->SEC_IPR = $site;
				$perm->save();
			}
			
			foreach($edts as $site => $value)
			{
				$perm = new Produtogrupo();
				$perm->SEC_IGR = $this->content->getGRPID();
				$perm->SEC_IPR = $site;
				$perm->save();
			}
			foreach($menu as $site => $value)
			{
				$perm = new Securitymenu();
				$perm->MSC_IGR = $this->content->getGRPID();
				$perm->MSC_IMN = $site;
				$perm->save();
			}
			
		}
		$criteria = new FuriousSelectCriteria();
		$criteria->add("`w11_produto_grupo`.`SEC_IGR`", $this->content->getGRPID(), FuriousExpressionsDB::EQUAL);
		$grupos = ProdutogrupoModel::doSelect($criteria);
		
		if(!empty($grupos[0]))
		{
			foreach($grupos as $perm)
			{
				$this->profilePerms['PRODUTOS'][$perm->getSECIPR()] = $perm->getSECIPR();
			}
		}
		
		
		$criteria = new FuriousSelectCriteria();
		$criteria->add("`w11_produto_menu_grupo`.`MSC_IGR`", $this->content->getGRPID(), FuriousExpressionsDB::EQUAL);
		$grupos = SecuritymenuModel::doSelect($criteria);
		if(!empty($grupos[0]))
		{
			foreach($grupos as $perm)
			{
				$this->profilePerms['MENUS'][$perm->getMSCIMN()] = $perm->getMSCIMN();
			}
		}
	}
}
?>