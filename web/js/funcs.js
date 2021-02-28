var SiteImageSizes = ["70x70", "65x85", "50x140", "1903x780", "175x330", "386x272", "635x352", "258x245", "445x530", "258x170", "1903x300", "1903x360", "1903x370", "1903x1000", "1903x470", "1903x435", "1903x236", "165x165", "540x683", "1903x270", "1903x575", "155x385", "1903x670", "1903x700", "200x250", "250x380", "150x200",  "542x350", "750x430"];
function AudioPlayer($){
	$.fn.AudioPlayer = function (options){
		var defaults = {

		}
		$.fn.AudioPlayer.options = $.extend(defaults, options);
		return this.each(function (){
			var $play = $('.btn-play', $(this)), $pause = $('.btn-pause', $(this)), $backward = $('.btn-seekDown', $(this)), $forward = $('.btn-seekUp', $(this))
			var song = new Audio(options.ogg, options.mp3);
			if(song.canPlayType('audio/mpeg'))
			{
				song.type = 'audio/mpeg';
				song.src = options.mp3;
			} else {
				song.type = 'audio/ogg';
				song.src = options.ogg;
			}

			$play.click(function (e){
				song.play();
				$play.addClass("hidden");
				$pause.removeClass("hidden");

				if(e.preventDefault) e.preventDefault();
				return false;
			})
			$pause.click(function (e){
				song.pause();
				$play.removeClass("hidden");
				$pause.addClass("hidden");

				if(e.preventDefault) e.preventDefault();
				return false;
			})
		});
	}
}
AudioPlayer(jQuery);

