<?php
class EnqueteModel extends ActiveModel {
	protected static $ActiveObject = "Enquete";
	public static $TABLE = "enquetes";
	protected static $fields = array("id", "site_id", "name", "value1", "value2", "value3", "value4", "value5", "voto1", "voto2", "voto3", "voto4", "voto5", "file_id", "status");
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