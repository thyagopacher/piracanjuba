<?php
class Capitulos extends ActiveObject
{
	protected $activeModel = "CapitulosModel";
	protected $FID = "textoid";

	public function getLivroID()
	{
		return $this->returnKey("livroid");
	}
	public function getSigla()
	{
		return $this->returnKey("sigla");
	}
	public function getNome()
	{
		return $this->returnKey("nome");
	}
	public function getInformacao()
	{
		return $this->returnKey("informacao");
	}
	public function getTestamentoID()
	{
		return $this->returnKey("testamentoid");
	}
	public function getCategoriaID()
	{
		return $this->returnKey("categoriaid");
	}
}
?>