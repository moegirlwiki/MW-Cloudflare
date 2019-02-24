document.write('<script type="text/html" id="bara"><button class="layui-btn layui-btn-xs" onclick="cachePurge(this)" name="{{d.name}}" id="purge" zone="{{d.id}}" lay-event="edit">清空缓存</button></script>')
layui.use(['table', 'layer'], function(){
  var table = layui.table, layer = layui.layer, $ = layui.jquery;
	$.ajax({
		url: "/api.php?action=cloudflare_proxy&type=listZones&format=json",
		beforeSend: function(){
			layer.msg("载入中...")
		},
		success: function (data) {
			$("#loading").attr("style","display:none")
			table.render({
				elem: '#root'
				,cols: [[ //标题栏
				  {field: 'name', title: '域名', width: 160, sort: true}
				  ,{field: 'status', title: '状态', width: 100}
				  ,{fixed: 'right', title:'操作', toolbar: '#bara', width:120}
				]]
				,data: data.cf.result
				//,skin: 'line' //表格风格
				,even: true
				//,page: true //是否显示分页
				//,limits: [5, 7, 10]
				//,limit: 5 //每页默认显示的数量
			  });
		},
		error: function (data) {
			layer.msg("载入失败")
		}
	});
	window.cachePurge = function (a){
		layer.msg("666")
		layer.open({
			content: '确定要清空' + $(a).attr("name") + '的缓存吗？'
			,btn: ['确定', '取消']
			,yes: function(){
				$.ajax({
					url: "/api.php?action=cloudflare_proxy&type=purgeCache&zoneid=" +  $(a).attr("zone") + "&format=json",
					beforeSend: function(){
						layer.msg("正在清空...")
					},
					success: function (data) {
						console.log("清空",data)
						layer.msg("已执行清空，约半小时后生效")
					},
					error: function (data) {
						layer.msg("清空缓存失败")
					}
				})
			}
		});
		
	}
});