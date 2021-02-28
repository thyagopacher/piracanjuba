<?php
class ConfigController extends DefaultBackEnd2Controller
{
	public function words($vars = null)
	{
		$siteID = $this->Site->getPDTID();
		$this->config = ConfigurationsModel::getConfig("blockedWords", $siteID);
		if(!empty($_POST['words']))
		{
			if(empty($this->config))
			{
				$this->config = new Configurations();
				$this->config->name = "blockedWords";
				$this->config->status = 1;
				$this->config->site_id = $siteID;
			}
			$this->config->value = addslashes($_POST['words']);
			if($this->config->save())
			{
				$this->config->generateJSON();
				
				$this->msg = "{Saved Successfully}";
			} else {
				$this->error = "{Save Error, try later}";
			}
		}
	}
	public function akismet($vars = null)
	{
		$siteID = $this->Site->getPDTID();
		$this->config = ConfigurationsModel::getConfig("akismetID", $siteID);
		if(!empty($_POST['akismet_key']))
		{
			$key = $_POST['akismet_key'];
			$akismet = new Akismet($key);
			if(!$akismet->verifyKey())
			{
				$this->error = "{Akismet Key Invalid}";
			}
			
			if(empty($this->config))
			{
				$this->config = new Configurations();
				$this->config->name = "akismetID";
				$this->config->status = 1;
				$this->config->site_id = $siteID;
			}
			$this->config->value = addslashes($_POST['akismet_key']);
			if( empty($this->error) )
			{
				if($this->config->save())
				{
					$this->config->generateJSON();

					$this->msg = "{Saved Successfully}";
				} else {
					$this->error = "{Save Error, try later}";
				}
			}
		}
	}
}
?>