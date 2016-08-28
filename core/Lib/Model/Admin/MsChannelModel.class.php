<?php
import('AdvModel');
class MsChannelModel extends AdvModel {
    protected $_validate = array(
        array('name','require','名称必须填写！',1),
    );
}
?>