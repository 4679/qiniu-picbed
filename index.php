<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=0.5, maximum-scale=0.5, user-scalable=no">
<title>七牛图床</title>
<meta name="Description" content="利用七牛云存储为存储空间的图床。允许上传的图片类型有JPG、JPEG、PNG、GIF、WEBP。"/>
<meta name="Keywords" content="图床,七牛图床"/>
<link rel="shortcut icon" href="data:image/x-icon;base64,R0lGODlhEAAQAPEAAAAAAACE/wAAAAAAACH5BAlkAAIAIf8LTkVUU0NBUEUyLjADAQAAACwAAAAAEAAQAAAC55QkIiIiIoQQQgghhBBCCCEIgiAIQhAIgiAIgiAIgiAIghAEgiAIgiAQCAQCgUAgCAQEAoFAIBAIBAKBQCAQBAICgUAgEAgEAoFAIBAIAgGBQCAQCAQCgUAgEAgEgYBAICAgICAgICAgICAQECAgICAgICAgICAgICAQECAgICAgICAgICAgICAQECAgICAgICAgICAgICAQECAgICAQEBAQEBAgICAQECAgICAgEBAQEBAQICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgQIAAAQIKAAAh+QQJZAACACwAAAAAEAAQAAAC55QkIiIiIoQQQgghhBBCCCEIgiAIQhAIgiAIgiAIgiAIghAEgiAIgiAQCAQCgUAgCAQEAoFAIBAIBAKBQCAQBAICgUAgEAgEAoFAIBAIAgGBQCAQCAQCgUAgEAgEgYBAICAgICAgICAgICAQECAgICAgICAgICAgICAQECAgICAgICAgICAgICAQECAgICAgICAgICAgICAQECAgICAgICAgICAgICAQECAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgQIAAAQIKAAA7" type="image/x-icon">
<link href="css/css.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="w">
  <h1>七牛图床</h1>
  <div class="div">允许上传的图片类型JPG、JPEG、PNG、GIF、WEBP；图片大小10M以内</div>
  <div id="up" class="div">
    <div id="picker">jQuery载入中</div>
  </div>
  <div id="progress" class="div" style="display:none;">
    <div class="progress"></div>
  </div>
  <div id="msg" class="div" style="display:none;"></div>
  <div id="show" style="display:none;">
    <div class="div">
      <div>图片地址&nbsp;&nbsp;<span id="url_info">Ctrl+C 或"右键"复制到剪贴板</span></div>
      <div>
        <input type="text" class="in" value="" id="url" onclick="select();" readonly/>
        <input id="url_QR" type="button" value="二维码"  class="btn" />
      </div>
    </div>
    <div class="div" style="text-align:center;"><span style="display:block;cursor:pointer;font-weight:bold;" onClick="reupload();">再传一张</span></div>
    <div class="div" style="text-align:center;"><img id="pic" src="" border="0" style="max-width:468px;_width:468px;" /></div>
  </div>
  <div class="div">利用七牛云存储为存储空间的免费、开源的图床系统。<br>开源地址：<a href="https://gitcafe.com/longmei/qiniu-picbed" style="color:#08C;" target="_blank">https://github.com/4679/qiniu-picbed</a><br>可以运行于任何PHP平台</div>
</div>
<div id="picqrdiv" style="display:none;">
<div id="qrclose"><img src="/css/close.png" onclick="" alt="点击取消"></div>
<div id="QRinfo"></div>
</div>
<script src="//apps.bdimg.com/libs/jquery/2.0.0/jquery.min.js"></script> 
<script type="text/javascript" src="js/webuploader.html5only.min.js"></script> 
<script type="text/javascript" src="js/upload.js"></script>
<script type="text/javascript" src="//apps.bdimg.com/libs/jquery-qrcode/1.0.0/jquery.qrcode.min.js"></script>
</body>
</html>
