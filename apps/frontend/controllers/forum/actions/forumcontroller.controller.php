<?php
class ForumController extends DefaultController 
{	
	private $keywords = "bispo,dizimo,edir,pastor,pastores,viado,cuzao,cuzão,buceta,boceta,viadu,cuzaum,puta,recopia,fieis,fiel,fiéis,IURD,igreja,igrejas,templo,templos,igreja universal,universal,caraleo,bispus,Hedir,Hedirr,Hedirrr,Hedirrrr,dizimista,onorilton ,Honorilton,roberto marinho,os marinho,marinho,silvio santos,sílvio santos,dizimo,dízimo,vagabunda,vagabundo,vadia,biscate,corno,boquete,chupeta,chupar,boqueteiro,chupador,fdp,foda,galinha,piranha,vaca,bucetuda,puteiro,benga,vagina,xota,xoxota,chavasca,xavasca,pussy,fuck,dick,cock,cuzuda,cusuda,cusudo,cuzudo,potranca,égua,idiota,xereca,xota,b0sta,merd@,vi@do,viad0,vi@d0,vi@du,gay,pau no seu cu,pau no cu,bunda,bund@,ridícula,ridicula,ridiculo,ridículo,escrota,girafona,enrustido,viadao,viadão,viadaum,ladrão,ladrao,ladraum,ladra,ladroes,ladraos,ladrões,ladrãos,bandido,bandidos,bandidão,bandidao,bandidaum,phoda,caralho,cuzinho,puta,putinha,cacete,piroca,pirocão";
	
