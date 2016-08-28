<?php
import('AdvModel');
class SourcesModel extends AdvModel {
    protected $_validate = array(
        array('name','require','名称必须填写！',1),
        array('size','require','没有大小哦！',1),
    );
}
?>