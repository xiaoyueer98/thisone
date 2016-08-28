<?php

   $action = $_REQUEST['action'];
   switch ($action){
      case "check_login";
        check($inter_check);
      break;
      case "create_live";
           $result=check_login();
           if($result==false){
              $res=urldecode("请先登录！");
              exit(json_encode($res));
           }

           $c = M('Channel');
           $id = $_POST['id'];
           $tid = $_POST['tid'];
           $actor=$_POST['actor'];
           $title=$_POST['title'];
           $cdescription=$_POST['content'];
           $inputer=$_POST['inputer'];
           $_POST['level'] = $_POST['userlevel'];
           $_POST['ctype'] = "live";
   }
?>
