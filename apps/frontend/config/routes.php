<?php

$appPrefix = str_replace("/", "\/", APP_WEB_PREFIX);
Dispatcher::addRoutes("/{$appPrefix}sendFriend/i", "home", "sendFriend", "html", true, true);

//A Piracanjuba

Dispatcher::addRoutes("/{$appPrefix}a-piracanjuba\/anos\/(.+)-([0-9]+)/i", "home", "internaAnos", "html", true, true, array("ID" => ":1"));
Dispatcher::addRoutes("/{$appPrefix}a-piracanjuba\/quem-somos(\/)?/i", "home", "aPiracanjuba", "html", true, true);
//REPRESENTANTES
Dispatcher::addRoutes("/{$appPrefix}a-piracanjuba\/representantes(\/)?/i", "home", "representantes", "html", true, true);

//UNIDADES FABRIS
Dispatcher::addRoutes("/{$appPrefix}a-piracanjuba\/unidades-fabris(\/)?/i", "home", "unidadeFabris", "html", true, true);


//CAMINHO DO LEITE
Dispatcher::addRoutes("/{$appPrefix}a-piracanjuba\/caminho-do-leite(\/)?/i", "home", "caminhodoleite", "html", true, true);

//COMPRA DE LEITE
Dispatcher::addRoutes("/{$appPrefix}a-piracanjuba\/compra-de-leite(\/)?/i", "home", "compradeleite", "html", true, true);

//CONTATO
Dispatcher::addRoutes("/{$appPrefix}fale-conosco(\/)?/i", "home", "contato", "html", true, true);

//DICAS DE NUTRICAO

Dispatcher::addRoutes("/{$appPrefix}dicas-de-nutricao-impressao\/(.+)-([0-9]+)/i", "home", "dicasdenutricaointernaImpressao", "html", true, true, array("ID" => ":1"));
Dispatcher::addRoutes("/{$appPrefix}dicas-de-nutricao\/(.+)-([0-9]+)/i", "home", "dicasdenutricaointerna", "html", true, true, array("ID" => ":1"));
Dispatcher::addRoutes("/{$appPrefix}dicas-de-nutricao(\/)?/i", "home", "dicasdenutricao", "html", true, true);





//BUSCA
Dispatcher::addRoutes("/{$appPrefix}busca(\/)?/i", "home", "busca", "html", true, true);

//FAQ
Dispatcher::addRoutes("/{$appPrefix}a-piracanjuba\/faq(\/)?/i", "home", "faq", "html", true, true);

//IMPRENSA
Dispatcher::addRoutes("/{$appPrefix}a-piracanjuba\/releases\/(.+)-([0-9]+)/i", "home", "releases", "html", true, true, array("ID" => ":1"));
Dispatcher::addRoutes("/{$appPrefix}a-piracanjuba\/releases(\/)?/i", "home", "releases", "html", true, true);
Dispatcher::addRoutes("/{$appPrefix}a-piracanjuba\/piracanjuba-na-midia\/(.+)-([0-9]+)?/i", "home", "piracanjubaNaMidia", "html", true, true, array("ID" => ":1"));
Dispatcher::addRoutes("/{$appPrefix}a-piracanjuba\/piracanjuba-na-midia(\/)?/i", "home", "piracanjubaNaMidia", "html", true, true);
Dispatcher::addRoutes("/{$appPrefix}a-piracanjuba(\/)?/i", "home", "imprensa", "html", true, true);
//LEI 12669
Dispatcher::addRoutes("/{$appPrefix}lei-12669(\/)?/i", "home", "lei12669", "html", true, true);

//ONDE ENCONTRAR
Dispatcher::addRoutes("/{$appPrefix}onde-encontrar(\/)?/i", "home", "ondeEncontrar", "html", true, true);

//PIRACANJUBA PRO CAMPO
//Dispatcher::addRoutes("/{$appPrefix}piracanjuba-pro-campo(\/)?/i", "home", "piracanjubaProCampo", "html", true, true);
Dispatcher::addRoutes("/{$appPrefix}piracanjuba-pro-campo(\/)?/i", "home", "equipeDeCompraLeite", "html", true, true, array("ID" => "300"));


