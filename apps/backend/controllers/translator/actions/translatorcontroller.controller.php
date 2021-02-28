<?php
class TranslatorController extends DefaultBackEnd2Controller {
  public function index($vars = null){
    $handle = opendir(APP_PATH_PREFIX."/lib/languages/");
    $this->itens = array();
    while(false !== ($file = readdir($handle))){
      if(preg_match("/(.+)\.ko/i", $file)){
        preg_match("/(.+)\.ko/i", $file, $matches);
        $this->itens[] = $matches[1];
      }

    }
    closedir($handle);
  }
  public function novo($vars = null){
    $path = APP_PATH_PREFIX."/lib/languages/".$_GET['item'].".ko";
    if(!empty($_POST['key']) && !empty($_POST['value'])){
      $txt = "";
      foreach($_POST['key'] as $key => $value){
        if(!empty($value)){
          $value = str_replace(array("/"), array("\\/"), $value);
          $txt .= $value."=".$_POST['value'][$key] . "\n";
        }
      }

      $res = Document::writeFile($path, $txt);
      $this->success = true;
    }


    $this->lines = array();
    $contents = @file_get_contents($path);
    if(!empty($contents)){
      $this->lines = explode("\n", $contents);

      foreach($this->lines as $key => $value){
        $data = explode("=", trim($value));
        if(!empty($data[1])){
          $this->lines[$key] = $data;
          $this->lines[$key][0] = str_replace(array("\\\\\\", "\\/"), array("\\\\", "/"), $data[0]);
        }

      }
    }
  }
}

?>
