<?php
class UsuarioModel extends ActiveModel {
	protected static $ActiveObject = "Usuario";
	public static $TABLE = "w11_usuario";
	protected static $fields = array("USU_ID", "USU_GRP", "USU_NOM", "USU_EMA", "USU_DPT", "USU_LOG", "USU_SEN", "USU_TIP", "USU_STS", "USU_FB", "USU_FBIM");
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