//PIRAKIDS
//Dispatcher::addRoutes("/{$appPrefix}pirakids(\/)?/i", "home", "pirakids", "html", true, true);

//PIRAKIDS SCHOOL
//Dispatcher::addRoutes("/{$appPrefix}pirakids-school(\/)?/i", "home", "pirakidsSchool", "html", true, true);

//PRODUTOS
Dispatcher::addRoutes("/{$appPrefix}produtos-impressao\/(.+)-([0-9]+)/i", "home", "produtosInternaImpressao", "html", true, true, array("ID" => ":1"));
Dispatcher::addRoutes("/{$appPrefix}produtos\/(.+)-([0-9]+)\/informacoes-nutricionais/i", "home", "produtosInternaTabela", "html", true, true, array("ID" => ":1"));
Dispatcher::addRoutes("/{$appPrefix}produtos\/(.+)-([0-9]+)/i", "home", "produtosInterna", "html", true, true, array("ID" => ":1"));
Dispatcher::addRoutes("/{$appPrefix}produtos(\/)?/i", "home", "produtos", "html", true, true);



//QUALIDADE DO LEITE
Dispatcher::addRoutes("/{$appPrefix}noticia\/(.+)\/(.+)-([0-9]+)(\.html)?$/i", "home", "qualidadeDoLeite", "html", true, true, array("ID" => ":2"));
Dispatcher::addRoutes("/{$appPrefix}produtor-de-leite\/politica-leiteira$/i", "home", "qualidadeDoLeite", "html", true, true, array("ID" => "737"));
#Dispatcher::addRoutes("/{$appPrefix}produtor-de-leite\/politica-leiteira$/i", "home", "qualidadeDoLeite", "html", true, true, array("ID" => "737"));

Dispatcher::addRoutes("/{$appPrefix}qualidade-do-leite(\/)?/i", "home", "qualidadeDoLeite", "html", true, true);
Dispatcher::addRoutes("/{$appPrefix}equipe-de-compra-de-leite(\/)?/i", "home", "equipeDeCompraLeite", "html", true, true, array("ID" => "286"));
Dispatcher::addRoutes("/{$appPrefix}pagamento-de-leite(\/)?/i", "home", "pagamentoDeLeite", "html", true, true);


//RECEITAS
Dispatcher::addRoutes("/{$appPrefix}receita-impressao\/(.+)-([0-9]+)/i", "receitas", "impressao", "html", true, true, array("ID" => ":1"));
Dispatcher::addRoutes("/{$appPrefix}receitas\/(.+)-([0-9]+)/i", "receitas", "interna", "html", true, true, array("ID" => ":1"));

Dispatcher::addRoutes("/{$appPrefix}receitas\/(.+)/i", "receitas", "index", "html", true, true, array('cat'=>':0'));
Dispatcher::addRoutes("/{$appPrefix}receitas(\/)?/i", "receitas", "index", "html", true, true);

//RELEASE
Dispatcher::addRoutes("/{$appPrefix}releases(\/)?/i", "home", "releases", "html", true, true);



//ZERO LACTOSE
Dispatcher::addRoutes("/{$appPrefix}zero-lactose(\/)?/i", "home", "zeroLactose", "html", true, true);


//--------------------------------------------------------------------------------------

//PRO CAMPO
Dispatcher::addRoutes("/{$appPrefix}perguntas-frequentes(\/)?/i", "home", "PerguntasFrequentesProCampo", "html", true, true);



//CAPTCHA CONTATO
Dispatcher::addRoutes("/{$appPrefix}captcha(\/)?/i", "home", "contato", "html", true, true);


//HOME
Dispatcher::addRoutes("/^{$appPrefix}index\.(html|php)$/i", "home", "index", "html", true, true, array('ID' => '1'));
Dispatcher::addRoutes("/^$appPrefix$/i", "home", "index", "html", true, true, array('ID' => '1'));



//ROTA FINAL
Dispatcher::addRoutes("/$appPrefix(.*)/i", "home", ":0", "html", true, true, array('ID' => '1'));

?>
