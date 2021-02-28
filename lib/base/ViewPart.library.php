<?php
class ViewPart {
	private $vars;
	private $autoLoad;
	public function __isset($prop)
	{
		return $this->hasVar($prop);
	}
	public function __set($prop, $value)
	{
		$this->vars[$prop] = $value;
	}
	public function __get($prop)
	{
		if(isset($this->vars[$prop]))
		{
			return $this->vars[$prop];
		}
		return false;
	}
	public function hasVar($prop)
	{
		return isset($this->vars[$prop]);
	}
	public function generateURL($controller, $method, $format = "html")
	{
		return Dispatcher::generateURL($controller, $method, $format);
	}
	public function generateEdtURL($params)
	{
		return Dispatcher::generateEditorialURL($params);
	}
	public function translate($txt, $format)
	{
		$translator = FuriousTranslator::init();
		return $translator->translate($txt, $format);
	}
	public function generateURL2($params)
	{
		$url = "/";
		$i = 1;
		$totParam = count($params);
		foreach($params as $param)
		{
			$url .= $param;
			if($i == ($totParam-1)){
				$url .= ".";
			} else if($i <  ($totParam-1)){
				$url .= "/";
			}
			$i++;
		}
		return $url;
	}
	public function template($path, $format = null)
	{

		try {
			ob_start();
			// Load Template
			if(file_exists($path)){
				include($path);
			} else {
				throw new LayoutException("Layout not Found In: ".$path);
			}
			//
			$html = ob_get_contents();
			ob_end_clean();
			return $this->translate(sprintf("%s\n", $html), $format);
		}
		catch (LayoutException $e)
		{
			echo $e->getMessage();
		}
	}
	public function formatDate($intTime, $format = "d/m/Y H:i")
	{
		return date($format, $intTime);
	}
	public function isUserLogged()
	{
		return Dispatcher::isUserLogged();
	}
	public function includePartial($module, $template)
	{

		$path = APP_PATH_PREFIX."apps/".APP_NAME."/controllers/{$module}/views/_{$template}.html.php";
		if(file_exists($path))
		{
			include($path);
		}
	}
	public function insertBlock($block, $method, $params = null)
	{
		$blName = $block."Block";
		if(!class_exists($blName)){
			$autoloader = Autoloader::init();
			$autoloader->block($block."Block");
		}



		$cont = new $blName();
		$cont->$method($params);



		$path = $this->generateBlockTemplatePath($block, $method);

		$view = new ViewPart();

		foreach(get_object_vars($cont) as $prop => $value)
		{
			$view->$prop = $value;
		}
		echo($view->template($path));
	}
	public function insertWidget($block, $method, $params = null)
	{
			$autoloader = Autoloader::init();
			$autoloader->block($block."Block");
			$blName = $block."Block";
			$cont = new $blName();
			if(method_exists($cont, $method))
			{
				$cont->$method($params);

				$path = $this->generateBlockTemplatePath($block, $method);

				$view = new ViewPart();

				foreach(get_object_vars($cont) as $prop => $value)
				{
					$view->$prop = $value;
				}
				echo($view->template($path));
			}
	}
	private function generateContentLink($type, $date, $tit, $id)
	{
		$url = APP_WEB_PREFIX;
		switch($type)
		{
			case "NT":
				$url .= "noticia";
			break;
			case "VD":
				$url .= "video";
			break;
			case "TD":
				$url .= "testemunhos";
			break;
			case "GA":
				$url .= "galeria";
			break;
			case "CA":
				$url .= "agenda";
			break;
			case "IT":
				$url .= "entrevistas";
			break;
			case "7E":
				$url .= "7-erros";
			break;
			case "TP":
				$url .= "forum";
			break;
		}
		$url .= "/".(date("Y/m/d/", strtotime($date)));
		$url .= (Slugfy(($tit)))."-{$id}.html";
		$url = str_replace("//", "/", $url);
		return $url;
	}
	private function generateUpDownLink($type, $date, $tit, $id, $act = 'UP')
	{
		$url = APP_WEB_PREFIX;
		switch($type)
		{
			case "NT":
				$url .= "noticia";
			break;
			case "VD":
				$url .= "video";
			break;
			case "TD":
				$url .= "testemunhos";
			break;
			case "GA":
				$url .= "galeria";
			break;
			case "CA":
				$url .= "agenda";
			break;
			case "IT":
				$url .= "entrevistas";
			break;
			case "7E":
				$url .= "7-erros";
			break;
			case "TP":
				$url .= "forum";
			break;
			case "MG":
				$url .= "mensagem";
			break;
		}
		$url .= "/".(date("Y/m/d/", strtotime($date)));
		$url .= (Slugfy(utf8_decode($tit)))."-{$id}";

		switch($act)
		{
			case "UP":
				$url .= "/like";
			break;
			case "DOWN":
				$url .= "/unlike";
			break;
		}


		$url = str_replace("//", "/", $url);
		return $url;
	}
	private function generateBlockTemplatePath($block, $method)
	{
		$controllerFolder = str_replace("block", "", strtolower($block));
		$path = APP_PATH_PREFIX."apps/".APP_NAME."/controllers/{$controllerFolder}/views/_{$method}.php";
		return $path;
	}
	public function writeValue($field, $values, $type = "textfield", $value = null)
	{
		if(!empty($values[$field]))
		{
			switch($type)
			{
				case "textarea":
					return ($values[$field]);
				break;
				case "radio":
					return (($values[$field] == $value)?"checked=\"checked\"":"");
				break;
				case "checkbox":
					return (($values[$field] == $value)?"checked=\"checked\"":"");
				break;
				case "option":
					return (($values[$field] == $value)?"selected=\"selected\"":"");
				break;
				default:
					return "value=\"".(htmlentities($values[$field]))."\"";
				break;
			}
		}
	}
	public function writeValue2($field, $values, $type = "textfield", $value = null)
	{
		if(!empty($values[$field]))
		{
			switch($type)
			{
				case "textarea":
					return ($values[$field]);
				break;
				case "radio":
					return (($values[$field] == $value)?"checked=\"checked\"":"");
				break;
				case "checkbox":
					return (($values[$field] == $value)?"checked=\"checked\"":"");
				break;
				case "option":
					return (($values[$field] == $value)?"selected=\"selected\"":"");
				break;
				default:
					return "value=\"".(($values[$field]))."\"";
				break;
			}
		}
	}
	function formatDate2($date)
	{
		$dif = time() - strtotime($date);
		if(floor($dif/2678400) >= 1)
		{
			return floor($dif/2678400) . " {months ago}";
		} else if(floor($dif/604800) >= 1)
		{
			return floor($dif/604800) . " {weeks ago}";
		} else if(floor($dif/86400) >= 1)
		{
			return floor($dif/86400) . " {days ago}";
		} else if(floor($dif/3600) >= 1)
		{
			return floor($dif/3600) . " {hours ago}";
		} else if(floor($dif/60) >= 1)
		{
			return floor($dif/60) . " {minutes ago}";
		} else {
			return floor($dif) . " {secounds ago}";
		}
		return "";
	}

