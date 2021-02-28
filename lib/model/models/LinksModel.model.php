<?php
class LinksModel extends ActiveModel {
	protected static $ActiveObject = "Links";
	public static $TABLE = "cnt_conteudo_link";
	protected static $fields = array("LNK_ID", "LNK_IPR", "LNK_CNT", "LNK_TIP", "LNK_TIT", "LNK_LNK", "LNK_STS");
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
		$criteria->add("`".self::$TABLE."`.`LNK_CNT`", $ID, FuriousExpressionsDB::EQUAL);
		$criteria->add("`".self::$TABLE."`.`LNK_STS`", 1, FuriousExpressionsDB::EQUAL);
		$itens = self::doSelect($criteria);
		return $itens;
	}
}
?>