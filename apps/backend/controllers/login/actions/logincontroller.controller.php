<?php

class LoginController extends DefaultController
{
	public function login($vars = null)
	{
		$this->setLayout("login");
		
		$this->bodyClasses = "loginPage";
		
		if(!empty($_POST['username']) && !empty($_POST['pass']))
		{
		
			// Generate Query
			$criteria = new FuriousSelectCriteria();
			$criteria->add("`w11_usuario`.`USU_LOG`", addslashes($_POST['username']), FuriousExpressionsDB::EQUAL);
			//$criteria->add("`w11_usuario`.`USU_SEN`", md5($_POST['pass']), FuriousExpressionsDB::EQUAL);
			$criteria->add("`w11_usuario`.`USU_STS`", 1, FuriousExpressionsDB::EQUAL);
			
			// DB Query
			$itens = UsuarioModel::doSelect($criteria);
			
			if(!empty($itens[0]))
			{
				$usuario = $itens[0];
				if($usuario->getUSUSEN() == md5($_POST['pass']))
				{
					Dispatcher::setUserSession($usuario);
					
					$produtos = $usuario->getProdutosPerms();
					$produto = $produtos[0];
					$site = $produto->getSite();
					Dispatcher::forwardRaw(APP_WEB_PREFIX.$site->getPDTID()."-".Slugfy($site->getPDTNOM()."/"));
				}
			}	
		}
		
	}
	public function logout($vars = null)
	{
		$this->setLayout("login");
		$this->bodyClasses = "loginPage";
		Dispatcher::unsetUser();
		Dispatcher::forwardRaw(APP_WEB_PREFIX);
	}
}

?>