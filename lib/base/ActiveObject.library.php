<?php

	abstract class ActiveObject {
		protected $params;
		public function getIDField()
		{
			return $this->FID;
		}
		public function getActiveModel()
		{
			return $this->activeModel;
		}
		public function __set($key, $value)
		{
			if($key == "children")
			{
				$this->children = $value;
			} else {
				$this->params[$key] = $value;
			}
		}
		public function toOption($Tab = 0)
		{
			$tabs = "";
			for($i=0; $i<$Tab; $i++){
				$tabs .= "&#09;";
			}
			$html = "<option value=\"{$this->getId()}\">{$tabs}{$this->getName()}</option>";
			return $html;
		}
		public function __isset($key)
		{
			return isset($this->params[$key]);
		}
		public function __unset($key)
		{
			unset($this->params[$key]);
		}
		public function __get($key)
		{
			if(isset($this->params[$key]))
			{
				return $this->params[$key];
			}
			else
			{
				return false;
			}
		}
		public function returnKey($key){
			if(isset($this->params[$key]))
			{
				return $this->params[$key];
			}
			else
			{
				return false;
			}
		}
		public function save()
		{
			if(isset($this->created_at))
			{
				unset($this->created_at);
			}
			
			if(!empty($this->params[$this->FID]))
			{
				$res = call_user_func("$this->activeModel::doUpdate", $this);
				if($res){
					return true;
				} else {
					return false;
				}
				
			} 
			else
			{
				if(call_user_func("$this->activeModel::doSave", $this))
				{
					$field = $this->FID;
					$this->params[$field] = call_user_func("$this->activeModel::getLastSaved");
					return true;
				} else {
					return false;
				}
			} 
		}
		public function toJSON()
		{
			$return = new StdClass();
			$props = $this->getProperties();
			foreach($props as $prop => $value)
			{
				$return->$prop = utf8_encode($value);
			}
			return $return; 
		}
		public function delete()
		{
			return call_user_func("$this->activeModel::doDelete", $this, $this->activeModel);

		}
	}
?>