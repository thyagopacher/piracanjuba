<?php

class indexBlock extends DefaultBlock
{
    private function translation()
    {
        $url = $_SERVER['REQUEST_URI'];
        $this->lingua_br = "";
        $this->lingua_es = "";
        $this->lingua_en = "";

        $linguagem = 0;
        if (strripos($url, "-br") !== false) {
            $ling = "br";
            $linguagem = "10";
            $this->lingua_br = "selected='selected'";
        } else if (strripos($url, "-es") !== false) {
            $ling = "es";
            $linguagem = "11";
            $this->lingua_es = "selected='selected'";
        } else {
            if (strripos($url, "/br") !== false) {
                $ling = "br";
                $linguagem = "10";
                $this->lingua_br = "selected='selected'";
            } else if (strripos($url, "/es") !== false) {
                $ling = "es";
                $linguagem = "11";
                $this->lingua_es = "selected='selected'";
            } else {
                $linguagem = "12";
                $ling = "en";
                $this->lingua_en = "selected='selected'";
            }
            $this->linguagem = $linguagem;
        }

        $this->linguagem = $linguagem;
        $this->ling = $ling;
        return $linguagem;

    }

    public function menu($vars = null)
    {
        // TRATANDO INTERNACIONALIZAÇÃO
        $linguagem = $this->translation();

        //MENU
        $criteria = new FuriousSelectCriteria();
        $criteria->add("`cnt_destaques`.`DTQ_EDT`", $linguagem, FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_destaques`.`DTQ_TIP`", "mn", FuriousExpressionsDB::EQUAL);
        $criteria->addDescendingOrder("`cnt_destaques`.`DTQ_ORD`");
        $criteria->add("`cnt_destaques`.`DTQ_STS`", 1, FuriousExpressionsDB::EQUAL);
        $criteria->addAscendingOrder("`cnt_destaques`.`DTQ_ID`");
        $this->menu = DestaquesModel::doSelect($criteria);

    }

    public function menumarket($vars = null)
    {
        // TRATANDO INTERNACIONALIZAÇÃO
        $linguagem = $this->translation();

        //MENU
        $criteria = new FuriousSelectCriteria();
        $criteria->add("`cnt_destaques`.`DTQ_EDT`", $linguagem, FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_destaques`.`DTQ_TIP`", "mn", FuriousExpressionsDB::EQUAL);
        $criteria->addDescendingOrder("`cnt_destaques`.`DTQ_ORD`");
        $criteria->add("`cnt_destaques`.`DTQ_STS`", 1, FuriousExpressionsDB::EQUAL);
        $criteria->addAscendingOrder("`cnt_destaques`.`DTQ_ID`");
        $this->menu = DestaquesModel::doSelect($criteria);
    }

    public function rotativo()
    {
        // TRATANDO INTERNACIONALIZAÇÃO
        $linguagem = $this->translation();

        //BANNER ROTATIVO - PRIMEIRO BLOCO DO SITE
        $criteria = new FuriousSelectCriteria();
        $criteria->add("`cnt_destaques`.`DTQ_EDT`", $linguagem, FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_destaques`.`DTQ_TIP`", "rt", FuriousExpressionsDB::EQUAL);
        $criteria->addDescendingOrder("`cnt_destaques`.`DTQ_ORD`");
        $criteria->add("`cnt_destaques`.`DTQ_STS`", 1, FuriousExpressionsDB::EQUAL);
        $criteria->addAscendingOrder("`cnt_destaques`.`DTQ_ID`");
        $this->rotativo = DestaquesModel::doSelect($criteria);

    }

    public function rotativoMarket()
    {
        // TRATANDO INTERNACIONALIZAÇÃO
        $linguagem = $this->translation();

        //BANNER ROTATIVO - PRIMEIRO BLOCO DO SITE
        $criteria = new FuriousSelectCriteria();
        $criteria->add("`cnt_destaques`.`DTQ_EDT`", $linguagem, FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_destaques`.`DTQ_TIP`", "rtm", FuriousExpressionsDB::EQUAL);
        $criteria->addDescendingOrder("`cnt_destaques`.`DTQ_ORD`");
        $criteria->add("`cnt_destaques`.`DTQ_STS`", 1, FuriousExpressionsDB::EQUAL);
        $criteria->addAscendingOrder("`cnt_destaques`.`DTQ_ID`");
        $this->rotativo_market = DestaquesModel::doSelect($criteria);

    }

    public function internetMonitor()
    {
        // TRATANDO INTERNACIONALIZAÇÃO
        $linguagem = $this->translation();

        //INTERNET MONITOR - SEGUNDO BLOCO DO SITE
        $criteria = new FuriousSelectCriteria();
        $criteria->add("`cnt_destaques`.`DTQ_EDT`", $linguagem, FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_destaques`.`DTQ_TIP`", "md", FuriousExpressionsDB::EQUAL);
        $criteria->addDescendingOrder("`cnt_destaques`.`DTQ_ORD`");
        $criteria->add("`cnt_destaques`.`DTQ_STS`", 1, FuriousExpressionsDB::EQUAL);
        $criteria->addAscendingOrder("`cnt_destaques`.`DTQ_ID`");
        $this->internet = DestaquesModel::doSelect($criteria);

    }

    public function versoesTitulo()
    {
        // TRATANDO INTERNACIONALIZAÇÃO
        $linguagem = $this->translation();

        //VERSOES TITULO - SEGUNDO BLOCO DO SITE
        $criteria = new FuriousSelectCriteria();
        $criteria->add("`cnt_destaques`.`DTQ_EDT`", $linguagem, FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_destaques`.`DTQ_TIP`", "vs1", FuriousExpressionsDB::EQUAL);
        $criteria->addDescendingOrder("`cnt_destaques`.`DTQ_ORD`");
        $criteria->add("`cnt_destaques`.`DTQ_STS`", 1, FuriousExpressionsDB::EQUAL);
        $criteria->addAscendingOrder("`cnt_destaques`.`DTQ_ID`");
        $this->versoesTitulo = DestaquesModel::doSelect($criteria);
    }

    public function versoes()
    {
        // TRATANDO INTERNACIONALIZAÇÃO
        $linguagem = $this->translation();

        //VERSOES - TERCEIRO BLOCO DO SITE
        $criteria = new FuriousSelectCriteria();
        $criteria->add("`cnt_destaques`.`DTQ_EDT`", $linguagem, FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_destaques`.`DTQ_TIP`", "vs", FuriousExpressionsDB::EQUAL);
        $criteria->addDescendingOrder("`cnt_destaques`.`DTQ_ORD`");
        $criteria->add("`cnt_destaques`.`DTQ_STS`", 1, FuriousExpressionsDB::EQUAL);
        $criteria->addAscendingOrder("`cnt_destaques`.`DTQ_ID`");
        $this->versoes = DestaquesModel::doSelect($criteria);
    }


    public function highlightTitulo()
    {
        // TRATANDO INTERNACIONALIZAÇÃO
        $linguagem = $this->translation();
        //HIGHLIGHT TITULO - QUARTO BLOCO DO SITE
        $criteria = new FuriousSelectCriteria();
        $criteria->add("`cnt_destaques`.`DTQ_EDT`", $linguagem, FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_destaques`.`DTQ_TIP`", "hg1", FuriousExpressionsDB::EQUAL);
        $criteria->addDescendingOrder("`cnt_destaques`.`DTQ_ORD`");
        $criteria->add("`cnt_destaques`.`DTQ_STS`", 1, FuriousExpressionsDB::EQUAL);
        $criteria->addAscendingOrder("`cnt_destaques`.`DTQ_ID`");
        $this->highlightTitulo = DestaquesModel::doSelect($criteria);
    }

    public function highlight()
    {
        // TRATANDO INTERNACIONALIZAÇÃO
        $linguagem = $this->translation();
        //HIGHLIGHT - QUARTO BLOCO DO SITE
        $criteria = new FuriousSelectCriteria();
        $criteria->add("`cnt_destaques`.`DTQ_EDT`", $linguagem, FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_destaques`.`DTQ_TIP`", "hg", FuriousExpressionsDB::EQUAL);
        $criteria->addDescendingOrder("`cnt_destaques`.`DTQ_ORD`");
        $criteria->add("`cnt_destaques`.`DTQ_STS`", 1, FuriousExpressionsDB::EQUAL);
        $criteria->addAscendingOrder("`cnt_destaques`.`DTQ_ID`");
        $this->highlight = DestaquesModel::doSelect($criteria);
    }

    public function mapaTitulo()
    {
        // TRATANDO INTERNACIONALIZAÇÃO
        $linguagem = $this->translation();
        //MAPA - QUINTO BLOCO DO SITE
        $criteria = new FuriousSelectCriteria();
        $criteria->add("`cnt_destaques`.`DTQ_EDT`", $linguagem, FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_destaques`.`DTQ_TIP`", "mp", FuriousExpressionsDB::EQUAL);
        $criteria->addDescendingOrder("`cnt_destaques`.`DTQ_ORD`");
        $criteria->add("`cnt_destaques`.`DTQ_STS`", 1, FuriousExpressionsDB::EQUAL);
        $criteria->addAscendingOrder("`cnt_destaques`.`DTQ_ID`");
        $this->mapaTitulo = DestaquesModel::doSelect($criteria);
    }

    public function pontoMapa()
    {
        // TRATANDO INTERNACIONALIZAÇÃO
        $linguagem = $this->translation();
        //PONTOS NO MAPA
        $criteria = new FuriousSelectCriteria();
        $criteria->add("`cnt_destaques`.`DTQ_EDT`", $linguagem, FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_destaques`.`DTQ_TIP`", "mp1", FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_destaques`.`DTQ_STS`", "1", FuriousExpressionsDB::EQUAL);
        //$criteria->addDescendingOrder("`cnt_destaques`.`DTQ_ORD`");
        $criteria->add("`cnt_destaques`.`DTQ_STS`", 1, FuriousExpressionsDB::EQUAL);
        $criteria->addAscendingOrder("`cnt_destaques`.`DTQ_ID`");

        $this->pontoMapa = DestaquesModel::doSelect($criteria);
        /*echo "<pre>";
        echo $criteria;
        echo "</pre>";
        exit;*/
    }

    public function resultsTitulo()
    {
        // TRATANDO INTERNACIONALIZAÇÃO
        $linguagem = $this->translation();
        //RESULTS TITULO - SEXTO BLOCO DO SITE
        $criteria = new FuriousSelectCriteria();
        $criteria->add("`cnt_destaques`.`DTQ_EDT`", $linguagem, FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_destaques`.`DTQ_TIP`", "rs", FuriousExpressionsDB::EQUAL);
        $criteria->addDescendingOrder("`cnt_destaques`.`DTQ_ORD`");
        $criteria->add("`cnt_destaques`.`DTQ_STS`", 1, FuriousExpressionsDB::EQUAL);
        $criteria->addAscendingOrder("`cnt_destaques`.`DTQ_ID`");
        $this->resultsTitulo = DestaquesModel::doSelect($criteria);
    }

    public function results()
    {
        // TRATANDO INTERNACIONALIZAÇÃO
        $linguagem = $this->translation();
        //RESULTS - SEXTO BLOCO DO SITE
        $criteria = new FuriousSelectCriteria();
        $criteria->add("`cnt_destaques`.`DTQ_EDT`", $linguagem, FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_destaques`.`DTQ_TIP`", "rs1", FuriousExpressionsDB::EQUAL);
        $criteria->addDescendingOrder("`cnt_destaques`.`DTQ_ORD`");
        $criteria->add("`cnt_destaques`.`DTQ_STS`", 1, FuriousExpressionsDB::EQUAL);
        $criteria->addAscendingOrder("`cnt_destaques`.`DTQ_ID`");
        $this->results = DestaquesModel::doSelect($criteria);
    }

    public function perforceTitulo()
    {
        // TRATANDO INTERNACIONALIZAÇÃO
        $linguagem = $this->translation();
        //PERFORMACE TITULO - SÉTIMO BLOCO DO SITE
        $criteria = new FuriousSelectCriteria();
        $criteria->add("`cnt_destaques`.`DTQ_EDT`", $linguagem, FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_destaques`.`DTQ_TIP`", "pf", FuriousExpressionsDB::EQUAL);
        $criteria->addDescendingOrder("`cnt_destaques`.`DTQ_ORD`");
        $criteria->add("`cnt_destaques`.`DTQ_STS`", 1, FuriousExpressionsDB::EQUAL);
        $criteria->addAscendingOrder("`cnt_destaques`.`DTQ_ID`");
        $this->perforceTitulo = DestaquesModel::doSelect($criteria);
    }

    public function perforce()
    {
        // TRATANDO INTERNACIONALIZAÇÃO
        $linguagem = $this->translation();
        //PERFORMACE - SÉTIMO BLOCO DO SITE
        $criteria = new FuriousSelectCriteria();
        $criteria->add("`cnt_destaques`.`DTQ_EDT`", $linguagem, FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_destaques`.`DTQ_TIP`", "pf1", FuriousExpressionsDB::EQUAL);
        $criteria->addDescendingOrder("`cnt_destaques`.`DTQ_ORD`");
        $criteria->add("`cnt_destaques`.`DTQ_STS`", 1, FuriousExpressionsDB::EQUAL);
        $criteria->addAscendingOrder("`cnt_destaques`.`DTQ_ID`");
        $this->perforce = DestaquesModel::doSelect($criteria);
    }

    public function eim()
    {
        // TRATANDO INTERNACIONALIZAÇÃO
        $linguagem = $this->translation();
        //EIM - OITAVO BLOCO DO SITE
        $criteria = new FuriousSelectCriteria();
        $criteria->add("`cnt_destaques`.`DTQ_EDT`", $linguagem, FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_destaques`.`DTQ_TIP`", "eim", FuriousExpressionsDB::EQUAL);
        $criteria->addDescendingOrder("`cnt_destaques`.`DTQ_ORD`");
        $criteria->add("`cnt_destaques`.`DTQ_STS`", 1, FuriousExpressionsDB::EQUAL);
        $criteria->addAscendingOrder("`cnt_destaques`.`DTQ_ID`");
        $this->eim = DestaquesModel::doSelect($criteria);

        $this->eimPlus();
    }

    public function eimPlus()
    {
        // TRATANDO INTERNACIONALIZAÇÃO
        $linguagem = $this->translation();
        //EIM PLUS - OITAVO BLOCO DO SITE
        $criteria = new FuriousSelectCriteria();
        $criteria->add("`cnt_destaques`.`DTQ_EDT`", $linguagem, FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_destaques`.`DTQ_TIP`", "ei2", FuriousExpressionsDB::EQUAL);
        $criteria->addDescendingOrder("`cnt_destaques`.`DTQ_ORD`");
        $criteria->add("`cnt_destaques`.`DTQ_STS`", 1, FuriousExpressionsDB::EQUAL);
        $criteria->addAscendingOrder("`cnt_destaques`.`DTQ_ID`");
        $this->eimPlus = DestaquesModel::doSelect($criteria);

    }

    public function about()
    {
        // TRATANDO INTERNACIONALIZAÇÃO
        $linguagem = $this->translation();
        //ABOUT - NONO BLOCO DO SITE
        $criteria = new FuriousSelectCriteria();
        $criteria->add("`cnt_destaques`.`DTQ_EDT`", $linguagem, FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_destaques`.`DTQ_TIP`", "ab", FuriousExpressionsDB::EQUAL);
        $criteria->addDescendingOrder("`cnt_destaques`.`DTQ_ORD`");
        $criteria->add("`cnt_destaques`.`DTQ_STS`", 1, FuriousExpressionsDB::EQUAL);
        $criteria->addAscendingOrder("`cnt_destaques`.`DTQ_ID`");
        $this->about = DestaquesModel::doSelect($criteria);
    }

    public function address()
    {
        // TRATANDO INTERNACIONALIZAÇÃO
        $linguagem = $this->translation();

        $criteria = new FuriousSelectCriteria();
        $criteria->add("`cnt_destaques`.`DTQ_EDT`", $linguagem, FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_destaques`.`DTQ_TIP`", "ad", FuriousExpressionsDB::EQUAL);
        $criteria->addDescendingOrder("`cnt_destaques`.`DTQ_ORD`");
        $criteria->add("`cnt_destaques`.`DTQ_STS`", 1, FuriousExpressionsDB::EQUAL);
        $criteria->addAscendingOrder("`cnt_destaques`.`DTQ_ID`");
        $this->address = DestaquesModel::doSelect($criteria);


        $criteria = new FuriousSelectCriteria();
        $criteria->add("`cnt_destaques`.`DTQ_EDT`", $linguagem, FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_destaques`.`DTQ_TIP`", "sn", FuriousExpressionsDB::EQUAL);
        $criteria->addDescendingOrder("`cnt_destaques`.`DTQ_ORD`");
        $criteria->add("`cnt_destaques`.`DTQ_STS`", 1, FuriousExpressionsDB::EQUAL);
        $criteria->addAscendingOrder("`cnt_destaques`.`DTQ_ID`");
        $this->socialNetwork = DestaquesModel::doSelect($criteria);

    }

    public function titleCalc()
    {
        // TRATANDO INTERNACIONALIZAÇÃO
        $linguagem = $this->translation();
        // CALCULADORA
        $criteria = new FuriousSelectCriteria();
        $criteria->add("`cnt_destaques`.`DTQ_EDT`", $linguagem, FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_destaques`.`DTQ_TIP`", "ca1", FuriousExpressionsDB::EQUAL);
        $criteria->addDescendingOrder("`cnt_destaques`.`DTQ_ORD`");
        $criteria->add("`cnt_destaques`.`DTQ_STS`", 1, FuriousExpressionsDB::EQUAL);
        $criteria->addAscendingOrder("`cnt_destaques`.`DTQ_ID`");
        $this->titleCalc = DestaquesModel::doSelect($criteria);
    }

    public function calculadora()
    {
        // TRATANDO INTERNACIONALIZAÇÃO
        $linguagem = $this->translation();
        // CALCULADORA
        $criteria = new FuriousSelectCriteria();
        $criteria->add("`cnt_destaques`.`DTQ_EDT`", $linguagem, FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_destaques`.`DTQ_TIP`", "cal", FuriousExpressionsDB::EQUAL);
        $criteria->addDescendingOrder("`cnt_destaques`.`DTQ_ORD`");
        $criteria->add("`cnt_destaques`.`DTQ_STS`", 1, FuriousExpressionsDB::EQUAL);
        $criteria->addAscendingOrder("`cnt_destaques`.`DTQ_ID`");
        $this->calculadora = DestaquesModel::doSelect($criteria);
        $this->eim();
        $this->eimPlus();
    }


    public function marketexamples()
    {
        // TRATANDO INTERNACIONALIZAÇÃO
        $linguagem = $this->translation();


        //TITULO
        $criteria = new FuriousSelectCriteria();
        $criteria->add("`cnt_destaques`.`DTQ_EDT`", $linguagem, FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_destaques`.`DTQ_TIP`", "mk1", FuriousExpressionsDB::EQUAL);
        $criteria->addDescendingOrder("`cnt_destaques`.`DTQ_ORD`");
        $criteria->add("`cnt_destaques`.`DTQ_STS`", 1, FuriousExpressionsDB::EQUAL);
        $criteria->addAscendingOrder("`cnt_destaques`.`DTQ_ID`");
        $this->mkt_titulo = DestaquesModel::doSelect($criteria);


        // ECOMMERCE
        $criteria = new FuriousSelectCriteria();
        $criteria->add("`cnt_destaques`.`DTQ_EDT`", $linguagem, FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_destaques`.`DTQ_TIP`", "eco", FuriousExpressionsDB::EQUAL);
        $criteria->addDescendingOrder("`cnt_destaques`.`DTQ_ORD`");
        $criteria->add("`cnt_destaques`.`DTQ_STS`", 1, FuriousExpressionsDB::EQUAL);
        $criteria->addAscendingOrder("`cnt_destaques`.`DTQ_ID`");
        $this->eco = DestaquesModel::doSelect($criteria);

        // MEDIA
        $criteria = new FuriousSelectCriteria();
        $criteria->add("`cnt_destaques`.`DTQ_EDT`", $linguagem, FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_destaques`.`DTQ_TIP`", "med", FuriousExpressionsDB::EQUAL);
        $criteria->addDescendingOrder("`cnt_destaques`.`DTQ_ORD`");
        $criteria->add("`cnt_destaques`.`DTQ_STS`", 1, FuriousExpressionsDB::EQUAL);
        $criteria->addAscendingOrder("`cnt_destaques`.`DTQ_ID`");
        $this->media = DestaquesModel::doSelect($criteria);

        // FINANCIAL
        $criteria = new FuriousSelectCriteria();
        $criteria->add("`cnt_destaques`.`DTQ_EDT`", $linguagem, FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_destaques`.`DTQ_TIP`", "fin", FuriousExpressionsDB::EQUAL);
        $criteria->addDescendingOrder("`cnt_destaques`.`DTQ_ORD`");
        $criteria->add("`cnt_destaques`.`DTQ_STS`", 1, FuriousExpressionsDB::EQUAL);
        $criteria->addAscendingOrder("`cnt_destaques`.`DTQ_ID`");
        $this->financial = DestaquesModel::doSelect($criteria);


        $criteria = new FuriousSelectCriteria();
        $criteria->add("`cnt_destaques`.`DTQ_EDT`", $linguagem, FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_destaques`.`DTQ_TIP`", "ebu", FuriousExpressionsDB::EQUAL);
        $criteria->addDescendingOrder("`cnt_destaques`.`DTQ_ORD`");
        $criteria->add("`cnt_destaques`.`DTQ_STS`", 1, FuriousExpressionsDB::EQUAL);
        $criteria->addAscendingOrder("`cnt_destaques`.`DTQ_ID`");
        $this->business = DestaquesModel::doSelect($criteria);

    }


    public function salesmarketing()
    {
        // TRATANDO INTERNACIONALIZAÇÃO
        $linguagem = $this->translation();

        $criteria = new FuriousSelectCriteria();
        $criteria->add("`cnt_destaques`.`DTQ_EDT`", $linguagem, FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_destaques`.`DTQ_TIP`", "smk", FuriousExpressionsDB::EQUAL);
        $criteria->addDescendingOrder("`cnt_destaques`.`DTQ_ORD`");
        $criteria->add("`cnt_destaques`.`DTQ_STS`", 1, FuriousExpressionsDB::EQUAL);
        $criteria->addAscendingOrder("`cnt_destaques`.`DTQ_ID`");
        $this->sales = DestaquesModel::doSelect($criteria);

    }

    public function whyperformace()
    {
        // TRATANDO INTERNACIONALIZAÇÃO
        $linguagem = $this->translation();

        $criteria = new FuriousSelectCriteria();
        $criteria->add("`cnt_destaques`.`DTQ_EDT`", $linguagem, FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_destaques`.`DTQ_TIP`", "wpm", FuriousExpressionsDB::EQUAL);
        $criteria->addDescendingOrder("`cnt_destaques`.`DTQ_ORD`");
        $criteria->add("`cnt_destaques`.`DTQ_STS`", 1, FuriousExpressionsDB::EQUAL);
        $criteria->addAscendingOrder("`cnt_destaques`.`DTQ_ID`");
        $this->wpm = DestaquesModel::doSelect($criteria);


    }

    public function contactform()
    {

        $linguagem = $this->translation();

        $criteria = new FuriousSelectCriteria();
        $criteria->add("`cnt_destaques`.`DTQ_EDT`", $linguagem, FuriousExpressionsDB::EQUAL);
        $criteria->add("`cnt_destaques`.`DTQ_TIP`", "ctt", FuriousExpressionsDB::EQUAL);
        $criteria->addDescendingOrder("`cnt_destaques`.`DTQ_ORD`");
        $criteria->add("`cnt_destaques`.`DTQ_STS`", 1, FuriousExpressionsDB::EQUAL);
        $criteria->addAscendingOrder("`cnt_destaques`.`DTQ_ID`");
        $this->contato = DestaquesModel::doSelect($criteria);

    }


    public function footer()
    {
        $this->address();
    }


}

?>
