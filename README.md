# 注意！
- 本插件目前存在权限bug，某些情况下普通用户可以进入cloudflare的特殊页面。
- 本插件目前存在性能问题，purge请求获得步骤需要改进（由于mediawiki缺乏对应hook，改进可能需要提交至Mediawiki core），purge请求发送步骤可以合并。
- 请帮助改善此插件。
- There is another generalized implment of Cloudflare page purge converter gateway: https://github.com/moegirlwiki/CloudflarePurgeGateway , which seems to perform better under heavy load. 

# 使用该插件自负风险。


# MW-Cloudflare
mediawiki的clouflare管理插件

## 已实现功能
- 获取cloudflare服务器列表并在specialpage页面管理
- 删除指定域名全部缓存
- 在页面更新时自动清空缓存

## 配置插件
```php
    //将文件放入/extensions/Cloudflare并在LocalSettings.php中加入以下代码
    wfLoadExtension('Cloudflare');
    $wgCloudflareEmail = '<your cloudflare email>';
    $wgCloudflareApikey = '<your cloudflare apikey>';
    $wgCloudflareEnableAutoPurge = true; //是否允许自动清空缓存
```
