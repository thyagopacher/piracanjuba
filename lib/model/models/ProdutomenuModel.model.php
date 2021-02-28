<?php
class ProdutomenuModel extends ActiveModel {
	protected static $ActiveObject = "Produtomenu";
	public static $TABLE = "w11_produto_menu";
	protected static $fields = array("MNU_ID", "MNU_IPR", "MNU_ORD", "MNU_GRP", "MNU_TIT", "MNU_TIP", "MNU_LNK", "MNU_URL", "MNU_ADM", "MNU_CHP", "MNU_EDT", "MNU_TXT", "MNU_WRD", "MNU_IMG", "MNU_IMG2", "MNU_LIN", "MNU_LN2", "MNU_TGT", "MNU_FTW", "MNU_FTR", "MNU_STS", "MNU_LTX", "MNU_IRE", "MNU_CAT", "MNU_DTP", "MNU_DRE", "MNU_DTA", "MNU_PRG", "MNU_IMG3", "MNU_EMB1", "MNU_EMB2");
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