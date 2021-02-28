<?php
if(!function_exists('get_called_class')) {
 function get_called_class($debug = false) {
    $bt = debug_backtrace();
	if($bt[1]['function'] == "doSelect" && $bt[2]['function'] == "doPaginatedSelect")
	{
		foreach($bt[3]['args'] as $arg){
			preg_match("/([a-z0-9]+)::([a-z0-9_]+)/i", $arg, $matches);
			if($matches[2] == "doPaginatedSelect"){
				return $matches[1];
			}
		}
	} else if($bt[1]['function'] == "doSelect" && $bt[2]['function'] != "doPaginatedSelect"){
		return $bt[2]['object']->getActiveModel();
	}
  }
}
if(!function_exists("validaCPF")){
  function validaCPF($cpf = null) {

    // Verifica se um nÃºmero foi informado
    if(empty($cpf)) {
        return false;
    }

    // Elimina possivel mascara
    $cpf = preg_replace('/[^0-9]/', '', $cpf);
    $cpf = str_pad($cpf, 11, '0', STR_PAD_LEFT);

    // Verifica se o numero de digitos informados Ã© igual a 11
    if (strlen($cpf) != 11) {
        return false;
    }
    // Verifica se nenhuma das sequÃªncias invalidas abaixo
    // foi digitada. Caso afirmativo, retorna falso
    else if ($cpf == '00000000000' ||
        $cpf == '11111111111' ||
        $cpf == '22222222222' ||
        $cpf == '33333333333' ||
        $cpf == '44444444444' ||
        $cpf == '55555555555' ||
        $cpf == '66666666666' ||
        $cpf == '77777777777' ||
        $cpf == '88888888888' ||
        $cpf == '99999999999') {
        return false;
     // Calcula os digitos verificadores para verificar se o
     // CPF Ã© vÃ¡lido
     } else {

        for ($t = 9; $t < 11; $t++) {

            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf{$c} * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf{$c} != $d) {
                return false;
            }
        }

        return true;
    }
}
}
if(!function_exists('wave_area'))
{
	function wave_area($img, $x, $y, $width, $height, $amplitude = 10, $period = 10){
	    // Make a copy of the image twice the size
	    $height2 = $height * 2;
	    $width2 = $width * 2;
	    $img2 = imagecreatetruecolor($width2, $height2);
	    imagecopyresampled($img2, $img, 0, 0, $x, $y, $width2, $height2, $width, $height);
	    if($period == 0) $period = 1;
	    // Wave it
	    for($i = 0; $i < ($width2); $i += 2){
			imagecopy($img2, $img2, $x + $i - 2, $y + sin($i / $period) * $amplitude, $x + $i, $y, 2, $height2);
		}
	    // Resample it down again
	    imagecopyresampled($img, $img2, $x, $y, 0, 0, ($width+2), $height, $width2, $height2);
	    imagedestroy($img2);
	}
}


if(!function_exists('Slugfy'))
{
	function Slugfy($string)
	{
		$chars = array(
      " " => "-",
  			"_" => "-",
  			"." => "-",
  			"," => "",
  			"/" => "",
  			"á" => "a",
  			"ã" => "a",
  			"â" => "a",
  			"à" => "a",
  			"ä" => "a",
  			"ê" => "e",
  			"ë" => "e",
  			"é" => "e",
  			"è" => "e",
  			"í" => "i",
  			"î" => "i",
  			"ì" => "i",
  			"ï" => "i",
  			"ó" => "o",
  			"õ" => "o",
  			"ò" => "o",
  			"ö" => "o",
  			"ô" => "o",
  			"ú" => "u",
  			"û" => "u",
  			"ù" => "u",
  			"ü" => "u",
  			"ç" => "c",
  			"\"" => "",
  			"\'" => "",
  			"?" => ""
		);
		$newStr = str_replace(array_keys($chars), array_values($chars), strtolower($string));
		return $newStr;
	}
}
if(!function_exists('Slugfy2'))
{
	function Slugfy2($string)
	{
		return strtolower(preg_replace('/[^a-zA-Z0-9]/i', '-', $string));
	}
}
if(!function_exists("renderArrayOption"))
{
	function renderArrayOption($item = null, $TabIndex = 0, $writeParent = true)
	{
		$itens = array();
		$tabs = "";
		if($writeParent != true)
		{
			$TabIndex--;
		}
		for($i=0; $i<$TabIndex; $i++){
			$tabs .= "&nbsp;&nbsp;&nbsp;&nbsp;";
		}
		if($writeParent == true)
		{
			$itens[$item->getId()] = $tabs . $item->getName();
		}
		if(method_exists($item, "hasChildren"))
		{
			if($item->hasChildren())
			{

				$itn = $item->getChildren();
				foreach($itn as $child){
					$itn2 = renderArrayOption($child, ($TabIndex+1));
					$itens = $itens + $itn2;
				}


			}
		}
		return $itens;
	}
}
if(!function_exists("renderArraySubmenu"))
{
	function renderArraySubmenu($item = null, $TabIndex = 0)
	{
		$itens = array();
		$tabs = "";
		for($i=0; $i<$TabIndex; $i++){
			$tabs .= "&nbsp;&nbsp;&nbsp;&nbsp;";
		}

		$itens[$item->getId()] = $tabs . $item->getName();

		if($item->hasChildren())
		{

			$itn = $item->getChildren();
			foreach($itn as $child){
				$itn2 = renderArraySubmenu($child, ($TabIndex+1));
				$itens = $itens + $itn2;
			}


		}

		return $itens;
	}
}

?>