function Slugfy(str)
{
	str = str.replace(/^\s+|\s+$/g, ''); // trim
	str = str.toLowerCase();

	// remove accents, swap Ò for n, etc
	var from = "„‡·‰‚?ËÈÎÍÏÌÔÓıÚÛˆÙ˘˙¸˚ÒÁ∑/_,:;";
	var to   = "aaaaaeeeeeiiiiooooouuuunc------";
	for (var i=0, l=from.length ; i<l ; i++) {
		str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
	}

	str = str.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
		.replace(/\s+/g, '-') // collapse whitespace and replace by -
		.replace(/-+/g, '-'); // collapse dashes

	return str;
}
//
function MediaUploader(options){
	var $this = this;
	// Settings
	this.defaults = {
		language: "pt",
		languagePath: "/web/js/languages/",
		languageExt: ".ko"
	};
	this.fileUp = Array();

	this.monthsArr = ["January","February","March","April","May","June","July","August","September","October","November","December"];

	this.options = $.extend($this.defaults, options);
	// Init Media
	this.initMedia = function (){


		$("body").append(this.generateHTML());
		this.$element = $("#mediaUploader");
		this.$element.dialog({
			modal: true,
			width: 1000,
			dialogClass: "mediaUploader",
			height: 500,
			closeText: "X",
			position: {my: "center center", at: "center center", of: $("body")},
			close: function()
			{
				$this.$element.remove();
			}
		})
		$(".ui-widget-overlay").click(function (){
			$this.$element.dialog("close");
		});
		this.callTrigger("INIT_COMPLETE");
	}
	this.close = function(){
		this.$element.dialog("close");
	}
	this.addMainMenuShowAct = function ($menu, pageSelector, $father, hasTrigger){
		$links = $("li a ", $menu);
		$links.each(function (){
			$(this).click(function (){
				var page = $(this).attr("href");

				$this.options.currentPage = page;

				$this.pgMode = page;

				$(this).parent().parent().children("li").removeClass("active");
				$(this).parent().addClass("active");

				var $content = $("#ContentMediaUplader", $this.$element);

				$("ul.submenu li:first a", $content).click();

				var txt = $(this).html();
				$(".mediaHeader h3", $content).html(txt);


				if(hasTrigger){
					$this.callTrigger("PAGE_CHANGE", $Page);
				}


				return false;
			})
		})
	}
	this.addMenuShowAct = function ($menu, pageSelector, $father, hasTrigger){
		$links = $("li a ", $menu);
		$links.each(function (){
			$(this).click(function (){
				var page = $(this).attr("href");

				$Page = $(page, $father);

				$(this).parent().parent().children("li").removeClass("active");
				$(this).parent().addClass("active");

				// Hide Others Pages
				$Page.parent().children(pageSelector).removeClass("active");
				$Page.addClass("active");

				if(hasTrigger){
					$this.callTrigger("PAGE_CHANGE", $Page);
				}


				return false;
			})
		})
	}

	this.initVariables = function (){
		// Library
		this.$library = $("#library1 .two-cols .col-1 .spacer");
		this.$details = $("#library1 .two-cols .attachDetails .spacer");
		this.$footer = $(".mediaFooter .spacer");



		// Main Menu
		$mainMenu = $("ul.menu_mediauploader", $this.$element);

		this.addMainMenuShowAct($mainMenu, "div", $this.$element, true);
		$this.$mainMenu = $mainMenu;

		// Submenus
		this.$submenu = $(".mediaHeader ul.submenu", $this.$element)
		this.$submenu.each(function (){
			$menu = $(this);
			$page = $menu.parent().parent();
			$this.addMenuShowAct($menu, ".page", $page, true);
		})

	}
	// Add Actions
	this.addActions = function (){

		$("form.ajaxedUpload").each(function (){
			var $form = $(this);

			var $formH = $form[0];

			$form.bind("dragover", function (e){
				$form.addClass("hover");
				return false;
			});

			$form.bind("dragleave dragend", function (e){
				$form.removeClass("hover");
				e.preventDefault();
				return false;
			});

			$form.bind("drop", function (e){
				var dt = e.originalEvent.dataTransfer;
				e.originalEvent.stopPropagation();
				e.originalEvent.preventDefault();

				var droppedFiles = dt.files;

				$(this).removeClass("hover");

				$this.submitFiles(droppedFiles, $form);


				return false;
			})

			var $btnForm = $("a.bot", $form);
			$btnForm.click(function (){
				$(this).next("input[type=file]").click();
				return false;
			})


			var $inputFiles = $("input[type=file]", $form);
			$inputFiles.change(function (evt){
				$this.submitFiles(this.files, $form)
			})

		})
	}
	this.submitFiles = function (files, $form){
		// Init Api's
		var formdata = (typeof window.FormData !== 'function')?false:new FormData();

		var i = 0, len = files.length, reader, file, $list = (!$("ul.uploadedFiles", $this.$library)[0])?$("<ul class=\"uploadedFiles\"></ul>"):$("ul.uploadedFiles", $this.$library);
		// Loop
		var z = 0;
		var readF = 0;
		for(; i < len; i++)
		{
			file = files[i];

			if(formdata)
			{
				formdata.append("images[]", file);
			}

			if(window.FileReader)
			{
				reader = new FileReader();
				reader.onloadend = function (e)
				{

					var res;

					if(!!file.type.match(/image.*/))
					{
						res = e.target.result;
					} else {
						res = "/web/images/icn-multimedia.png";
					}
					var $img = $("<img src=\""+res+"\" />");
					var $li = $("<li class=\"notEnabled uploading upload-"+z+"\"></li>");

					$li.append($img);
					$li.append("<div class=\"pBar\"><span>&nbsp;</span></div>");

					$list.prepend($li);
					$("li:last-child", $list).hide();
					$this.fileUp.push($li);
					z++;
					readF++;
					if(readF == len)
					{
						// Submit
						if(formdata)
						{
							var request = $.ajax({
								xhr: function (evt){
									var xhr = new XMLHttpRequest();
									// Upload Proggress
									xhr.upload.addEventListener("progress", function(evt){
										if(evt.lengthComputable)
										{
											var loaded = evt.loaded;
											var i = 0;

											for(; i < files.length; i++){

												var fPerc = ((loaded / files[i].size) <= 1)?(loaded / files[i].size):1;
												if($(".uploading.upload-"+i, $this.$library))
												{
													var wdt = 98*fPerc;
													$(".uploading.upload-"+i+" span", $this.$library).css("width", wdt+"px");
													if(fPerc >= 1)
													{
														$(".uploading.upload-"+i, $this.$library).removeClass("uploading").children(".pBar").remove();
													}
												}

												if(loaded >= files[i].size){
													loaded -= files[i].size;
												} else {
													loaded = 0
												}

											}
										}
									}, false);

									return xhr;
								},
								url: "/adm/images/edit.php",
								type: "POST",
								data: formdata,
								processData: false,
								contentType: false,
								dataType: "json",
								complete: function (res)
								{
									var data = eval("("+res.responseText+")");

									$(".uploading", $this.$library).removeClass("uploading");

									var i = 0;
									for(; i < data.files.length; i++)
									{
										var f = data.files[i];
										var $upload = $(".upload-"+i, $this.$library);
										$("img", $upload).attr("src", f["100x100"] );

										$upload.wrapInner("<a href=\"#\"></a>");
										$("a", $upload).data("file", f);
										$upload.removeClass(".upload-"+i).removeClass("notEnabled");
									}
									$this.generateActionThumbs();
									//$form.html(res);
								}
							})
						}
					}
				}
				reader.readAsDataURL(file);
				$this.$library.append($list);
			}

		}
		$("li:last a", $this.$submenu).click();

	}
	this.changeDetails = function (file){
		var dt = file.ARQ_DTA;
		dt = dt.replace(/(-)/g, "/");
		var dFile = new Date(dt);


		var mTime = "{"+(this.monthsArr[dFile.getMonth()])+"}, "+dFile.getHours()+" "+dFile.getFullYear();
		var html = "<h3>{Attachment Details}</h3><img style=\"width: 100px\" src=\""+(file["100x100"])+"\" alt=\"Attach\"/>";
		html += "<p>";
		html += "<strong>"+file.ARQ_NOM+"</strong><br />";
		html += mTime+"<br />";
		html += (Math.ceil(file.size))+"Kb <br />";
		//html += "<a href=\"#\" class=\"editImage\">{Edit Image}</a> ";
		html += "<input type=\"\" value=\""+file.url+"\"/>";
		//html += "<a href=\"#\" class=\"deleteImage\">{Delete Permanently}</a>";
		html += "</p>";
		html += "<div class=\"hr\"><hr /></div>";
		/*
		 html += "<form>";
		 html += "<fieldset><legend class=\"hidden\">{Image Stats}</legend>";
		 html += "<input type=\"hidden\" name=\"image_id\" value=\""+(file.ARQ_ID)+"\" />";
		 html += "<label for=\"image_title\">{Title}</label><input type=\"text\" id=\"image_title\" name=\"image_title\" /><br />";
		 html += "<label for=\"image_caption\">{Caption}</label><input type=\"text\" id=\"image_caption\" name=\"image_caption\" /><br />";
		 html += "<label for=\"image_alt\">{Alt Text}</label><input type=\"text\" id=\"image_alt\" name=\"image_alt\" /><br />";
		 html += "<label for=\"image_description\">{Description}</label><input type=\"text\" id=\"image_description\" name=\"image_description\" />"
		 html += "<input type=\"submit\" value=\"{Save}\" />";
		 html += "</fieldset>";
		 html += "</form>";
		 */
		html = this.translateTxt(html);

		this.$details.html(html);
	}

	this.generateActionThumbs = function (){
		var $itens = $("li a", this.$library);
		$itens.each(function (){
			$(this).click(function (evt){

				var f = $(this).data("file");
				$this.changeDetails(f);
				if($this.options.currentPage != "#createGaleryPage")
				{
					$(this).parents("ul").children("li").removeClass("selected");
					$(this).parents("li").addClass("selected");
				} else {
					if($(this).parents("li").hasClass("selected"))
					{
						$(this).parents("li").removeClass("selected")
					} else {
						$(this).parents("li").addClass("selected");
					}
				}
				$this.selectItens();
				return false;
			})
		})
	}
	this.selectButtonAct = function (){
		$p = $("p", this.$footer);
		// Files


		switch($this.options.currentPage)
		{
			case "#useAsThumbPage":
				var file = $("img", $p).data("file");

				if(typeof($this.options.target) != "undefined")
				{
					$target = $this.options.target;
				} else {
					$target = $(".IDThumbNailImage");
				}
				if(typeof(this.options.targetFn) != "undefined"){
					this.options.targetFn(file);
				} else {
					$target.data("file", file);
					$target.val(file.ARQ_ID);
					$target.change();
				}

				$this.close();
				break;
			case "#insertMediaPage":
				var file = $("img", $p).data("file");
				//console.log(file);
				var html;
				if(file.ARQ_EXT.toLowerCase() in {'jpeg': true, 'jpg': true, 'gif': true, 'png': true})
				{
					html = "<img src=\""+file["540x683"]+"\"  />";
				} else if(file.ARQ_EXT.toLowerCase() in {'mov': true, 'mkv': true, 'mp4': true, 'avi': true, 'mpeg': true, 'mpg': true, 'ogg': true}){
					html = '<video width="320" height="240" controls>';
					html += '<source src="'+file.url+'" type="video/'+file.ARQ_EXT+'">';
					html += 'Your browser does not support the video tag.';
					html += '</video>';

				} else {
					html = '<audio controls="controls">';
					html += '<source src="'+file.url+'" type="audio/mpeg">';
					html += 'Your browser does not support the audio element.';
					html += '</audio>';

				}

				$('textarea.tinymce').tinymce().execCommand("mceInsertContent", false, html);
				$this.close();
				break;
			case "#createGaleryPage":
				var ret = new Array();

				$imgs = $("img.imgSel", $p);
				var tot = $imgs.length/2;
				var i = 0;

				$imgs.each(function (){
					if(i < tot){
						var file = $(this).data("file");

						var html = "<fieldset class=\"imageRem\">";
						html += "<a href=\"#\" class=\"ImageRemoveIcn\" title=\"{Remove}\">{Remove}</a>";
						html += "<img src=\""+file['100x100']+"\" />";
						html += "<input type=\"hidden\" name=\"gallery[IMG_REL][IMG_ID][]\" value=\""+file.ARQ_ID+"\" />";
						html += "<input type=\"text\" name=\"gallery[IMG_REL][IMG_TIT][]\" class=\"imgRelTit\" value=\"\" placeholder=\"{Title}\"/>";
						html += "<textarea name=\"gallery[IMG_REL][IMG_TXT][]\" class=\"imgRelTxt\" placeholder=\"{Text}\"></textarea>";
						//html += "<input type=\"text\" name=\"gallery[IMG_REL][IMG_TAGS][]\" class=\"imgRelTag\" value=\"\"  placeholder=\"{Tags}\" />";
						html += "</fieldset>";
						ret.push($this.translateTxt(html));
					}
					i++;
				})
				//console.log(ret);
				if(ret.length > 0)
				{
					$("#ImagesRelations").append(ret.join(""));
				}
				$this.close();
				break;

		}
	}
	this.selectItens = function (){
		var $itens = $("li.selected a", this.$library);
		$p = $("p", this.$footer);
		if($itens.length > 0) {

			var $btn;
			if($this.options.currentPage != "#createGaleryPage")
			{
				$btn = $(this.translateTxt("<input type=\"button\" value=\"{Add Image}\" class=\"alignRight\" />"));
			} else {
				$btn = $(this.translateTxt("<input type=\"button\" value=\"{Add Image}\" class=\"alignRight\" />"));
			}
			$btn.click(function (){
				$this.selectButtonAct();
			})

			var tit = this.translateTxt("{SELECTED}: ");
			$p.html(tit);
			$p.prepend($btn);
			$itens.each(function (){
				var f = $(this).data("file");
				$img = $("<img src=\""+f["100x100"]+"\" class=\"imgSel\"/>");
				$img.data("file", f);
				$p.append($img);
			})
		} else {
			$p.html("&nbsp;");
		}

	}
	// Init Triggers
	this.triggers = new Array();
	this.addTrigger = function (statusName, func)
	{
		this.triggers.push([statusName, func]);
	}
	this.removeTrigger = function (statusName)
	{
		for( var i in this.triggers)
		{
			if(this.triggers[i][0] == statusName)
			{
				this.triggers.splice(i, 1);
			}
		}
	}
	this.callTrigger = function (triggerName, params)
	{
		for(var i in this.triggers)
		{
			if(this.triggers[i][0] == triggerName)
			{
				var func = this.triggers[i][1];
				func(params);
			}
		}
	}

	this.addTrigger("PAGE_CHANGE", function ($PAGE){
		if($PAGE.attr("id") == "library1")
		{
			//console.log($this.options.currentPage);
			if($this.options.currentPage == "#createGaleryPage")
			{

				$PAGE.addClass("galleryPG");
			} else {
				$PAGE.removeClass("galleryPG");
			}

		}
	});

	this.addTrigger("LOAD_COMPLETE", function (){
		if(typeof($this.htmlLayout) != "undefined" && typeof($this.langData) != "undefined"){
			$this.initMedia()
		}
	});
	this.addTrigger("INIT_COMPLETE", function (){
		$this.initVariables();
	})
	this.renderPage = function (data){
		$this.$library.html("");

		var hasUp = (!$("ul.uploadedFiles", $this.$library)[0])?false:true;
		$list = (!$("ul.uploadedFiles", $this.$library)[0])?$("<ul class=\"uploadedFiles\"></ul>"):$("ul.uploadedFiles", $this.$library);
		$list.append("<li>Carregando...</li>")
		if(hasUp == false)
		{
			$this.$library.append($list);
		}
		$list.html("");

		if(data.totalPages > 1)
		{
			$pagination = $("<ul class=\"alignRight pagination\"></ul>");
			$this.$library.prepend($pagination);

			var cPage = Number(data.currentPage);

			var tPage = Math.min(Number(data.totalPages), (cPage+3));

			var sPage = Math.max(1, (cPage-3))

			for(var i = sPage; i<=tPage; i++)
			{
				$li = $("<li></li>");
				$a = $("<a href=\"/adm/images/index.php?page="+(i-1)+"\" class=\"bot\">"+i+"</a>")
				if((i-1) == data.currentPage)
				{
					$a.addClass("selected");
				}
				$a.click(function (){
					var Url = $(this).attr("href");
					$this.$library.html("<p>Carregando...</p>");
					$.ajax({
						url: Url,
						dataType: "json",
						success: function (data)
						{
							if(data.status == "SUCCESS")
							{
								$this.renderPage(data);
							}
						}
					})
					return false;
				})
				$li.append($a);
				$pagination.append($li);
			}
		}

		for(var i in data.data)
		{

			var file = data.data[i];


			var $img = $("<img src=\""+(file['100x100'])+"\" />");
			var $link = $("<a href=\"#\"></a>");
			var $li = $("<li class=\"files\"></li>");
			$link.data("file", file);
			$link.append($img);
			$li.append($link);
			$list.append($li);
		}
		$this.generateActionThumbs();
	}
	this.addTrigger("INIT_COMPLETE", function (){
		$list = (!$("ul.uploadedFiles", $this.$library)[0])?$("<ul class=\"uploadedFiles\"></ul>"):$("ul.uploadedFiles", $this.$library);
		$list.append("<li>Carregando...</li>");

		var urlPg = ($this.options.page != "insertMediaPage")?"/adm/images/index.php?OnlyImages=true":"/adm/images/index.php";

		$this.$library.append($list);
		$.ajax({
			url: urlPg,
			dataType: "json",
			success: function (data)
			{
				if(data.status == "SUCCESS")
				{
					$this.renderPage(data);
				}
			}
		})
	});

	this.addTrigger("INIT_COMPLETE", function (){
		$this.addActions()
		if( typeof($this.options.page) != "undefined")
		{
			$("a[href='#"+$this.options.page+"']", $this.$mainMenu).click();
		}
	});




	this.addTrigger("PAGE_CHANGE", function ($page){
		$(".submenu li:first a", $page).click();
	})


	this.initTemplatesLanguages = function (){
		// Init Template
		$.ajax({
			url: "/web/js/mediaUploader.layout.html",
			success: function (data){
				$this.htmlLayout = data;
				$this.callTrigger("LOAD_COMPLETE");
			}
		})



		// Init Language
		var langPath = this.options.languagePath+this.options.language+this.options.languageExt;
		$.ajax({
			url: langPath,
			success: function (data){
				var lang = data.split("\n");

				var languagePat = new Array();

				for(var i in lang)
				{
					var str = String(lang[i]);
					var str2 = str.split("=");
					languagePat.push(str2);
				}

				$this.langData = languagePat;
				$this.callTrigger("LOAD_COMPLETE");
			}
		})
	}
	this.loadLibraryPage = function (params){
		var url = (params != null && typeof(params) != "undefined")?"/":"";

	}

	this.initTemplatesLanguages();

	this.translateTxt = function (variable){
		for(var i in this.langData)
		{
			var regExp = new RegExp("\{("+this.langData[i][0]+")\}", "g");
			variable = variable.replace(regExp, this.langData[i][1]);
		}
		return variable;
	}
	this.generateHTML = function (){
		var html = this.translateTxt(this.htmlLayout);

		return html;
	}

}

