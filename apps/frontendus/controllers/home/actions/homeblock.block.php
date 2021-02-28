<?php
	class HomeBlock extends DefaultBlock
	{
		public function barLangs(){

			$arrayLanguages = array(1 => array("NAME" => "pt", "PATH" => "/"), 26 => array("NAME" => "en", "PATH" => "/us/"), 51 => array("NAME" => "es", "PATH" => "/es/"));
			$this->current = $arrayLanguages[APP_DEFAULT_EDITORIAL];
			$this->langs = array();
			foreach($arrayLanguages as $key => $value){
				if($key != APP_DEFAULT_EDITORIAL){
					$this->langs[] = $value;
				}
			}
		}
		public function rodapeImprensa(){
			$criteria = new FuriousSelectCriteria();
			$criteria->add("`cnt_destaques`.`DTQ_TIP`", "imp", FuriousExpressionsDB::EQUAL);
			$criteria->add("`cnt_destaques`.`DTQ_STS`", 1, FuriousExpressionsDB::EQUAL);
			$criteria->setLimit(1);
			$criteria->addAscendingOrder("`cnt_destaques`.`DTQ_INI`");
			$this->imprensa = DestaquesModel::doSelect($criteria);
		}
		public function menu(){

			$criteria = new FuriousSelectCriteria();

			$criteria->add("`cnt_categorias`.`CAT_COR`", "prod", FuriousExpressionsDB::EQUAL);
			$criteria->add("`cnt_categorias`.`CAT_STS`", 1, FuriousExpressionsDB::EQUAL);
			$criteria->add("`cnt_categorias`.`CAT_ID`", (34+APP_CATS), FuriousExpressionsDB::NOT_EQUAL);
			$criteria->addAscendingOrder("`cnt_categorias`.`CAT_NOM`");

			$categorias = CategoriasModel::doSelect($criteria);

			$produto = array();
			foreach($categorias as $categoria){


				$criteria = new FuriousSelectCriteria();
				$criteria->addJoin(FuriousExpressionsDB::LEFT_JOIN, "`cnt_categorias_conteudos`", "`cnt_categorias_conteudos`.CCL_CNT", "`cnt_conteudo`.CNT_ID");
				$criteria->add("`cnt_categorias_conteudos`.`CCL_CAT`",  $categoria->CAT_ID, FuriousExpressionsDB::EQUAL);
				//$criteria->add("`cnt_conteudo`.`CNT_ID`",  $cat[0]->CCL_CNT, FuriousExpressionsDB::EQUAL);
				$criteria->addDescendingOrder("`cnt_conteudo`.`CNT_DTA`");
				$criteria->add("`cnt_conteudo`.`CNT_STS`",  1, FuriousExpressionsDB::EQUAL);
				$criteria->add("`cnt_conteudo`.`CNT_TIP`",  "PROD", FuriousExpressionsDB::EQUAL);
				$prod = ConteudoModel::doSelect($criteria);

				$produto[$categoria->CAT_ID] = $prod[0];

			}

			$this->produtos = $produto;
			$this->categorias = $categorias;

			// --------------------- ZERO LACTOSE ------------------------
			$criteria = new FuriousSelectCriteria();

			$criteria->add("`cnt_categorias`.`CAT_STS`", 1, FuriousExpressionsDB::EQUAL);
			$criteria->add("`cnt_categorias`.`CAT_ID`", (34+APP_CATS), FuriousExpressionsDB::EQUAL);

			$zeroLactose = CategoriasModel::doSelect($criteria);



			$criteria = new FuriousSelectCriteria();
			$criteria->addJoin(FuriousExpressionsDB::LEFT_JOIN, "`cnt_categorias_conteudos`", "`cnt_categorias_conteudos`.CCL_CNT", "`cnt_conteudo`.CNT_ID");
			$criteria->add("`cnt_categorias_conteudos`.`CCL_CAT`",  $zeroLactose[0]->CAT_ID, FuriousExpressionsDB::EQUAL);
			$criteria->add("`cnt_conteudo`.`CNT_STS`",  1, FuriousExpressionsDB::EQUAL);
			$criteria->add("`cnt_conteudo`.`CNT_TIP`",  "PROD", FuriousExpressionsDB::EQUAL);
			$prodZeroLactose = ConteudoModel::doSelect($criteria);

			$this->categoriaZeroLactose = $zeroLactose[0];
			$this->zeroLactose = $prodZeroLactose[0];

			/**************************************************************/
			$criteria = new FuriousSelectCriteria();

			$criteria->add("`cnt_destaques`.`DTQ_TIP`", "map", FuriousExpressionsDB::EQUAL);
			$criteria->add("`cnt_destaques`.`DTQ_STS`", 1, FuriousExpressionsDB::EQUAL);
			$criteria->addAscendingOrder("`cnt_destaques`.`DTQ_INI`");

			$aPiracanjuba = DestaquesModel::doSelect($criteria);
			
			$this->aPiracanjuba = $aPiracanjuba;

			/**************************************************************/
			$criteria = new FuriousSelectCriteria();
			$criteria->add("`cnt_destaques`.`DTQ_SIT`", APP_DEFAULT_EDITORIAL, FuriousExpressionsDB::EQUAL);
			$criteria->add("`cnt_destaques`.`DTQ_TIP`", "mpl", FuriousExpressionsDB::EQUAL);
			$criteria->add("`cnt_destaques`.`DTQ_STS`", 1, FuriousExpressionsDB::EQUAL);
			$criteria->addAscendingOrder("`cnt_destaques`.`DTQ_INI`");
			$produtorLeite = DestaquesModel::doSelect($criteria);

			$this->produtorLeite = $produtorLeite;





		}
		public function bannerHome($vars){

			$criteria = new FuriousSelectCriteria();
			$criteria->add("`cnt_destaques`.`DTQ_EDT`", APP_HOME_EDITORIAL, FuriousExpressionsDB::EQUAL);
			$criteria->add("`cnt_destaques`.`DTQ_TIP`", "ban", FuriousExpressionsDB::EQUAL);
			$criteria->add("`cnt_destaques`.`DTQ_STS`", 1, FuriousExpressionsDB::EQUAL);
			$criteria->addAscendingOrder("`cnt_destaques`.`DTQ_CID`");
			$criteria->addDescendingOrder("`cnt_destaques`.`DTQ_INI`");
			//$criteria->setLimit(3);

			$banners = DestaquesModel::doSelect($criteria);

			$this->banners = $banners;

			//exit;
			//= DestaquesModel::doSelect($criteria);

		}
		public function breadcrumb($vars = null){

			$this->links = array("/" => "{Home}");

			if(!empty($vars["LINKS"])){
				foreach($vars["LINKS"] as $link => $label){
					$this->links[$link] = $label;
				}
			}

			$this->linkFormated = array();
			foreach($this->links as $link => $label){
				$this->linkFormated[] = "<a href=\"{$link}\">{$label}</a>";
			}


		}
		public function produtoDestaque(){

			$criteria = new FuriousSelectCriteria();
			$criteria->add("`cnt_destaques`.`DTQ_EDT`", APP_HOME_EDITORIAL, FuriousExpressionsDB::EQUAL);
			$criteria->add("`cnt_destaques`.`DTQ_TIP`", "h1", FuriousExpressionsDB::EQUAL);
			$criteria->add("`cnt_destaques`.`DTQ_STS`", 1, FuriousExpressionsDB::EQUAL);
			$criteria->addAscendingOrder("`cnt_destaques`.`DTQ_CID`");
			$criteria->addDescendingOrder("`cnt_destaques`.`DTQ_INI`");
			$criteria->setLimit(1);
			$produtoPrincipal = DestaquesModel::doSelect($criteria);


			$criteria = new FuriousSelectCriteria();
			$criteria->add("`cnt_destaques`.`DTQ_EDT`", APP_HOME_EDITORIAL, FuriousExpressionsDB::EQUAL);
			$criteria->add("`cnt_destaques`.`DTQ_TIP`", "h2", FuriousExpressionsDB::EQUAL);
			$criteria->add("`cnt_destaques`.`DTQ_STS`", 1, FuriousExpressionsDB::EQUAL);
			$criteria->addAscendingOrder("`cnt_destaques`.`DTQ_CID`");
			$criteria->addDescendingOrder("`cnt_destaques`.`DTQ_INI`");
			$criteria->setLimit(1);
			$depoimentos = DestaquesModel::doSelect($criteria);


			$this->produtoPrincipal = $produtoPrincipal;
			$this->depoimentoPrincipal = $depoimentos;


		}

		public function receitasHome(){

			$criteria = new FuriousSelectCriteria();

			$criteria->add("`cnt_conteudo`.`CNT_TIP`", "REC", FuriousExpressionsDB::EQUAL);
			$criteria->add("`cnt_conteudo`.`CNT_STS`", 1, FuriousExpressionsDB::EQUAL);
			$criteria->setLimit(2);
			$receitasHome = ConteudoModel::doSelect($criteria);

			$this->receitasHome = $receitasHome;

		}

		public function ondeEncontrar(){

		}

		public function rodapePiracanjuba($vars = null){

			$criteria = new FuriousSelectCriteria();
			$criteria->add("`cnt_destaques`.`DTQ_TIP`", "rd1", FuriousExpressionsDB::EQUAL);
			$criteria->add("`cnt_destaques`.`DTQ_STS`", 1, FuriousExpressionsDB::EQUAL);
			$criteria->addAscendingOrder("`cnt_destaques`.`DTQ_INI`");

			$this->links_rodape1 = DestaquesModel::doSelect($criteria);

			$criteria = new FuriousSelectCriteria();
			$criteria->add("`cnt_destaques`.`DTQ_TIP`", "rd2", FuriousExpressionsDB::EQUAL);
			$criteria->add("`cnt_destaques`.`DTQ_STS`", 1, FuriousExpressionsDB::EQUAL);
			$criteria->addAscendingOrder("`cnt_destaques`.`DTQ_INI`");
			$this->links_rodape2 = DestaquesModel::doSelect($criteria);

			$criteria = new FuriousSelectCriteria();
			$criteria->add("`cnt_destaques`.`DTQ_TIP`", "rd3", FuriousExpressionsDB::EQUAL);
			$criteria->add("`cnt_destaques`.`DTQ_STS`", 1, FuriousExpressionsDB::EQUAL);
			$criteria->addAscendingOrder("`cnt_destaques`.`DTQ_INI`");
			$this->links_rodape3 = DestaquesModel::doSelect($criteria);

			$criteria = new FuriousSelectCriteria();
			$criteria->add("`cnt_destaques`.`DTQ_TIP`", "rd4", FuriousExpressionsDB::EQUAL);
			$criteria->add("`cnt_destaques`.`DTQ_STS`", 1, FuriousExpressionsDB::EQUAL);
			$criteria->addAscendingOrder("`cnt_destaques`.`DTQ_INI`");
			$this->links_rodape4 = DestaquesModel::doSelect($criteria);

			$criteria = new FuriousSelectCriteria();
			$criteria->add("`cnt_destaques`.`DTQ_TIP`", "rd5", FuriousExpressionsDB::EQUAL);
			$criteria->add("`cnt_destaques`.`DTQ_STS`", 1, FuriousExpressionsDB::EQUAL);
			$criteria->addAscendingOrder("`cnt_destaques`.`DTQ_INI`");
			$this->links_rodape5 = DestaquesModel::doSelect($criteria);

			$criteria = new FuriousSelectCriteria();
			$criteria->add("`cnt_destaques`.`DTQ_TIP`", "rd6", FuriousExpressionsDB::EQUAL);
			$criteria->add("`cnt_destaques`.`DTQ_STS`", 1, FuriousExpressionsDB::EQUAL);
			$criteria->addAscendingOrder("`cnt_destaques`.`DTQ_INI`");
			$this->links_rodape6 = DestaquesModel::doSelect($criteria);


			$this->layoutVars = $vars['layoutVars'];


		}

		public function redesSociais(){
			$criteria = new FuriousSelectCriteria();

			$criteria->add("`cnt_destaques`.`DTQ_TIP`", "rds", FuriousExpressionsDB::EQUAL);
			$criteria->add("`cnt_destaques`.`DTQ_STS`", 1, FuriousExpressionsDB::EQUAL);

			$redes = DestaquesModel::doSelect($criteria);
			$this->redes =$redes;


		}

		public function receitas($vars){

			$criteria = new FuriousSelectCriteria();

			$criteria->add("`cnt_destaques`.`DTQ_TIP`", "brc", FuriousExpressionsDB::EQUAL);
			$criteria->add("`cnt_destaques`.`DTQ_STS`", 1, FuriousExpressionsDB::EQUAL);

			$conteudo = DestaquesModel::doSelect($criteria);

			//-----------------------------------------------------

			$produto = $vars['produto'];

			$criteria = new FuriousSelectCriteria();
			$criteria->addJoin(FuriousExpressionsDB::LEFT_JOIN, "`cnt_categorias_conteudos`", "`cnt_categorias_conteudos`.`CCL_CNT`", "`cnt_conteudo`.`CNT_ID`");
			$criteria->add("`cnt_categorias_conteudos`.`CCL_CAT`",  $produto->CNT_ID, FuriousExpressionsDB::EQUAL);
			$criteria->add("`cnt_categorias_conteudos`.`CCL_TIP`",  "PROD", FuriousExpressionsDB::EQUAL);
			$criteria->add("`cnt_categorias_conteudos`.`CCL_STS`",  "1", FuriousExpressionsDB::EQUAL);
			$criteria->add("`cnt_conteudo`.`CNT_TIP`", "REC", FuriousExpressionsDB::EQUAL);
			$criteria->add("`cnt_conteudo`.`CNT_STS`", "1", FuriousExpressionsDB::EQUAL);
			$receita = ConteudoModel::doSelect($criteria);



			if(!empty($receita[0])){
				$this->receita = $receita[0];
				$this->conteudo = $conteudo[0];
				HomeController::$hasSaibaMais = true;
			}


		}

		public function nutricao($vars){

			$produto = $vars['produto'];

			$criteria = new FuriousSelectCriteria();

			$criteria->add("`cnt_destaques`.`DTQ_TIP`", "bnt", FuriousExpressionsDB::EQUAL);
			$criteria->add("`cnt_destaques`.`DTQ_STS`", 1, FuriousExpressionsDB::EQUAL);
			$conteudo = DestaquesModel::doSelect($criteria);

			$criteria = new FuriousSelectCriteria();
			$criteria->addJoin(FuriousExpressionsDB::LEFT_JOIN, "`cnt_categorias_conteudos`", "`cnt_categorias_conteudos`.`CCL_CNT`", "`cnt_conteudo`.`CNT_ID`");
			$criteria->add("`cnt_categorias_conteudos`.`CCL_CAT`",  $produto->CNT_ID, FuriousExpressionsDB::EQUAL);
			$criteria->add("`cnt_categorias_conteudos`.`CCL_TIP`",  "DICA", FuriousExpressionsDB::EQUAL);
			$criteria->add("`cnt_categorias_conteudos`.`CCL_STS`",  "1", FuriousExpressionsDB::EQUAL);
			$criteria->add("`cnt_conteudo`.`CNT_TIP`", "DN", FuriousExpressionsDB::EQUAL);
			$criteria->add("`cnt_conteudo`.`CNT_STS`", "1", FuriousExpressionsDB::EQUAL);
			$dica = ConteudoModel::doSelect($criteria);


			if(!empty($dica[0])){
				$this->dica = $dica[0];
				$this->conteudo = $conteudo[0];
				HomeController::$hasSaibaMais = true;
			}

		}

		public function noticiasBlock($vars){


			$produto = $vars['produto'];

			$criteria = new FuriousSelectCriteria();

			$criteria->add("`cnt_destaques`.`DTQ_TIP`", "bno", FuriousExpressionsDB::EQUAL);
			$criteria->add("`cnt_destaques`.`DTQ_STS`", 1, FuriousExpressionsDB::EQUAL);

			$conteudo = DestaquesModel::doSelect($criteria);

			$criteria = new FuriousSelectCriteria();
			$criteria->addJoin(FuriousExpressionsDB::LEFT_JOIN, "`cnt_categorias_conteudos`", "`cnt_categorias_conteudos`.`CCL_CNT`", "`cnt_conteudo`.`CNT_ID`");
			$criteria->addJoin(FuriousExpressionsDB::LEFT_JOIN, "`cnt_arquivos_conteudo`", "`cnt_arquivos_conteudo`.`ARC_CID`", "`cnt_conteudo`.`CNT_ID`");
			$criteria->add("`cnt_categorias_conteudos`.`CCL_CAT`",  $produto->CNT_ID, FuriousExpressionsDB::EQUAL);
			$criteria->add("`cnt_categorias_conteudos`.`CCL_TIP`",  "PROD", FuriousExpressionsDB::EQUAL);
			$criteria->add("`cnt_categorias_conteudos`.`CCL_STS`",  "1", FuriousExpressionsDB::EQUAL);
			$criteria->add("`cnt_arquivos_conteudo`.`ARC_ID`",  "", FuriousExpressionsDB::IS_NOT_NULL);
			$criteria->add("`cnt_conteudo`.`CNT_TIP`", "NOT", FuriousExpressionsDB::EQUAL);
			$criteria->add("`cnt_conteudo`.`CNT_STS`", "1", FuriousExpressionsDB::EQUAL);
			$noticias = ConteudoModel::doSelect($criteria);


			if(!empty($noticias[0])){

				$this->noticias = $noticias[0];
				$this->conteudo = $conteudo[0];
				HomeController::$hasSaibaMais = true;
			}

		}

		public function heading($vars = null){
			$this->heading = $vars;
			if(!empty($vars['BREADCRUMB'])){
				$this->breadcrumb = $vars['BREADCRUMB'];
			}
			$this->pageTitle = $vars['PAGETITLE'];
			if(!empty($vars['slogan'])){
				$this->slogan = $vars['slogan'];
			}
			if(!isset($vars['SHOW_IMAGE'])){
				$this->heading["SHOW_IMAGE"] = true;
			}
		}

		public function outrosProdutos($vars){

			$this->produto = $vars['produto'];


				$criteria = new FuriousSelectCriteria();

				/*
				if(!empty($vars['categoria'])){
					$cat = $vars['categoria'];
					$criteria->addJoin(FuriousExpressionsDB::LEFT_JOIN, "`cnt_categorias_conteudos`", "`cnt_categorias_conteudos`.`CCL_CNT`", "`cnt_conteudo`.`CNT_ID`");
					$criteria->add("`cnt_categorias_conteudos`.`CCL_CAT`",  $cat->CAT_ID, FuriousExpressionsDB::EQUAL);
					$criteria->add("`cnt_categorias_conteudos`.`CCL_STS`",  1, FuriousExpressionsDB::EQUAL);
				}
				$criteria->add("`cnt_conteudo`.`CNT_TIP`",  "PROD", FuriousExpressionsDB::EQUAL);
				$criteria->add("`cnt_conteudo`.`CNT_STS`",  1, FuriousExpressionsDB::EQUAL);
				$criteria->addGroupBy("`cnt_conteudo`.`CNT_ID`");
				*/

				$database = Database2::getDB();
				$database->query("SET @contador = 0; ");
				$criteria2 = new FuriousRawCriteria("(SELECT case when `CNT_ID` = ".($this->produto->CNT_ID)." then @contador := 3 else @contador := @contador + 1 end as ordem, `cnt_conteudo`.`CNT_ID`, `cnt_conteudo`.`CNT_SIT`, `cnt_conteudo`.`CNT_IPR`, `cnt_conteudo`.`CNT_TIP`, `cnt_conteudo`.`CNT_DTA`, `cnt_conteudo`.`CNT_TIS`, `cnt_conteudo`.`CNT_TIT`, `cnt_conteudo`.`CNT_OLH`, `cnt_conteudo`.`CNT_TXT`, `cnt_conteudo`.`CNT_RES`, `cnt_conteudo`.`CNT_FT1`, `cnt_conteudo`.`CNT_FT1_`, `cnt_conteudo`.`CNT_RDT`, `cnt_conteudo`.`CNT_EMA`, `cnt_conteudo`.`CNT_CHV`, `cnt_conteudo`.`CNT_CMT`, `cnt_conteudo`.`CNT_CMD`, `cnt_conteudo`.`CNT_CKY`, `cnt_conteudo`.`CNT_TAG`, `cnt_conteudo`.`CNT_CAT`, `cnt_conteudo`.`CNT_ENQ`, `cnt_conteudo`.`CNT_CTT`, `cnt_conteudo`.`CNT_PAI`, `cnt_conteudo`.`CNT_EST`, `cnt_conteudo`.`CNT_STS`, `cnt_conteudo`.`CNT_NOT`, `cnt_conteudo`.`CNT_VOT`, `cnt_conteudo`.`CNT_EMB` FROM cnt_conteudo WHERE `cnt_conteudo`.`CNT_TIP` = 'PROD' AND `cnt_conteudo`.`CNT_STS` = '1' GROUP BY `cnt_conteudo`.`CNT_ID` ORDER By ordem ASC)");

				$outrosProdutos = ConteudoModel::doSelect($criteria2);
				//echo($criteria);



				$this->outrosProdutos = $outrosProdutos;


		}

		public function menuprincipal(){
			$this->initJsonDtq(array("ID" => 17));
		}
		public function redesocial($vars = NULL){
			if(empty($vars['ID'])){
				$vars['ID'] = 30;
			}
			$this->initJsonDtq($vars);
		}
		public function banner($vars = NULL){
			$this->initJsonDtq($vars);
		}
		public function bannerinterno($vars = NULL){
			$this->initJsonDtq($vars);
		}
		public function destaque($vars = NULL){
			if(!empty($vars['SHOW_BAR'])){
				$this->show_bar = true;
			}
			if(!empty($vars['DATA'])){
				$this->data = true;
			}
			if(!empty($vars['SHARE'])){
				$this->share = true;
			}
				$this->initJsonDtq($vars);
		}
		public function video($vars = NULL){
			$this->initJsonDtq($vars);
		}
		public function historiasquadrinhos($vars = NULL){
			$this->initJsonDtq($vars);
		}
		public function videobanner($vars = NULL){

			if(!empty($vars['COR'])){
				$this->cor = $vars['COR'];
			}
			$this->initJsonDtq($vars);
		}
		public function cortapmim($vars = NULL){
			if(empty($vars['ID'])){
				$vars['ID'] = 14;
			}
			$this->initJsonDtq($vars);
		}
		public function entrevistas($vars = NULL){
			if(empty($vars['notshow'])){
				$this->initJsonDtq(array("ID" => 15));
			}
		}
		public function menurodape(){
			$this->initJsonDtq(array("ID" => 16));
		}
		public function rodape(){
			$this->initJsonDtq(array("ID" => 18));
		}
		public function textoforum(){
			$this->initJsonDtq(array("ID" => 120));
		}
		public function noticiabanner($vars = NULL){
			$this->initJsonDtq($vars);
		}
		public function form($vars = NULL){
			$this->initJsonDtq($vars);
		}
		public function vinho($vars = NULL){
			$this->initJsonDtq($vars);
		}
		public function narra($vars = NULL){
			$this->initJsonDtq($vars);
		}
		public function cidadezinha($vars = NULL){
			$this->initJsonDtq($vars);
		}
		public function gourmetbanner($vars = NULL){
			$this->initJsonDtq($vars);
		}
		public function viagemdestaque($vars = NULL){
			$this->initJsonDtq($vars);
		}
		public function diariodestaque($vars = NULL){
			$this->initJsonDtq($vars);
		}
		public function albunsdestaque($vars = NULL){
			$this->initJsonDtq($vars);
		}
		public function cidadezinhadestaque($vars = NULL){
			$this->initJsonDtq($vars);
		}
		public function textodestaque($vars = NULL){
			$this->initJsonDtq($vars);
		}
		public function jogodestaque($vars = NULL){
			$this->initJsonDtq($vars);
		}
		public function imprimedestaque($vars = NULL){
			$this->initJsonDtq($vars);
		}
		public function quadrinhodestaque($vars = NULL){
			$this->initJsonDtq($vars);
		}
		public function shares()
		{
		}
		public function fbcomments(){
		}
		public function publicidade(){
		}
		public function noticias($vars = NULL){
			if(!empty($vars['JSON'])){
				$this->items = $vars['JSON'];
			}else{
				if(Document::hasFile(APP_JSON_PATH."SITE_".APP_DEFAULT_EDITORIAL."_NT.json")){
					$this->items = json_decode(file_get_contents(APP_JSON_PATH."SITE_".APP_DEFAULT_EDITORIAL."_NT.json"), true);
				}
			}
		}
		public function galerias($vars = NULL){
			if(!empty($vars['JSON'])){
				$this->items = $vars['JSON'];
			}else{
				if(Document::hasFile(APP_JSON_PATH."SITE_".APP_DEFAULT_EDITORIAL."_GA.json")){
					$this->items = json_decode(file_get_contents(APP_JSON_PATH."SITE_".APP_DEFAULT_EDITORIAL."_GA.json"), true);
				}
			}
		}
		public function videos($vars = NULL){
			if(!empty($vars['JSON'])){
				$this->items = $vars['JSON'];
			}else{
				if(Document::hasFile(APP_JSON_PATH."SITE_".APP_DEFAULT_EDITORIAL."_VD.json")){
					$this->items = json_decode(file_get_contents(APP_JSON_PATH."SITE_".APP_DEFAULT_EDITORIAL."_VD.json"), true);
				}
			}
		}
		public function logos($vars = null)
		{
			$scope = $vars['SCOPE'];
			$img = $scope->logoPage;

			$this->logo = (!empty($img))?$img['dtq_fto']['fto']['url']:APP_WEB_PREFIX."web/img/logos-categoria/cidade-alerta.png";
		}
		public function maisReceitas($vars = null){
			$criteria = new FuriousSelectCriteria();
			$criteria->addJoin(FuriousExpressionsDB::LEFT_JOIN, "`cnt_arquivos_conteudo`", "`cnt_arquivos_conteudo`.`ARC_CID`", "`cnt_conteudo`.`CNT_ID`");
			$criteria->add("`cnt_arquivos_conteudo`.`ARC_CTP`", "THB_CNT", FuriousExpressionsDB::EQUAL);
			$criteria->add("`cnt_arquivos_conteudo`.`ARC_STS`", "1", FuriousExpressionsDB::EQUAL);
			$criteria->add("`cnt_conteudo`.`CNT_TIP`", "REC", FuriousExpressionsDB::EQUAL);
			$criteria->add("`cnt_conteudo`.`CNT_STS`", 1, FuriousExpressionsDB::EQUAL);

			$criteria->setLimit(5);
			$this->maisDicas = ConteudoModel::doSelect($criteria);


			$criteria = new FuriousSelectCriteria();
			$criteria->add("`cnt_categorias`.`CAT_COR`", "REC", FuriousExpressionsDB::EQUAL);
			$criteria->add("`cnt_categorias`.`CAT_TIP`", APP_DEFAULT_EDITORIAL, FuriousExpressionsDB::EQUAL);

			$this->categorias = CategoriasModel::doSelect($criteria);


		}
		public function maisDicas($vars = null){
			$criteria = new FuriousSelectCriteria();
			$criteria->add("`cnt_conteudo`.`CNT_TIP`", "DN", FuriousExpressionsDB::EQUAL);
			$criteria->add("`cnt_conteudo`.`CNT_STS`", 1, FuriousExpressionsDB::EQUAL);
			$criteria->addJoin(FuriousExpressionsDB::LEFT_JOIN, "`cnt_arquivos_conteudo`", "`cnt_arquivos_conteudo`.`ARC_CID`", "`cnt_conteudo`.`CNT_ID`");
			$criteria->add("`cnt_arquivos_conteudo`.`ARC_CTP`", "THB_CNT", FuriousExpressionsDB::EQUAL);
			$criteria->add("`cnt_arquivos_conteudo`.`ARC_STS`", "1", FuriousExpressionsDB::EQUAL);

			$criteria->setLimit(5);
			$this->maisDicas = ConteudoModel::doSelect($criteria);


			$criteria = new FuriousSelectCriteria();
			$criteria->add("`cnt_categorias`.`CAT_COR`", "DICA", FuriousExpressionsDB::EQUAL);
			$criteria->add("`cnt_categorias`.`CAT_TIP`", APP_DEFAULT_EDITORIAL, FuriousExpressionsDB::EQUAL);

			$this->categorias = CategoriasModel::doSelect($criteria);


		}
		public function share($vars = null){

		}
		public function aleitamento($vars = null){
			$criteria = new FuriousSelectCriteria();
			$criteria->add("`cnt_destaques`.`DTQ_EDT`", APP_DEFAULT_EDITORIAL, FuriousExpressionsDB::EQUAL);
			$criteria->add("`cnt_destaques`.`DTQ_TIP`", "ale", FuriousExpressionsDB::EQUAL);
			$criteria->add("`cnt_destaques`.`DTQ_STS`", 1, FuriousExpressionsDB::EQUAL);
			//$criteria->addAscendingOrder("`cnt_destaques`.`DTQ_CID`");
			$criteria->addDescendingOrder("`cnt_destaques`.`DTQ_INI`");
			$criteria->setLimit(1);
			$this->depoimentos = DestaquesModel::doSelect($criteria);
		}
		public function barRedes($vars = null){
			$criteria = new FuriousSelectCriteria();

			$criteria->add("`cnt_destaques`.`DTQ_TIP`", "rds", FuriousExpressionsDB::EQUAL);
			$criteria->add("`cnt_destaques`.`DTQ_STS`", 1, FuriousExpressionsDB::EQUAL);

			$redes = DestaquesModel::doSelect($criteria);
			$this->redes =$redes;
		}
}
?>
