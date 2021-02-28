<?php

class ProdutosController extends DefaultController
{
    public function index($vars = null)
    {
        $this->bodyClasses = "home red recipes";
        $this->heading = array("BREADCRUMB" => array("LINKS" => array('/receitas' => "{RECEIPTS}")));
        $this->pageTitle = "{RECEIPTS}";


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




        $this->heading = array("BREADCRUMB" => array("LINKS" => array('/receitas' => "{RECEIPTS}")), "IMAGE" => $this->receita->getCNTFTO()->getFile()->getPath2(), "TXT" => $this->receita->CNT_TIT);
        $this->bodyClasses = "home red internalTips internalRecipes";


    }

    public function impressao($vars = null)
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




        $this->heading = array("BREADCRUMB" => array("LINKS" => array('/receitas' => "{RECEIPTS}")), "IMAGE" => $this->receita->getCNTFTO()->getFile()->getPath2(), "TXT" => $this->receita->CNT_TIT);
        $this->bodyClasses = "home print internalTips internalRecipes";


    }


}

?>
