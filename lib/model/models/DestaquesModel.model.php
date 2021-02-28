<?php
class DestaquesModel extends ActiveModel {
	protected static $ActiveObject = "Destaques";
	public static $TABLE = "cnt_destaques";
	protected static $fields = array("DTQ_ID","DTQ_SIT", "DTQ_CID", "DTQ_ORD", "DTQ_MNU", "DTQ_TIP", "DTQ_EDT", "DTQ_CNL", "DTQ_TIT", "DTQ_TXT", "DTQ_IMG", "DTQ_LNK", "DTQ_TGT", "DTQ_INI", "DTQ_FIM", "DTQ_ILI", "DTQ_STS", "DTQ_LTX", "DTQ_IRE", "DTQ_CAT",  "DTQ_LN2", "DTQ_DTP", "DTQ_DTA", "DTQ_EMB", "DTQ_EMB2");
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
			$criteria->add("`cnt_destaques`.`DTQ_SIT`", APP_DEFAULT_EDITORIAL, FuriousExpressionsDB::EQUAL);
		}
		return parent::doSelect($criteria, __CLASS__);
	}
}
?>
