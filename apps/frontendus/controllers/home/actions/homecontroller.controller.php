<?php

class HomeController extends DefaultController
{
    static $hasSaibaMais = false;
    public $bodyClasses = "home";

    public function index($vars = NULL)
    {
        //$this->initProdutoJson($vars);
        $this->bodyClasses = "home red";
    }

    public function sendFriend($vars = null)
    {
        $translator = FuriousTranslator::init();
        if (!empty($_POST['url'])) {
            $this->errors = array();
            $fields = array("name" => "{Seu_Nome}", "email" => "{Seu_Email}", "name_to" => "{Nome_do_seu_amigo}", "email_to" => "{Email_do_seu_amigo}", "message" => "{Message}");
            foreach ($fields as $key => $value) {
                if (empty($_POST[$key])) {
                    $this->errors[] = $value . " {cant be blank}";
                }
                if (in_array($key, array("email", "email_to")) && !filter_var($_POST[$key], FILTER_VALIDATE_EMAIL)) {
                    $this->errors[] = $value . " {Invalid}";
                }
            }

            if (count($this->errors) < 1) {
                $mail = new ActiveMail();
                $mail->addAddress(trim($_POST['name_to']), trim($_POST['email_to']));

                $message = "<p>{SEU_AMIGO} " . trim($_POST['name']) . " {ENVIOU_UM_LINK}</p>";
                foreach ($fields as $key => $value) {
                    $message .= "<p>" . $value . ": " . $_POST[$key] . "</p>";
                }
                $message .= "<p><a href=\"" . $_POST['url'] . "\">" . $_POST['url'] . "</a>";
                $message = $translator->translate($message, "");
                $mail->addSubject($translator->translate("{SEU_AMIGO} " . trim($_POST['name']) . " {ENVIOU_UM_LINK}", ""));
                $mail->addMessage($message);

                if (!$mail->sendMail()) {
                    $this->errors[] = "{Failed to submit}";
                } else {
                    $this->success = "{MSG_SENDED}";
                }
                $this->setLayout("ajax");
            }
        }
    }


