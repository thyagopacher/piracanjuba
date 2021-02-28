<?php
class Quiz extends Conteudo {
	protected $activeModel = "QuizModel";
	protected $FID = "CNT_ID";
	protected $questions, $answers;
	public function removeQuestions()
	{

		$ID = $this->getID();
		
		$criteria = new FuriousSelectCriteria();
		$criteria->add("`cnt_conteudo_testes_perguntas`.`TSP_TES`", $ID, FuriousExpressionsDB::EQUAL);
		$criteria->add("`cnt_conteudo_testes_perguntas`.`TSP_STS`", "1", FuriousExpressionsDB::EQUAL);
		$itens = TestesperguntasModel::doSelect($criteria);
		if(!empty($itens[0]))
		{
			foreach($itens as $item)
			{
				if(!$item->delete())
				{
					echo "Error";
					return false;
				}
				
			}
		}
	}
	public function removeAnswers()
	{
		$ID = $this->getID();
		
		$criteria = new FuriousSelectCriteria();
		$criteria->add("`cnt_conteudo_testes_respostas`.`TSR_TES`", $ID, FuriousExpressionsDB::EQUAL);
		$criteria->add("`cnt_conteudo_testes_respostas`.`TSR_STS`", "1", FuriousExpressionsDB::EQUAL);
		$itens = TestesrespostasModel::doSelect($criteria);
		if(!empty($itens[0]))
		{
			foreach($itens as $item)
			{
				$item->delete();
			}
		}
	}
	public function getAnswers()
	{
		if(!empty($this->answers))
		{
			return $this->answers;
		}
		$ID = $this->getID();
			
		$criteria = new FuriousSelectCriteria();
		$criteria->add("`cnt_conteudo_testes_respostas`.`TSR_TES`", $ID, FuriousExpressionsDB::EQUAL);
		$criteria->add("`cnt_conteudo_testes_respostas`.`TSR_STS`", "1", FuriousExpressionsDB::EQUAL);
		$itens = TestesrespostasModel::doSelect($criteria);
		if(!empty($itens[0]))
		{
			$this->answers = $itens;
		}
		return $this->answers;
	}
	public function getQuestions()
	{
		if(!empty($this->questions))
		{
			return $this->questions;
		}
		$ID = $this->getID();
			
		$criteria = new FuriousSelectCriteria();
		$criteria->add("`cnt_conteudo_testes_perguntas`.`TSP_TES`", $ID, FuriousExpressionsDB::EQUAL);
		$criteria->add("`cnt_conteudo_testes_perguntas`.`TSP_STS`", "1", FuriousExpressionsDB::EQUAL);
		$itens = TestesperguntasModel::doSelect($criteria);
		if(!empty($itens[0]))
		{
			$this->questions = $itens;
		}
		return $this->questions;
	}
	public function toJSON()
	{
		$t = parent::toJSON();
		
		$fto = $this->getDTQFTO();
		if($fto != false)
		{
			$t->thb_fto = $fto->toJSON();
		}
		// Answers
		$ans = $this->getAnswers();
		if(!empty($ans[0]))
		{
			$t->answers = array();
			foreach($ans as $a)
			{
				$t->answers[] = $a->toJSON();
			}
		}
		
		// Questions
		$ques = $this->getQuestions();
		if(!empty($ques[0]))
		{
			$t->questions = array();
			foreach($ques as $q)
			{
				$t->questions[] = $q->toJSON();
			}
		}
		
		return $t;
	}
	public function generateJSON()
	{
		$t = $this->toJSON();
		$id = $this->getCNTID();
		$dir = Document::renderDirStructure($id, "json");
		if($dir != false)
		{
			return Document::writeFile($dir."CNT_".($id).".json", json_encode($t));
		}
		return false;
	}
	public function generateJsonLists()
	{
		
		$site = ProdutoModel::getOne($this->getCNTIPR());
		if(!empty($site[0]))
		{
			$site = $site[0];
			$site = $site->getSite();
			$siteID = $site->getPDTID();
		} 
		
		$criteria = new FuriousSelectCriteria();
		$criteria->add("`cnt_conteudo`.`CNT_TIP`", "QZ", FuriousExpressionsDB::EQUAL);
		$criteria->add("`cnt_conteudo`.`CNT_IPR`", $this->getCNTIPR(), FuriousExpressionsDB::EQUAL);
		$criteria->add("`cnt_conteudo`.`CNT_STS`", 1, FuriousExpressionsDB::EQUAL);
		$itens = QuizModel::doSelect($criteria);
		$ret = new StdClass();
		$ret->items = array();
		if(!empty($itens[0]))
		{
			foreach($itens as $item)
			{
				$ret->items = $item->toJSONLimited();
			}
		}
		
		return Document::writeFile("json/SITE_{$siteID}_QZ.json", json_encode($ret));
		
	}
}
?>