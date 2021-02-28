<?php
class ProdutoModel extends ActiveModel {
	protected static $ActiveObject = "Produto";
	public static $TABLE = "w11_produto";
	protected static $fields = array("PDT_ID", "PDT_PAI", "PDT_ORD", "PDT_ICO", "PDT_NOM", "PDT_TIT", "PDT_DES", "PDT_KEY", "PDT_URL", "PDT_RSS", "PDT_OMN", "PDT_STS");
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