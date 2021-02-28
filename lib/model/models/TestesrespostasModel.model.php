<?php
class TestesrespostasModel extends ActiveModel {
	protected static $ActiveObject = "Testesrespostas";
	public static $TABLE = "cnt_conteudo_testes_respostas";
	protected static $fields = array("TSR_ID", "TSR_IPR", "TSR_TES", "TSR_INI", "TSR_FIM", "TSR_TIT", "TSR_TXT", "TSR_FT1", "TSR_STS");
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