	public function index( $vars = null )
	{
		$this->initProdutoJson (array("VARS" => array("ID" => $vars['VARS']['PDT_ID'])));
		$this->bodyId = "interna";
		$this->content = json_decode(file_get_contents(APP_JSON_PATH . "SITE_".APP_DEFAULT_EDITORIAL."_TP.json"), true);
		$this->contentHelped = json_decode(file_get_contents(APP_JSON_PATH . "SITE_".APP_DEFAULT_EDITORIAL."_TP_MoreHelped.json"), true);
		$this->contentWeek = json_decode(file_get_contents(APP_JSON_PATH . "SITE_".APP_DEFAULT_EDITORIAL."_TP_MoreWeek.json"), true);
	}
	public function likeContent($vars = null)
	{
		$this->setTemplate("like", "forum");
		if(!empty($vars['VARS']['UID']))
		{
			$id = addslashes($vars['VARS']['ID']);
			$sql = "UPDATE `cnt_conteudo` SET `cnt_conteudo`.`CNT_ENQ` = `cnt_conteudo`.`CNT_ENQ`+1 WHERE `cnt_conteudo`.`CNT_ID` = {$id}";
			$db = Database2::getDB();
		
			if($db->query($sql))
			{
				$cnt = TopicsModel::getOne($id);
				if(!empty($cnt[0]))
				{
					$cnt = $cnt[0];
				}
				$this->content = $cnt;
				$this->nota = $this->content->getCNTENQ();
				$cnt->generateJsonLists();
				$cnt->generateJSON();
			}
		} else {
			$this->message = "{You need to login do that}";
		}
	}
	public function likeMessage($vars = null)
	{
		$this->setTemplate("like", "forum");
		if(!empty($vars['VARS']['UID']))
		{
			$id = addslashes($vars['VARS']['ID']);
			$sql = "UPDATE `cnt_conteudo_msg` SET `cnt_conteudo_msg`.`MSG_NOT` = `cnt_conteudo_msg`.`MSG_NOT`+1 WHERE `cnt_conteudo_msg`.`MSG_ID` = {$id}";
			$db = Database2::getDB();
		
			if($db->query($sql))
			{
				$cnt = MensagensModel::getOne($id);
				if(!empty($cnt[0]))
				{
					$cnt = $cnt[0];
				}
				$this->content = $cnt;
				
				$this->nota = $this->content->getMSGNOT();
				
				$idContent = $this->content->getMSGCNT();
				$content = TopicsModel::getOne($idContent);
				if(!empty($content[0]))
				{
					$content = $content[0];
					
					$content->generateJsonLists();
					$content->generateJSON();
				}
				
				
			}
		} else {
			$this->message = "{You need to login do that}";
		}
	}
	public function unlikeMessage($vars = null)
	{
		$this->setTemplate("like", "forum");
		if(!empty($vars['VARS']['UID']))
		{
			$id = addslashes($vars['VARS']['ID']);
			$sql = "UPDATE `cnt_conteudo_msg` SET `cnt_conteudo_msg`.`MSG_NOT` = `cnt_conteudo_msg`.`MSG_NOT`-1 WHERE `cnt_conteudo_msg`.`MSG_ID` = {$id}";
			$db = Database2::getDB();
		
			if($db->query($sql))
			{
				$cnt = MensagensModel::getOne($id);
				if(!empty($cnt[0]))
				{
					$cnt = $cnt[0];
				}
				$this->content = $cnt;
				$this->nota = $this->content->getMSGNOT();
				
				$idContent = $this->content->getMSGCNT();
				$content = TopicsModel::getOne($idContent);
				if(!empty($content[0]))
				{
					$content = $content[0];
					
					$content->generateJsonLists();
					$content->generateJSON();
				}
				
				
			}
		} else {
			$this->message = "{You need to login do that}";
		}
	}
	public function unlikeContent($vars = null)
	{
		$this->setTemplate("like", "forum");
		if(!empty($vars['VARS']['UID']))
		{
			$id = addslashes($vars['VARS']['ID']);
			$sql = "UPDATE `cnt_conteudo` SET `cnt_conteudo`.`CNT_ENQ` = `cnt_conteudo`.`CNT_ENQ`-1 WHERE `cnt_conteudo`.`CNT_ID` = {$id}";
			$db = Database2::getDB();
		
			if($db->query($sql))
			{
				$cnt = TopicsModel::getOne($id);
				if(!empty($cnt[0]))
				{
					$cnt = $cnt[0];
				}
				$this->content = $cnt;
				$this->nota = $this->content->getCNTENQ();
				$cnt->generateJsonLists();
				$cnt->generateJSON();
			}
		} else {
			$this->message = "{You need to login do that}";
		}
	}
	public function interna( $vars = null )
	{
		$this->initProdutoJson (array("VARS" => array("ID" => $vars['VARS']['PDT_ID'])));
		$this->bodyId = "interna";
		
		if(!empty($_POST['comment']))
		{
			$notSave = false;
			$errors = array();
			
			$values = $_POST['comment'];
			
			if(empty($values['text'])){
				$errors[] = "Campo resposta é obrigatório";
			} else if(!empty($values['text']))
			{
				foreach(explode(",",$this->keywords) as $item)
				{
					if(strpos(" ".strtolower($values['text']), $item)){
			      $notSave = true;
			    }
				}
			}
			
			#Create Or Get User to Comment
			$user = $this->createOrGetUser($values['user']);
			
			if(!empty($user))
			{
				$content = TopicsModel::getOne($vars['VARS']['ID']);
				
				if(!empty($content[0]))
				{
					$content = $content[0];
					$comment = new Comentarios();
					$comment->MSG_CNT = $content->getCNTID();
					$comment->MSG_TXT = addslashes(strip_tags($values['text'], "<strong><em><ol><ul><li><blockquote><a><code>"));
					$comment->MSG_UID = $user->getUSUID();
					$comment->MSG_NOT = 0;
					$comment->MSG_STS = 1;
					if(!$comment->save())
					{
						$this->msg = "{Error saving your comment}";
					} else {
						
							$count = ((int)($content->getCNTCKY()));
							$content->CNT_CKY = ($count+1);
							$content->save();
							$content->generateJsonLists();
							$content->generateJSON();
							$this->msg = "{Content Saved}";
					}
				}	
			}
		}
		$this->initConteudoJson($vars);
		
		if(!empty($this->content['comments']))
		{
			$this->doPaginationJSON(count($this->content['comments']), $vars, 5);
		}
	}
	private function createOrGetUser($values)
	{
		$criteria = new FuriousSelectCriteria();
		$criteria->add("`cnt_usuarios`.`USU_FB`", addslashes($values['uid']), FuriousExpressionsDB::EQUAL);
		$criteria->add("`cnt_usuarios`.`USU_STS`", '1', FuriousExpressionsDB::EQUAL);
		
		$users = UsuarioModel::doSelect($criteria);
		
		if(!empty($users[0]))
		{
			return $users[0];
		} else {
			$user = new Usuario();
			$user->USU_NOM = addslashes(utf8_decode($values['name']));
			$user->USU_EMA = addslashes(utf8_decode($values['email']));
			$user->USU_FB = addslashes(utf8_decode($values['uid']));
			$user->USU_GRP = 0;
			$user->USU_STS = 1;
			if($user->save())
			{
				return $user;
			}	
		}
		return false;
	}
	public function criar ( $vars = null )
	{
		$this->initProdutoJson (array("VARS" => array("ID" => $vars['VARS']['PDT_ID'])));
		$this->bodyId = "interna";
		$errors = array();
		if(!empty($_POST['forum']))
		{
			$values = $_POST['forum'];
			
			
		  
			$notSave = false;
			
			$obrigatoryFields = array("titulo" => "Titulo", 'texto' => "Texto");
			foreach($obrigatoryFields as $field => $label)
			{
				if(empty($values[$field]))
				{
					$errors[] = sprintf("%s não pode ficar em branco.", $label);
				} else {
					foreach(explode(",",$this->keywords) as $item)
					{
						if(strpos(" ".strtolower($values[$field]), $item)){
				      $notSave = true;
				    }
					}
				}
			}
			if(empty($values['user']['uid']))
			{
				$errors[] = sprintf("Você deve estar logado no facebook para enviar sua pergunta");
			}
			if(count($errors) <= 0)
			{
				
				$user = $this->createOrGetUser($values['user']);

				if(!empty($user))
				{
					if(!$notSave)
					{
						$topic = new Topics();
						$topic->CNT_TIP = 'TP';
						$topic->CNT_IPR = APP_DEFAULT_EDITORIAL;
						$topic->CNT_SIT = APP_DEFAULT_EDITORIAL;
						$topic->CNT_STS = 1;
						$topic->CNT_TIT = addslashes(($values['titulo']));
						$topic->CNT_TXT = addslashes(($values['texto']));
						$topic->CNT_MCO = $user->getUSUID();
						$topic->CNT_DTA = date("Y-m-d H:i:s", time());
						$topic->CNT_ENQ = 0;
						$topic->CNT_CKY = 0;
						if($topic->save())
						{
							$topic->generateJsonLists();
							$topic->generateJSON();
							
							Dispatcher::forwardRaw (APP_WEB_PREFIX."forum/");
						}
					}
					
					
				} else {
					$errors[] = "Falha ao salvar tente mais tarde";
				}
				
			}
			
		}
		if(count($errors) > 0)
		{
			$this->errors = $errors;
		}
	}
}
?>