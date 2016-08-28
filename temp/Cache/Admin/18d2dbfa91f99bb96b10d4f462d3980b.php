<?php if (!defined('THINK_PATH')) exit();?><?php if(is_array($channel_list)): $i = 0; $__LIST__ = $channel_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ch): ++$i;$mod = ($i % 2 )?><?php
		$str = '';
		if($mcid == $ch['id']){
            $str = "checked='true'";
		}
	?>
	<input type="radio" name="channel_mcid"  <?php echo ($str); ?> value="<?php echo ($ch['id']); ?>" onchange="changeChl(this.value)"/><?php echo ($ch['cname']); ?>
	<input type="hidden" name="nmcid" id="nmcid" value="<?php echo ($mcid); ?>"><?php endforeach; endif; else: echo "" ;endif; ?>