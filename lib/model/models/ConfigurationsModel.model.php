<?php
class ConfigurationsModel extends ActiveModel {
	protected static $ActiveObject = "Configurations";
	public static $TABLE = "w11_configurations";
	protected static $fields = array("id", "name", "value", "status");
	static function getConfig($configName)
	{
		$criteria = new FuriousSelectCriteria();
		$criteria->add("`w11_configurations`.`name`", addslashes($configName), FuriousExpressionsDB::EQUAL);
		$criteria->add("`w11_configurations`.`status`", 1, FuriousExpressionsDB::EQUAL);
		$criteria->setLimit(1);
		$configs = self::doSelect($criteria);
		if(!empty($configs[0]))
		{
			return $configs[0];
		}
		return false;
	}
	static function doDelete(ActiveObject $obj, $class = null)
	{
		return parent::doDelete($obj, __CLASS__);
	}
	static function doUpdate(ActiveObject $obj, $class = null)
	{
		return parent::doUpdate($obj, __CLASS__);
	}
	static function doSave(ActiveObject $obj, $class = null)
	{
		return parent::doSave($obj, __CLASS__);
	}
	static function doPaginatedSelect($criteria, $class = null){
		return parent::doPaginatedSelect($criteria, __CLASS__);
	}
	static function getAll($activeModel = null) {
		return parent::getAll(__CLASS__);
	}
	static function getOne($ID, $activeModel = null) {
		return parent::getOne($ID, __CLASS__);
	}
	static function doSelect($criteria, $class = null){
		return parent::doSelect($criteria, __CLASS__);
	}
}
?>