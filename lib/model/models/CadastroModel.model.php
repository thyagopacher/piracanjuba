<?php
class CadastroModel extends ActiveModel {
	protected static $ActiveObject = "Cadastro";
	public static $TABLE = "cnt_cadastros";
	protected static $fields = array('CAD_ID', 'CAD_NOM', 'CAD_TEL', 'CAD_EST', 'CAD_CID', 'CAD_EMA', 'CAD_PAS', 'CAD_NEW', 'CAD_SEX', 'CAD_CAR', 'CAD_SIT', 'CAD_CPF', 'CAD_RG', 'CAD_DAT', 'CAD_RAM', 'CAD_CNPJ', 'CAD_NIC', 'CAD_TWI', 'CAD_CEL', 'CAD_FAX', 'CAD_TIP', 'CAD_STS');
	
	static function doCount($criteria)
	{
		self::getDatabase();
		$criteria->addFields(array("COUNT(*) as totalNews"));
		$criteria->setTable(self::$TABLE);
		$res = self::$database->executeQuery($criteria);
		$total = self::$database->fetch_object($res);
		return ((int)$total->totalNews);
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