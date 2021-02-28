<?php
class MensagensModel extends ActiveModel {
	protected static $ActiveObject = "Mensagens";
	public static $TABLE = "cnt_conteudo_msg";
	protected static $fields = array("MSG_ID", "MSG_IPR", "MSG_CNT", "MSG_NOM", "MSG_EMA", "MSG_TIT", "MSG_TXT", "MSG_RSP", "MSG_DTA", "MSG_STS", "MSG_NOT", "MSG_CTI");
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