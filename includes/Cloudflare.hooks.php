<?php

require_once __DIR__ . '/../vendor/autoload.php';
class CacheHooks {

    public static function onTitleSquidURLs($title, $urls){
        global $wgCloudflareEmail;
		global $wgCloudflareApikey;
        global $wgCloudflareEnableAutoPurge;

        if($wgCloudflareEnableAutoPurge){
            $key = new Cloudflare\API\Auth\APIKey($wgCloudflareEmail, $wgCloudflareApikey);
            $adapter = new Cloudflare\API\Adapter\Guzzle($key);
            $zones  = new Cloudflare\API\Endpoints\Zones($adapter);
            foreach ( $urls as $url ) {
                $attr = parse_url($url);
                $zoneID = $zones->getZoneID($attr['host']);
                $zones->cachePurge($zoneID, array($url));  
            }
        }
    }

}