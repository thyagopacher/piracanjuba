<?php
class CategoriasModel extends ActiveModel {
	protected static $ActiveObject = "Categorias";
	public static $TABLE = "cnt_categorias";
	protected static $fields = array("CAT_ID", "CAT_PAI", "CAT_TIP", "CAT_ORD", "CAT_NOM", "CAT_COR", "CAT_QTD", "CAT_STS", "CAT_DESC", "CAT_TXT", "CAT_TITULO", "CAT_LIVRE");
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
        if(APP_NAME != "backend"){
            $criteria->add("`cnt_categorias`.CAT_TIP", APP_DEFAULT_EDITORIAL, FuriousExpressionsDB::EQUAL);
        }
		return parent::doSelect($criteria, __CLASS__);
	}
}
?>