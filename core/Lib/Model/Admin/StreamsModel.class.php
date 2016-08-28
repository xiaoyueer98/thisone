<?php 
import('AdvModel');
class StreamsModel extends AdvModel {
	protected $_validate=array(
	    array('name','require','名字不能为空！',1,'',3),
	//	array('playurl[]','require','播放地址必须填写！',1,'',3),
	);
}
?>