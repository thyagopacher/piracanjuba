<?php
class TestesperguntasModel extends ActiveModel {
	protected static $ActiveObject = "Testesperguntas";
	public static $TABLE = "cnt_conteudo_testes_perguntas";
	protected static $fields = array("TSP_ID", "TSP_IPR", "TSP_TES", "TSP_ORD", "TSP_TIT", "TSP_TXT", "TSP_FT1", "TSP_AL1", "TSP_AL2", "TSP_AL3", "TSP_AL4", "TSP_AL5", "TSP_AL6", "TSP_AL7", "TSP_AL8", "TSP_AL9", "TSP_AL0", "TSP_PT1", "TSP_PT2", "TSP_PT3", "TSP_PT4", "TSP_PT5", "TSP_PT6", "TSP_PT7", "TSP_PT8", "TSP_PT9", "TSP_PT0", "TSP_STS");
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