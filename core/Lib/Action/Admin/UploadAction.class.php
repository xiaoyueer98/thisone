<?php
/**
 * @name    上传附件管理模块
 * @package GXCMS.Administrator
 * @link    www.gxcms.com
 */
class UploadAction extends AdminAction{
	// 列表		
    public function show(){
		$this->display('./views/admin/upload.html');
    }
           
	// 上传
	public function upload(){
	    
		echo('<div style="font-size:12px; height:30px; line-height:30px">');
		$uppath   = './'.C('upload_path').'/';
		$uppath_s = './'.C('upload_path').'-s/';
		$mid      = trim($_POST['mid']);
		$fileback = !empty($_POST['fileback']) ? trim($_POST['fileback']) : 'picurl';
		if ($mid) {
			$uppath.= $mid.'/';
			$uppath_s.= $mid.'/';
			$backpath = $mid.'/';
		}
		
		file_put_contents('log.txt', "mid:$mid \n", FILE_APPEND);
		$files = $_FILES;
		$len = count($files);
		$fname = $_FILES['upthumb']['name'];
		$er = $_FILES["upthumb"]["error"];
		file_put_contents('log.txt', "vvvvvvvvvvvv len:$len;er:$er;name:$fname; \n ", FILE_APPEND);
		import("ORG.Net.UploadFile");
		$up = new UploadFile();
		//$up->maxSize = 3292200;
		file_put_contents('log.txt', "upload====== $uppath \n", FILE_APPEND);
		$up->savePath      = $uppath;
		$up->saveRule      = uniqid;
		$up->uploadReplace = true;
		$up->allowExts     = explode(',',C('cms_exts'));
		$up->autoSub       = true;
		$up->subType       = date;
		$up->dateFormat    = C('upload_style');
		file_put_contents('log.txt', "upload====== $up->dateFormat \n", FILE_APPEND);
        if (!$up->upload()) {
            file_put_contents('log.txt', "upload====== 111 \n", FILE_APPEND);
			$error = $up->getErrorMsg();
			if($error == '上传文件类型不允许'){
				$error .= ',可上传<font color=red>'.C('cms_exts').'</font>';
			}
			exit($error.' [<a href="?s=Admin/Upload/Show/mid/'.$mid.'/fileback/'.$fileback.'">重新上传</a>]');
			//dump($up->getErrorMsg());
		}
		file_put_contents('log.txt', "upload====== 222 \n", FILE_APPEND);
		$uploadList = $up->getUploadFileInfo();
		//是否添加水印
		if (C('upload_water')) {
		   import("ORG.Util.Image");
		   Image::water($uppath.$uploadList[0]['savename'],C('upload_water_img'),'',C('upload_water_pct'),C('upload_water_pos'));
		}
		file_put_contents('log.txt', "upload====== 333 \n", FILE_APPEND);
		//是否生成缩略图
		if (C('upload_thumb')) {
		   $thumbdir = substr($uploadList[0]['savename'],0,strrpos($uploadList[0]['savename'], '/'));
		   mkdirss($uppath_s.$thumbdir);
		   import("ORG.Util.Image");
		   Image::thumb($uppath.$uploadList[0]['savename'],$uppath_s.$uploadList[0]['savename'],'',C('upload_thumb_w'),C('upload_thumb_h'),true);
		}
		file_put_contents('log.txt', "upload====== 444 \n", FILE_APPEND);
		//是否远程图片
		if (C('upload_ftp')) {
			$img = D('Down');
			$img->ftp_upload($backpath.$uploadList[0]['savename']);
		}
		file_put_contents('log.txt', "upload====== 555 \n", FILE_APPEND);
		echo "<script type='text/javascript'>parent.document.getElementById('".$fileback."').value='".$backpath.$uploadList[0]['savename']."';</script>";
		echo '文件<a href="'.$uppath.$uploadList[0]['savename'].'" target="_blank"><font color=red>'.$uploadList[0]['savename'].'</font></a>上传成功　[<a href="?s=Admin/Upload/Show/mid/'.$mid.'/fileback/'.$fileback.'">重新上传</a>]';
		echo '</div>';
		file_put_contents('log.txt', "upload====== 666 \n", FILE_APPEND);
	}
	// 本地附件展示
    public function fileshow(){
		$id = $_GET['id'];
		if ($id) {
			$dirup   = substr($id,0,strrpos($id, '*'));
			$dirpath = str_replace('*','/',$id);
		}else{
			$dirpath = './'.C('upload_path');
		}
		if (!strpos($dirpath,trim(C('upload_path')))) {
			$this->error('不在附件文件夹的范围内!');
		}		
		import("ORG.Io.Dir");
		$dir = new Dir($dirpath);
		$dirlist = $dir->toArray();
		if (strpos($dirup,C('upload_path')) > 0){
			$this->assign('dirup',$dirup);
		}
		$this->assign('dir',$dirlist);
		$this->display('./views/admin/upload_fileshow.html');
    }
	// 删除本地附件
    public function filedel(){
		$id = $_GET['id'];
		if ($id) {
			$dirpath = str_replace('*','/',$id);
			@unlink($dirpath);
			@unlink(str_replace(C('upload_path').'/',C('upload_path').'-s/',$dirpath));
			$this->success('删除附件成功！');
		}
    }		

   public function upload_media($url, $data=""){
       $postdata = http_build_query($data);
       $opts = array('http' =>       
           array(       
               'method'  => 'POST',       
               'header'  => 'Content-type: application/x-www-form-urlencoded', 
               'enctype' => 'multipart/form-data',
               'content' => $postdata       
           )       
       );

       $context = stream_context_create($opts);            
       $result = file_get_contents($url, false, $context);      
       return $result;       
   }
}
?>