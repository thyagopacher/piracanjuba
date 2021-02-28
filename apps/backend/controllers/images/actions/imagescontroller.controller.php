<?php
class ImagesController extends DefaultController 
{
	private $fileFormats = array("50x50" => array(50, 50), "60x60" => array(60, 60), "100x100" => array(100, 100), "1550x616" => array(1550, 616), "400x330" => array(400, 330), "300x160" => array(300, 160));
	
	public function __construct($method, $params)
	{
		
		
	}
	
	public function index($vars = null)
	{
		$criteria = new FuriousSelectCriteria();
		$criteria->add("`cnt_arquivos`.`ARQ_STS`", 1, FuriousExpressionsDB::EQUAL);
		if(!empty($_GET['OnlyImages']))
		{
			$criteria->add("LOWER(`cnt_arquivos`.`ARQ_EXT`)", "('jpg', 'gif', 'jpg', 'jpeg')", FuriousExpressionsDB::IN);
		}
		$criteria->addDescendingOrder("`cnt_arquivos`.`ARQ_DTA`");
		$this->doPagination("ArquivoModel", "itens", $criteria, $vars, 10);
		
		
	}
	public function show($vars  = null)
	{
		if(!empty($_GET['ID'])):
			$criteria = new FuriousSelectCriteria();
			$criteria->add("`cnt_arquivos`.`ARQ_STS`", 1, FuriousExpressionsDB::EQUAL);
			$this->itens = ArquivoModel::getOne(addslashes($_GET['ID']));
			if(!empty($this->itens[0])):
				$this->itens = $this->itens[0];
			endif;
		endif;
	}
	public function edit($vars = null)
	{
		$this->itens = array();
		
		if(!empty($_GET['ID'])):
			$item = ArquivoModel::getOne(addslashes($_GET['ID']));
			if(!empty($item[0])):
				$this->itens = $item;
			endif;
		endif; 
		
		if(!empty($_FILES['images']))
		{
			if(!is_array($_FILES['images']['error']))
			{
				if($_FILES['images']['error'] == UPLOAD_ERR_OK)
				{
					
					$name = Slugfy($_FILES['images']['name']);
					if(Document::createDirIfNotExists(date("Y"), APP_UPLOADS_PATH))
					{
						if(Document::createDirIfNotExists(date("m"), APP_UPLOADS_PATH.(date("Y")."/")))
						{
							if(Document::createDirIfNotExists(date("d"), APP_UPLOADS_PATH.(date("Y")."/".(date("m")."/"))))
							{
								$path = APP_UPLOADS_PATH.(date("Y"))."/".(date("m"))."/".(date("d"))."/".(str_replace(" ", "_", $_FILES['images']['name']));
								if(!Document::hasFile($path))
								{
									if(Document::moveUploadedFile($_FILES["images"]["tmp_name"], $path))
									{
										$arquivo = new Arquivo();
										$arquivo->ARQ_EXT = Document::getFileExtension($_FILES["images"]["name"]);
										$arquivo->ARQ_NOM = str_replace(" ", "_", $_FILES['images']['name']);
										$arquivo->ARQ_DTA = date("Y-m-d H:i:s");
										$arquivo->ARQ_STS = 1;
										$save = $arquivo->save();
										if($save == true)
										{
											$this->itens[] = $arquivo;
										}
									}
								} else {
									$dirPath = APP_UPLOADS_PATH.(date("Y"))."/".(date("m"))."/".(date("d"))."/";
									$fileName = Document::generateFilePrefix(str_replace(" ", "_", $_FILES['images']['name']), $dirPath);
									if($fileName !== false)
									{
										if(Document::moveUploadedFile($_FILES["images"]["tmp_name"], sprintf("%s%s", $dirPath, $fileName)))
										{
											$arquivo = new Arquivo();
											$arquivo->ARQ_EXT = Document::getFileExtension($fileName);
											$arquivo->ARQ_NOM = $fileName;
											$arquivo->ARQ_DTA = date("Y-m-d H:i:s");
											$arquivo->ARQ_STS = 1;
											$save = $arquivo->save();

											if($save == true)
											{
												$this->itens[] = $arquivo;
											}
										}
									}
								}
							}
						}
					}
				}
			} else {
				foreach($_FILES['images']['error'] as $key => $error)
				{
					if($error == UPLOAD_ERR_OK)
					{
					
					
						$name = $_FILES['images']['name'][$key];
						if(Document::createDirIfNotExists(date("Y"), APP_UPLOADS_PATH))
						{
							if(Document::createDirIfNotExists(date("m"), APP_UPLOADS_PATH.(date("Y")."/")))
							{
								if(Document::createDirIfNotExists(date("d"), APP_UPLOADS_PATH.(date("Y")."/".(date("m")."/"))))
								{
									$path = APP_UPLOADS_PATH.(date("Y"))."/".(date("m"))."/".(date("d"))."/".$_FILES['images']['name'][$key];
									if(!Document::hasFile($path))
									{
										if(Document::moveUploadedFile($_FILES["images"]["tmp_name"][$key], $path))
										{
											$arquivo = new Arquivo();
											$arquivo->ARQ_EXT = Document::getFileExtension($_FILES["images"]["name"][$key]);
											$arquivo->ARQ_NOM = $_FILES['images']['name'][$key];
											$arquivo->ARQ_DTA = date("Y-m-d H:i:s");
											$arquivo->ARQ_STS = 1;
											$save = $arquivo->save();
											if($save)
											{
												$this->itens[] = $arquivo;
											}
										}
									} else {
										$dirPath = APP_UPLOADS_PATH.(date("Y"))."/".(date("m"))."/".(date("d"))."/";
										$fileName = Document::generateFilePrefix($_FILES['images']['name'][$key], $dirPath);
										if($fileName !== false)
										{
											if(Document::moveUploadedFile($_FILES["images"]["tmp_name"][$key], sprintf("%s%s", $dirPath, $fileName)))
											{
												$arquivo = new Arquivo();
												$arquivo->ARQ_EXT = Document::getFileExtension($fileName);
												$arquivo->ARQ_NOM = $fileName;
												$arquivo->ARQ_DTA = date("Y-m-d H:i:s");
												$arquivo->ARQ_STS = 1;
												$save = $arquivo->save();
												if($save)
												{
													$this->itens[] = $arquivo;
												}
											}
										}
									}
								}
							}
						}
					}
				}
			}
		}
	}
	public function generateThumbs($vars = null)
	{
		if(!empty($_GET['ID']))
		{
			$criteria = new FuriousSelectCriteria();
			$criteria->add("`cnt_arquivos`.`ARQ_ID`", addslashes($_GET['ID']), FuriousExpressionsDB::EQUAL);
			$criteria->add("`cnt_arquivos`.`ARQ_STS`", 1, FuriousExpressionsDB::EQUAL);
			$files = ArquivoModel::doSelect($criteria);
			if(!empty($files[0]))
			{
				$this->files = $files[0];
				$this->files->generateThumbs();
				
			}
		} else {
			$this->Error404();
		}
	}
	public function upload($vars = null)
	{
		
	}
}
?>