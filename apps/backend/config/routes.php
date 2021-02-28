<?php
// Configs
Dispatcher::addRoutes("/([0-9]+)-([a-z0-9_-]+)\/config\/words\.php/i", "config", "words", "html", true);
Dispatcher::addRoutes("/([0-9]+)-([a-z0-9_-]+)\/config\/akismet\.php/i", "config", "akismet", "html", true);

// Images
Dispatcher::addRoutes("/\/(images)\/(upload)\.php/i", "images", ":3", "html", true);
Dispatcher::addRoutes("/\/(images)\/([a-z]+)\.php/i", "images", ":1", "json", true);

# Produtos
Dispatcher::addRoutes("/\/(produto)\/([a-zA-Z]+)\.php/i", "produto", ":1", "html", true);

// Images
Dispatcher::addRoutes("/([0-9]+)-([a-z0-9_-]+)\/(images)\/(upload)\.php/i", "images", ":3", "html", true);
Dispatcher::addRoutes("/([0-9]+)-([a-z0-9_-]+)\/(images)\/([a-z]+)\.php/i", "images", ":3", "json", true);

// Tags
Dispatcher::addRoutes("/(tags)\.php/", "home", "tags", "json", true);
Dispatcher::addRoutes("/(categoria)\.php/", "home", "categoria", "json", true);
Dispatcher::addRoutes("/(categoriaDicas)\.php/", "home", "categoriaDicas", "json", true);
Dispatcher::addRoutes("/(prod)\.php/", "home", "prod", "json", true);
Dispatcher::addRoutes("/(tabela)\.php/", "home", "tabela", "json", true);
//Dispatcher::addRoutes("/(removeTabela)\.php/", "home", "tabelaRem", "json", true);


// Featured
Dispatcher::addRoutes("/(featured)\/(configs)\.php/i", "featured", "configs", "html", true);
Dispatcher::addRoutes("/(featured)\/(listAreas)\.json(?:\.php)?/i", "featured", "listAreas", "json", true);
Dispatcher::addRoutes("/([0-9]+)-([a-z0-9_-]+)\/([a-z0-9]{2}|[a-z0-9]{3})\/(quick)\.php/i", "featured", "quick", "json", true);
Dispatcher::addRoutes("/([0-9]+)-([a-z0-9_-]+)\/([a-z0-9]{2}|[a-z0-9]{3})\/(new|edit)\.php/i", "featured", "edit", "html", true);
Dispatcher::addRoutes("/([0-9]+)-([a-z0-9_-]+)\/([a-z0-9]{2}|[a-z0-9]{3})\/([a-z]+)\.php/i", "featured", ":3", "html", true);

//Tabela
Dispatcher::addRoutes("/([0-9]+)-([a-z0-9_-]+)\/tabela\/([0-9]+)\/(new|edit)\.php/i", "tabela", "novo", "html", true, true, array('ID'=>':2'));
Dispatcher::addRoutes("/([0-9]+)-([a-z0-9_-]+)\/tabela\/([0-9]+)\/([a-z]+)\.php/i", "tabela", ":3", "html", true, true, array('ID'=>':2'));

//Categorias
Dispatcher::addRoutes("/([0-9]+)-([a-z0-9_-]+)\/categorias\/([a-z0-9]+)\/(new|edit)\.php/i", "categorias", "novo", "html", true, true, array('TYPE'=>':2'));
Dispatcher::addRoutes("/([0-9]+)-([a-z0-9_-]+)\/categorias\/([a-z0-9]+)\/([a-z]+)\.php/i", "categorias", ":3", "html", true, true, array('TYPE'=>':2'));

// Livro
Dispatcher::addRoutes("/([0-9]+)-([a-z0-9_-]+)\/(livro)\/(download)\.php/i", "livro", "download", "xls", true);


// Comments
Dispatcher::addRoutes("/([0-9]+)-([a-z0-9_-]+)\/(comments)\/(approve)\.json/i", ":2", "approve", "json", true);
Dispatcher::addRoutes("/([0-9]+)-([a-z0-9_-]+)\/(comments)\/(not_spam)\.json/i", ":2", "not_spam", "json", true);
Dispatcher::addRoutes("/([0-9]+)-([a-z0-9_-]+)\/(comments)\/(edit)\.php/i", ":2", "edit", "html", true);
Dispatcher::addRoutes("/([0-9]+)-([a-z0-9_-]+)\/(comments)\/(edit)\.json\.php/i", ":2", "edit", "json", true);

// Modules
Dispatcher::addRoutes("/([0-9]+)-([a-z0-9_-]+)\/([a-z]+)\/(quick)\.php/i", ":2", "quick", "json", true);

// Quick Edit2
Dispatcher::addRoutes("/([0-9]+)-([a-z0-9_-]+)\/([a-z]+)\/(edit)\.json\.php/i", ":2", "novo", "json", true);

Dispatcher::addRoutes("/([0-9]+)-([a-z0-9_-]+)\/([a-z]+)\/([a-z]+)\.json\.php/i", ":2", ":3", "json", true);
Dispatcher::addRoutes("/([0-9]+)-([a-z0-9_-]+)\/([a-z]+)\/(new|edit)\.php/i", ":2", "novo", "html", true);
Dispatcher::addRoutes("/([0-9]+)-([a-z0-9_-]+)\/([a-z]+)\/([a-z]+)\.php/i", ":2", ":3", "html", true);


//Autocomplete Content
Dispatcher::addRoutes("/(content)\/(loadContent)\.php/i", "content", "loadContent", "json", true);


// Login
Dispatcher::addRoutes("/(login)\/(login|logout)\.php/i", "login", ":1", "html", true);

// Home
Dispatcher::addRoutes("/([0-9]+)-([a-z0-9_-]+)(?:(\/index\.html))?/i", "home", "index", "html", true);
//Dispatcher::addRoutes("/^$/i", "home", "index", "html", true);

// Image Resize
Dispatcher::addRoutes("/uploads\/([0-9]+)\/([0-9]+)\/([0-9]+)\/((.+)+(jpg|jpeg|png|gif))/i", "images", "resize", "raw", true);

// Redirect to First Site
Dispatcher::addRoutes("/\//i", "home", "redirect", "html", true);

//Dispatcher::addRoutes("/(uploads)\/(photos)\/([a-z0-9]+)\.([a-z0-9]+)\.(jpg|jpeg|png|gif)/i", "photos", "renderimage", "raw", true);
?>
