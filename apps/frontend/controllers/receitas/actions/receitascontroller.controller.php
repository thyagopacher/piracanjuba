<?php

class ReceitasController extends DefaultController
{
    public function index($vars = null)
    {
        if(!empty($vars['VARS']['cat'])){

            $categoria = $vars['VARS']['cat'];
        }

        $criteria = new FuriousSelectCriteria();
        $criteria->add("`cnt_destaques`.`DTQ_EDT`", 20, FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_destaques`.`DTQ_TIP`", "bg", FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_destaques`.`DTQ_STS`", 1, FuriousExpressionsDB::EQUAL);

        $bg = DestaquesModel::doSelect($criteria);
        $this->bg = $bg[0];

        $this->bodyClasses = "home red recipes";
        $this->heading = array("BREADCRUMB" => array("LINKS" => array('/receitas' => "{RECEIPTS}")),"IMAGE" => $this->bg->getDTQFTO()->getFile()->getPath2());
        $this->pageTitle = "{RECEIPTS}";

        $criteria = new FuriousSelectCriteria();

        if (!empty($_POST)) {

            $criteria->addJoin(FuriousExpressionsDB::LEFT_JOIN, "`cnt_categorias_conteudos`", "`cnt_categorias_conteudos`.`CCL_CNT`", "`cnt_conteudo`.`CNT_ID`");
            $releaseSearch = $_POST['titulo_dica'];
            $category = $_POST['category'];
            if(!empty($category)){
                $criteria->add("`cnt_categorias_conteudos`.`CCL_CAT`", $category, FuriousExpressionsDB::LIKE);
            }

            $criteria->add("`cnt_conteudo`.`CNT_TIT`", "%$releaseSearch%", FuriousExpressionsDB::LIKE);

        }


        if(!empty($categoria) && $categoria != "todas"){

            $criteria->addJoin(FuriousExpressionsDB::LEFT_JOIN, "`cnt_categorias_conteudos`", "`cnt_categorias_conteudos`.`CCL_CNT`", "`cnt_conteudo`.`CNT_ID`");
            $criteria->addJoin(FuriousExpressionsDB::LEFT_JOIN, "`cnt_categorias`", "`cnt_categorias_conteudos`.`CCL_CAT`", "`cnt_categorias`.`CAT_ID`");
            $criteria->add("LOWER(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(REPLACE(TRIM(`cnt_categorias`.`CAT_NOM`), ':', ''), ')', ''), '(', ''), ',', ''), '\\\\', ''), '\/', ''), '\"', ''), '?', ''), '\'', ''), '&', ''), '!', ''), '.', ''), ' ', '-'), '--', '-'), '--', '-'))", $categoria, FuriousExpressionsDB::EQUAL);

            $criteria->add("`cnt_categorias_conteudos`.`CCL_STS`", 1, FuriousExpressionsDB::EQUAL);

        }

        $criteria->add("`cnt_conteudo`.`CNT_TIP`", "REC", FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_conteudo`.`CNT_STS`", 1, FuriousExpressionsDB::EQUAL);
        $criteria->addGroupBy("`cnt_conteudo`.`CNT_ID`");




        /*$criteria->add("`cnt_categorias_conteudos`.`CCL_CAT`", 35, FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_categorias_conteudos`.`CCL_STS`", 1, FuriousExpressionsDB::EQUAL);*/


        $this->doPagination('ConteudoModel', 'receitas', $criteria, $vars, 10);
    }

    public function interna($vars = null)
    {


        $id = $vars['VARS']['ID'];

        $this->bodyClasses = "home red recipes";
        $this->pageTitle = "{RECEIPTS}";
        $criteria = new FuriousSelectCriteria();

        $criteria->add("`cnt_conteudo`.`CNT_TIP`", "REC", FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_conteudo`.`CNT_STS`", 1, FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_conteudo`.`CNT_ID`", $id, FuriousExpressionsDB::EQUAL);
        $receita = ConteudoModel::doSelect($criteria);
        $this->receita = $receita[0];



        $criteria = new FuriousSelectCriteria();
        $criteria->addJoin(FuriousExpressionsDB::LEFT_JOIN, "`cnt_categorias_conteudos`", "`cnt_categorias_conteudos`.`CCL_CAT`", "`cnt_conteudo`.`CNT_ID`");
        $criteria->add("`cnt_categorias_conteudos`.`CCL_CNT`", $receita[0]->CNT_ID, FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_categorias_conteudos`.`CCL_TIP`", "PROD", FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_categorias_conteudos`.`CCL_STS`", 1, FuriousExpressionsDB::EQUAL);

        $this->produtos = ConteudoModel::doSelect($criteria);


        $this->heading = array("BREADCRUMB" => array("LINKS" => array('/receitas' => "{RECEIPTS}")),"IMAGE" => $this->receita->getCNTFTO()->getFile()->getPath2(), "TXT" => $this->receita->CNT_TIT);
        $this->bodyClasses = "home red internalTips internalRecipes";


    }

    public function impressao($vars = null)
    {

        /*
        $id = $vars['VARS']['ID'];

        $this->bodyClasses = "home red recipes";
        $this->pageTitle = "{RECEIPTS}";
        $criteria = new FuriousSelectCriteria();

        $criteria->add("`cnt_conteudo`.`CNT_TIP`", "REC", FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_conteudo`.`CNT_STS`", 1, FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_conteudo`.`CNT_ID`", $id, FuriousExpressionsDB::EQUAL);
        $receita = ConteudoModel::doSelect($criteria);
        $this->receita = $receita[0];


        $criteria = new FuriousSelectCriteria();
        $criteria->addJoin(FuriousExpressionsDB::LEFT_JOIN, "`cnt_categorias_conteudos`", "`cnt_categorias_conteudos`.`CCL_CAT`", "`cnt_conteudo`.`CNT_ID`");
        $criteria->add("`cnt_categorias_conteudos`.`CCL_CNT`", $receita[0]->CNT_ID, FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_categorias_conteudos`.`CCL_TIP`", "PROD", FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_categorias_conteudos`.`CCL_STS`", 1, FuriousExpressionsDB::EQUAL);


        $this->produtos = ConteudoModel::doSelect($criteria);




        $this->heading = array("BREADCRUMB" => array("LINKS" => array('/receitas' => "{RECEIPTS}")), "IMAGE" => $this->receita->getCNTFTO()->getFile()->getPath(), "TXT" => $this->receita->CNT_TIT);
        $this->bodyClasses = "home print internalTips internalRecipes";
        */
        $this->print = true;
        $this->interna($vars);
        $this->heading = array("BREADCRUMB" => array("LINKS" => array('/receitas' => "{RECEIPTS}")),  "SHOW_IMAGE"=>false, "TXT" => $this->receita->CNT_TIT);
        $this->bodyClasses = "home print internalTips internalRecipes";

        $this->setLayout("impressao");


    }


}

?>