    public function aPiracanjuba($vars)
    {


        $criteria = new FuriousSelectCriteria();

        $criteria->add("`cnt_destaques`.`DTQ_TIP`", "apt", FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_destaques`.`DTQ_STS`", 1, FuriousExpressionsDB::EQUAL);

        $topo = DestaquesModel::doSelect($criteria);
        $this->topo = $topo;

        //-----------
        $criteria = new FuriousSelectCriteria();

        $criteria->add("`cnt_destaques`.`DTQ_TIP`", "apc", FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_destaques`.`DTQ_STS`", 1, FuriousExpressionsDB::EQUAL);

        $conteudo = DestaquesModel::doSelect($criteria);
        $this->conteudo = $conteudo;
        //-----------


        $criteria = new FuriousSelectCriteria();
        $criteria->addJoin(FuriousExpressionsDB::LEFT_JOIN, "`cnt_categorias_conteudos`", "`cnt_categorias_conteudos`.`CCL_CAT`", "`cnt_categorias`.`CAT_ID`");
        $criteria->addJoin(FuriousExpressionsDB::LEFT_JOIN, "`cnt_conteudo`", "`cnt_conteudo`.`CNT_ID`", "`cnt_categorias_conteudos`.`CCL_CNT`");
        $criteria->add("`cnt_categorias`.`CAT_COR`", "anos", FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_categorias`.`CAT_STS`", 1, FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_categorias_conteudos`.`CCL_STS`", 1, FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_conteudo`.`CNT_SIT`", APP_DEFAULT_EDITORIAL, FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_conteudo`.`CNT_STS`", 1, FuriousExpressionsDB::EQUAL);
        $criteria->addGroupBy("`cnt_categorias`.`CAT_ID`");

        $this->timelineYears = CategoriasModel::doSelect($criteria);

        $this->heading = array("BREADCRUMB" => array(
            "LINKS" => array(
                '#' => "{A_Piracanjuba}",
                $vars[0][0] => "{Quem_somos}"
            ),
        ),
            //"TXT" => "{SLOGAN_RELEASE}"
        );
        if (!empty($conteudo[0])) {
            $this->heading["IMAGE"] = $conteudo[0]->getDTQFTO()->getFile()->getPath2();
        }

        $this->bodyClasses = "home red the-piracanjuba";
    }


    public function caminhoDoLeite($vars)
    {
        $this->layoutVars['semrodape'] = true;

        $criteria = new FuriousSelectCriteria();

        $criteria->add("`cnt_conteudo`.`CNT_IPR`", (14 + APP_PLUS_CAM), FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_conteudo`.`CNT_DTA`", date("Y-m-d H:i:s"), FuriousExpressionsDB::MINOR_EQUAL);
        $criteria->add("`cnt_conteudo`.`CNT_STS`", 1, FuriousExpressionsDB::EQUAL);
        $criteria->addAscendingOrder("`cnt_conteudo`.`CNT_DTA`");


        $conteudo = ConteudoModel::doSelect($criteria);
        $this->conteudo = $conteudo;
        if (empty($this->conteudo[0])) {
            return $this->Error404();
        }

        $this->heading = array("BREADCRUMB" => array(
            "LINKS" => array(
                '#' => "{A_Piracanjuba}",
                $vars[0][0] => "{Caminho_do_Leite}"
            ),
        ),
            //"IMAGE" => $conteudo[0]->getDTQFTO()->getFile()->getPath2(),
            "TXT" => "{SLOGAN_RELEASE}",
            "SHOW_IMAGE" => false
        );

        $this->pageTitle = "{Caminho_do_Leite}";


        $this->bodyClasses = "home milkway skroll-content";
    }

    public function compradeleite($vars = null)
    {

        $criteria = new FuriousSelectCriteria();
        $criteria->add("`cnt_conteudo`.`CNT_IPR`", (6 + APP_PLUS_EDT), FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_conteudo`.`CNT_STS`", 1, FuriousExpressionsDB::EQUAL);
        $conteudo = ConteudoModel::doSelect($criteria);

        $this->conteudo = $conteudo;


        $this->bodyClasses = "home green purchase";
    }


    public function contato($vars = null)
    {
        $criteria = new FuriousSelectCriteria();
        $criteria->add("`cnt_destaques`.`DTQ_TIP`", "sac", FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_destaques`.`DTQ_STS`", 1, FuriousExpressionsDB::EQUAL);
        $destaques = DestaquesModel::doSelect($criteria);

        $this->sac = $destaques;

        $criteria = new FuriousSelectCriteria();
        $criteria->add("`cnt_destaques`.`DTQ_EDT`", (4 + APP_PLUS_EDT), FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_destaques`.`DTQ_TIP`", "bg", FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_destaques`.`DTQ_STS`", 1, FuriousExpressionsDB::EQUAL);
        $destaque = DestaquesModel::doSelect($criteria);

        $this->destaque = $destaque[0];

        $criteria = new FuriousSelectCriteria();
        $criteria->add("`cnt_destaques`.`DTQ_EDT`", APP_FALECONOSCO, FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_destaques`.`DTQ_TIP`", "sac", FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_destaques`.`DTQ_STS`", 1, FuriousExpressionsDB::EQUAL);
        $topo = DestaquesModel::doSelect($criteria);

        $criteria = new FuriousSelectCriteria();
        $criteria->add("`cnt_destaques`.`DTQ_EDT`", APP_FALECONOSCO, FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_destaques`.`DTQ_TIP`", "fpr", FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_destaques`.`DTQ_STS`", 1, FuriousExpressionsDB::EQUAL);
        $criteria->addAscendingOrder("`cnt_destaques`.`DTQ_TIT`");

        /*$criteria->add("`cnt_categorias`.`CAT_COR`", "prod", FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_categorias`.`CAT_STS`", 1, FuriousExpressionsDB::EQUAL);*/


        $categoriasObj = DestaquesModel::doSelect($criteria);



        $this->categorias = array();
        foreach ($categoriasObj as $categoria){

            $this->categorias[$categoria->DTQ_TIT] = $categoria->DTQ_TIT;
        }

        $this->textoTopo = $topo[1];

        $this->heading = array(
            "BREADCRUMB" => array("LINKS" => array($vars[0][0] => "{FALE_CONOSCO}")),
            "TXT" => $topo[0]->DTQ_TIT,
            "DESC" => $topo[0]->DTQ_TXT,
        );

        if (!empty($this->destaque)) {
            $fto = $this->destaque->getDTQFTO();
            if (!empty($fto)) {
                $this->heading["IMAGE"] = $fto->getFile()->getPath2();
            }

        }


        if (!empty($this->sac[0])) {
            $dtq = $this->sac[0];
            $fto = $dtq->getDTQFTO();
            if (!empty($fto)) {
                $this->heading["IMAGE"] = $this->destaque->getDTQFTO()->getFile()->getPath2();
            }

        }
        $this->pageTitle = "{FALE_CONOSCO}";

        $this->subjects = array();
        $this->to = array();


        $criteria = new FuriousSelectCriteria();
        $criteria->add("`cnt_destaques`.`DTQ_TIP`", "ar", FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_destaques`.`DTQ_STS`", 1, FuriousExpressionsDB::EQUAL);
        $criteria->addAscendingOrder("`cnt_destaques`.`DTQ_INI`");

        $subjects = DestaquesModel::doSelect($criteria);

        if (!empty($subjects[0])) {

            foreach ($subjects as $sub) {
                $this->subjects[Slugfy2($sub->getDTQTIT())] = $sub->getDTQTIT();
                $this->to[Slugfy2($sub->getDTQTIT())] = $sub->getDTQTXT();
            }
        }


        $criteria = new FuriousSelectCriteria();
        $criteria->addAscendingOrder("`paises`.`nome`");
        $paises = PaisesModel::doSelect($criteria);

        if (!empty($paises[0])) {

            foreach ($paises as $pais) {
                $this->paises[$pais->getID()] = strtoupper($pais->getPAISNOME());
                //$this->to[Slugfy2($sub->getDTQTIT())] = $sub->getDTQTXT();
            }
        }


        $criteria = new FuriousSelectCriteria();
        $criteria->addAscendingOrder("`estado`.`nome`");
        $estados = EstadoModel::doSelect($criteria);

        if (!empty($estados[0])) {

            foreach ($estados as $estado) {
                $this->estados[$estado->getEID()] = strtoupper($estado->getNome());
                //$this->to[Slugfy2($sub->getDTQTIT())] = $sub->getDTQTXT();
            }
        }


        if (!empty($_POST)) {
            $this->errors = array();


            if (!empty($_FILES['image']) && !empty($_FILES['image']['tmp_name'])) {
                if (!preg_match("/image/i", $_FILES['image']['type'])) {
                    $this->errors["image"] = "<strong>{Image}</strong> {Invalid file format}";
                }
            }


            //$bro = new Browser();
            //$bro->setURL("https://www.google.com/recaptcha/api/siteverify");
            //$bro->addPOSTData(array("secret" => "6LeuvyUTAAAAANoUQDt1XdvLoJvE2bntCnwDFnu-", "response" => $_POST['g-recaptcha-response'], "remoteip" => ($_SERVER['REMOTE_ADDR'] != "127.0.0.1") ? $_SERVER['REMOTE_ADDR'] : "179.208.177.216"));
            //$data = json_decode($bro->go());

            $this->fields = array(
                "area" => "{Area}",
                "name" => "{Name}",
                "gender" => "{Gender}",
                "birth" => "{Birth}",
                "relationship" => "{Relationship}",
                "cpf" => "{cpf}",
                "cellphone" => "{Cellphone}",
                "phone" => "{Phone}",
                "email" => "{Email}",
                "zipcode" => "{Zipcode}",
                "address" => "{Address}",
                "number" => "{Number}",
                "additional" => "{Additional}",
                "address2" => "{Address2}",
                "country" => "{Country}",
                "state" => "{State}",
                "city" => "{City}",
                "subject" => "{Subject}",
                "message" => "{Message}",
                "produto" => "{Produto}",
                "data_fabricacao" => "{Data de Fabrica??o}",
                "data_validade" => "{Data de Validade}",
                "lote" => "{Lote}",
                "autorizacao"=>"{RECEBER_INFORMACOES}"
            );
            $this->values = array();
            foreach ($this->fields as $field => $label) {
                $this->values[$field] = (!empty($_POST[$field])) ? $_POST[$field] : "";
            }
            $this->obrigatory = array(
                "area",
                "name",
                "gender",
                "birth",
                "relationship",
                "cpf",
                "cellphone",
                "phone",
                "email",
                "zipcode",
                "address",
                "number",
                "country",
                "state",
                //"city",
                "subject",
                "message"
            );


            foreach ($this->obrigatory as $field) {
                if (empty($_POST[$field])) {
                    $this->errors[$field] = "<strong>" . $this->fields[$field] . "</strong> {cant be blank}";
                    continue;
                }
                switch ($field) {
                    case "email":
                        if (!filter_var($_POST[$field], FILTER_VALIDATE_EMAIL)) {
                            $this->errors[$field] = "<strong>" . $this->fields[$field] . "</strong> {Invalid}";
                        }
                        break;
                    case "cpf":
                        if (!validaCPF($_POST[$field])) {
                            $this->errors[$field] = "<strong>" . $this->fields[$field] . "</strong> {Invalid}";
                        }
                        break;
                }
            }
            $data->success = true;
            $this->errors = array();
            // TODO: CHANGE Comparison mode
            if (!empty($data->success) && count($this->errors) == 0) {

                $toSend = $this->to[$_POST["area"]];

                $xml = "<?xml version='1.0' encoding='UTF-8'?>";
                $xml .= "<moduledata>";
                $xml .= "<entity tablename='Ent' formatname='faleconosco'>";
                $xml .= "<SigaFiles Text='SQG'>";
                $xml .= "<Dados>";


                $message = "<p>Você recebeu uma nova mensagem no site: </p>";
                $campos = array(
                    "area" => "assunto",
                    "name" => "nome",
                    "gender" => "sexo",
                    "birth" => "nascimento",
                    "relationship" => "estadocivil",
                    "cpf" => "cpf",
                    "cellphone" => "celular",
                    "phone" => "telefone",
                    "email" => "email",
                    "zipcode" => "cep",
                    "address" => "endereco",
                    "number" => "numero",
                    "additional" => "complemento",
                    "address2",
                    "country" => "pais",
                    "state" => "estado",
                    "city" => "cidade",
                    //"subject" => "assunto",
                    "message" => "mensagem",
                    "produto" => "produto",
                    "data_fabricacao" => "datafabricacao",
                    "data_validade" => "datavalidade",
                    "lote" => "lote",
                    "autorizacao"=>"autorizacao");


                if(!empty($_POST["cpf"])){
                    $_POST["cpf"] = str_replace(".", "",$_POST["cpf"]);
                }

                if(!empty($_POST["zipcode"])){
                    $_POST["zipcode"] = str_replace("-", "",$_POST["zipcode"]);
                }

                if(!empty($_POST["birth"])){
                    $_POST["birth"] = str_replace("/", "",$_POST["birth"]);
                }

                if(!empty($_POST["data_fabricacao"])){
                    $_POST["data_fabricacao"] = str_replace("/", "",$_POST["data_fabricacao"]);
                }

                if(!empty($_POST["data_validade"])){
                    $_POST["data_validade"] = str_replace("/", "",$_POST["data_validade"]);
                }

                if(!empty($_POST["autorizacao"]) && $_POST["autorizacao"] == "on"){
                    $_POST["autorizacao"] = "S";
                }else{
                    $_POST["autorizacao"] = "N";
                }

                foreach ($campos as $field => $campo) {

                    if (!empty($_POST[$field])) {
                        if ($field == "area") {
                            $message .= "<p>" . $this->fields[$field] . ": " . $this->subjects[$_POST[$field]] . "</p>";
                            $xml .= "<attribute domainname='$campo'><![CDATA[" . $_POST['subject'] . "]]></attribute>";
                        } else {
                            $message .= "<p>" . $this->fields[$field] . ": " . $_POST[$field] . "</p>";
                            $xml .= "<attribute domainname='$campo'><![CDATA[" . $_POST[$field] . "]]></attribute>";
                        }


                    }
                }
                $xml .= "</Dados>";
                $xml .= "</SigaFiles>";
                $xml .= "</entity>";
                $xml .= "</moduledata>";

                $criteria = new FuriousSelectCriteria();
                $criteria->add("`w11_produto`.`PDT_ID`", 18, FuriousExpressionsDB::EQUAL);
                $prod = ProdutoModel::doSelect($criteria);

                $prod = $prod[0];
                $numero  = $prod->getPDTOMN();

                $nome_arquivo = $numero.".xml";

                $path = APP_PATH_PREFIX."faleconosco/xml_formatado/";
                Document::writeFile($path.$nome_arquivo, $xml);

                if(!empty($_FILES['image']['name'])){
                    $nomeTemp = $_FILES['image']['name'];
                    $explodeNomeTemp = explode(".",$nomeTemp);
                    $extensao = $explodeNomeTemp[1];
                    $nomeImagem = $numero."_001.".$extensao;
                    Document::moveUploadedFile($_FILES['image']['tmp_name'], $path.$nomeImagem);
                }


                $prod->PDT_OMN = $numero+1;
                $prod->save();


                $translator = FuriousTranslator::init();
                $message = $translator->translate($message, "");


                $mail = new ActiveMail();
                if (strpos($toSend, ",") === FALSE) {
                    $mail->addAddress("Contato", trim($toSend));
                } else {
                    foreach (explode(",", $toSend) as $val) {
                        $mail->addAddress("Contato", trim($val));
                    }
                }

                $mail->addSubject("Contato Piracanjuba");
                $mail->addMessage($message);
                if (!empty($_FILES['image']['tmp_name']) && empty($_FILES['image']['error'])) {
                    $mail->addAttachment($_FILES['image']['tmp_name'], $_FILES['image']['name']);
                }

                if (!$mail->sendMail()) {
                    $this->errors[] = "{Failed to submit}";
                } else {
                    $this->success = "{MSG_SENDED}";
                }

            } else {
                $this->errors["captcha"] = "<strong>{Invalid Captcha}</strong>";
            }
        }
        $this->bodyClasses = "home red contact";
    }


    public function listaCidades($vars = null)
    {

        $estado_id = $_POST['estado'];

        $this->cidades = array();
        
        $criteria = new FuriousSelectCriteria();
        $criteria->add("`cidades`.`estado_id`", $estado_id, FuriousExpressionsDB::EQUAL);
        $criteria->addAscendingOrder("cidades.nome");
        $cities = CidadesModel::doSelect($criteria);
        if(!empty($cities[0])){
          foreach ($cities as $cidade) {
              $this->cidades[$cidade->getCID()] = strtoupper(utf8_encode($cidade->getCNome()));
          }
        }


        asort($this->cidades);
        $this->cidades = json_encode($this->cidades);

    }

    public function dicasdenutricao($vars = null)
    {


        $criteria = new FuriousSelectCriteria();
        $criteria->add("`cnt_destaques`.`DTQ_TIP`", "rec", FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_destaques`.`DTQ_STS`", 1, FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_destaques`.`DTQ_INI`", date("Y-m-d H:i:s"), FuriousExpressionsDB::MINOR_EQUAL);
        $criteria->add("`cnt_destaques`.`DTQ_FIM`", date("Y-m-d H:i:s"), FuriousExpressionsDB::GREATER_EQUAL);


        $this->dicas = DestaquesModel::doSelect($criteria);;


        $criteria = new FuriousSelectCriteria();

        if (!empty($_REQUEST['titulo_dica'])) {
            $titulo = $_REQUEST['titulo_dica'];
            if (!empty($titulo)) {

                $criteria->add("`cnt_conteudo`.`CNT_TIT`", "%$titulo%", FuriousExpressionsDB::LIKE);
                $this->titulo = $titulo;
            }

        }
        if (!empty($_REQUEST['category'])) {
			$criteria->addJoin(FuriousExpressionsDB::RIGHT_JOIN, "`cnt_categorias_conteudos`", "`cnt_categorias_conteudos`.`CCL_CNT`", "`cnt_conteudo`.`CNT_ID`");
            $cat = $_REQUEST['category'];
            if (!empty($titulo)) {
                $criteria->add("`cnt_categorias_conteudos`.`CCL_CAT`", $cat, FuriousExpressionsDB::LIKE);
                $this->cat = $cat;
            }
        }
        $criteria->add("`cnt_conteudo`.`CNT_TIP`", "DN", FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_conteudo`.`CNT_STS`", 1, FuriousExpressionsDB::EQUAL);
        $criteria->addGroupBy("`cnt_conteudo`.`CNT_ID`");



        $maisDicas = ConteudoModel::doSelect($criteria);

        $this->maisDicas = $maisDicas;


        $criteria = new FuriousSelectCriteria();
        //$criteria->addJoin("`cnt_categorias_conteudos`.`CCL_CNT`", $cat, FuriousExpressionsDB::LIKE);
        $criteria->add("`cnt_categorias`.`CAT_COR`", "DICA", FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_categorias`.`CAT_TIP`", APP_DEFAULT_EDITORIAL, FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_categorias`.`CAT_STS`", "1", FuriousExpressionsDB::EQUAL);

        $this->categorias = CategoriasModel::doSelect($criteria);


        $this->bodyClasses = "home bege tips";
    }


    public function maisDicasnutricao()
    {

        $perPage = 10;
        $page = 0;
        if (!empty($_GET['page']) && (int)$_GET['page']) {
            $page = ((int)$_GET['page']);
            $pagination = $page[0];
        }


        $criteria = new FuriousSelectCriteria();
        if (!empty($_GET['titulo'])) {
            $titulo = $_GET['titulo'];
            $criteria->add("`cnt_conteudo`.`CNT_TIT`", "%$titulo%", FuriousExpressionsDB::LIKE);
        }

        $criteria->add("`cnt_conteudo`.`CNT_TIP`", "DN", FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_conteudo`.`CNT_STS`", 1, FuriousExpressionsDB::EQUAL);
        $criteria->setLimit($perPage);
        $criteria->setOffset(ceil($page * $perPage));

        $maisDicas = ConteudoModel::doSelect($criteria);

        $this->maisDicas = $maisDicas;
    }

    public function dicasdenutricaointerna($vars = null)
    {

        $id = $vars['VARS']['ID'];

        $criteria = new FuriousSelectCriteria();
        $criteria->add("`cnt_conteudo`.`CNT_ID`", $id, FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_conteudo`.`CNT_TIP`", "DN", FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_conteudo`.`CNT_STS`", 1, FuriousExpressionsDB::EQUAL);

        $dica = ConteudoModel::doSelect($criteria);

        $this->dica = $dica[0];


        //-------------------------------------------
        $criteria = new FuriousSelectCriteria();

        $criteria->add("`cnt_conteudo`.`CNT_TIP`", "DN", FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_conteudo`.`CNT_STS`", 1, FuriousExpressionsDB::EQUAL);

        $dicas = ConteudoModel::doSelect($criteria);

        $this->dicas = $dicas;


        $this->bodyClasses = "home bege internalTips";
    }

    public function dicasdenutricaointernaImpressao($vars = null)
    {
        $id = $vars['VARS']['ID'];

        $criteria = new FuriousSelectCriteria();
        $criteria->add("`cnt_conteudo`.`CNT_ID`", $id, FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_conteudo`.`CNT_TIP`", "DN", FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_conteudo`.`CNT_STS`", 1, FuriousExpressionsDB::EQUAL);

        $dica = ConteudoModel::doSelect($criteria);

        $this->dica = $dica[0];


        //-------------------------------------------
        $criteria = new FuriousSelectCriteria();

        $criteria->add("`cnt_conteudo`.`CNT_TIP`", "DN", FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_conteudo`.`CNT_STS`", 1, FuriousExpressionsDB::EQUAL);

        $dicas = ConteudoModel::doSelect($criteria);

        $this->dicas = $dicas;

        $this->bodyClasses = "home internalTips print";


        $this->heading = array("BREADCRUMB" => array(
            "LINKS" => array(
                '#' => "{A_Piracanjuba}",
                $vars[0][0] => "{Dicas_de_nutricao}"
            ),
        ),
            "SHOW_IMAGE" => false,
            //"TXT" => "{SLOGAN_RELEASE}"
        );


        $this->setLayout('impressao');
        $this->setTemplate('dicasdenutricaointernaPrint');


    }

    public function faq($vars)
    {

        $criteria = new FuriousSelectCriteria();

        if ($_POST) {
            $busca = addslashes($_POST['releaseSearch']);
            $criteria->addComplexFilter("`cnt_conteudo`.`CNT_TIT`", "%$busca%", FuriousExpressionsDB::LIKE, "`cnt_conteudo`.`CNT_TXT`", "%$busca%", FuriousExpressionsDB::LIKE, FuriousExpressionsDB::SQL_OR);

        }
        $criteria->add("`cnt_conteudo`.`CNT_IPR`", (8 + APP_PLUS_FAQ), FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_conteudo`.`CNT_STS`", 1, FuriousExpressionsDB::EQUAL);

        $conteudo = ConteudoModel::doSelect($criteria);

        $criteria = new FuriousSelectCriteria();
        $criteria->add("`cnt_destaques`.`DTQ_EDT`", (8 + APP_PLUS_FAQ), FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_destaques`.`DTQ_TIP`", "bg", FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_destaques`.`DTQ_STS`", 1, FuriousExpressionsDB::EQUAL);

        $destaque = DestaquesModel::doSelect($criteria);

        $this->destaque = $destaque[0];

        $this->conteudo = $conteudo;

        $this->heading = array("BREADCRUMB" => array(
            "LINKS" => array(
                '#' => "{A_Piracanjuba}",
                $vars[0][0] => "{FAQ}"
            ),
        ),
            "IMAGE" => $this->destaque->getDTQFTO()->getFile()->getPath2(),
            //"TXT" => "{SLOGAN_RELEASE}"
        );
        $this->pageTitle = "{FAQ}";


        $this->bodyClasses = "home red questions";
    }


    public function imprensa($vars = null)
    {

        $this->bodyClasses = "home red imprensa";
        $criteria = new FuriousSelectCriteria();

        $criteria->addJoin(FuriousExpressionsDB::LEFT_JOIN, "`cnt_categorias_conteudos`", "`cnt_categorias_conteudos`.`CCL_CNT`", "`cnt_conteudo`.`CNT_ID`");
        if (!empty($_POST)) {

            $releaseSearch = $_POST['releaseSearch'];
            $criteria->add("`cnt_conteudo`.`CNT_TIT`", "%$releaseSearch%", FuriousExpressionsDB::LIKE);

        }

        $criteria->add("`cnt_conteudo`.`CNT_TIP`", "NT", FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_conteudo`.`CNT_STS`", 1, FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_categorias_conteudos`.`CCL_CAT`", 32, FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_categorias_conteudos`.`CCL_STS`", 1, FuriousExpressionsDB::EQUAL);
        //32 EH O ID DA CATEGORIA DE IMPRENSA

        //$noticias = ConteudoModel::doSelect($criteria);
        //$this->noticias = $noticias;

        $this->doPagination('ConteudoModel', 'noticias', $criteria, $vars, 10);

    }

    public function releases($vars = null)
    {

        $this->bodyClasses = "home red imprensa";

        $criteria = new FuriousSelectCriteria();
        $criteria->add("`cnt_destaques`.`DTQ_EDT`", (21 + APP_PLUS_EDT), FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_destaques`.`DTQ_TIP`", "bg", FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_destaques`.`DTQ_STS`", 1, FuriousExpressionsDB::EQUAL);

        $destaque = DestaquesModel::doSelect($criteria);

        $this->destaque = $destaque[0];


        $criteria = new FuriousSelectCriteria();

        $criteria->addJoin(FuriousExpressionsDB::LEFT_JOIN, "`cnt_categorias_conteudos`", "`cnt_categorias_conteudos`.`CCL_CNT`", "`cnt_conteudo`.`CNT_ID`");
        if (!empty($_POST)) {

            $releaseSearch = $_POST['releaseSearch'];
            $criteria->add("`cnt_conteudo`.`CNT_TIT`", "%$releaseSearch%", FuriousExpressionsDB::LIKE);

        }
        if (!empty($vars['VARS']['ID'])) {
            $criteria->add("`cnt_conteudo`.`CNT_ID`", addslashes($vars['VARS']['ID']), FuriousExpressionsDB::EQUAL);
        }


        $this->heading = array("BREADCRUMB" => array(
            "LINKS" => array(
                '/a-piracanjuba/quem-somos' => "{A_Piracanjuba}",
                $vars[0][0] => "Releases"
            ),
        ),
            "IMAGE" => $this->destaque->getDTQFTO()->getFile()->getPath2(),
            "TXT" => "{SLOGAN_RELEASE}"
        );
        $this->pageTitle = "Releases";

        $criteria->add("`cnt_conteudo`.`CNT_TIP`", "NOT", FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_conteudo`.`CNT_STS`", 1, FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_categorias_conteudos`.`CCL_CAT`", 35, FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_categorias_conteudos`.`CCL_STS`", 1, FuriousExpressionsDB::EQUAL);
        $criteria->addDescendingOrder("`cnt_conteudo`.`CNT_DTA`");

        $this->doPagination('ConteudoModel', 'releases', $criteria, $vars, 10);

        if (!empty($vars['VARS']['ID'])) {
            $this->setLayout("impressao");
            $this->setTemplate("releasesImpressao");
            $this->heading['SHOW_IMAGE'] = false;
        }

    }

    public function piracanjubaNaMidia($vars = null)
    {

        $this->bodyClasses = "home red imprensa";


        $criteria = new FuriousSelectCriteria();
        $criteria->add("`cnt_destaques`.`DTQ_EDT`", (22 + APP_PLUS_EDT), FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_destaques`.`DTQ_TIP`", "bg", FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_destaques`.`DTQ_STS`", 1, FuriousExpressionsDB::EQUAL);

        $destaque = DestaquesModel::doSelect($criteria);

        $this->destaque = $destaque[0];


        $this->heading = array("BREADCRUMB" => array(
            "LINKS" => array(
                '/a-piracanjuba/quem-somos' => "{A_Piracanjuba}",
                $vars[0][0] => "{Piracanjuba_na_Midia}"
            ),
        ),
            "IMAGE" => $this->destaque->getDTQFTO()->getFile()->getPath2(),
            "TXT" => "{SLOGAN_RELEASE}"
        );


        $criteria = new FuriousSelectCriteria();

        $criteria->addJoin(FuriousExpressionsDB::LEFT_JOIN, "`cnt_categorias_conteudos`", "`cnt_categorias_conteudos`.`CCL_CNT`", "`cnt_conteudo`.`CNT_ID`");
        if (!empty($_POST)) {

            $releaseSearch = $_POST['releaseSearch'];
            $criteria->add("`cnt_conteudo`.`CNT_TIT`", "%$releaseSearch%", FuriousExpressionsDB::LIKE);

        }

        if (!empty($vars['VARS']['ID'])) {
            $criteria->add("`cnt_conteudo`.`CNT_ID`", addslashes($vars['VARS']['ID']), FuriousExpressionsDB::EQUAL);
        }


        $criteria->add("`cnt_conteudo`.`CNT_TIP`", "NOT", FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_conteudo`.`CNT_STS`", 1, FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_categorias_conteudos`.`CCL_CAT`", (59 + APP_CATS), FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_categorias_conteudos`.`CCL_STS`", 1, FuriousExpressionsDB::EQUAL);

        $this->doPagination('ConteudoModel', 'releases', $criteria, $vars, 10);

        $this->pageTitle = "{Piracanjuba_na_Midia}";

        if (!empty($vars['VARS']['ID'])) {
            $this->setLayout("impressao");
            $this->setTemplate("releasesImpressao");
            $this->heading['SHOW_IMAGE'] = false;
        }

    }


    public function lei12669($vars = null)
    {


        $criteria = new FuriousSelectCriteria();

        $criteria->add("`cnt_conteudo`.`CNT_IPR`", (9 + APP_PLUS_EDT), FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_conteudo`.`CNT_STS`", 1, FuriousExpressionsDB::EQUAL);

        $conteudo = ConteudoModel::doSelect($criteria);
        $this->conteudo = $conteudo;

        //--------------------------------
        // Filters
        //
        $filters = array(
            "years" => "`cnt_destaques`.`DTQ_LTX`",
            "months" => "`cnt_destaques`.`DTQ_LN2`"
        );


        foreach ($filters as $outVar => $group) {
            $criteria = new FuriousSelectCriteria();

            $criteria->add("`cnt_destaques`.`DTQ_TIP`", "ple", FuriousExpressionsDB::EQUAL);
            $criteria->add("`cnt_destaques`.`DTQ_STS`", 1, FuriousExpressionsDB::EQUAL);
            //$criteria->add($group, "", FuriousExpressionsDB::NOT_EQUAL);
            $criteria->addGroupBy($group);
            $itens = DestaquesModel::doSelect($criteria);
            $this->$outVar = $itens;
        }
        ///


        $criteria = new FuriousSelectCriteria();

        $criteria->add("`cnt_destaques`.`DTQ_TIP`", "ple", FuriousExpressionsDB::EQUAL);
        if (!empty($_POST['year'])) {
            $criteria->add("`cnt_destaques`.`DTQ_LTX`", addslashes($_POST['year']), FuriousExpressionsDB::EQUAL);
        }
        if (!empty($_POST['month'])) {
            $criteria->add("`cnt_destaques`.`DTQ_LN2`", addslashes($_POST['month']), FuriousExpressionsDB::EQUAL);
        }
        $criteria->add("`cnt_destaques`.`DTQ_STS`", 1, FuriousExpressionsDB::EQUAL);

        $itens = DestaquesModel::doSelect($criteria);
        $this->itens = $itens;

        //-------------------------------------
        $this->arrayTables = array(
            "pbp" => "proteina",
            "pae" => "adicional_escala",
            "pbc" => "contagem_bacteriana",
            "pba" => "adicional_distancia",
            "pbt" => "taxa_frio",
            "pbg" => "gordura",
            "pc2" => "contagem_celulas"
        );
        foreach ($this->arrayTables as $key => $outVar) {
            $criteria = new FuriousSelectCriteria();
            $criteria->add("`cnt_destaques`.`DTQ_TIP`", $key, FuriousExpressionsDB::EQUAL);
            $criteria->add("`cnt_destaques`.`DTQ_STS`", 1, FuriousExpressionsDB::EQUAL);
            $criteria->add("`cnt_destaques`.`DTQ_FIM`", date("Y-m-d H:i:s"), FuriousExpressionsDB::GREATER_EQUAL);
            $this->$outVar = DestaquesModel::doSelect($criteria);;
        }


        $criteria = new FuriousSelectCriteria();
        $criteria->add("`cnt_destaques`.`DTQ_EDT`", (3 + APP_PLUS_EDT), FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_destaques`.`DTQ_TIP`", "bg", FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_destaques`.`DTQ_STS`", 1, FuriousExpressionsDB::EQUAL);

        $destaque = DestaquesModel::doSelect($criteria);

        $this->destaque = $destaque[0];

        $this->pageTitle = "{Qualidade_do_Leite}";


        $this->heading = array("BREADCRUMB" => array(),
            "IMAGE" => $this->destaque->getDTQFTO()->getFile()->getPath2(),
            //"TXT" => "{WE_LOVE_DO_THE_BEST}"
        );

        if (APP_DEFAULT_EDITORIAL == 1) {
            $this->heading["BREADCRUMB"]["LINKS"] = array(
                '#' => "{Produtor_de_Leite}",
                $vars[0][0] => "{Lei_12669}"
            );
        } else {
            $this->heading["BREADCRUMB"]["LINKS"] = array(
                $vars[0][0] => "{Produtor_de_Leite}"
            );
        }


        $this->pageTitle = "{Lei_12669}";

        $this->bodyClasses = "home green purchase law";
    }

    public function ondeEncontrar($vars)
    {

        $criteria = new FuriousSelectCriteria();


        $this->heading = array("BREADCRUMB" => array("LINKS" => array('/ondeEncontrar' => "{WHERE_TO_FIND}")));
        $this->pageTitle = "{WHERE_TO_FIND}";

        if (!empty($_REQUEST)) {


            $produto = @$_REQUEST['produto'];
            $cidade = @$_REQUEST['cidade'];
            $estado = @$_REQUEST['estado'];

            if (!empty($produto)) {

                $criteria->addJoin(FuriousExpressionsDB::LEFT_JOIN, "`cnt_categorias_conteudos` AS categoria_rep", "`categoria_rep`.`CCL_CNT`", "`cnt_conteudo`.`CNT_ID`");
                $criteria->addJoin(FuriousExpressionsDB::LEFT_JOIN, "`cnt_conteudo` AS prod", "`prod`.`CNT_ID`", "`categoria_rep`.`CCL_CAT`");
                //$criteria->addJoin(FuriousExpressionsDB::LEFT_JOIN, "`cnt_categorias_conteudos` AS categoria_prod", "`categoria_prod`.`CCL_CNT`", "`prod`.`CNT_ID`");

                $criteria->add("`prod`.`CNT_TIT`", "%$produto%", FuriousExpressionsDB::LIKE);
                $criteria->add("`prod`.`CNT_STS`", 1, FuriousExpressionsDB::EQUAL);
                $criteria->add("`prod`.`CNT_ID`", "", FuriousExpressionsDB::IS_NOT_NULL);


                $criteria->add("`categoria_rep`.`CCL_CNT`", "", FuriousExpressionsDB::IS_NOT_NULL);
                $criteria->add("`categoria_rep`.`CCL_STS`", 1, FuriousExpressionsDB::EQUAL);
                $criteria->add("`categoria_rep`.`CCL_TIP`", 'PROD_EST', FuriousExpressionsDB::EQUAL);

                //$criteria->add("`categoria_prod`.`CCL_CNT`", "", FuriousExpressionsDB::IS_NOT_NULL);
                //$criteria->add("`categoria_prod`.`CCL_STS`", 1, FuriousExpressionsDB::EQUAL);
            }

            if (!empty($cidade)) {
                $criteria->add("`cnt_conteudo`.`CNT_RDT`", "$cidade", FuriousExpressionsDB::LIKE);
            }

            if (!empty($estado)) {

                $criteriaEstado = new FuriousSelectCriteria();
                $criteriaEstado->addComplexFilter("`estado`.`sigla`", "%$estado%", FuriousExpressionsDB::LIKE, "`estado`.`nome`", "$estado%", FuriousExpressionsDB::LIKE, FuriousExpressionsDB::SQL_OR);

                $estado = EstadoModel::doSelect($criteriaEstado);

                if (!empty($estado[0])) {
                    $estado_id = $estado[0]->id;
                } else {
                    $estado_id = 0;
                }
                $criteria->add("`cnt_conteudo`.`CNT_CKY`", $estado_id, FuriousExpressionsDB::EQUAL);

            }
        }

        $criteria->add("`cnt_conteudo`.`CNT_TIP`", "EST", FuriousExpressionsDB::EQUAL);

        $criteria->add("`cnt_conteudo`.`CNT_STS`", 1, FuriousExpressionsDB::EQUAL);

        $criteria->addGroupBy("`cnt_conteudo`.`CNT_ID`");

        $this->doPagination('ConteudoModel', 'representantes', $criteria, $vars);

        $this->bodyClasses = "home red onde";

        $criteria = new FuriousSelectCriteria();
        $criteria->add("`cnt_destaques`.`DTQ_EDT`", (19 + APP_PLUS_EDT), FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_destaques`.`DTQ_TIP`", "bg", FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_destaques`.`DTQ_STS`", 1, FuriousExpressionsDB::EQUAL);

        $destaque = DestaquesModel::doSelect($criteria);

        if (!empty($destaque[0])) {
            $this->destaque = $destaque[0];
            $this->heading["IMAGE"] = $this->destaque->getDTQFTO()->getFile()->getPath2();
        }

    }

    public function piracanjubaProCampo($vars = null)
    {

        $criteria = new FuriousSelectCriteria();

        $criteria->add("`cnt_conteudo`.`CNT_IPR`", (3 + APP_PLUS_EDT), FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_conteudo`.`CNT_STS`", 1, FuriousExpressionsDB::EQUAL);

        $conteudo = ConteudoModel::doSelect($criteria);


        $criteria = new FuriousSelectCriteria();
        $criteria->add("`cnt_destaques`.`DTQ_EDT`", (3 + APP_PLUS_EDT), FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_destaques`.`DTQ_TIP`", "bg", FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_destaques`.`DTQ_STS`", 1, FuriousExpressionsDB::EQUAL);

        $destaque = DestaquesModel::doSelect($criteria);

        $this->destaque = $destaque[0];

        $this->pageTitle = "{Qualidade_do_Leite}";


        $this->heading = array("BREADCRUMB" => array(
            "LINKS" => array(
                '#' => "{Produtor_de_Leite}",
                $vars[0][0] => "{Piracanjuba_Pro_Campo}"
            ),
        ),
            "IMAGE" => $this->destaque->getDTQFTO()->getFile()->getPath2(),
            "TXT" => "{PROGRAMA_DE_APOIO_TECNICO_AO_RPODUTOR_DE_LEITE_PIRACAMJUBA}"
        );


        $this->conteudo = $conteudo;


        $this->bodyClasses = "home green purchase";

    }


    public function produtos($vars)
    {

        $this->heading = array("BREADCRUMB" => array(
            "LINKS" => array("/produtos" => "{Products}")),
            "IMAGE" => "",

        );
        $this->pageTitle = "{Products}";

        $criteria = new FuriousSelectCriteria();

        $criteria->add("`cnt_categorias`.`CAT_COR`", "prod", FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_categorias`.`CAT_STS`", 1, FuriousExpressionsDB::EQUAL);
        //$criteria->add("`cnt_categorias`.`CAT_ID`", 34, FuriousExpressionsDB::NOT_EQUAL);
        $criteria->addAscendingOrder("`cnt_categorias`.`CAT_NOM`");

        $categorias = CategoriasModel::doSelect($criteria);

        $produto = array();
        foreach ($categorias as $categoria) {


            $criteria = new FuriousSelectCriteria();
            $criteria->addJoin(FuriousExpressionsDB::LEFT_JOIN, "`cnt_categorias_conteudos`", "`cnt_categorias_conteudos`.CCL_CNT", "`cnt_conteudo`.CNT_ID");
            $criteria->addJoin(FuriousExpressionsDB::LEFT_JOIN, "`cnt_arquivos_conteudo`", "`cnt_arquivos_conteudo`.ARC_CID", "`cnt_conteudo`.CNT_ID");
            $criteria->add("`cnt_categorias_conteudos`.`CCL_CAT`", $categoria->CAT_ID, FuriousExpressionsDB::EQUAL);
            $criteria->add("`cnt_arquivos_conteudo`.`ARC_CTP`", "THB_CNT", FuriousExpressionsDB::EQUAL);
            $criteria->add("`cnt_arquivos_conteudo`.`ARC_STS`", "1", FuriousExpressionsDB::EQUAL);
            //$criteria->add("`cnt_conteudo`.`CNT_ID`",  $cat[0]->CCL_CNT, FuriousExpressionsDB::EQUAL);
            $criteria->add("`cnt_conteudo`.`CNT_STS`", 1, FuriousExpressionsDB::EQUAL);
            $criteria->add("`cnt_conteudo`.`CNT_TIP`", "PROD", FuriousExpressionsDB::EQUAL);
            $prod = ConteudoModel::doSelect($criteria);

            $produto[$categoria->CAT_ID] = $prod[0];

        }

        $this->produto = $produto;
        $this->categorias = $categorias;


        $this->heading = array("BREADCRUMB" => array(
            "LINKS" => array(
                '#' => "{A_Piracanjuba}",
                $vars[0][0] => "{Produtos}"
            ),

        ),
            "SHOW_IMAGE" => false
            //"IMAGE" => $conteudo[0]->getDTQFTO()->getFile()->getPath2(),
            //"TXT" => "{SLOGAN_RELEASE}"
        );


        $this->pageTitle = "{Produtos}";


        $this->bodyClasses = "home red product";

    }

    public function produtosInterna($vars)
    {


        $produto_id = $vars['VARS']['ID'];


        $criteria = new FuriousSelectCriteria();
        $criteria->add("`cnt_conteudo`.`CNT_ID`", $produto_id, FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_conteudo`.`CNT_STS`", 1, FuriousExpressionsDB::EQUAL);
        $produto = ConteudoModel::doSelect($criteria);

        $this->produto = $produto[0];
        //------------------------------------------------------

        $criteria = new FuriousSelectCriteria();

        $criteria->addField2("case `cnt_categorias`.`CAT_NOM`  when 'Zero Lactose' then 3  when 'Pirakids School' then 2 when 'Pirakids' then 1 else 0 end as ord");
        $criteria->add("`cnt_categorias_conteudos`.`CCL_CNT`", $produto_id, FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_categorias_conteudos`.`CCL_TIP`", "PROD", FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_categorias_conteudos`.`CCL_STS`", 1, FuriousExpressionsDB::EQUAL);

        $criteria->addJoin(FuriousExpressionsDB::LEFT_JOIN, "`cnt_categorias`", "`cnt_categorias_conteudos`.`CCL_CAT`", "`cnt_categorias`.`CAT_ID`");
        $criteria->addDescendingOrder("ord");
        $cat = CategoriaconteudoModel::doSelect($criteria);

        //------------------------------------------------------


        $criteria = new FuriousSelectCriteria();
        $criteria->add("`cnt_categorias`.`CAT_ID`", $cat[0]->CCL_CAT, FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_categorias`.`CAT_STS`", 1, FuriousExpressionsDB::EQUAL);
        $categoria = CategoriasModel::doSelect($criteria);

        $this->categoria = $categoria[0];


        //OUTROS PRODUTOS
        $criteria = new FuriousSelectCriteria();

        $criteria->addJoin(FuriousExpressionsDB::LEFT_JOIN, "`cnt_categorias_conteudos`", "`cnt_categorias_conteudos`.`CCL_CNT`", "`cnt_conteudo`.`CNT_ID`");
        $criteria->add("`cnt_conteudo`.`CNT_DTA`", $this->produto->CNT_DTA, FuriousExpressionsDB::GREATER_THAN);
        $criteria->add("`cnt_conteudo`.`CNT_TIP`", "PROD", FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_conteudo`.`CNT_ID`", $produto_id, FuriousExpressionsDB::NOT_EQUAL);
        $criteria->add("`cnt_categorias_conteudos`.`CCL_CAT`", $cat[0]->CCL_CAT, FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_categorias_conteudos`.`CCL_TIP`", "PROD", FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_conteudo`.`CNT_STS`", 1, FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_categorias_conteudos`.`CCL_STS`", 1, FuriousExpressionsDB::EQUAL);
        $criteria->addAscendingOrder("`cnt_conteudo`.`CNT_DTA`");
        $criteria->setLimit(1);

        $prodMaior = ConteudoModel::doSelect($criteria);

        $this->prodMaior = $prodMaior[0];


        //---------------------------

        $criteria = new FuriousSelectCriteria();

        $criteria->addJoin(FuriousExpressionsDB::LEFT_JOIN, "`cnt_categorias_conteudos`", "`cnt_categorias_conteudos`.`CCL_CNT`", "`cnt_conteudo`.`CNT_ID`");
        $criteria->add("`cnt_conteudo`.`CNT_DTA`", $this->produto->CNT_DTA, FuriousExpressionsDB::MINOR_THAN);
        $criteria->add("`cnt_conteudo`.`CNT_TIP`", "PROD", FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_conteudo`.`CNT_ID`", $produto_id, FuriousExpressionsDB::NOT_EQUAL);
        $criteria->add("`cnt_categorias_conteudos`.`CCL_CAT`", $cat[0]->CCL_CAT, FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_categorias_conteudos`.`CCL_TIP`", "PROD", FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_categorias_conteudos`.`CCL_STS`", 1, FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_conteudo`.`CNT_STS`", 1, FuriousExpressionsDB::EQUAL);
        $criteria->addDescendingOrder("`cnt_conteudo`.`CNT_DTA`");
        $criteria->setLimit(1);

        $prodMenor = ConteudoModel::doSelect($criteria);

        $this->prodMenor = $prodMenor[0];


        //------------------------------------------------------
        $criteria = new FuriousSelectCriteria();
        $criteria->add("`cnt_conteudo`.`CNT_TIP`", "REC", FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_conteudo`.`CNT_STS`", 1, FuriousExpressionsDB::EQUAL);
        $receitas = ConteudoModel::doSelect($criteria);

        $this->receita = $receitas[0];

        //------------------------------------------------------


        //PROXIMO PRODUTO

        $criteria = new FuriousSelectCriteria();
        $criteria->add("`cnt_conteudo`.`CNT_ID`", $produto_id, FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_conteudo`.`CNT_STS`", 1, FuriousExpressionsDB::EQUAL);
        $produto = ConteudoModel::doSelect($criteria);

        $this->produto = $produto[0];


        $this->cat0 = $categoria[0];

        if ($categoria[0]->CAT_NOM == "Pirakids") {

            $this->bodyClasses = "home brown internalProduct";
            $this->setTemplate("pirakids");

            $criteria = new FuriousSelectCriteria();
            $criteria->add("`cnt_categorias`.`CAT_NOM`", 'Pirakids School', FuriousExpressionsDB::EQUAL);
            $criteria->add("`cnt_categorias`.`CAT_TIP`", APP_DEFAULT_EDITORIAL, FuriousExpressionsDB::EQUAL);
            $criteria->add("`cnt_categorias`.`CAT_STS`", 1, FuriousExpressionsDB::EQUAL);
            $criteria->setLimit(1);

            $seeMore = CategoriasModel::doSelect($criteria);
            if (!empty($seeMore[0])) {
                $this->seeMore = $seeMore[0];
            }


        } elseif ($categoria[0]->CAT_NOM == "Zero Lactose") {
            $this->bodyClasses = "home orange internalProduct zero";
            $this->setTemplate("zeroLactose");
        } elseif ($categoria[0]->CAT_NOM == "Pirakids School") {
            $this->bodyClasses = "home blue internalProduct";
            $this->setTemplate("pirakidsSchool");

            $criteria = new FuriousSelectCriteria();
            $criteria->add("`cnt_categorias`.`CAT_NOM`", 'Pirakids', FuriousExpressionsDB::EQUAL);
            $criteria->add("`cnt_categorias`.`CAT_TIP`", APP_DEFAULT_EDITORIAL, FuriousExpressionsDB::EQUAL);
            $criteria->add("`cnt_categorias`.`CAT_STS`", 1, FuriousExpressionsDB::EQUAL);
            $criteria->setLimit(1);

            $seeMore = CategoriasModel::doSelect($criteria);
            if (!empty($seeMore[0])) {
                $this->seeMore = $seeMore[0];
            }


        } else {
            $this->bodyClasses = "home red internalProduct";
        }

        $this->pageTitle = "{Produtos}";

        /*if($categoria = pirakids){

            $this->bodyClasses = "home brown internalProduct";
        }*/
    }

    public function produtosInternaImpressao($vars = null)
    {

        // DADOS DO PRODUTO
        $produto_id = $vars['VARS']['ID'];

        $criteria = new FuriousSelectCriteria();
        $criteria->add("`cnt_conteudo`.`CNT_ID`", $produto_id, FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_conteudo`.`CNT_STS`", 1, FuriousExpressionsDB::EQUAL);
        $produto = ConteudoModel::doSelect($criteria);

        $this->produto = $produto[0];

        //---------------------------------------------------


        // CATEGORIAS DESTE PRODUTO EM ORDEM
        $criteria = new FuriousSelectCriteria();

        $criteria->addField2("case `cnt_categorias`.`CAT_NOM`  when 'Zero Lactose' then 3  when 'Pirakids School' then 2 when 'Pirakids' then 1 else 0 end as ord");
        $criteria->add("`cnt_categorias_conteudos`.`CCL_CNT`", $produto_id, FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_categorias_conteudos`.`CCL_TIP`", "PROD", FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_categorias_conteudos`.`CCL_STS`", 1, FuriousExpressionsDB::EQUAL);

        $criteria->addJoin(FuriousExpressionsDB::LEFT_JOIN, "`cnt_categorias`", "`cnt_categorias_conteudos`.`CCL_CAT`", "`cnt_categorias`.`CAT_ID`");
        $criteria->addDescendingOrder("ord");
        $cat = CategoriaconteudoModel::doSelect($criteria);

        //------------------------------------------------------
        // CATEGORIA "PRINCIPAL"

        $criteria = new FuriousSelectCriteria();
        $criteria->add("`cnt_categorias`.`CAT_ID`", $cat[0]->CCL_CAT, FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_categorias`.`CAT_STS`", 1, FuriousExpressionsDB::EQUAL);
        $categoria = CategoriasModel::doSelect($criteria);

        $this->categoria = $categoria[0];

        //------------------------------------------------------

        //BREADCRUMB
        $this->heading = array("BREADCRUMB" => array(
            "LINKS" => array(
                '#' => "{Produtos}",
                $vars[0][0] => $this->categoria->CAT_NOM
            ),
        ),
            "SHOW_IMAGE" => false
            //"IMAGE" => $conteudo[0]->getDTQFTO()->getFile()->getPath2(),
            //"TXT" => "{SLOGAN_RELEASE}"
        );
        $this->pageTitle = "{Produtos}";


        $this->bodyClasses = "home internalProduct print";

        $this->setLayout("impressao");


    }

    public function produtosInternaTabela($vars = null)
    {

        $this->produtosInterna($vars);
        $produto_id = $this->produto->CNT_ID;
        $criteria = new FuriousSelectCriteria();
        $criteria->add("`tabela_nutricional`.`produto_id`", $produto_id, FuriousExpressionsDB::EQUAL);
        $criteria->add("`tabela_nutricional`.`status`", 1, FuriousExpressionsDB::EQUAL);
        $tabela = TabelaNutricionalModel::doSelect($criteria);


        $this->tabela = $tabela;

        $categoria[0] = $this->cat0;

        $this->setTemplate("produtosInternaTabela");

    }

    public function qualidadeDoLeite($vars = null)
    {

        $criteria = new FuriousSelectCriteria();
        if (!empty($vars['VARS']) && !empty($vars['VARS']['ID'])) {
            $criteria->add("`cnt_conteudo`.`CNT_ID`", $vars['VARS']['ID'], FuriousExpressionsDB::EQUAL);
        } else {
            $criteria->add("`cnt_conteudo`.`CNT_IPR`", (16 + APP_PLUS_EDT), FuriousExpressionsDB::EQUAL);
        }
        $criteria->add("`cnt_conteudo`.`CNT_STS`", 1, FuriousExpressionsDB::EQUAL);

        $conteudo = ConteudoModel::doSelect($criteria);
        if (!empty($conteudo[0])) {
            $this->conteudo = $conteudo[0];

            $criteria = new FuriousSelectCriteria();
            $criteria->add("`cnt_destaques`.`DTQ_EDT`", (16 + APP_PLUS_EDT), FuriousExpressionsDB::EQUAL);
            $criteria->add("`cnt_destaques`.`DTQ_TIP`", "bg", FuriousExpressionsDB::EQUAL);
            $criteria->add("`cnt_destaques`.`DTQ_STS`", 1, FuriousExpressionsDB::EQUAL);

            $destaque = DestaquesModel::doSelect($criteria);

            $this->destaque = $destaque[0];


            $this->heading = array("BREADCRUMB" => array("LINKS" => array($this->conteudo->getUrl() => $this->conteudo->getCNTTIT())), "IMAGE" => $this->destaque->getDTQFTO()->getFile()->getPath2());
            $this->pageTitle = $this->conteudo->getCNTTIT();

            $this->bodyClasses = "home green purchase";
        } else {
            $this->Error404();
        }


    }

    public function equipeDeCompraLeite($vars)
    {

        $criteria = new FuriousSelectCriteria();
        if (!empty($vars['VARS']) && !empty($vars['VARS']['ID'])) {
            $criteria->add("`cnt_conteudo`.`CNT_ID`", $vars['VARS']['ID'], FuriousExpressionsDB::EQUAL);
        } else {
            if (!empty($vars['VARS']) && !empty($vars['VARS']['EDT'])) {
                $criteria->add("`cnt_conteudo`.`CNT_IPR`", $vars['VARS']['EDT'], FuriousExpressionsDB::EQUAL);
            } else {
                $criteria->add("`cnt_conteudo`.`CNT_IPR`", (6 + APP_PLUS_EDT), FuriousExpressionsDB::EQUAL);
            }
        }
        //$criteria->add("`cnt_conteudo`.`CNT_IPR`", 16, FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_conteudo`.`CNT_STS`", 1, FuriousExpressionsDB::EQUAL);

        $conteudo = ConteudoModel::doSelect($criteria);

        $this->conteudo = $conteudo[0];

        $criteria = new FuriousSelectCriteria();
        $criteria->add("`cnt_destaques`.`DTQ_EDT`", (3 + APP_PLUS_EDT), FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_destaques`.`DTQ_TIP`", "bg", FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_destaques`.`DTQ_STS`", 1, FuriousExpressionsDB::EQUAL);

        $destaque = DestaquesModel::doSelect($criteria);

        $this->destaque = $destaque[0];

        $this->pageTitle = "{Qualidade_do_Leite}";


        $this->heading = array("BREADCRUMB" => array(
            "LINKS" => array($this->conteudo->getUrl() => $this->conteudo->getCNTTIT())
        ),
            "IMAGE" => $this->destaque->getDTQFTO()->getFile()->getPath2(),
            "TXT" => "{PROGRAMA_DE_APOIO_TECNICO_AO_RPODUTOR_DE_LEITE_PIRACAMJUBA}"
        );

        //$this->heading = array("BREADCRUMB" => array("LINKS" => array($this->conteudo->getUrl() => $this->conteudo->getCNTTIT())), "IMAGE"=>$this->destaque->getDTQFTO()->getFile()->getPath2());
        $this->pageTitle = $this->conteudo->getCNTTIT();

        $this->bodyClasses = "home green purchase";

        $this->setTemplate("qualidadeDoLeite");

    }

    public function pagamentoDeLeite($vars)
    {


        $criteria = new FuriousSelectCriteria();

        $criteria->add("`cnt_conteudo`.`CNT_IPR`", (16 + APP_PLUS_EDT), FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_conteudo`.`CNT_STS`", 1, FuriousExpressionsDB::EQUAL);

        $conteudo = ConteudoModel::doSelect($criteria);
        $this->conteudo = $conteudo[0];


        $this->bodyClasses = "home green purchase";

    }


    public function representantes($vars = null)
    {

        $criteria = new FuriousSelectCriteria();
        $criteria->addJoin(FuriousExpressionsDB::LEFT_JOIN, "`cnt_categorias_conteudos`", "`cnt_categorias_conteudos`.`CCL_CNT`", "`cnt_conteudo`.`CNT_ID`");
        if (!empty($_GET['releaseSearch'])) {

            $releaseSearch = addslashes($_GET['releaseSearch']);
            $criteria->add("`cnt_conteudo`.`CNT_TIT`", "%$releaseSearch%", FuriousExpressionsDB::LIKE);

        }
        $this->ufs = array(
            "AC" => "Acre",
            "AL" => "Alagoas",
            "AP" => "Amap?",
            "AM" => "Amazonas",
            "BA" => "Bahia",
            "CE" => "Cear?",
            "DF" => "Distrito Federal",
            "ES" => "Esp?rito Santo",
            "GO" => "Goi?s",
            "MA" => "Maranh?o",
            "MT" => "Mato Grosso",
            "MS" => "Mato Grosso do Sul",
            "MG" => "Minas Gerais",
            "PA" => "Par?",
            "PB" => "Para?ba",
            "PR" => "Paran?",
            "PE" => "Pernambuco",
            "PI" => "Piau?",
            "RJ" => "Rio de Janeiro",
            "RN" => "Rio Grande do Norte",
            "RS" => "Rio Grande do Sul",
            "RR" => "Rond?nia",
            "RO" => "Roraima",
            "SC" => "Santa Catarina",
            "SP" => "S?o Paulo",
            "SE" => "Sergipe",
            "TO" => "Tocantins"
        );
        $ufsIndex = array_keys($this->ufs);
        $this->ufsIndex = $ufsIndex;
        $this->currentState = "Brasil";

        $this->imgUF = $ufsIndex[rand(0, (count($this->ufs) - 1))];

        if (!empty($_GET['uf']) && !empty($this->ufs[strtoupper($_GET['uf'])])) {
            $criteria2 = new FuriousSelectCriteria();
            $criteria2->add("`estado`.`sigla`", addslashes($_GET['uf']), FuriousExpressionsDB::EQUAL);

            $state = EstadoModel::doSelect($criteria2);

            if (!empty($state[0])) {
                $state2 = $state[0];
                $this->state = $state2;
                $this->imgUF = $this->state->sigla;

                $criteria->add("`cnt_conteudo`.`CNT_CKY`", $state2->id, FuriousExpressionsDB::EQUAL);
            }


        }

        $criteria->add("`cnt_conteudo`.`CNT_TIP`", "REP", FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_conteudo`.`CNT_STS`", 1, FuriousExpressionsDB::EQUAL);

        $this->releases = ConteudoModel::doSelect($criteria);


        $criteria = new FuriousSelectCriteria();
        $criteria->add("`cnt_destaques`.`DTQ_STS`", '1', FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_destaques`.`DTQ_TIP`", $this->imgUF, FuriousExpressionsDB::EQUAL);
        $criteria->setLimit(1);

        $this->img = DestaquesModel::doSelect($criteria);

        $criteria = new FuriousSelectCriteria();
        $criteria->add("`cnt_destaques`.`DTQ_EDT`", (19 + APP_PLUS_EDT), FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_destaques`.`DTQ_TIP`", "bg", FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_destaques`.`DTQ_STS`", 1, FuriousExpressionsDB::EQUAL);

        $destaque = DestaquesModel::doSelect($criteria);

        $this->destaque = $destaque[0];

        $this->heading = array("BREADCRUMB" =>
            array("LINKS" =>
                array("/a-piracanjuba" => "{A_Piracanjuba}",
                    $vars[0][0] => "{Representantes}"),
            ), "IMAGE" => $this->destaque->getDTQFTO()->getFile()->getPath2(),
            "TXT" => "{MSG_REPRESENTANTES}",
            "DESC" => "{DESC_REPRESENTANTES}",
        );
        $this->pageTitle = "{Representantes}";

        $this->bodyClasses = "home red representantive imprensa";
    }

    public function unidadeFabris($vars)
    {


        $criteria = new FuriousSelectCriteria();

        $criteria->add("`cnt_conteudo`.`CNT_IPR`", (17 + APP_PLUS_EDT), FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_conteudo`.`CNT_STS`", 1, FuriousExpressionsDB::EQUAL);

        $conteudo = ConteudoModel::doSelect($criteria);
        $this->conteudos = $conteudo;

        $this->heading = array("BREADCRUMB" => array(
            "LINKS" => array(
                '#' => "{A_Piracanjuba}",
                $vars[0][0] => "{Unidades}"
            ),

        ),
            "SHOW_IMAGE" => false
            //"IMAGE" => $conteudo[0]->getDTQFTO()->getFile()->getPath2(),
            //"TXT" => "{SLOGAN_RELEASE}"
        );

        $this->pageTitle = "{Unidade_Fabris}";

        $this->bodyClasses = "home red unit";
    }


    public function busca($vars = NULL)
    {
        $this->bodyId = "interna";

        if (!empty($_GET['q'])) {
            $q = strip_tags(addslashes($_GET['q']));

            $criteria = new FuriousSelectCriteria();
            $criteria->addComplexFilter('`cnt_conteudo`.`CNT_TIT`', '%' . $q . '%', FuriousExpressionsDB::LIKE, '`cnt_conteudo`.`CNT_TXT`', '%' . $q . '%', FuriousExpressionsDB::LIKE, FuriousExpressionsDB::SQL_OR);
            $criteria->add("`cnt_conteudo`.`CNT_TIT`", '', FuriousExpressionsDB::IS_NOT_NULL);
            $criteria->add("`cnt_conteudo`.`CNT_TIT`", '', FuriousExpressionsDB::NOT_EQUAL);
            $criteria->add("`cnt_conteudo`.`CNT_STS`", '1', FuriousExpressionsDB::EQUAL);
            //$criteria->add("`cnt_conteudo`.`CNT_DTA`", date('Y-m-d H:i:s'), FuriousExpressionsDB::MINOR_THAN);
            //$criteria->add("`cnt_conteudo`.`CNT_TIP`", "ST", FuriousExpressionsDB::NOT_EQUAL);

            $this->doPagination('ConteudoModel', 'content', $criteria, $vars);

        }


        $this->heading = array("BREADCRUMB" => array(
            "LINKS" => array(
                '#' => "{A_Piracanjuba}",
                $vars[0][0] => "{Busca}"
            ),
        ),
            "SHOW_IMAGE" => false,
            //"IMAGE" => $conteudo[0]->getDTQFTO()->getFile()->getPath2(),
            //"TXT" => "{SLOGAN_RELEASE}"
        );
        $this->pageTitle = "{Busca}";

        $this->bodyClasses = "home red imprensa searchPage";

    }

    //----------------------------------------------------------------------

    public function ContatoProCampo()
    {

        $criteria = new FuriousSelectCriteria();

        $criteria->add("`cnt_destaques`.`DTQ_TIP`", "ctt", FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_destaques`.`DTQ_STS`", 1, FuriousExpressionsDB::EQUAL);

        $destaques = DestaquesModel::doSelect($criteria);
        $this->destaques = $destaques;

        $this->bodyClasses = "home red profield";


    }


    public function ultimas($vars = NULL)
    {
        $this->initProdutoJson($vars);
        $itensPerPage = 10;
        $this->bodyId = "interna";

        $this->jsonCat = json_decode(file_get_contents(APP_JSON_PATH . "SITE_1.json"), true);

        $this->doPaginationJSON(count($this->jsonCat["news"]), $vars, $itensPerPage);

    }


    public function galerias($vars = NULL)
    {
        $this->initProdutoJson($vars);
        $itensPerPage = 10;
        $this->bodyId = "interna";

        $this->jsonCat = json_decode(file_get_contents(APP_JSON_PATH . "SITE_1_GA.json"), true);

        $this->doPaginationJSON(count($this->jsonCat["news"]), $vars, $itensPerPage);

    }

    public function OqueeoProCampo()
    {

        $criteria = new FuriousSelectCriteria();

        $criteria->add("`cnt_destaques`.`DTQ_TIP`", "oqp", FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_destaques`.`DTQ_STS`", 1, FuriousExpressionsDB::EQUAL);

        $destaques = DestaquesModel::doSelect($criteria);
        $this->destaques = $destaques;

        $this->bodyClasses = "home red profield";


    }


    public function OqueeoProCampo2()
    {

        $criteria = new FuriousSelectCriteria();

        $criteria->add("`cnt_destaques`.`DTQ_TIP`", "oq2", FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_destaques`.`DTQ_STS`", 1, FuriousExpressionsDB::EQUAL);

        $destaques = DestaquesModel::doSelect($criteria);
        $this->destaques = $destaques;

        $this->bodyClasses = "home red profield the-profield";


    }


    public function PerguntasFrequentesProCampo()
    {

        $criteria = new FuriousSelectCriteria();

        $criteria->add("`cnt_destaques`.`DTQ_TIP`", "pgt", FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_destaques`.`DTQ_STS`", 1, FuriousExpressionsDB::EQUAL);

        $destaques = DestaquesModel::doSelect($criteria);
        $this->destaques = $destaques;

        $this->bodyClasses = "home red profield questions";


    }


    public function EquipeProCampo()
    {

        $criteria = new FuriousSelectCriteria();

        $criteria->add("`cnt_destaques`.`DTQ_TIP`", "eqp", FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_destaques`.`DTQ_STS`", 1, FuriousExpressionsDB::EQUAL);

        $destaques = DestaquesModel::doSelect($criteria);
        $this->destaques = $destaques;

        $this->bodyClasses = "home red profield";


    }


    public function QualidadeDoLeitoProCampo()
    {

        $criteria = new FuriousSelectCriteria();

        $criteria->add("`cnt_destaques`.`DTQ_TIP`", "qdl", FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_destaques`.`DTQ_STS`", 1, FuriousExpressionsDB::EQUAL);

        $destaques = DestaquesModel::doSelect($criteria);
        $this->destaques = $destaques;

        $this->bodyClasses = "home red profield";


    }


    public function CalendarioProCampo()
    {

        $criteria = new FuriousSelectCriteria();

        $criteria->add("`cnt_destaques`.`DTQ_TIP`", "cld", FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_destaques`.`DTQ_STS`", 1, FuriousExpressionsDB::EQUAL);

        $destaques = DestaquesModel::doSelect($criteria);
        $this->destaques = $destaques;

        $this->bodyClasses = "home red profield";


    }


    public function proCampoParceiros()
    {

        $criteria = new FuriousSelectCriteria();

        $criteria->add("`cnt_destaques`.`DTQ_TIP`", "prc", FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_destaques`.`DTQ_STS`", 1, FuriousExpressionsDB::EQUAL);

        $destaques = DestaquesModel::doSelect($criteria);
        $this->destaques = $destaques;

        $this->bodyClasses = "home red profield";


    }


    //------------------------------------------------------------------------------------------------------------------

    public function editoria($vars = NULL)
    {

        $this->initProdutoJson($vars);
        //$this->template = (!empty($vars['VARS']['TEMPLATE']))?$vars['VARS']['TEMPLATE']:FALSE;
        if (!empty($vars['VARS']['TEMPLATE'])) {
            if ($vars['VARS']['TEMPLATE'] == "albuns") {
                $vars['VARS']['TYPE'] = "GA";
            }
            if ($vars['VARS']['TEMPLATE'] == "videos") {
                $vars['VARS']['TYPE'] = "VD";
            }
        }

        $this->loadCategoryJson($vars);

        $this->bodyId = "interna";
        //sobrescrever o pageTitle da p?gina [passar para o pagetTitle de noticias e n?o de produto]
        //ex: $this->pageTitle = $this->pagetitleNoticia;

        if ((!empty($this->template)) && ($this->template == "cidadezinhaalerta" || $this->template == "historiasquadrinhos")) {

        } else {
            $this->totalItens = count($this->jsonCat["news"]);

            $this->currentPage = (!empty($_GET['page'])) ? ((int)$_GET['page']) : 0;

            if (!empty($this->template)) {
                //var_dump($this->template);
                switch ($this->template) {
                    case ($this->template == "principaiscasos"):
                        $itensPerPage = 3;
                        break;
                    case ($this->template == "bastidores"):
                        $itensPerPage = 9;
                        break;
                    case ($this->template == "crimedecodificado"):
                        $itensPerPage = 6;
                        break;
                    case ($this->template == "porumdia"):
                        $itensPerPage = 4;
                        break;
                    case ($this->template == "marcelorezendenarra"):
                        $itensPerPage = 7;
                        break;
                    case ($this->template == "blog"):
                        $itensPerPage = 4;
                        break;
                    default:
                        $itensPerPage = 12;
                }
            } else {
                $itensPerPage = 10;
            }

            $this->doPaginationJSON(count($this->jsonCat["news"]), $vars, $itensPerPage);

        }

        if ((!empty($this->template)) && ($this->template == "marcelorezendenarra")) {

            $this->initConteudoJson(array("VARS" => array("ID" => 67)));

            $this->doPaginationJSON(count($this->content['comments']), $vars, $itensPerPage);
            //var_dump($vars);
            if (Document::hasFile(APP_JSON_PATH . "SITE_" . APP_DEFAULT_EDITORIAL . "_NT.json")) {
                $this->news = json_decode(file_get_contents(APP_JSON_PATH . "SITE_" . APP_DEFAULT_EDITORIAL . "_NT.json"), true);
            }

            if (!empty($_POST)) {
                $nome = $_POST['nome'];
                $email = $_POST['email'];
                $telefone = $_POST['telefone'];
                $estado = $_POST['estado'];
                $upload;

                //echo ($nome." - ".$email." - ".$telefone." - ".$estado." - ".$upload);

                $coment = new Mensagens();
                $coment->MSG_NOM = $nome;
                $coment->MSG_CNT = 67;
                $coment->MSG_IPR = 1;
                $coment->MSG_EMA = $email;
                $coment->MSG_TEL = $telefone;
                $coment->MSG_TIT = $estado;

                if (!empty($_FILES['upload'])) {
                    if (!is_array($_FILES['upload']['error'])) {
                        if ($_FILES['upload']['error'] == UPLOAD_ERR_OK) {

                            $name = Slugfy($_FILES['upload']['name']);
                            $dir = Document::renderYMDStructure("uploads/users/", time());
                            if (!empty($dir)) {

                                $path = $dir . (str_replace(" ", "_", $_FILES['upload']['name']));

                                if (!Document::hasFile($path)) {
                                    if (Document::moveUploadedFile($_FILES['upload']["tmp_name"], $path)) {
                                        $arquivo = new Arquivo();
                                        $arquivo->ARQ_EXT = Document::getFileExtension($_FILES['upload']["name"]);
                                        $arquivo->ARQ_DIR = "uploads/users/";
                                        $arquivo->ARQ_NOM = str_replace(" ", "_", $_FILES['upload']['name']);
                                        $arquivo->ARQ_DTA = date("Y-m-d H:i:s");
                                        $arquivo->ARQ_STS = 1;
                                        $save = $arquivo->save();
                                        if ($save == true) {
                                            $upload = $arquivo->getARQID();
                                            //var_dump($upload);
                                        }
                                    }
                                } else {
                                    $dirPath = "uploads/users/" . (date("Y")) . "/" . (date("m")) . "/" . (date("d")) . "/";
                                    $fileName = Document::generateFilePrefix(str_replace(" ", "_", $_FILES['upload']['name']), $dirPath);
                                    if ($fileName !== false) {
                                        if (Document::moveUploadedFile($_FILES["upload"]["tmp_name"], sprintf("%s%s", $dirPath, $fileName))) {
                                            $arquivo = new Arquivo();
                                            $arquivo->ARQ_EXT = Document::getFileExtension($fileName);
                                            $arquivo->ARQ_DIR = "uploads/users/";
                                            $arquivo->ARQ_NOM = $fileName;
                                            $arquivo->ARQ_DTA = date("Y-m-d H:i:s");
                                            $arquivo->ARQ_STS = 1;
                                            $save = $arquivo->save();

                                            if ($save == true) {
                                                $upload = $arquivo->getARQID();
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    } else {
                        foreach ($_FILES["images"]["errors"] as $key => $error) {
                            if ($error == UPLOAD_ERR_OK) {

                                $name = $_FILES['images']['name'][$key];
                                $dir = Document::renderYMDStructure("uploads/users/", time());

                                if (!empty($dir)) {
                                    $path = $dir . (str_replace(" ", "_", $_FILES['upload']['name']));

                                    if (!Document::hasFile($path)) {
                                        if (Document::moveUploadedFile($_FILES["images"]["tmp_name"][$key], $path)) {
                                            $arquivo = new Arquivo();
                                            $arquivo->ARQ_EXT = Document::getFileExtension($_FILES["images"]["name"][$key]);
                                            $arquivo->ARQ_NOM = $_FILES['images']['name'][$key];
                                            $arquivo->ARQ_DIR = "uploads/users/";
                                            $arquivo->ARQ_DTA = date("Y-m-d H:i:s");
                                            $arquivo->ARQ_STS = 1;
                                            $save = $arquivo->save();
                                            if ($save) {
                                                $upload = $arquivo->getARQID();
                                            }
                                        }
                                    } else {
                                        $dirPath = "uploads/" . (date("Y")) . "/" . (date("m")) . "/" . (date("d")) . "/";
                                        $fileName = Document::generateFilePrefix($_FILES['images']['name'][$key], $dirPath);
                                        if ($fileName !== false) {
                                            if (Document::moveUploadedFile($_FILES["images"]["tmp_name"][$key], sprintf("%s%s", $dirPath, $fileName))) {
                                                $arquivo = new Arquivo();
                                                $arquivo->ARQ_EXT = Document::getFileExtension($fileName);
                                                $arquivo->ARQ_NOM = $fileName;
                                                $arquivo->ARQ_DIR = "uploads/users/";
                                                $arquivo->ARQ_DTA = date("Y-m-d H:i:s");
                                                $arquivo->ARQ_STS = 1;
                                                $save = $arquivo->save();
                                                if ($save) {
                                                    $upload = $arquivo->getARQID();
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                } else {
                    echo("? necess?rio o preenchimento do campo upload.");
                }

                $coment->MSG_TXT = $upload;
                $coment->MSG_STS = 0;
                $coment->save();
                if ($coment->save() == true) {
                    $this->Success = true;
                }
            }

        }

    }

    public function subPorumDia($vars = null)
    {
        $this->subeditoria($vars);

        if (!empty($_POST['pordia'])) {
            $values = $_POST['pordia'];
            $this->values = $values;
            $errors = array();

            $obrigatory = array("nome" => "Nome", "cidade" => "Cidade", "embed" => "Embed", "email" => "E-mail");
            foreach ($obrigatory as $field => $label) {
                $value = trim($values[$field]);
                if (empty($value)) {
                    $errors[] = $label . " n?o pode ficar vazio.";
                }
            }
            if (empty($values['concordo'])) {
                $errors[] = "Voc? deve aceitar os termos";
            }
            if (!empty($values['email']) && !filter_var($values['email'], FILTER_VALIDATE_EMAIL)) {
                $errors[] = "E-mail inv?lido";
            }
            if (!empty($values['embed']) && !preg_match("/youtube\.com\/watch\?v\=/i", $values['embed'])) {
                $errors[] = "Url do youtube inv?lida";
            }

            if (count($errors) > 0) {
                $this->errors = $errors;
            } else {
                $coment = new Mensagens();
                $coment->MSG_NOM = addslashes(utf8_decode($values['nome']));
                $coment->MSG_CNT = 68;
                $coment->MSG_IPR = 1;
                $coment->MSG_EMA = addslashes(utf8_decode($values['email']));;
                $coment->MSG_TIT = addslashes(utf8_decode($values['cidade']));;
                $coment->MSG_TXT = addslashes(utf8_decode($values['embed']));;
                $coment->MSG_STS = 0;
                if ($coment->save()) {
                    $this->success = true;
                }
            }
        }
    }

    public function subeditoria($vars = NULL)
    {
        $this->template = (!empty($vars['VARS']['TEMPLATE'])) ? $vars['VARS']['TEMPLATE'] : "subeditoria";
        $this->setTemplate($this->template);
        $this->editoria($vars);
        $this->bodyId = "interna";
    }

    public function internaAnos($vars = null)
    {
        $criteria = new FuriousSelectCriteria();
        $criteria->add("`cnt_conteudo`.`CNT_ID`", addslashes($vars['VARS']['ID']), FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_conteudo`.`CNT_STS`", 1, FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_conteudo`.`CNT_TIP`", 'AN', FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_conteudo`.`CNT_DTA`", date("Y-m-d H:i:s"), FuriousExpressionsDB::MINOR_EQUAL);
        $criteria->setLimit(1);
        $this->content = ConteudoModel::doSelect($criteria);

        if (empty($this->content[0])) {
            $this->Error404();
        } else {
            $this->content = $this->content[0];
        }
    }
}

?>
