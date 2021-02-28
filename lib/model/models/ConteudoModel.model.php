<?php
class ConteudoModel extends ActiveModel {
	protected static $ActiveObject = "Conteudo";
	public static $TABLE = "cnt_conteudo";
	protected static $fields = array("CNT_ID", "CNT_SIT", "CNT_IPR", "CNT_TIP", "CNT_DTA", "CNT_TIS", "CNT_TIT", "CNT_OLH", "CNT_TXT", "CNT_RES", "CNT_FT1", "CNT_FT1_", "CNT_RDT", "CNT_EMA", "CNT_CHV", "CNT_CMT", "CNT_CMD", "CNT_CKY", "CNT_TAG", "CNT_CAT", "CNT_ENQ", "CNT_CTT", "CNT_PAI", "CNT_EST", "CNT_STS", "CNT_NOT", "CNT_VOT", "CNT_EMB");

	static function doCount($criteria)
	{
		self::getDatabase();
		$criteria->addFields(array("COUNT(*) as totalNews"));
		$criteria->setTable(self::$TABLE);
		$res = self::$database->executeQuery($criteria);
		if($res)
		{
			$total = self::$database->fetch_object($res);
			return ((int)$total->totalNews);
		}
		return 0;
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
		if(APP_NAME != "backend"){
			$criteria->add("`cnt_conteudo`.`CNT_SIT`", APP_DEFAULT_EDITORIAL, FuriousExpressionsDB::EQUAL);
		}
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
			$criteria->add("`cnt_conteudo`.`CNT_SIT`", APP_DEFAULT_EDITORIAL, FuriousExpressionsDB::EQUAL);
		}
		return parent::doSelect($criteria, __CLASS__);
	}
}
?>
