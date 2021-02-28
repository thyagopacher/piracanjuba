<?php
class CategoriaconteudoModel extends ActiveModel {
	protected static $ActiveObject = "Categoriaconteudo";
	public static $TABLE = "cnt_categorias_conteudos";
	protected static $fields = array("CCL_ID", "CCL_CNT", "CCL_CAT", "CCL_TIP", "CCL_STS");
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
		$criteria->add("`".self::$TABLE."`.`CCL_CNT`", $ID, FuriousExpressionsDB::EQUAL);
		$criteria->add("`".self::$TABLE."`.`CCL_STS`", 1, FuriousExpressionsDB::EQUAL);
		$itens = self::doSelect($criteria);
		return $itens;
	}
	static function getContentTipoRelations($ID, $tipo)
	{
		$criteria = new FuriousSelectCriteria();
		$criteria->add("`".self::$TABLE."`.`CCL_CNT`", $ID, FuriousExpressionsDB::EQUAL);
		$criteria->add("`".self::$TABLE."`.`CCL_STS`", 1, FuriousExpressionsDB::EQUAL);
		$criteria->add("`".self::$TABLE."`.`CCL_TIP`", $tipo, FuriousExpressionsDB::EQUAL);
		$itens = self::doSelect($criteria);
		return $itens;
	}
}
?>