<?php
class TagconteudoModel extends ActiveModel {
	protected static $ActiveObject = "Tagconteudo";
	public static $TABLE = "cnt_conteudo_tag";
	protected static $fields = array("CTA_ID", "CTA_CNT", "CTA_TAG", "CTA_STS");
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
	static function getContentRelations($ID)
	{
		$criteria = new FuriousSelectCriteria();
		$criteria->add("`".self::$TABLE."`.`CTA_CNT`", $ID, FuriousExpressionsDB::EQUAL);
		$criteria->add("`".self::$TABLE."`.`CTA_STS`", 1, FuriousExpressionsDB::EQUAL);
		$itens = self::doSelect($criteria);
		return $itens;
	}
}
?>