<?php
class WidgetsController extends DefaultController {
	public function avalie($vars = null)
	{
		if(!empty($vars['VARS']['ID']))
		{
			$id = addslashes($vars['VARS']['ID']);
			$nota = addslashes((int)$_GET['stars']);
			$nota = max(0, $nota);
			$nota = min(5, $nota);
			
			
			$sql = "UPDATE `cnt_conteudo` SET `cnt_conteudo`.`CNT_VOT` = `cnt_conteudo`.`CNT_VOT`+1, `cnt_conteudo`.`CNT_NOT` = `cnt_conteudo`.`CNT_NOT`+".$nota." WHERE `cnt_conteudo`.`CNT_ID` = {$id}";
			
			$db = Database2::getDB();
		
			if($db->query($sql))
			{
				$cnt = NoticiaModel::getOne($id);
				if(!empty($cnt[0]))
				{
					$cnt = $cnt[0];
				}
				$this->content = $cnt;
				$cnt->generateJsonLists();
				$cnt->generateJSON();
			}
		}
	}
}
?>