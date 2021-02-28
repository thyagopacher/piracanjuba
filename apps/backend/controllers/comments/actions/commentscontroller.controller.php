<?php
class CommentsController extends DefaultBackEnd2Controller
{
	public function index($vars = null)
	{
		$this->pageTitle = "{List Comments}";

		$this->breadCrumb = array("/comments/index.php" => "{Comments}");

		if(Dispatcher::getPostValues("index"))
		{
			$this->errors = array();

			$values = Dispatcher::getPostValues("index");
			if(!empty($_POST["actions"]))
			{
				$act = ($_POST["actions"] == "delete")?"delete":"";
				foreach($values as $id => $val)
				{
					if(!empty($act))
					{
						$item = ComentariosModel::getOne(((int)$id));
						if(!empty($item[0]))
						{
							$item = $item[0];
							if(!$item->$act())
							{
								$this->errors[] = "{Error saving comment ID}: {$id}";
							}
						}
					}
				}
			}
			if(count($this->errors) < count($values))
			{
				$this->msg = "{Saved Successfully}";
			}

		}

		if(!empty($_GET["ID"]))
		{
			$id = addslashes($_GET["ID"]);
			$news = NoticiaModel::getOne(((int)$id));
			if(!empty($news[0]))
			{
				$this->news = $news[0];
			}
		}

		$criteria = new FuriousSelectCriteria();
		if(!empty($this->news))
		{
			$criteria->addJoin(FuriousExpressionsDB::LEFT_JOIN, "`cnt_conteudo`", "`cnt_conteudo`.`CNT_ID`", "`cnt_conteudo_msg`.`MSG_CNT`");
			$criteria->add("`cnt_conteudo_msg`.`MSG_CNT`", $id, FuriousExpressionsDB::EQUAL);
		}
		if(empty($_GET['excluded']))
		{
			$criteria->add("`cnt_conteudo_msg`.`MSG_STS`", 9, FuriousExpressionsDB::NOT_EQUAL);
		} else {
			$criteria->add("`cnt_conteudo_msg`.`MSG_STS`", 9, FuriousExpressionsDB::EQUAL);
		}
		if(empty($_GET['spam']))
		{
			$criteria->add("`cnt_conteudo_msg`.`MSG_STS`", 8, FuriousExpressionsDB::NOT_EQUAL);
		} else {
			$criteria->add("`cnt_conteudo_msg`.`MSG_STS`", 8, FuriousExpressionsDB::EQUAL);
		}

		//$criteria->add("`cnt_conteudo_msg`.`MSG_STS`", 8, FuriousExpressionsDB::NOT_EQUAL);

		//$criteria->add("`cnt_conteudo_msg`.`CNT_IPR`", $this->EditorialID, FuriousExpressionsDB::EQUAL);
		$criteria->addDescendingOrder("`cnt_conteudo_msg`.`MSG_DTA`");
		$criteria->add("`cnt_conteudo_msg`.`MSG_CNT`", 19480, FuriousExpressionsDB::NOT_EQUAL);
		$criteria->add("`cnt_conteudo_msg`.`MSG_CNT`", 67, FuriousExpressionsDB::NOT_EQUAL);
		$criteria->add("`cnt_conteudo_msg`.`MSG_CNT`", 68, FuriousExpressionsDB::NOT_EQUAL);
		$criteria->add("`cnt_conteudo_msg`.`MSG_IPR`", $this->Site->getPDTID(), FuriousExpressionsDB::EQUAL);

		$this->applyFilters($criteria, "`cnt_conteudo_msg`.`MSG_STS`", "`cnt_conteudo_msg`.`MSG_TIT`");

		// Generate Page
		$this->doPagination("ComentariosModel", "itens", $criteria, $vars, 50);


		// Approved Comments Total
		$criteria = new FuriousSelectCriteria();
		$criteria->addJoin(FuriousExpressionsDB::LEFT_JOIN, "`cnt_conteudo`", "`cnt_conteudo`.`CNT_ID`", "`cnt_conteudo_msg`.`MSG_CNT`");
		if(!empty($this->news))
		{
			$criteria->addJoin(FuriousExpressionsDB::LEFT_JOIN, "`cnt_conteudo`", "`cnt_conteudo`.`CNT_ID`", "`cnt_conteudo_msg`.`MSG_CNT`");
			$criteria->add("`cnt_conteudo_msg`.`MSG_CNT`", $id, FuriousExpressionsDB::EQUAL);
		}
		$criteria->add("`cnt_conteudo_msg`.`MSG_CNT`", 19480, FuriousExpressionsDB::NOT_EQUAL);
		$criteria->add("`cnt_conteudo_msg`.`MSG_CNT`", 67, FuriousExpressionsDB::NOT_EQUAL);
		$criteria->add("`cnt_conteudo_msg`.`MSG_CNT`", 68, FuriousExpressionsDB::NOT_EQUAL);
		$criteria->add("`cnt_conteudo_msg`.`MSG_STS`", 1, FuriousExpressionsDB::EQUAL);
		$criteria->add("`cnt_conteudo_msg`.`MSG_IPR`", $this->Site->getPDTID(), FuriousExpressionsDB::EQUAL);
		$this->approvedTotal = ComentariosModel::count($criteria);

		// Pendant Comments Total
		$criteria = new FuriousSelectCriteria();
		$criteria->addJoin(FuriousExpressionsDB::LEFT_JOIN, "`cnt_conteudo`", "`cnt_conteudo`.`CNT_ID`", "`cnt_conteudo_msg`.`MSG_CNT`");
		if(!empty($this->news))
		{
			$criteria->addJoin(FuriousExpressionsDB::LEFT_JOIN, "`cnt_conteudo`", "`cnt_conteudo`.`CNT_ID`", "`cnt_conteudo_msg`.`MSG_CNT`");
			$criteria->add("`cnt_conteudo_msg`.`MSG_CNT`", $id, FuriousExpressionsDB::EQUAL);
		}
		$criteria->add("`cnt_conteudo_msg`.`MSG_CNT`", 19480, FuriousExpressionsDB::NOT_EQUAL);
		$criteria->add("`cnt_conteudo_msg`.`MSG_CNT`", 67, FuriousExpressionsDB::NOT_EQUAL);
		$criteria->add("`cnt_conteudo_msg`.`MSG_CNT`", 68, FuriousExpressionsDB::NOT_EQUAL);
		$criteria->add("`cnt_conteudo_msg`.`MSG_IPR`", $this->Site->getPDTID(), FuriousExpressionsDB::EQUAL);
		$criteria->add("`cnt_conteudo_msg`.`MSG_STS`", 0, FuriousExpressionsDB::EQUAL);
		$this->pendantTotal = ComentariosModel::count($criteria);

		// Excluded Comments Total
		$criteria = new FuriousSelectCriteria();
		$criteria->addJoin(FuriousExpressionsDB::LEFT_JOIN, "`cnt_conteudo`", "`cnt_conteudo`.`CNT_ID`", "`cnt_conteudo_msg`.`MSG_CNT`");
		if(!empty($this->news))
		{
			$criteria->addJoin(FuriousExpressionsDB::LEFT_JOIN, "`cnt_conteudo`", "`cnt_conteudo`.`CNT_ID`", "`cnt_conteudo_msg`.`MSG_CNT`");
			$criteria->add("`cnt_conteudo_msg`.`MSG_CNT`", $id, FuriousExpressionsDB::EQUAL);
		}
		$criteria->add("`cnt_conteudo_msg`.`MSG_CNT`", 19480, FuriousExpressionsDB::NOT_EQUAL);
		$criteria->add("`cnt_conteudo_msg`.`MSG_CNT`", 67, FuriousExpressionsDB::NOT_EQUAL);
		$criteria->add("`cnt_conteudo_msg`.`MSG_CNT`", 68, FuriousExpressionsDB::NOT_EQUAL);
		$criteria->add("`cnt_conteudo_msg`.`MSG_IPR`", $this->Site->getPDTID(), FuriousExpressionsDB::EQUAL);
		$criteria->add("`cnt_conteudo_msg`.`MSG_STS`", 9, FuriousExpressionsDB::EQUAL);
		$this->excludedTotal = ComentariosModel::count($criteria);

		// Spam Comments Total
		$criteria = new FuriousSelectCriteria();
		$criteria->addJoin(FuriousExpressionsDB::LEFT_JOIN, "`cnt_conteudo`", "`cnt_conteudo`.`CNT_ID`", "`cnt_conteudo_msg`.`MSG_CNT`");
		if(!empty($this->news))
		{
			$criteria->addJoin(FuriousExpressionsDB::LEFT_JOIN, "`cnt_conteudo`", "`cnt_conteudo`.`CNT_ID`", "`cnt_conteudo_msg`.`MSG_CNT`");
			$criteria->add("`cnt_conteudo_msg`.`MSG_CNT`", $id, FuriousExpressionsDB::EQUAL);
		}
		$criteria->add("`cnt_conteudo_msg`.`MSG_CNT`", 19480, FuriousExpressionsDB::NOT_EQUAL);
		$criteria->add("`cnt_conteudo_msg`.`MSG_CNT`", 67, FuriousExpressionsDB::NOT_EQUAL);
		$criteria->add("`cnt_conteudo_msg`.`MSG_CNT`", 68, FuriousExpressionsDB::NOT_EQUAL);
		//$criteria->add("`cnt_conteudo_msg`.`MSG_IPR`", $this->Site->getPDTID(), FuriousExpressionsDB::EQUAL);

		$criteria->add("`cnt_conteudo_msg`.`MSG_STS`", 8, FuriousExpressionsDB::EQUAL);
		$this->spamTotal = ComentariosModel::count($criteria);

	}
	public function approve($vars = null)
	{
		if(!empty($_GET['ID']))
		{
			$msg = ComentariosModel::getOne(addslashes((int)$_GET['ID']));
			if(!empty($msg[0]))
			{
				$msg = $msg[0];
				if($msg->approve())
				{
					//Dispatcher::forwardRaw(Dispatcher::generateEditorialURL(array("comments", "index")));

					$msgCNT = $msg->getMSGCNT();

					$news = ConteudoModel::getOne($msgCNT);
					if(!empty($news[0]))
					{
						$news = $news[0];
						$cntTip = $news->getCNTTIP();
						switch($cntTip)
						{
							case "NT":
								$news = NoticiaModel::getOne($msgCNT);
								if(!empty($news[0])):
									$news = $news[0];
									$news->generateJSON();
								endif;
							break;
							case "GA":
								$news = GaleriaModel::getOne($msgCNT);
								if(!empty($news[0])):
									$news  = $news[0];
									$news->generateJSON();
								endif;
							break;
							case "CA":
								$news = AgendaModel::getOne($msgCNT);
								if(!empty($news[0])):
									$news  = $news[0];
									$news->generateJSON();
								endif;
							break;
						}

					}


					$this->msg = $msg;
				}
			}
		}
	}
	public function not_spam($vars = null)
	{
		$this->setTemplate("approve");

		if(!empty($_GET['ID']))
		{
			$msg = ComentariosModel::getOne(addslashes((int)$_GET['ID']));
			if(!empty($msg[0]))
			{
				$msg = $msg[0];
				if($msg->pendant())
				{
					//Dispatcher::forwardRaw(Dispatcher::generateEditorialURL(array("comments", "index")));

					$msgCNT = $msg->getMSGCNT();

					$news = ConteudoModel::getOne($msgCNT);
					if(!empty($news[0]))
					{
						$news = $news[0];
						$cntTip = $news->getCNTTIP();
						switch($cntTip)
						{
							case "NT":
								$news = NoticiaModel::getOne($msgCNT);
								if(!empty($news[0])):
									$news = $news[0];
									$news->generateJSON();
								endif;
							break;
							case "GA":
								$news = GaleriaModel::getOne($msgCNT);
								if(!empty($news[0])):
									$news  = $news[0];
									$news->generateJSON();
								endif;
							break;
							case "CA":
								$news = AgendaModel::getOne($msgCNT);
								if(!empty($news[0])):
									$news  = $news[0];
									$news->generateJSON();
								endif;
							break;
						}

					}


					$this->msg = $msg;
				}
			}
		}
	}
	public function edit($vars = null)
	{
		if(Dispatcher::getPostValues("message"))
		{
			$values = Dispatcher::getPostValues("message");
			if(!empty($values["MSG_ID"]))
			{
				$msg = ComentariosModel::getOne(addslashes((int)$values["MSG_ID"]));
				if(!empty($msg[0]))
				{
					$msg = $msg[0];
					foreach($values as $prop => $value)
					{
						if(!Dispatcher::isAjax()):
							$msg->$prop = $value;
						else:
							$msg->$prop = utf8_decode($value);
						endif;

					}
					$this->saveSuccess = true;
					$msg->save();

					$msgCNT = $msg->getMSGCNT();

					$news = ConteudoModel::getOne($msgCNT);
					if(!empty($news[0]))
					{
						$news = $news[0];
						$cntTip = $news->getCNTTIP();
						switch($cntTip)
						{
							case "NT":
								$news = NoticiaModel::getOne($msgCNT);
								if(!empty($news[0])):
									$news = $news[0];
									$news->generateJSON();
								endif;
							break;
							case "GA":
								$news = GaleriaModel::getOne($msgCNT);
								if(!empty($news[0])):
									$news  = $news[0];
									$news->generateJSON();
								endif;
							break;
							case "CA":
								$news = AgendaModel::getOne($msgCNT);
								if(!empty($news[0])):
									$news  = $news[0];
									$news->generateJSON();
								endif;
							break;
						}

					}


				}
			}
		}
		if(!empty($_GET['ID']))
		{
			$this->ID = $_GET['ID'];
		}
		if(!empty($_GET['ID']))
		{
			$msg = ComentariosModel::getOne(addslashes((int)$_GET['ID']));
			if(!empty($msg[0]))
			{
				$this->msg = $msg[0];
			}
		}
	}
	public function reply($vars = null)
	{
		$this->setTemplate("edit", "comments");
		if(Dispatcher::getPostValues("message"))
		{
			$values = Dispatcher::getPostValues("message");
			if(!empty($values["MSG_ID"]))
			{
				$msg = ComentariosModel::getOne(addslashes((int)$values["MSG_ID"]));
				if(!empty($msg[0]))
				{
					$msg = $msg[0];
					foreach($values as $prop => $value)
					{
						$msg->$prop = $value;
					}
					$this->saveSuccess = true;
					$msg->save();
				}
			}
		}

		if(!empty($_GET['ID']))
		{
			$msg = ComentariosModel::getOne(addslashes((int)$_GET['ID']));
			$this->ID = $_GET['ID'];
			if(!empty($msg[0]))
			{
				if(empty($_GET["MSG_ID"]))
				{
					$msg = $msg[0];

					$this->msg = new Comentarios();
					$this->msg->MSG_IPR = htmlentities(utf8_decode($msg->getMSGIPR()));
					$this->msg->MSG_CNT = htmlentities(utf8_decode($msg->getMSGCNT()));
					$this->msg->MSG_IPR = htmlentities(utf8_decode($msg->getMSGIPR()));
					$this->msg->MSG_PAI = htmlentities(utf8_decode($msg->getMSGID()));
					$this->msg->MSG_DTA = date("Y-m-d H:i:s");
					$this->msg->MSG_STS = 9;

					$this->msg->save();

					$this->msg->MSG_STS = 1;
					$this->ID = $_GET['ID'] . "&MSG_ID=".$this->msg->getMSGID();

				} else {

					$msg = ComentariosModel::getOne(((int)$_GET['MSG_ID']));
					if(!empty($msg[0]))
					{
						$this->ID = $_GET['ID'] . "&MSG_ID=".$_GET['MSG_ID'];
						$this->msg = $msg[0];
					}

				}


			}
		}
	}
	public function delete($vars = null)
	{
		if(!empty($_GET['ID']))
		{
			$msg = ComentariosModel::getOne(addslashes((int)$_GET['ID']));
			if(!empty($msg[0]))
			{
				$this->msg = $msg[0];
				if($this->msg->delete())
				{
					Dispatcher::forwardRaw(Dispatcher::generateEditorialURL(array("comments", "index")));
				}
			}
		}
	}
}
?>
