<?php
	abstract class ActiveModel {
		static $database;
		static $TABLE = "";
		protected static $fields;
		static function count($criteria, $class)
		{
			//self::getMyName();
			self::getDatabase();
			
			if(!$class){
				$class = get_called_class();
			}
			
			$variables = get_class_vars($class);
			
			$criteria->setTable($variables['TABLE']);
			$criteria->addFields(array(FuriousExpressionsDB::COUNT));
			
			$itens = self::$database->executeQuery($criteria);
	
			
			if(isset($itens) && $itens != false)
			{
				if($itens->num_rows >= 1){
					$row = self::$database->fetch_object($itens);
					return $row->total;
				}
			}
			return false;
		}
		static function getTable()
		{
			return self::$TABLE;
		}
		static function getAll($activeModel)
		{
			$criteria = new FuriousSelectCriteria();
			return self::doSelect($criteria, $activeModel);
		}
		static function getFields($class)
		{
			if(!$class){
				$class = get_called_class();
			}
			
			$variables = get_class_vars($class);
			return $variables["fields"];
		}
		static function getOne($ID, $activeModel)
		{
			$criteria = new FuriousSelectCriteria();
			$field = self::getFields($activeModel);
			$field = $field[0];

			
			$criteria->add("`" . self::$TABLE . "`.`".$field."`", $ID, FuriousExpressionsDB::EQUAL);
			return self::doSelect($criteria, $activeModel);
		}
		protected static function getDatabase()
		{
			if(!isset(self::$database))
			{
				self::$database = Database2::getDB();
			}
			return self::$database;
		}
		/*
		protected static function getFields($modelTable)
		{
			//$className
			/*
			$schema = FuriousSchema::init();
			$fields = $schema->getTable($modelTable);
			
			$fields = self::$fields;
			return $fields;
		}*/
		static function doSelect($criteria, $class = NULL)
		{
			//self::getMyName();
			self::getDatabase();
			if(!$class){
				$class = get_called_class();
			}
			
			$variables = get_class_vars($class);
			
			$criteria->setTable($variables['TABLE']);
			// Get Fields

			$fields = self::getFields($class);
			$fields2 = array();
			foreach($fields as $field)
			{
				$fields2[] = sprintf("%s`.`%s",$variables['TABLE'] ,$field);
			}
			$criteria->addFields($fields2);
			
			
			//print $criteria;
			//die();
			$itens = self::$database->executeQuery($criteria);
			Debugger::$querys[]= array("query"=>(String)$criteria, "assinatura"=>md5((String)$criteria));
			
			if(isset($itens) && $itens != false)
			{
				$get = array();
				if($itens->num_rows > 1){
					while($row = self::$database->fetch_object($itens, $variables['ActiveObject']))
					{
						$get[] = $row;
					}
					return $get;
				} else if ($itens->num_rows <= 1){
					$row = self::$database->fetch_object($itens, $variables['ActiveObject']);
					$get[] = $row;
					return $get;
				} else {
					return false;
				}
			}
			return false;
		}
		static function doPaginatedSelect($criteria, $class = null)
		{
			self::getDatabase();
			
			if (!$class){
			$itens['itens'] = self::doSelect($criteria);
			} else {
			$itens['itens'] = self::doSelect($criteria, $class);
			}
			$criteriaTot = new FuriousSelectCriteria();
			$criteriaTot->addCountRowsReturn();
			
			$total = self::$database->executeQuery($criteriaTot);
			$row = self::$database->fetch_object($total);
				
			$itens['totalItens'] = $row->total;
			
			return $itens;
		}
		static function doSave(ActiveObject $obj, $class = null)
		{
			if(!$class){
				$class = get_called_class();
			}
			
			$values = $obj->getProperties();
			$variables = get_class_vars($class);
			
			$criteria = new FuriousInsertCriteria();
			$criteria->setTable($variables['TABLE']);
			$criteria->addFields($values);
			
			self::getDatabase();


			if(self::$database->executeQuery($criteria))
			{
				
				return true;
			}
			var_dump(self::$database->Error());
			return false;
		}
		static function doUpdate(ActiveObject $obj, $class = null)
		{
			if(!$class){
				$class = get_called_class();
			}
			$values = $obj->getProperties();
			$fieldID = $obj->getIDField();
			
			$id = $values[$fieldID];
			unset($values[$fieldID]);
			
			$variables = get_class_vars($class);
			
			
			$field = self::getFields($class);
			$field = $field[0];
			
			$criteria = new FuriousUpdateCriteria();
			$criteria->setTable($variables['TABLE']);
			$criteria->addFields($values);
			$criteria->add("`{$variables['TABLE']}`.`".$field."`", $id, FuriousExpressionsDB::EQUAL);
			$criteria->setLimit(1);
			
			self::getDatabase();
			//echo ($criteria);
			if(self::$database->executeQuery($criteria))
			{
				return true;
			}
			var_dump(self::$database->Error());
			return false;
		}
		static function doDelete(ActiveObject $obj, $class = null)
		{
			if(!$class){
				$class = get_called_class();
			}
			
			$variables = get_class_vars($class);
			
			$values = $obj->getProperties();
			$fieldID = $obj->getIDField();
			$id = $values[$fieldID];
			
			$criteria = new FuriousDeleteCriteria();
			
			$field = self::getFields($class);
			$field = $field[0];
			
			$criteria->addFields(array("`{$variables['TABLE']}`.`".$field."`"));
			$criteria->setTable($variables['TABLE']);
			//$criteria->addFields(array($variables['']));
			$criteria->add("`{$variables['TABLE']}`.`".$field."`", $id, FuriousExpressionsDB::EQUAL);
			$criteria->setLimit(1);

			self::getDatabase();
			if(self::$database->executeQuery($criteria))
			{
				return true;
			} else {

				return false;
			}
		}

		static function getLastSaved()
		{
			self::getDatabase();
			$lastId = self::$database->lastInsertId();
			
			return $lastId;
			
		}
	}
?>