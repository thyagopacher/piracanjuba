<?php
class UsersController extends DefaultBackEnd2Controller
{
	public function index($vars = null)
	{
		$criteria = new FuriousSelectCriteria();
		$criteria->add("`w11_usuario`.`USU_STS`", 1, FuriousExpressionsDB::EQUAL);
		$criteria->add("`w11_usuario`.`USU_TIP`", 1, FuriousExpressionsDB::EQUAL);
		$this->doPagination("UsuarioModel", "itens", $criteria, $vars);
	}
	public function delete($vars = null)
	{
		$this->setTemplate("delete", "default");
		$this->pageTitle = "{Delete User}";
		$this->breadCrumb = array("/users/index.php" => "{Users}");

		if(!empty($_GET['ID']))
		{
			$ID = ((int)$_GET['ID']);

			$criteria = new FuriousSelectCriteria();
			$criteria->add("`w11_usuario`.`USU_ID`", addslashes($ID), FuriousExpressionsDB::EQUAL);
			$item = UsuarioModel::doSelect($criteria);

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
		} else {
			$this->Error404();
		}
	}
	public function novo($vars = null)
	{
		$ID = null;
		$this->groups = array("" => "{Select one Group}");

		$criteria = new FuriousSelectCriteria();
		$criteria->add("`w11_grupo`.`GRP_STS`", 1, FuriousExpressionsDB::EQUAL);
		$itens = GrupoModel::doSelect($criteria);
		if(!empty($itens[0]))
		{
			foreach($itens as $item)
			{
				$this->groups[$item->getGRPID()] = $item->getGRPTIT();
			}
		}


		if(!empty($_GET['ID']))
		{
			$ID = ((int)$_GET['ID']);

			$criteria = new FuriousSelectCriteria();
			$criteria->add("`w11_usuario`.`USU_ID`", $ID, FuriousExpressionsDB::EQUAL);
			$item = UsuarioModel::doSelect($criteria);
			if(!empty($item[0]))
			{
				$this->content = $item[0];
			}
		}
		if(empty($this->content))
		{
			$this->content = new Usuario();
			$this->content->USU_STS = 9;
			$this->content->USU_TIP = 1;
			if($this->content->save())
			{
				$ID = $this->content->getUSUID();
			}
		}

		if(Dispatcher::getPostValues("user"))
		{
			$values = Dispatcher::getPostValues("user");
			if(!empty($values['USU_SEN']) && strlen($values['USU_SEN']) < 32)
			{
				$values['USU_SEN'] = md5($values['USU_SEN']);
			} else {
				unset($values['USU_SEN']);
			}
			foreach($values as $prop => $value)
			{
				$this->content->$prop = $value;
			}

			if(!$this->content->save())
			{
				$this->Errors = "{Save Error, try later}";
			} else {
				$this->Message = "{User} {Saved}";
			}
		}
		$this->action = $this->Editorial->getURL()."users/edit.php?ID=".($this->content->getUSUID());
	}
}
?>
