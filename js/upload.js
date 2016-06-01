var _CalF = { //便捷方法
	$$$: function(id) {
		return document.getElementById(id)
	},
	create: function(id) {
		return document.createElement(id)
	},
	append: function(id) {
		return document.body.appendChild(id)
	},
	remove: function(id) {
		return document.body.removeChild(id)
	}
}
function popup(openID, conID, closeID) {
	this.onclick(openID, conID, closeID);
}
popup.prototype = {
	cssStyle: "width:100%;position:absolute;left:0;top:0;filter:alpha(opacity = 50);opacity:0.5;border:0;overflow:auto;",
	createShadowDiv: function() { //背景遮罩
		var that = this;
		var shadowDiv = _CalF.create("div");
		shadowDiv.id = "shadowDiv";
		shadowDiv.style.cssText = this.cssStyle;
		shadowDiv.style.height = document.body.scrollHeight + "px";
		shadowDiv.style.backgroundColor = "#000";
		shadowDiv.style.zindex = "100";
		shadowDiv.onclick=function(){that.removeDiv();_CalF.$$$(that.conid).style.display="none";};
		_CalF.append(shadowDiv);
	},
	createIframe: function() { //iframe
		var iframe = _CalF.create("iframe");
		iframe.id = "shadowIframe";
		iframe.style.cssText = this.cssStyle;
		iframe.style.height = document.body.scrollHeight + "px";
		iframe.style.zindex = "19";
		_CalF.append(iframe);
	},
	removeDiv: function() {
		_CalF.remove(_CalF.$$$("shadowDiv"));
		_CalF.remove(_CalF.$$$("shadowIframe"));
	},
	onclick: function(openID, conID, closeID) {
		var that = this;
		this.conid=conID;
		_CalF.$$$(openID).onclick = function() {
			$('#QRinfo').html('').qrcode({render:"table",width:300,height:300,correctLevel:0,text:$('#url').val()});
			if (window.ActiveXObject) { //ie6
				if (!window.XMLHttpRequest) {
					document.body.style.cssText = "_background-image: url(about:blank);_background-attachment: fixed;";
				}
			}
			that.createIframe();
			that.createShadowDiv();
			_CalF.$$$(conID).style.display = "block";
		}
		_CalF.$$$(closeID).onclick = function() {
			_CalF.$$$(conID).style.display = "none";
			that.removeDiv();
		}
	}
}
var QRbt = new popup("url_QR","picqrdiv","qrclose");

if ( !WebUploader.Uploader.support() ) {
	$('#up').html('<span style="color:#F00">您的浏览器版本太低，请升级！</span>');
	throw new Error( 'WebUploader does not support the browser you are using.' );
}
var MAXSIZE=2;//最大允许上传2M的图片
// init 
var uploader = WebUploader.create({
	swf: 'js/Uploader.swf',
	server: 'action/upload.php',
	pick: {id:'#picker',multiple:false,innerHTML:'选择图片'},
	accept:{title: '图片文件',extensions: 'gif,jpg,jpge,png',mimeTypes: 'image/*'},
	auto:false,
	fileVal:'upfile',
	compress: false,
	thumb:false
});	
// 队列
uploader.on( 'beforeFileQueued', function( file ) {
	$('#up').slideUp(function(){
		$('#msg').html("正在读取图片信息");
		$('#msg').slideDown(function(){
			// size
			if(file.size>(MAXSIZE*1024*1024)){
				$('#msg').slideUp(function(){
					$('#msg').html("<span style='color:#F00;'>请控制图片大小在"+MAXSIZE+"M以内</span>").slideDown().delay(1500).slideUp(function(){
						$('#up').slideDown();	
					});	
				});
				uploader.reset();
				return false;
			}
			
			var str=file.ext;
			str=str.toLocaleLowerCase();
			if(str!='jpg' && str!='png' && str!='gif' && str!='jpge'){
					$('#msg').slideUp(function(){
							$('#msg').html('<span style="color:#F00;">请上传图片文件</span>').slideDown().delay(1500).slideUp(function(){	$('#up').slideDown();});	
				});
				uploader.reset();
				return false;	
			}
			
			upload();
				
		});	
	});
	
});

function upload(){
	$('#msg').slideUp(function(){
		$('#progress').slideDown(function(){
			uploader.upload();	
		});	
	});
}
// 进度
uploader.on( 'uploadProgress', function( file, percentage ) {
    var $li = $( '#progress .progress');
    $li.css( 'width', percentage * 100 + '%' );
});
// 状态处理
uploader.on( 'uploadSuccess', function( file,ret) {
	var msg=ret._raw;
    //console.log(msg);
	if(msg=='error'){
		$('#progress').slideUp(function(){
			$('#msg').html('<span style="color:#F00;">服务器错误</span>').slideDown().delay(1500).slideUp(function(){
				uploader.reset();
				$('#up').slideDown();
			});	
		});	
	}
	else{
		show(msg);
		$('#progress').slideUp(function(){
			$('#show').slideDown();	
		});	
	}
});

uploader.on( 'uploadError', function( file,code ) {
    //console.log(code);
});


function show(data){
	$('#url').val(data);
	$('#url_info').show();
	$('#pic').attr('src',data);	
}
function reupload(){
 	var $li = $( '#progress .progress');
    $li.css( 'width','0');
	uploader.reset();
	$('#show').slideUp(function(){
		$('#url').val('');
		$('#pic').attr('src','');
		$('#up').slideDown();
	});	
}
