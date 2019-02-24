<?php
namespace Cloudflare;

class SpecialCF extends \SpecialPage {

	public function __construct() {
		parent::__construct('CFConfiguration', 'editinterface');
	}

	public function execute($par) {
		$this->checkPermissions();
		$request = $this->getRequest();
		$output = $this->getOutput();
		$this->setHeaders();

		$output->addModules('ext.cloudflare.cf');
		$output->addHTML('<link rel="stylesheet" href="/extensions/Cloudflare/layui/css/layui.css">');
		$output->addHTML('<script src="/extensions/Cloudflare/layui/layui.js"></script>');
		$output->addHTML('<script src="/extensions/Cloudflare/main.js"></script>');
		$output->addHTML('<i id="loading" class="layui-icon layui-icon-loading-1 layui-icon layui-anim layui-anim-rotate layui-anim-loop"></i>');
		$output->addHTML('<table id="root"></table>');
	}
}
