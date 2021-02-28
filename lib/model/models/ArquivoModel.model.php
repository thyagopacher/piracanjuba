<?php
class ArquivoModel extends ActiveModel {
	protected static $ActiveObject = "Arquivo";
	public static $TABLE = "cnt_arquivos";
	protected static $fields = array("ARQ_ID", "ARQ_EXT", "ARQ_NOM", "ARQ_STS", "ARQ_DTA", "ARQ_DIR");
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