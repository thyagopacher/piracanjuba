<?php
class SevenerrorsModel extends ActiveModel {
	protected static $ActiveObject = "Sevenerrors";
	public static $TABLE = "cnt_conteudo_7erros";
	protected static $fields = array("ER7_ID", "ER7_CNT", "ER7_IMG1", "ER7_IMG2", "ER7_CO1", "ER7_CO2", "ER7_CO3", "ER7_CO4", "ER7_CO5", "ER7_CO6", "ER7_CO7", "ER7_STS");
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