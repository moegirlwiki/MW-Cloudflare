<?php

require_once __DIR__ . '/../vendor/autoload.php';
class APICloudFlare extends ApiBase {
	private $adapter;

	protected function getAllowedParams() {
        return [
			'type' => [
				ApiBase::PARAM_TYPE => 'string',
				ApiBase::PARAM_REQUIRED => true,
			],
			'zoneid' => [
				ApiBase::PARAM_TYPE => 'string',
			],
        ];
    }
	public function execute() {
		global $wgCloudflareEmail;
		global $wgCloudflareApikey;

		$params = $this->extractRequestParams();
		if(isset($params['type']) && isset($wgCloudflareEmail) && isset($wgCloudflareApikey)){
			$key = new Cloudflare\API\Auth\APIKey($wgCloudflareEmail, $wgCloudflareApikey);
			$this->adapter = new Cloudflare\API\Adapter\Guzzle($key);
			//$user    = new Cloudflare\API\Endpoints\User($adapter);
			switch($params['type']){
				case 'listZones':
					$this->listZones();
					break;
				case 'purgeCache':
					if(isset($params['zoneid'])){
						$this->purgeCache($params['zoneid']);
					}
					break;
			}
		}
		
	}

	public function listZones(){
		$zones  = new Cloudflare\API\Endpoints\Zones($this->adapter);
		$html = $zones->listZones();
		//$this->getResult()->addContentValue(null,'html', $html);
		$this->getResult()->addValue(null, 'cf', $html);
	}

	public function purgeCache($zoneID){
		$zones  = new Cloudflare\API\Endpoints\Zones($this->adapter);
	 	$html = $zones->cachePurgeEverything($zoneID);
		$this->getResult()->addValue(null, 'cf', $html);
	}
}