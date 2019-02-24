# MW-Cloudflare
mediawiki的clouflare管理插件

## 已实现功能
    -获取cloudflare服务器列表并在specialpage页面管理
    -删除指定域名全部缓存
    -在页面更新时自动清空缓存
## 配置LocalSettings
    在LocalSettings.php中加入以下代码
    $wgCloudflareEmail = '<your cloudflare email>';
    $wgCloudflareApikey = '<your cloudflare apikey>';
    $wgCloudflareEnableAutoPurge = true; //是否允许自动清空缓存
