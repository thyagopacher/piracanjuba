<?php
class Sevengame extends Conteudo
{
	protected $activeModel = "SevengameModel";
	protected $FID = "CNT_ID";
	protected $imgs;
	protected $img1;
	protected $img2;
	//public $fotos = array();
	
	public function getGameErrors(){
		$criteria = new FuriousSelectCriteria();
		$criteria->add("`cnt_conteudo_7erros`.`ER7_CNT`", $this->getCNTID(), FuriousExpressionsDB::EQUAL);
		$criteria->add("`cnt_conteudo_7erros`.`ER7_STS`", "1", FuriousExpressionsDB::EQUAL);
		$it = SevenerrorsModel::doSelect($criteria);
		if(!empty($it[0]))
		{
			$this->imgs = $it[0];
		}
	}
	public function getIMG1()
	{
		if(empty($this->imgs))
		{
			$this->getGameErrors();
		}
		if(!empty($this->imgs))
		{
			$img = ArquivoModel::getOne($this->imgs->getER7IMG1());
			if(!empty($img[0]))
			{
				$this->img1 = $img[0];
				return $this->img1;
			}
		}
		
		return false;
	}
	public function getIMG2()
	{
		if(empty($this->imgs))
		{
			$this->getGameErrors();
		}
		if(!empty($this->imgs))
		{
			$img = ArquivoModel::getOne($this->imgs->getER7IMG2());
			if(!empty($img[0]))
			{
				$this->img2 = $img[0];
				return $this->img2;
			}
		}
		
		return false;
	}
	public function getGame()
	{
		if(empty($this->imgs))
		{
			$this->getGameErrors();
		}
		return $this->imgs;
	}
	public function toJSON()
	{
		$ret = new StdClass();
		foreach($this->getProperties() as $prop => $value)
		{
			$ret->$prop = utf8_encode($value);
		}
		// Imagem 1
		$img1 = $this->getIMG1();
		$ret->img1 = $img1->toJSON();
		// Imagem 2
		$img2 = $this->getIMG2();
		$ret->img2 = $img2->toJSON();
		
		$game = $this->getGame();
		
		
		$fto = $this->getDTQFTO();
		if($fto != false)
		{
			$ret->thb_fto = $fto->toJSON();
		}
		
		
		for($i=1; $i<=7; $i++)
		{
			$prop = "coord".$i; 
			$prop2 = "getER7CO".$i;
			$ret->$prop = utf8_encode($game->$prop2());
		}
		
		return $ret;
	}
	
	public function generateJSON()
	{
		$t = $this->toJSON();
		$id = $this->getCNTID();
		$dir = Document::renderDirStructure($id, APP_JSON_PATH);
		if($dir != false)
		{
			return Document::writeFile($dir."CNT_".($id).".json", json_encode($t));
		}
		return false;
	}
	public function generateJsonLists()
	{
		 
		$siteID = APP_DEFAULT_EDITORIAL;
		
		
		$criteria = new FuriousSelectCriteria();
		$criteria->add("`cnt_conteudo`.`CNT_TIP`", "7E", FuriousExpressionsDB::EQUAL);
		$criteria->add("`cnt_conteudo`.`CNT_SIT`", $siteID, FuriousExpressionsDB::EQUAL);
		$criteria->add("`cnt_conteudo`.`CNT_IPR`", $siteID, FuriousExpressionsDB::EQUAL);
		$criteria->add("`cnt_conteudo`.`CNT_STS`", 1, FuriousExpressionsDB::EQUAL);
		$itens = SevengameModel::doSelect($criteria);
		$ret = new StdClass();
		$ret->items = array();
		if(!empty($itens[0]))
		{
			foreach($itens as $item)
			{
				$ret->items[] = $item->toJSONLimited();
			}
		}		
		return Document::writeFile(APP_JSON_PATH."/SITE_{$siteID}_7E.json", json_encode($ret));
		
	}
}
?>