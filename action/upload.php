<?php
    header("Content-Type:text/html;charset=utf-8");
    error_reporting(0);
    date_default_timezone_set("Asia/chongqing");	
	include "Uploader.class.php";
  include "qiniu/rs.php";
	include "qiniu/io.php";
	
	include "config.php";
	
	if($bucket&&$QINIU_ACCESS_KEY&&$QINIU_SECRET_KEY){
		try {
			$tmpFileID=date("YmdHis").rand(100,999);
			
			$thisfile=$_FILES[ "upfile" ][ 'tmp_name' ];
			$filedata = fopen($thisfile, 'rb');
			$filename=$_FILES[ "upfile" ]["name"];
			$filesize=$_FILES['upfile']['size'] ;
			$filetype=pathinfo($filename, PATHINFO_EXTENSION);
			
			$newname=md5_file($thisfile) .'.'.$filetype;
			$newfileurl=getFolder() .'/'.$newname;
			
			if(defined('SAE_TMP_PATH')){
				$tmpfile=SAE_TMP_PATH . 'mycode'.$tmpFileID.'.'.$filetype;
				file_put_contents( $tmpfile , $filedata );
				$thisfile=$tmpfile;
			}
			Qiniu_SetKeys($QINIU_ACCESS_KEY, $QINIU_SECRET_KEY);
			$putPolicy = new Qiniu_RS_PutPolicy($bucket);
			$upToken = $putPolicy->Token(null);
			$putExtra = new Qiniu_PutExtra();
			$putExtra->Crc32 = 1;
			list($ret, $err) = Qiniu_PutFile($upToken, $newfileurl, $thisfile, $putExtra);
			echo "$QINIU_URL".$newfileurl;
		}
		catch(Exception $e) {
			echo $e->getCode();
			echo $e->getMessage();
		}
	}else{
		//上传配置
		$config = array(
			"savePath" => "/upload/" ,             //存储文件夹
			"maxSize" => 10000 ,                   //允许的文件最大尺寸，单位KB
			"allowFiles" => array( ".gif" , ".png" , ".jpg" , ".jpeg" , ".bmp" , ".webp" )  //允许的文件格式
		);
		//上传文件目录
		$Path = "upload/";
	
		//背景保存在临时目录中
		$config[ "savePath" ] = $Path;
		$up = new Uploader( "upfile" , $config );
		$type = $_REQUEST['type'];
		$callback=$_GET['callback'];
	
		$info = $up->getFileInfo();
		/**
		 * 返回数据
		 */
		if($callback) {
			echo 'error';
		} else {
			echo $mySiteDomain.$Path.$info['url'];
		}
	}
	
	function getFolder()
    {
        $pathStr = 'upload';
        //if ( strrchr( $pathStr , "/" ) != "/" ) {
        //    $pathStr .= "/";
        //}
        //$pathStr .= date( "Ymd" );
        return $pathStr;
    }
	function getName()
    {
        return time() . rand( 1 , 10000 );
    }
