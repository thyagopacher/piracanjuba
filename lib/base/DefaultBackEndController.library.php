<?php
	class DefaultBackEndController extends DefaultController {
		public function show($vars = null)
		{
			if(!$this->verifyTemplateExists("show")){
				$this->prepareDefaultTemplate("show");
			}
			$this->title = $this->titles['SHOW'];
			
			
			$criteria = new FuriousSelectCriteria();
			
			$modelVars = get_class_vars($this->Model);
			
			$table = $modelVars['TABLE'];
			
			if(!empty($vars[0][3]) && is_numeric($vars[0][3])){
				$criteria->add('`' . $table . '`.`id`', addslashes($vars[0][3]), FuriousExpressionsDB::EQUAL);
			} else {
				$criteria->add('`' . $table . '`.`id`', addslashes($vars[0][6]), FuriousExpressionsDB::EQUAL);
			}
			$criteria->setLimit(1);
			
			$item = call_user_func_array($this->Model."::doSelect", array($criteria));
			
			if($item[0] != null)
			{
				$this->item = $item[0];
			} else {
				$this->Error404();
			}	
			//$this->doPagination($this->Model, "itens", $criteria, $vars);
		}
		public function index($vars = null)
		{
			if(!$this->verifyTemplateExists("index")){
				$this->prepareDefaultTemplate("index");
			}
			$this->title = $this->titles['INDEX'];
			$criteria = new FuriousSelectCriteria();
			
			$this->doPagination($this->Model, "itens", $criteria, $vars, ((!empty($_GET['perPage']))?$_GET['perPage']:10));
		}
		// EDIT
		public function edit($vars = null)
		{
			$modelVars = get_class_vars($this->Model);
			
			$table = $modelVars['TABLE'];
			
			$criteria = new FuriousSelectCriteria();
			
			$criteria->add('`' . $table . '`.`id`', addslashes($vars[0][6]), FuriousExpressionsDB::EQUAL);
			$criteria->setLimit(1);
			$item = call_user_func_array($this->Model."::doSelect", array($criteria));
			
			if($item[0] != null)
			{
				$this->form = new $this->FormName(Dispatcher::generateEditorialURL(array($this->controllerDir, "create")));
				$this->form->appendValues($item[0]->getProperties());
				$this->title = $this->titles['EDIT'] . " " . ((string)$item[0]);
				
				if(!$this->verifyTemplateExists("novo")){
					$this->setTemplate("novo", "default");
				}
		
			} else {
				$this->Error404();
			}
		}
		public function delete($vars = null)
		{
			if(isset($vars[0][6]))
			{
				$modelVars = get_class_vars($this->Model);
			
				$table = $modelVars['TABLE'];
			
				if(!$this->verifyTemplateExists("novo")){
					$this->setTemplate("novo", "default");
				}

				$this->title = $this->titles['EDIT'];

				$criteria = new FuriousSelectCriteria();
				
				$criteria->add('`' . $table . '`.`id`', addslashes($vars[0][6]), FuriousExpressionsDB::EQUAL);
				$criteria->setLimit(1);
				$item = call_user_func_array($this->Model."::doSelect", array($criteria));

					$item[0]->delete();

					Dispatcher::forwardRaw (Dispatcher::generateEditorialURL(array($this->controllerDir, "index")));
				}
		}
		// Create
		public function create($vars = null)
		{
			
			if(!$this->verifyTemplateExists("create")){
				$this->setTemplate("create", "default");
			}
			
			$Form = new $this->FormName(Dispatcher::generateEditorialURL(array($this->controllerDir, "create")));
			$values = Dispatcher::getPostValues($Form->getName());
			if(isset($values["id"]) && $values["id"] != "" && is_numeric($values["id"]))
			{
				$this->title = $this->titles['EDIT'];
			} else {
				$this->title = $this->titles['NEW'];
			}
			if(Dispatcher::getPostValues($Form->getName())){
				$this->proccessForm($Form);
			} 
		}
		// Novo
		public function novo($vars = null)
		{
			
			if(!$this->verifyTemplateExists("novo")){
				$this->setTemplate("novo", "default");
			}
			
			
			$this->title = $this->titles['NEW'];
			$this->form = new $this->FormName(Dispatcher::generateEditorialURL(array($this->controllerDir, "create")));
			
		}
		public function prepareVars()
		{
			$this->controller = str_replace("controller", "", strtolower(get_class($this)));
		}
		public function prepareDefaultTemplate($method)
		{
			$this->setTemplate($method, "default");
			
		}
		public function __destruct(){
			if(method_exists($this, Dispatcher::$calledMethod))
			{
				$controller = (!empty($this->templateController))? $this->templateController : Dispatcher::$calledController;
				$this->prepareVars();
				
				$this->renderView($controller, Dispatcher::$calledMethod, Dispatcher::$calledFormat);
			}
		}
	}
?>