	public function formValues($values, $field, $type = "text", $option = null){
		switch ($type) {
			case 'radio':
					if($option == $values[$field]){
						echo(" selected=\"selected\" ");
					}
			break;
			case 'option':
					if($option == $values[$field]){
						 echo(" selected=\"selected\" ");
					}
			break;
			case 'checkbox':
					if($option == $values[$field]){
						 echo(" checked=\"checked\" ");
					}
			break;
			case 'textarea':
						 echo((!empty($values[$field]))?$values[$field]:"");
			break;
			default:
					 echo((!empty($values[$field]))?" value=\"".$values[$field]."\" ":"");
			break;
		}
	}
	public function cores($link){

		$cores = array(
		"/\/(cidade-alerta)\//i" => "cinza",
		"/\/(marcelo-rezende-gourmet)\//i" => "amarelo",
		"/\/(marcelo-rezende-viaja)\//i" => "bege",
		"/\/(corta-pra-mim)\//i" => "vermelho",
		"/\/(entrevistas)\//i" => "azul",
		"/\/(forum)\//i" => "cinza-escuro",
		"/\/(enquetes)\//i" => "cinza-escuro");

		foreach($cores as $reg => $cls):
			if(preg_match($reg, $link)){
				return ($cls);
			}
		endforeach;
		return "cinza-claro";
	}

	public function cores2($link){

		$cores = array(
		"/\/(cidade-alerta)\//i" => "cz",
		"/\/(marcelo-rezende-gourmet)\//i" => "am",
		"/\/(marcelo-rezende-viaja)\//i" => "bg",
		"/\/(corta-pra-mim)\//i" => "vm",
		"/\/(entrevistas)\//i" => "az",
		"/\/(forum)\//i" => "ce",
		"/\/(enquetes)\//i" => "ce");

		foreach($cores as $reg => $cls):
			if(preg_match($reg, $link)){
				return ($cls);
			}
		endforeach;
	}

	public function logos($link){

		$logos = array(
		"/\/(cidade-alerta)\//i" => "cidade-alerta.png",
		"/\/(marcelo-rezende-gourmet)\//i" => "gourmet.png",
		"/\/(marcelo-rezende-viaja)\//i" => "viaja.png",
		"/\/(corta-pra-mim)\//i" => "corta-pra-mim.png",
		"/\/(entrevistas)\//i" => "entrevista.png",
		"/\/(forum)\//i" => "forum.png");

		foreach($logos as $reg => $imag):
			if(preg_match($reg, $link)){
				return ($imag);
			}
		endforeach;
	}

}
?>