$(function (){

	$("#previewBot").each(function (){
		$(this).click(function (e){
			if(e.preventDefault){ e.preventDefault(); }

			var href = $(this).attr("href");

			//href = href.replace("http://r7.com/", "http://marcelorezende.com.br/");
			href += "?withTemplate=true";

			var $form = $(this).parents("form");
			var data = $form.serialize();


			$.post(href, data, function (html){
				var $overflow = $("<div class=\"overflow\"></div>")
				var $lightbox = $("<div id=\"lightboxPreview\"></div>")
				var $botClose = $("<a class=\"btClose\">X</a>");
				var $mask = $("<iframe id=\"maskPreview\"></iframe>")

				$botClose.click(function (e){
					if(e.preventDefault){e.preventDefault();}

					$lightbox.remove();
					$overflow.remove();

					return false;
				})

				$lightbox.append($botClose);
				$lightbox.append($mask);

				$("body").append($overflow);
				$("body").append($lightbox);

				var h = $(window).height();

				var size = (h/2);
				var topS = ((h - size)/2)*(-1);

				$mask.css({"width": "1024px", "height": size+"px", "display": "block"});
				$lightbox.css("marginTop", topS+"px");

				var iframe = document.getElementById("maskPreview");
				iframe = (iframe.contentWindow) ? iframe.contentWindow : (iframe.contentDocument.document) ? iframe.contentDocument.document : iframe.contentDocument;
				iframe.document.open();
				iframe.document.write(html);
				iframe.document.close();

			})

			return false
		})
	})

	$(window).resize(function (){
		//var wdt = $(window).width();
		//wdt = wdt - 222;
		var height = ($(window).height() - 58);

		$("section").css({"min-height": height+"px"});
	})
	$(window).resize();

	$(".selectSite select").change(function (){
		var $this = $(this);
		var value = $this.val();
		if(value != "")
		{
			var htm = $this.children("option[value='"+value+"']").html();

			$this.prev("span").html(htm);

			document.location = value;
		}

	});

	$(".selectSite select").each(function (){
		var value = $(this).val();
		var htm = $(this).children("option[value='"+value+"']").html();
		$(this).prev("span").html(htm);
	})

	$("#menuSel select").change(function (){
		var $this = $(this);
		var value = $this.val();

		var htm = $this.children("option[value='"+value+"']").html();

		$this.prev("span").html(htm);

		document.location = value;
	});

	$("#menuSel select").each(function (){
		var value = $(this).val();
		var htm = $(this).children("option[selected='selected']").html();

		var regExp = new RegExp("(\&nbsp\;)", "g");
		if(htm != null)
		{
			htm = htm.replace(regExp, "");
		} else {
			html = "";
		}


		$(this).prev("span").html(htm);
	})

	$('textarea.tinymce').tinymce({
		language : "pt",
		// Location of TinyMCE script
		script_url : '/web/js/tiny_mce/tiny_mce.js',
		document_base_url: "/",
		relative_urls: false,
		theme : "advanced",
		skin : "wp_theme",
		plugins : "autolink,lists,advlink,contextmenu,fullscreen,advlist,media,paste,pagebreak",

		// Theme options
		theme_advanced_buttons1 : "bold,italic,underline,bullist,numlist,blockquote,justifyleft,justifycenter,justifyright,justifyfull,|,undo,redo,|,link,unlink,code,fullscreen,imageFF,media,pasteword,pagebreak",
		theme_advanced_toolbar_align : "left",
		theme_advanced_resizing : true,
		site_image_formats: SiteImageSizes,
		extended_valid_elements: "video[*],audio[*],source[*]",
		custom_elements: "video, audio",

		setup: function (ed)
		{
			ed.addButton("imageFF", {
				title : 'Adicionar Imagem da Biblioteca',
				image : '/web/images/imgBrowser.png',
				onclick : function() {
					$mediaUploader = new MediaUploader({page: "insertMediaPage"});
				}
			})
		}

	})
	$('textarea.tinymce2').tinymce({
		language : "pt",
		// Location of TinyMCE script
		script_url : '/web/js/tiny_mce/tiny_mce.js',
		document_base_url: "/",
		relative_urls: false,
		theme : "advanced",
		skin : "wp_theme",
		plugins : "autolink,lists,advlink,contextmenu,fullscreen,advlist,media,paste",

		// Theme options
		theme_advanced_buttons1 : "bold,italic,underline,bullist,numlist,blockquote,justifyleft,justifycenter,justifyright,justifyfull,|,undo,redo,|,link,unlink,code,fullscreen,pasteword",
		theme_advanced_toolbar_align : "left",
		theme_advanced_resizing : true,
		site_image_formats: SiteImageSizes,
		extended_valid_elements: "video[*],audio[*],source[*]",
		custom_elements: "video, audio",

	})
	// Add Tiny MCE Command
	// Translator
	function FuriousTranslator()
	{
		var langPath = "/web/js/languages/pt.ko";
		$this = this;

		$.ajax({
			url: langPath,
			success: function (data){
				var lang = data.split("\n");

				var languagePat = new Array();

				for(var i in lang)
				{
					var str = String(lang[i]);
					var str2 = str.split("=");
					languagePat.push(str2);
				}

				$this.langData = languagePat;
			}})

		this.translateTxt = function (variable)
		{
			for(var i in this.langData)
			{
				var re = this.langData[i][0];
				re = re.replace("?", "\\?");

				var regExp = new RegExp("\{("+re+")\}", "g");

				variable = variable.replace(regExp, this.langData[i][1]);
			}
			return variable;
		}
	}
	var translator = new FuriousTranslator();


	// Input Status checkbox
	$(".changeStatus").change(function(){
		if($(this).is(":checked")){
			$(this).parent("li").attr("class", "").addClass("approved-color");
			$(this).next("span").html("Ativo");
		} else {
			$(this).parent("li").attr("class", "").addClass("pendant-color");
			$(this).next("span").html("N&atilde;o ativo");
		}
	})
	// Quick Form
	$(".quickEditBtn").each(function (){
		var $this = $(this);
		$this.click(function(){
			var $trThis = $(this).parents("tr");
			var $QForm = $trThis.next("tr.quickEditForm");
			$trThis.hide("fast");
			$QForm.show("fast");
			return false;
		})
	})
	// Quick Edit
	$("a.saveQuickEdit").click(function (){
		var $this = $(this), $li = $this.parents("tr"), $inputs = $li.find(":input");

		var $tds = $li.prev("tr").children();

		var path = String(document.location);
		path = path.replace("index", "quick");


		$.ajax({
			url: path,
			data: $inputs.serialize(),
			dataType: "json",
			type: "POST",
			success: function (data)
			{
				if(data.status != "SUCCESS")
				{
					window.alert("Houve um erro ao salvar. Tente novamente mais tarde");
				}
				else {
					document.location.reload();
				}
			}
		});

		return false;
	})

	// Add Repply Pool
	$("a.addPoolRepply").click(function(){
		var $parent = $(this).parent().parent();
		var $lastInp = $(this).parent().prev("input");
		var $lastLbl = $lastInp.prev("label").clone().insertBefore($(this).parent());
		$lastInp = $lastInp.clone().insertBefore($(this).parent());

		var lblFor = $lastLbl.attr("for");
		var reg = new RegExp("(.+)([0-9]+)");


		// IDS
		var re = reg.exec(lblFor);
		var num = Number(re[2]);
		num++;
		var str = re[1];
		var nID = str+num;

		// Placeholders
		var re = reg.exec($lastLbl.html());
		var num = Number(re[2]);
		num++;
		var str = re[1];
		var lbl = str+num;


		$lastInp.attr({"id": nID, "name": nID, "placeholder": lbl});
		$lastLbl.attr({"for": nID});
		$lastLbl.html(lbl);

		return false;
	})

	var $mediaUploader;
	$("a.OpenMediaUploader").each(function (){

		$(this).click(function (){
			if($(this).hasClass("removeImg"))
			{
				$parent = $(this).parents(".box");
				$("input", $parent).val("");
				$("img", $parent).parent().remove();

				$(this).removeClass("removeImg").addClass("bot").html("Adicionar Imagem");



			} else {
				var pageAct = $(this).attr("rel");
				$parent = $(this).parents(".box");
				console.log($parent);
				var $input = $("input", $parent);

				$mediaUploader = new MediaUploader({page: pageAct, target: $input});
			}
			/*
			 $("<img src=\"images/_imgGalEd.png\" width=\"1346\" height=\"\" />").appendTo($("body")).dialog({
			 modal: true,
			 width: 1327,
			 dialogClass: "mediaUploader",
			 height: 769,
			 position: {my: "center center", at: "center center", of: $("body")}
			 });*/
			return false;
		})

	})

	// Main Menu
	$(".mainMenu").children("li").each(function (){
		$(this).children("a").click(function (){
			$(this).parents("ul.mainMenu").children("li").removeClass("open");
			$(this).parent("li").addClass("open");
			return false;
		})
	})
	var $sele = $("li.selected", $(".mainMenu"));
	if($sele[0])
	{
		$sele.parent("ul").parent("li").children("a").click();
	} else {
		$(".mainMenu").children("li:first").children("a").click();
	}

	$(".mainMenu li ul li.selected").parent().parent().children("a").click();

	// Menu
	$("input[name='inptType']").change(function() {
		var el = $(this).val();
		$("#formQuiz").attr("class", el);
	})
	$("input[name='inptType']:checked").change();
	/*
	 $(".menuSeta li a").each(function (){
	 $(this).click(function (){
	 var parents = $(this).parents("ul");
	 parents.children("li").removeClass("selected");

	 $(this).parent().addClass("selected");

	 var attr = $(this).attr("href");

	 var $target = $(attr);
	 $target.parent().children("div").hide();
	 $target.show();

	 return false;
	 })
	 })
	 $(".menuSeta li:first a").click();
	 */
	// Tag Remove
	$(document).on("click", "a.removeTagBtn", function (){
		$(this).parents("li").remove();
		return false;
	})
	$(document).on("click", "a.removeProdBtn", function (){
		$(this).parents("li").remove();
		return false;
	})

	$(document).on("click", "a.removeCatBtn", function (){
		$(this).parents("li").remove();
		return false;
	})

	function addTag(item, target, sender, nomeCampo)
	{
		if(!target){
			target = "taglistAdd";
		}
		if(!sender){
			sender = "tagsInsert";
		}

		if(!nomeCampo){
			nomeCampo = "cnt_tags";
		}
		$ulTags = $("ul."+target);
		var inputs = $(":input[name*='[']:first");
		var reg = new RegExp("^([a-z]+)([\[])");
		var prefix = reg.exec(inputs.attr("name"));
		prefix = prefix[1];
		var html = " <li><input type=\"hidden\" name=\""+prefix+"["+nomeCampo+"][]\" value=\""+item.value+"\"><span class=\"tag\"><a href=\"#\">"+item.label+"</a> <a href=\"#\" class=\"removeTagBtn\">X</a></span></li>";
		$ulTags.append(html);
		$("#"+sender).val("");
	}


	// Featured News ID Relation
	$("#news_id").autocomplete({
		minLength: 2,
		source: function (request, response)
		{
			$.ajax({
				url: "/content/loadContent.php",
				dataType: "json",
				data: {
					term: request.term
				},
				success: function (data)
				{
					if(data.status == "SUCCESS")
					{
						response($.map(data.itens, function (item){
							return {label: item.tit, value: item.ID, date: item.date, url: item.url}
						}));
					}
				}
			})
		},
		select: function (event, ui)
		{
			$(this).val(ui.item.value);
			$("#dtq_lnk").val(ui.item.url).attr("readonly", "readonly");
			var dt = new Date(ui.item.date);
			var cDate = new Date();
			if(dt > cDate)
			{
				var sDt = dt.getDay()+"/"+dt.getMonth()+"/"+dt.getYear()+" "+dt.getHours()+":"+dt.getMinutes()+":"+dt.getSeconds();
				window.alert(translator.translateTxt("{Atention this content is programmed to}:"+sDt));
			}


		}
	})
	// Tag Add
	$("#tagsInsert").autocomplete({
		source: function(request, response){
			$.ajax({
				url: "/adm/tags.php",
				dataType: "json",
				data: {
					term: request.term
				},
				success: function (data)
				{

					if(data.status == "SUCCESS")
					{
						response($.map(data.itens, function (item){
							alert(item.TAG_NOM);
							return {label: item.TAG_NOM, value: item.TAG_ID}
						}));
					} else {
						response(false);
					}

				}

			})
		},
		minLength: 2,
		select: function (event, ui)
		{
			addTag(ui.item);
			return false;
		}
	})
	$("#tagsInsert").keyup(function(){
		var v = $(this).val();
		var reg = new RegExp("([,])");
		if(reg.test(v))
		{
			v = v.replace(", ", "");
			v = v.replace(",", "");
			$(this).val(v);
			$(this).next(".addTag").click();
			$("ul.ui-autocomplete").hide();
		}
	})
	$(".addTag").click(function (){
		var tag = $("#tagsInsert").val();
		$.ajax({
			url: "/adm/tags.php",
			dataType: "json",
			data: {
				addTag: tag,
				term: tag
			},
			success: function (data)
			{
				if(data.status == "SUCCESS")
				{

					var item = data.itens[0];
					addTag({label: item.TAG_NOM, value: item.TAG_ID});
				}
			}
		})
		return false;
	})

	//PROD RECEITA ADD
	$("#prodsInsert").autocomplete({
		source: function(request, response){
			$.ajax({
				url: "/adm/prod.php",
				dataType: "json",
				data: {
					term: request.term
				},
				success: function (data)
				{

					if(data.status == "SUCCESS")
					{
						response($.map(data.itens, function (item){
							return {label: item.CNT_TIT, value: item.CNT_ID}
						}));
					} else {
						response(false);
					}

				}

			})
		},
		minLength: 2,
		select: function (event, ui)
		{
			console.log(ui);
			console.log(event);
			addTag({label: ui.item.label, value: ui.item.value}, "prodlistAdd","prodsInsert", "cnt_prods");
			return false;
		}
	})
	$("#prodsInsert").keyup(function(){
		var v = $(this).val();
		var reg = new RegExp("([,])");
		if(reg.test(v))
		{
			v = v.replace(", ", "");
			v = v.replace(",", "");
			$(this).val(v);
			$(this).next(".addTag").click();
			$("ul.ui-autocomplete").hide();
		}
	})

	$(".addProd").click(function (){
		var tag = $("#prodsInsert").val();
		var receita = $('#CNT_ID').val();
		$.ajax({
			url: "/adm/prod.php",
			dataType: "json",
			data: {
				addTag: tag,
				term: tag,
				receita: receita
			},
			success: function (data)
			{
				if(data.status == "SUCCESS")
				{

					var item = data.itens[0];
					addTag({label: item.TAG_NOM, value: item.TAG_ID}, "prodlistAdd","prodsInsert", "cnt_prods");
				}
			}
		})
		return false;
	})


	$(".addTabela").click(function (){
		var tabela_valor_energetico = $('#tabela_valor_energetico').val();
		var tabela_quantidade = $('#tabela_quantidade').val();
		var tabela_porcentagem = $('#tabela_porcentagem').val();
		var produto_id = $('#news_cnt_id').val();

		$.ajax({
			url: "/adm/tabela.php",
			dataType: "json",
			data: {
				tabela_valor_energetico: tabela_valor_energetico,
				tabela_quantidade:tabela_quantidade,
				tabela_porcentagem:tabela_porcentagem,
				produto_id:produto_id
			},
			success: function (data)
			{
				if(data.status == "SUCCESS")
				{


					var item = data.itens[0];

					addTabela(item.produto_id, item.valor_energetico, item.quantidade_porcao, item.porcentagem_por_porcao);
					$('#tabela_valor_energetico').val("");
					$('#tabela_quantidade').val("");
					$('#tabela_porcentagem').val("");
				}
			}
		})
		return false;
	})


	function addTabela(produto_id, valor_energetico, quantidade_porcao, porcentagem_por_porcao){

		var html = '<tr><td class="coluna_tabela">'+valor_energetico+'</td>';
		html += '<td class="coluna_tabela">'+quantidade_porcao+'</td>';
		html += '<td class="coluna_tabela">'+porcentagem_por_porcao+'</td></tr>';


		$('.tabListAdd').append(html);

	}

	// Tag Add
	$("#tagsInsert").autocomplete({
		source: function(request, response){
			$.ajax({
				url: "/adm/tags.php",
				dataType: "json",
				data: {
					term: request.term
				},
				success: function (data)
				{

					if(data.status == "SUCCESS")
					{
						response($.map(data.itens, function (item){
							return {label: item.TAG_NOM, value: item.TAG_ID}
						}));
					} else {
						response(false);
					}

				}

			})
		},
		minLength: 2,
		select: function (event, ui)
		{
			addTag(ui.item);
			return false;
		}
	})
	$("#tagsInsert").keyup(function(){
		var v = $(this).val();
		var reg = new RegExp("([,])");
		if(reg.test(v))
		{
			v = v.replace(", ", "");
			v = v.replace(",", "");
			$(this).val(v);
			$(this).next(".addTag").click();
			$("ul.ui-autocomplete").hide();
		}
	})
	$(".addTag").click(function (){
		var tag = $("#tagsInsert").val();
		$.ajax({
			url: "/adm/tags.php",
			dataType: "json",
			data: {
				addTag: tag,
				term: tag
			},
			success: function (data)
			{
				if(data.status == "SUCCESS")
				{

					var item = data.itens[0];
					addTag({label: item.TAG_NOM, value: item.TAG_ID});
				}
			}
		})
		return false;
	})

	/**************************************************************************/
	/* ADICIONANDO CATEGORIA */

	$(".addCat").click(function (){
		var categoria = $("#catInsert").val();
		$.ajax({
			url: "/adm/categoria.php",
			dataType: "json",
			data: {
				categoria: categoria,
				term: categoria
			},
			success: function (data)
			{
				if(data.status == "SUCCESS")
				{
					var item = data.itens[0];
					addCategoria({label: item.CAT_NOM, value: item.CAT_ID});
				}
			}
		})
		return false;
	});
	$("#catInsert").autocomplete({
		source: function(request, response){
			$.ajax({
				url: "/adm/categoria.php",
				dataType: "json",
				data: {
					term: request.term
				},
				success: function (data)
				{
					if(data.status == "SUCCESS")
					{
						response($.map(data.itens, function (item){
							return {label: item.CAT_NOM, value: item.CAT_ID}
						}));
					} else {
						response(false);
					}

				}

			})
		},
		minLength: 2,
		select: function (event, ui)
		{
			addCategoria(ui.item);
			return false;
		}
	})
	$("#catInsert").keyup(function(){
		var v = $(this).val();
		var reg = new RegExp("([,])");
		if(reg.test(v))
		{
			v = v.replace(", ", "");
			v = v.replace(",", "");
			$(this).val(v);
			$(this).next(".addCat").click();
			$("ul.ui-autocomplete").hide();
		}
	})


	function addCategoria(item)
	{
		$ulCategorias = $("ul.catListAdd");
		var inputs = $(":input[name*='[']:first");
		var reg = new RegExp("^([a-z]+)([\[])");
		var prefix = reg.exec(inputs.attr("name"));
		prefix = prefix[1];
		var html = " <li><input type=\"hidden\" name=\""+prefix+"[cnt_cats][]\" value=\""+item.value+"\"><span class=\"tag\"><a href=\"#\">"+item.label+"</a> <a href=\"#\" class=\"removeCatBtn\">X</a></span></li>";
		$ulCategorias.append(html);
		$("#catInsert").val("");
	}


	/*************************************************************************/

	/**************************************************************************/
	/* ADICIONANDO CATEGORIA DE DICAS */
	$("#catDicasInsert").autocomplete({
		source: function(request, response){
			$.ajax({
				url: "/adm/categoriaDicas.php",
				dataType: "json",
				data: {
					term: request.term
				},
				success: function (data)
				{

					if(data.status == "SUCCESS")
					{
						response($.map(data.itens, function (item){
							return {label: item.CAT_NOM, value: item.CAT_ID}
						}));
					} else {
						response(false);
					}

				}

			})
		},
		minLength: 2,
		select: function (event, ui)
		{
			console.log(ui);
			console.log(event);
			addTag({label: ui.item.label, value: ui.item.value}, "catDicasListAdd","catDicasInsert", "cnt_cats");
			return false;
		}
	})

	$(".addCatDicas").click(function (){
		var categoria = $("#catDicasInsert").val();
		$.ajax({
			url: "/adm/categoriaDicas.php",
			dataType: "json",
			data: {
				categoria: categoria,
				term: categoria
			},
			success: function (data)
			{
				if(data.status == "SUCCESS")
				{
					var item = data.itens[0];
					addCategoriaDicas({label: item.CAT_NOM, value: item.CAT_ID});
				}
			}
		})
		return false;
	});

	function addCategoriaDicas(item)
	{
		$ulCategorias = $("ul.catDicasListAdd");
		var inputs = $(":input[name*='[']:first");
		var reg = new RegExp("^([a-z]+)([\[])");
		var prefix = reg.exec(inputs.attr("name"));
		prefix = prefix[1];
		var html = " <li><input type=\"hidden\" name=\""+prefix+"[cnt_cats][]\" value=\""+item.value+"\"><span class=\"tag\"><a href=\"#\">"+item.label+"</a> <a href=\"#\" class=\"removeCatBtn\">X</a></span></li>";
		$ulCategorias.append(html);
		$("#catInsert").val("");
	}

	/*************************************************************************************************/

	$("a.changePubDate").click(function (){
		$(this).parents("#boxPublish").children("div").children("div.showHide.date").toggleClass("hidden");
		return false;
	})

	$(".IDThumbNailImage").change(function (){
		if($(this).val() != "" && $(this).val() != " ")
		{
			if(typeof($(this).data("file")) != "undefined")
			{
				var file = $(this).data("file");

				var $parent = $(this).parent();
				if(!$("img", $parent)[0])
				{
					$(this).prev("p").children("a").html("Remover Imagem").removeClass("bot").clone().prependTo($parent).html("<img src=\""+file["100x100"]+"\" class=\"ftdImage\" />");
					$(this).prev("p").children("a").addClass("removeImg");
				} else {
					$("img", $parent).attr("src", file["100x100"]);
				}


			}
		}
	})
	$(".IDThumbNailImage").change();
	$("a.ImageRemoveIcn").live("click", function (){
		if(window.confirm(translator.translateTxt("{Are you sure wants to remove this image?}")))
		{
			$(this).parent("fieldset").remove();
		}
		return false;
	})
	$(".checkAll").change(function (){
		var check = $(this).attr("checked");
		if(typeof(check) == "undefined")
		{
			$(".selComment").attr("checked", false);
		} else {
			$(".selComment").attr("checked", true);
		}
	})
	$(".quickEditBtn2").each(function (){
		$(this).click(function (){
			//console.log("RODOU");
			var $this = $(this);
			var $parentTR = $this.parents("tr");

			var offset = $parentTR.offset();


			var urlS = $(this).attr("href");
			$.ajax({
				url: urlS,
				success: function (data){
					var $div = $("<div></div>");
					$div.html(data);
					$div.css({
						position: "absolute",
						top: offset.top,
						left: offset.left,
						width: $parentTR.width(),
						"z-index": 1000
					})
					$("body").append($div);
					$parentTR.children("td").css("height", $div.height()+"px");
					var bg = $parentTR.children("td").css("background-color");
					$div.css("background-color", bg);
					if(bg == "rgba(0, 0, 0, 0)"){
						bg = "#FFF";
					}
					$div.css("background", bg);
					$("input[type=reset]", $div).click(function (){
						$parentTR.children("td").css("height", "auto");
						$div.remove();
						return false;
					})
					$("form", $div).submit(function (){
						var u = $(this).attr("action");
						u = u.replace(".php", ".json.php");
						var m = $(this).attr("method");

						var dataU = $(":input", $(this)).serialize();
						$.ajax({
							url: u,
							type: m.toUpperCase(),
							dataType: "json",
							data: dataU,
							success: function (data)
							{
								if(data.status == "SUCCESS")
								{



									$("td[rel]", $parentTR).each(function (){
										var rel = $(this).attr("rel");
										$(this).html(data.item[rel]);
									})

									//html("<p>"+data.item.MSG_TXT+"</p>");
									//$(".comment-author", $parentTR).html(data.item.MSG_NOM);
									$("input[type=reset]", $div).click();
								} else {
									window.alert(data.msg);
									$("input[type=reset]", $div).click();
								}
							}
						})

						return false;
					})


				}
			})

			return false;
		})
	})

	//  Repply Comment
	$(".EditComment").each(function (){
		$(this).click(function (){
			//console.log("RODOU");
			var $this = $(this);
			var $parentTR = $this.parents("tr");

			var offset = $parentTR.offset();


			var urlS = $(this).attr("href");
			$.ajax({
				url: urlS,
				success: function (data){
					var $div = $("<div></div>");
					$div.html(data);
					$div.css({
						position: "absolute",
						top: offset.top,
						left: offset.left,
						width: $parentTR.width(),
						"z-index": 1000
					})
					$("body").append($div);
					$parentTR.children("td").css("height", $div.height()+"px");
					var bg = $parentTR.children("td").css("background-color");
					if(bg == "rgba(0, 0, 0, 0)"){
						bg = "#FFF";
					}
					$div.css("background-color", bg);
					$("input[type=reset]", $div).click(function (){
						$parentTR.children("td").css("height", "auto");
						$div.remove();
						return false;
					})
					$("form", $div).submit(function (){
						var u = $(this).attr("action");
						u = u.replace(".php", ".json.php");
						var m = $(this).attr("method");

						var dataU = $(":input", $(this)).serialize();
						$.ajax({
							url: u,
							type: m.toUpperCase(),
							dataType: "json",
							data: dataU,
							success: function (data)
							{
								if(data.status == "SUCCESS")
								{
									$(".comment-txt", $parentTR).html("<p>"+data.item.MSG_TXT+"</p>");
									$(".comment-author", $parentTR).html(data.item.MSG_NOM);
									$("input[type=reset]", $div).click();
								}
							}
						})

						return false;
					})


				}
			})

			return false;
		})
	})

	//  Reply
	$(".ReplyComment").each(function (){
		$(this).click(function (){
			//console.log("RODOU");
			var $this = $(this);
			var $parentTR = $this.parents("tr");
			var offset = $parentTR.offset();

			var Top = offset.top + $parentTR.height();


			var urlS = $(this).attr("href");
			$.ajax({
				url: urlS,
				success: function (data){
					var $div = $("<div></div>");
					$div.html(data);
					$div.css({
						position: "absolute",
						top: Top,
						left: offset.left,
						width: $parentTR.width(),
						"z-index": 1000
					})
					$("body").append($div);
					//$parentTR.children("td").css("height", $div.height()+"px");
					var bg = $parentTR.children("td").css("background-color");
					if(bg == "rgba(0, 0, 0, 0)"){
						bg = "#FFF";
					}
					$div.css("background-color", bg);
					$("input[type=reset]", $div).click(function (){
						$parentTR.children("td").css("height", "auto");
						$div.remove();
						return false;
					})
					$("form", $div).submit(function (){
						var u = $(this).attr("action");
						u = u.replace(".php", ".json.php");
						var m = $(this).attr("method");

						var dataU = $(":input", $(this)).serialize();
						$.ajax({
							url: u,
							type: m.toUpperCase(),
							dataType: "json",
							data: dataU,
							success: function (data)
							{
								if(data.status == "SUCCESS")
								{
									document.location.reload();
								}
							}
						})

						return false;
					})


				}
			})

			return false;
		})
	})

	// Sites HideShow
	$(".Sites input[type=\"checkbox\"]").click(function (){
		if($(this).is(":checked"))
		{
			$(this).next("label").next(".hideShowPerms").css("height", "auto");
		} else {
			$(this).next("label").next(".hideShowPerms").css("height", "0");
		}
	});
	$(".Sites input[type=\"checkbox\"]:checked").each(function (){
		$(this).next("label").next(".hideShowPerms").css("height", "auto");
	});

	//  Featured Box Block
	$(document).on("change", "#FeaturedBlock select.SiteAreas", function (){
		var value = $(this).val();
		$area = $(".SelectArea", $(this).parent());
		$area.html("<option>Carregando...</option>");
		$.ajax({
			url: "/adm/featured/listAreas.json.php",
			data: {"EditorialID": value},
			type: "POST",
			dataType: "json",
			success: function (data){
				if(data.status == "SUCCESS")
				{
					$area.html("");
					for(var i in data.data)
					{
						var item = data.data[i];
						$area.append("<option value="+item.type+">"+item.name+"</option>");
					}
				} else {
					$area.html("<option>N&atilde;o h&aacute; itens cadastrados </option>");
				}
			}
		})
	})
	$("#FeaturedBlock select.SiteAreas").change();
	$(document).on("click", "#FeaturedBlock .addButton", function (){
		if($("#FeaturedBlock select.SiteAreas").val() != "" && $("#FeaturedBlock select.SelectArea").val() != "")
		{
			var edt = $("#FeaturedBlock select.SiteAreas").val();
			var tip = $("#FeaturedBlock select.SelectArea").val();

			$.ajax({
				url: "/adm/featured/configs.php",
				data: {"EditorialID": edt, "Tip": tip},
				type: "POST",
				success: function (data){
					$("#FeaturedBlock").children("h3").next("div").append(data);
					var i = 1;

					// Auto Complete Infos
					var link = $("input[type=hidden][name*='CONTENT_LINK']").val();
					var $blockForm = $("#FeaturedBlock .blockForm:last");

					$("input[name*='DTQ_LNK']", $blockForm).val(link);

					$("#FeaturedBlock .blockForm").each(function (){
						var $this = $(this);
						$this.prev("input[type='radio']").attr("id", "HideShow-"+i);
						$("legend label", $this).attr("for", "HideShow-"+i);

						i++;
					})
				}
			})

		} else {
			window.alert("Primeiro selecione um site e uma ·rea");
		}
		return false;
	})
	$(document).on("click", ".add_file_url", function (){
		var rel = $(this).attr("rel");
		var $target = $("#"+rel);
		if($target[0]){
			$mediaUploader = new MediaUploader({page: "useAsThumbPage", targetFn: function (file){
				$target.val(file.url);
			}});
		}
		return false;
	})
	$(document).on("click", ".selectPrevImage", function (){
		if($(this).prev("input[type='hidden']")[0])
		{
			$mediaUploader = new MediaUploader({page: "useAsThumbPage", target: $(this).prev("input[type='hidden']")});
		}
		return false;
	})
	$(document).on("click", ".selectNextImage", function (){
		if($(this).next("input[type='hidden']")[0])
		{
			$mediaUploader = new MediaUploader({page: "useAsThumbPage", target: $(this).next("input[type='hidden']")});
		}
		return false;
	})
	$(document).on("change", ".previewImage", function (){
		if($(this).data("file"))
		{
			var $img, $a, files = $(this).data("file");
			if(!$(this).prev("a.selectNextImage")[0])
			{
				$a = $("<a href=\"#\" class=\"selectNextImage\"></a>")
				$img = $("<img src=\"\" class=\"prevImage\"/>");
				$a.append($img)
				$(this).before($a);
			} else {
				$a = $(this).prev("a.selectNextImage");
				$img = $("img", $a);
			}
			$img.attr("src", files['50x50']);
		}
		return false;
	})
	$(document).on("change", ".previewImage2", function (){
		if($(this).data("file"))
		{
			var $img, $a, files = $(this).data("file");

			if(!$(this).prev("a.selectNextImage")[0])
			{
				$a = $("<a href=\"#\" class=\"selectNextImage\"></a>")
				$img = $("<img src=\"\" class=\"prevImage\"/>");
				$a.append($img)
				$(this).before($a);
			} else {
				$a = $(this).prev("a.selectNextImage");
				$img = $("img", $a);
			}
			$img.attr("src", files['370x370']);
		}
		return false;
	})
	$(document).on("change", ".previewImageErrada", function (){
		if($(this).data("file"))
		{
			var $img, $a, files = $(this).data("file");
			if($(this).prev("div#FtoErrada")[0])
			{
				$(this).prev("div#FtoErrada").remove();
			}
			if(!$(this).prev("div#FtoErrada")[0])
			{
				$a = $("<div id=\"FtoErrada\"></div>")
				$img = $("<img src=\"\" class=\"prevImage\"/>");
				$a.append($img)
				$map = $("<div class=\"mapItens\"></div>");
				$a.append($map);
				for(var i = 1; i<=7; i++)
				{
					var $marker = $("<span class=\"markerBall\" rel=\"#coord"+i+"\">"+i+"</span>");
					$marker.draggable({
						containment: "parent",
						drag: function(event, ui) {
							var index = Number($(this).html());
							var pos = ui.position;
							var top = pos.top + (20*(index-1));
							var left = pos.left;
							var target = $(this).attr("rel");

							$(target).val(left+","+top);

						}
					})
					if($("#coord"+i).val() != "")
					{
						var v = $("#coord"+i).val();
						v = v.split(",");
						var index = Number($marker.html())
						var top = ((Number(v[1])) + (20*(index-1))*(-1))
						$marker.css({"left": (v[0])+"px", "top": (top)+"px"});
					}
					$map.append($marker);
				}

				$(this).before($a);
			} else {
				$a = $(this).prev("div#FtoErrada");
				$img = $("img", $a);
			}
			$img.attr("src", files['370x370']);
		}
		return false;
	})
	$(document).on("click", ".removeFeatured", function (){
		$(this).parents(".blockForm").prev("input[type='radio']").remove();
		$(this).parents(".blockForm").remove();
		return false;
	})

	var alphabet = ["A", "B", "C", "D", "E", "F", "G", "H", "I", "J"];
	$(document).on("click", ".InsertOption", function (){
		var $fieldset = $(this).parents("fieldset"), labels = $("label", $fieldset), cls = $fieldset.attr("class");
		if((labels.length+1) <= 10)
		{
			var leter = (labels.length >= 1)?alphabet[(labels.length)]:alphabet[0];
			var html = "<label rel=\""+leter+"\">"+leter+"</label>";
			html += "<input type=\"text\" name=\"quiz[questions]["+cls+"][]\"><br />";
			$(this).parent().before(html);
		} else {
			window.alert(translator.translateTxt("{Maximum number of alternatives reached}"));
		}
		return false;
	})
	$(".insertQuestion").click(function (){

		var $parents = $(this).parent().parent();
		var $fields = $("fieldset", $parents);


		var html = "<fieldset class=\"question1\">";
		html += "<input type=\"text\" name=\"quiz['questions]['questionName'][]\" placeholder=\"Pergunta\" class=\"inputText\">";
		html += "<div>";
		html += "	<label rel=\"A\">A</label><input type=\"text\" name=\"quiz[questions][question1][]\"><br>";
		html += "	<label rel=\"B\">B</label><input type=\"text\" name=\"quiz[questions][question1][]\"><br>";
		html += "	<label rel=\"C\">C</label><input type=\"text\" name=\"quiz[questions][question1][]\"><br>";
		html += "	<label rel=\"D\">D</label><input type=\"text\" name=\"quiz[questions][question1][]\"><br>";
		html += "	<p><a href=\"#\" class=\"bot InsertOption\">Inserir Alternativa</a></p>";
		html += "</div>";
		html += "</fieldset>";

		var regExp = new RegExp("(question1)", "g");
		html = html.replace(regExp, "question"+($fields.length+1));

		$(this).parent().before(html);

		return false;
	})

	// Insert Answers
	$(".insertAnswer").click(function (){
		$(this).parent().before("<input type=\"text\" name=\"quiz[answers][]\" class=\"inputText\">");
		return false;
	})

	// LinkSite
	$(".linkSite").each(function (){
		var $this = $(this);
		var $input = $(this).parent().prev("br").prev("input");
		$input.change(function (){
			var value = $(this).val();
			var str = $this.html();
			str = str.replace(/\n(\t+)/, "");
			str = str.replace(/(\t+)/, "");
			var reg = /([a-z0-9_]+)\-([0-9]+)\.html$/i;
			var parts = reg.exec(str);
			str = str.replace(parts[0], (Slugfy(value))+"-"+parts[2]+".html");
			$this.attr("href", str).html(str);
		})
	})
	$("#DashboardIndex").masonry({
		columnWidth: 350,
		itemSelector: '.box',
		gutter: 20
	})

	$(document).on("click", "a.addLinkBtn", function (){
		var $parent = $(this).parent().parent();
		var $fieldset = $("fieldset.linksAddFieldset:last", $parent);
		var $newFieldset = $fieldset.clone();

		$(":input", $newFieldset).each(function (){
			$(this).val("");
		})

		$parent.append($newFieldset);

		var i = 0;
		$parent.children("fieldset.linksAddFieldset").each(function (){

			var $this = $(this);
			$("label", $(this)).each(function (){
				var attFor = $(this).attr("for");
				var $input = $("#"+attFor, $this);
				var reg = new RegExp("([0-9]+)");
				var res = reg.exec(attFor);
				var inputName = $input.attr("name");
				var res2 = reg.exec(inputName);

				if(res != null)
				{
					var nFor = attFor.replace(res[0], i);
					$(this).attr("for", nFor);
					$input.attr("id", nFor);
				}


				if(res2 != null)
				{
					var n = inputName.replace(res2[0], i);
					$input.attr("name", n);
				}
			})
			i++;
		})

		return false;
	})
	$(document).on("click", "a.removeLinkBtn", function (){
		var $parent = $(this).parent().parent();

		if($parent.children("fieldset.linksAddFieldset").length > 1)
		{
			$(this).parent().remove();

		} else {
			var $field = $(this).parent();
			$(":input", $field).each(function (){
				$(this).val("");
			})
		}
		var i = 0;
		$parent.children("fieldset.linksAddFieldset").each(function (){

			var $this = $(this);
			$("label", $(this)).each(function (){
				var attFor = $(this).attr("for");
				var $input = $("#"+attFor, $this);
				var reg = new RegExp("([0-9]+)");
				var res = reg.exec(attFor);
				var inputName = $input.attr("name");
				var res2 = reg.exec(inputName);
				if(res != null)
				{
					var nFor = attFor.replace(res[0], i);
					$(this).attr("for", nFor);
					$input.attr("id", nFor);
				}
				if(res2 != null)
				{
					var n = inputName.replace(res2[0], i);
					$input.attr("name", n);
				}
			})
			i++;
		})

		return false;
	})
	$("#ImagesRelations").sortable();

	// Comments Buttons Actions

	$("a.aproveBtn, a.spamBtn").click(function(){
		var link = $(this).attr("href");
		link = link.replace(".php", ".json");
		var $this = $(this);
		$.ajax({
			url: link,
			dataType: "json",
			success: function (data)
			{
				if(data.status == "SUCCESS")
				{
					$this.parents("tr").hide("fast");
				} else {
					window.alert("Houve um erro ao processar sua requisiÁ„o");
				}
			}
		})

		return false;
	})
	$(".audioPlayer").each(function(){
		var $this = $(this);
		$this.AudioPlayer({'mp3': $this.attr("data-audio")});
	})
	/*if($("#EditorialForm :checkbox:checked")[0])
	{
		var $checked = $("#EditorialForm :checkbox:checked");
		$("#EditorialForm :checkbox").each(function (){
			$(this).attr("disabled", "disabled");
		})
		$checked.attr("disabled", false);
	}	else {
		$("#EditorialForm :checkbox").each(function (){
			$(this).attr("disabled", false);
		})
	}*/
	$("#EditorialForm :checkbox").click(function (e){


		/*if($("#EditorialForm :checkbox:checked")[0])
		{
			var $checked = $("#EditorialForm :checkbox:checked");
			$("#EditorialForm :checkbox").each(function (){
				$(this).attr("disabled", "disabled");
			})
			$checked.attr("disabled", false);
		} else {
			$("#EditorialForm :checkbox").each(function (){
				$(this).attr("disabled", false);
			})
		}*/

	})

	$(".subSelect").change(function (){
			$(this).parents("form").submit();
	})
})
