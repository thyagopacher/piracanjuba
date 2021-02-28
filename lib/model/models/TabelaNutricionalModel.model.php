<?php
class TabelaNutricionalModel extends ActiveModel {
	protected static $ActiveObject = "TabelaNutricional";
	public static $TABLE = "tabela_nutricional";
	protected static $fields = array("id", "produto_id", "valor_energetico", "valor_por_porcao", "quantidade_porcao", "porcentagem_por_porcao", "status");
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
		$criteria->add("`".self::$TABLE."`.`produto_id`", $ID, FuriousExpressionsDB::EQUAL);
		$itens = self::doSelect($criteria);
		return $itens;
	}
}
?>