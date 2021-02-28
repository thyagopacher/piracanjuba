<?php
class QuizController extends DefaultBackEnd2Controller
{
	const THUMB_TYPE = "THB_CNT";
	public function index($vars = null)
	{
		$this->pageTitle = "{List Quiz}";
		
		$this->breadCrumb = array("/quiz/index.php" => "{Quiz}");
		
		$criteria = new FuriousSelectCriteria();
		$criteria->add("`cnt_conteudo`.`CNT_TIP`", "QZ", FuriousExpressionsDB::EQUAL);
		$criteria->add("`cnt_conteudo`.`CNT_STS`", 9, FuriousExpressionsDB::NOT_EQUAL);
		$criteria->add("`cnt_conteudo`.`CNT_STS`", 8, FuriousExpressionsDB::NOT_EQUAL);
		$criteria->add("`cnt_conteudo`.`CNT_IPR`", $this->EditorialID, FuriousExpressionsDB::EQUAL);
		$criteria->addDescendingOrder("`cnt_conteudo`.`CNT_DTA`");
		
		$this->applyFilters($criteria, "`cnt_conteudo`.`CNT_STS`", "`cnt_conteudo`.`CNT_TIT`");
		
		$this->doPagination("QuizModel", "itens", $criteria, $vars);
	}
	public function novo($vars = null)
	{
		if(!empty($_GET['ID']))
		{
			$content = QuizModel::getOne(((int)$_GET['ID']));
			if(!empty($content[0]))
			{
				$this->content = $content[0];
			}
			
		}
		if(empty($this->content))
		{
			$this->content = new Quiz();
			$this->content->CNT_TIP = "QZ";
			$this->content->CNT_STS = 8;
			$this->content->CNT_DTA = date("Y-m-d H:i:s");
			$this->content->save();
		}
		if(Dispatcher::getPostValues("quiz"))
		{
			$values = Dispatcher::getPostValues("quiz");
			
			$values["CNT_DTA"] = date("Y-m-d H:i:s",strtotime(str_replace("/", "-", $values["CNT_DTA"])));
			
			$questions = array();
			$answers = array();
			$edts = array();
			$tags = array();
			$links = array();
			$imgNews = "";
			
			if(!empty($values['questions']))
			{
				$questions = $values['questions'];
				unset($values['questions']);
			}
			if(!empty($values['answers']))
			{
				$answers = $values['answers'];
				unset($values['answers']);
			}
			if(!empty($values["EDT_CATS"]))
			{
				$edts = $values["EDT_CATS"];
				unset($values["EDT_CATS"]);
			}
			if(!empty($values["cnt_tags"]))
			{
				$tags = $values["cnt_tags"];
				unset($values["cnt_tags"]);
			}
			
			if(isset($values["IMG_DTQ"]))
			{
				$imgNews = $values["IMG_DTQ"];
				unset($values["IMG_DTQ"]);
			}
			
			// Save Noticia
			$this->content->CNT_CMT = 0;
			foreach($values as $key => $value)
			{
				$this->content->$key = $value;
			}
			
			if(!$this->content->save())
			{
				$this->Errors = "{Save Error, try later}";
			} else {
				$this->Message = "{News Saved}";
			}
			
			// Get Noticia ID
			$ID = $this->content->getCNTID();
			
			if(!empty($edts[0]))
			{
				// Update Editorial Relations
				$this->updateEdtsRelations($ID, $edts);
			}
			if(!empty($tags[0]))
			{
				// Update Tags Relations
				$this->updateTagsRelations($ID, $tags);
			}
			if(!empty($links[0]))
			{
				// Update Links Relations
				$this->updateLinksRelations($ID, $links);
			}
			// Save Image Relation
			if(!empty($imgNews))
			{
				$this->updateImageRelation($ID, $imgNews, self::THUMB_TYPE);
			}
			// Remove Questions
			$this->content->removeQuestions();
			if(!empty($questions['questionName'][0]))
			{
				$questionsTit = $questions['questionName'];
				unset($questions['questionName']);
				
				$i = 0;
				
				foreach($questions as $key => $arr)
				{
					$quest = new Testesperguntas();
					$quest->TSP_IPR = $this->EditorialID;
					$quest->TSP_TES = $ID;
					$quest->TSP_TIT = $questionsTit[$i];
					$x = count($arr);
					foreach($arr as $z => $nom)
					{
						$alNom = "TSP_AL".$z;
						$quest->$alNom = $nom;
						
						$alNom2 = "TSP_PT".$z;
						$quest->$alNom2 = $x;
						
						$x--;
					}
					$quest->TSP_STS = 1;
					$quest->save();
					$i++;
				}
			}
			
			
			// Remove Answers
			$this->content->removeAnswers();
			
			
			
			// Save Featured
			$this->createFeatureds($this->content);
			$total = count($answers);
			$notas = ceil(10/$total);
			
			$note = 10; 
			
			foreach($answers as $ans)
			{
				$answ = new Testesrespostas();
				$answ->TSR_IPR = $this->EditorialID;
				$answ->TSR_TES = $ID;
				$answ->TSR_FIM = $note;

				$note -= $notas;

				$answ->TSR_INI = ($note < 0)?0:$note;
				
				$answ->TSR_STS = 1;
				$answ->TSR_TIT = $ans;
				$answ->save();
			}
			
			
			//$this->content->generateJSON();
			//$this->content->generateJsonLists();
		}
		$this->action = $this->Editorial->getURL()."quiz/edit.php?ID=".($this->content->getCNTID());
	}
}
?>