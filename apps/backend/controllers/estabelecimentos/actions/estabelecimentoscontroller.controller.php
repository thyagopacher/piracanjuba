<?php

class EstabelecimentosController extends DefaultBackEnd2Controller
{
    const THUMB_TYPE = "THB_CNT";
    public $moduleName = "Estabelecimentos";
    public $moduleDir = "estabelecimentos";

    public function index($vars = null)
    {

        $this->pageTitle = "Listar Estabelecimentos";

        $this->breadCrumb = array("/estabelecimentos/index.php" => "Estabelecimentos");

        $criteria = new FuriousSelectCriteria();
        $criteria->add("`cnt_conteudo`.`CNT_TIP`", "EST", FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_conteudo`.`CNT_STS`", 9, FuriousExpressionsDB::NOT_EQUAL);
        $criteria->add("`cnt_conteudo`.`CNT_STS`", 8, FuriousExpressionsDB::NOT_EQUAL);
        $criteria->add("`cnt_conteudo`.`CNT_IPR`", $this->Site->getPDTID(), FuriousExpressionsDB::EQUAL);
        $criteria->addDescendingOrder("`cnt_conteudo`.`CNT_DTA`");


        $this->applyFilters($criteria, "`cnt_conteudo`.`CNT_STS`", "`cnt_conteudo`.`CNT_TIT`");


        $this->doPagination("NoticiaModel", "itens", $criteria, $vars);
    }

    public function novo($vars = null)
    {
        $this->pageTitle = "Adicionar Estabelecimento";
        $this->breadCrumb = array("estabelecimentos/index.php" => "Estabelecimentos");

        $newsID = null;
        if (!empty($_GET["ID"])) {
            $newsID = $_GET["ID"];
        }
        if (!empty($_POST["news"]["CNT_ID"])) {
            $newsID = $_POST["news"]["CNT_ID"];
        }

        if ($newsID != null) {
            $this->breadCrumb["/estabelecimentos/new.php"] = "Editar Estabelecimento";
            $this->pageTitle = "Editar Estabelecimento";
            $content = NoticiaModel::getOne(addslashes($newsID));
            $this->content = $content[0];
            $this->content->CNT_TIP = "EST";

        } else {
            $this->breadCrumb["/estabelecimentos/new.php"] = "Adicionar Estabelecimento";

            $this->content = new Noticia();
            $this->content->CNT_SIT = $this->Site->getPDTID();
            $this->content->CNT_IPR = $this->Site->getPDTID();
            $this->content->CNT_TIP = "EST";
            $this->content->CNT_STS = 8;
            $this->content->CNT_DTA = date("Y-m-d H:i:s");
            $this->content->save();
            //$this->content->CNT_STS = 0;
        }

        if (Dispatcher::getPostValues("news")) {


            $edts = array();
            $tags = array();
            $links = array();
            $imgNews = NULL;
            $imgNews2 = NULL;
            $imgNews3 = NULL;

            $values = Dispatcher::getPostValues("news");

            $values["CNT_DTA"] = date("Y-m-d H:i:s", strtotime(str_replace("/", "-", $values["CNT_DTA"])));


            if (!empty($values["EDT_CATS"])) {
                $edts = $values["EDT_CATS"];
                unset($values["EDT_CATS"]);
            }
            if (!empty($values["cnt_tags"])) {
                $tags = $values["cnt_tags"];
                unset($values["cnt_tags"]);
            }

            if (isset($values["IMG_DTQ"])) {
                $imgNews = $values["IMG_DTQ"];
                unset($values["IMG_DTQ"]);
            }
            if (isset($values["IMG_DTQ2"])) {
                $imgNews2 = $values["IMG_DTQ2"];
                unset($values["IMG_DTQ2"]);
            }
            if (isset($values["IMG_DTQ3"])) {
                $imgNews3 = $values["IMG_DTQ3"];
                unset($values["IMG_DTQ3"]);
            }

            if (!empty($values["CNT_LINK"])) {
                $links = $values["CNT_LINK"];
                unset($values["CNT_LINK"]);
            }

            if (!empty($values["cnt_prods"])) {
                $prods = $values["cnt_prods"];
                unset($values["cnt_prods"]);
                if (!empty($values["cnt_tags"])) {
                    $prods = array_merge($prods, $values["cnt_tags"]);
                }
                unset($values["cnt_tags"]);

            }

            // Save Noticia
            $this->content->CNT_CMT = 0;
            foreach ($values as $key => $value) {
                $this->content->$key = $value;
            }

            if (!$this->content->save()) {
                $this->Errors = "{Save Error, try later}";
            } else {
                $this->Message = "Estabelecimento Cadastrado";
            }

            // Get Noticia ID
            $ID = $this->content->getCNTID();
            if (!empty($edts[0])) {
                // Update Editorial Relations
                $this->updateEdtsRelations($ID, $edts, "PROD_EST");
            }
            if (empty($prods)) {
                $prods = array();
            }
            $this->updateProdsRelationss($ID, $prods, 'PROD_EST');

            // Save Featured
            $this->createFeatureds($this->content);

            //$this->content->generateJSON();
//				$this->content->generateJsonLists();

        }

        $this->action = $this->Editorial->getURL() . "estabelecimentos/edit.php?ID=" . ($this->content->getCNTID());

    }

    public function csv($vars = null)
    {

        $this->pageTitle = "Importar CSV de estabelecimentos";

        if (!empty($_FILES)) {


            //Importar o arquivo transferido para o banco de dados
            $handle = fopen($_FILES['filename']['tmp_name'], "r");

            $i = 0;
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {

                if(!empty($data[0])){
                    $empresa = $data[0];
                    $nome_estabelecimento = $data[1];
                    $email = $data[2];
                    $descricao = $data[3];
                    $cidade = $data[4];
                    $endereco = $data[5];
                    $categorias = @$data[6];

                    $estabelecimento = new Noticia();
                    $estabelecimento->CNT_SIT = $this->Site->getPDTID();
                    $estabelecimento->CNT_IPR = $this->Site->getPDTID();
                    $estabelecimento->CNT_TIP = "EST";
                    $estabelecimento->CNT_STS = 1;
                    $estabelecimento->CNT_DTA = date("Y-m-d H:i:s");


                    $estabelecimento->CNT_TIT = $empresa;
                    $estabelecimento->CNT_OLH = $nome_estabelecimento;
                    $estabelecimento->CNT_RES = $email;
                    $estabelecimento->CNT_TXT = $descricao;
                    $estabelecimento->CNT_RDT = $cidade;
                    $estabelecimento->CNT_EMB = $endereco;
                    $estabelecimento->save();
                    if (!empty($categorias)) {


                        $cats = explode('/', $categorias);
                        foreach ($cats as $cat) {


                            $criteria = new FuriousSelectCriteria();
                            $criteria->add("`cnt_categorias_conteudos`.`CCL_TIP`", "PROD", FuriousExpressionsDB::EQUAL);
                            $criteria->add("`cnt_categorias_conteudos`.`CCL_STS`", 1, FuriousExpressionsDB::EQUAL);
                            $criteria->add("`cnt_categorias_conteudos`.`CCL_CAT`", $cat, FuriousExpressionsDB::EQUAL);
                            $criteria->addJoin(FuriousExpressionsDB::LEFT_JOIN, "`cnt_conteudo`", "`cnt_categorias_conteudos`.`CCL_CNT`", "`cnt_conteudo`.`CNT_ID`");

                            $criteria->add("`cnt_conteudo`.`CNT_TIP`", "PROD", FuriousExpressionsDB::EQUAL);
                            $criteria->addGroupBy("`cnt_categorias_conteudos`.`CCL_CNT`");
                            $produtos = CategoriaconteudoModel::doSelect($criteria);

                            foreach ($produtos as $produto){

                                $categoria_estabelecimento = new Categoriaconteudo();
                                $categoria_estabelecimento->CCL_CNT = $estabelecimento->CNT_ID;
                                $categoria_estabelecimento->CCL_CAT = $produto->CCL_CNT;
                                $categoria_estabelecimento->CCL_TIP = "PROD_EST";
                                $categoria_estabelecimento->CCL_STS = 1;
                                $categoria_estabelecimento->save();

                            }

                        }

                    }
                }
                $i++;
            }

            fclose($handle);

            $this->importacao = "Impotação realizada com sucesso! Foram importados $i estabelecimentos.";

        }
    }

    public function delete($vars = null)
    {
        $this->setTemplate("delete", "default");

        $this->pageTitle = "Estabelecimento deletado";
        $this->breadCrumb = array("estabelecimentos/index.php" => "Estabelecimentos");
        if (!empty($_GET["ID"])) {
            $content = NoticiaModel::getOne(addslashes($_GET["ID"]));
            $this->content = $content[0];
            if ($this->content->delete()) {
                $this->DeleteOk = true;
            }
        } else {
            $this->Error404();
        }
    }

    public function quick($vars = null)
    {
        $this->setTemplate("quick", "default");

        if (Dispatcher::getPostValues("quick")):
            $values = Dispatcher::getPostValues("quick");
            $values["CNT_DTA"] = date("Y-m-d H:i:s", strtotime(str_replace("/", "-", $values["CNT_INI"])));

            if (!empty($values["CNT_ID"])):
                $this->item = DestaquesModel::getOne($values["CNT_ID"]);

                // If isn't empty itens returned
                if (!empty($this->item[0])) {
                    // Set Content variable and set Page Title
                    $this->content = $this->item[0];

                    foreach ($values as $key => $value):
                        $this->content->$key = $value;
                    endforeach;
                    if (empty($values["CNT_STS"])) {
                        $this->content->CNT_STS = 0;
                    }

                    if ($this->content->save()):
                        $this->success = true;
                    endif;
                }
            endif;
        endif;
    }
}

?>
