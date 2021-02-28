<?php
class ArquivoconteudoModel extends ActiveModel {
	protected static $ActiveObject = "Arquivoconteudo";
	public static $TABLE = "cnt_arquivos_conteudo";
	protected static $fields = array("ARC_ID", "ARC_ORD", "ARC_AID", "ARC_CID", "ARC_CTP", "ARC_TXT", "ARC_TIT", "ARC_STS");
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
	static function getContentRelations($ID, $type)
	{
		$criteria = new FuriousSelectCriteria();
		$criteria->add("`".self::$TABLE."`.`ARC_CID`", $ID, FuriousExpressionsDB::EQUAL);
		$criteria->add("`".self::$TABLE."`.`ARC_CTP`", $type, FuriousExpressionsDB::EQUAL);
		$criteria->add("`".self::$TABLE."`.`ARC_STS`", 1, FuriousExpressionsDB::EQUAL);
		$itens = self::doSelect($criteria);
		return $itens;
	}
}
?>