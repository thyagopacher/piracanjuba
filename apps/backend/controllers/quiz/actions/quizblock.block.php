<?php
class QuizBlock extends DefaultBlock
{
	public function quizform($vars = null)
	{
		if(!empty($vars['CONTENT']))
		{
			$this->container = $vars['CONTENT'];
		}
		// Get Questions
		
		$criteria = new FuriousSelectCriteria();
		$criteria->add("`cnt_conteudo_testes_perguntas`.`TSP_TES`", $this->container->getCNTID(), FuriousExpressionsDB::EQUAL);
		$criteria->add("`cnt_conteudo_testes_perguntas`.`TSP_STS`", "1", FuriousExpressionsDB::EQUAL);
		$itens = TestesperguntasModel::doSelect($criteria);
		if(!empty($itens[0]))
		{
			$this->questions = $itens;
		}


		// Get Answers
		$criteria = new FuriousSelectCriteria();
		$criteria->add("`cnt_conteudo_testes_respostas`.`TSR_TES`", $this->container->getCNTID(), FuriousExpressionsDB::EQUAL);
		$criteria->add("`cnt_conteudo_testes_respostas`.`TSR_STS`", "1", FuriousExpressionsDB::EQUAL);
		$itens = TestesrespostasModel::doSelect($criteria);
		if(!empty($itens[0]))
		{
			$this->answers = $itens;
		}

	}
}
?>