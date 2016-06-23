<?php
function Status($dd){
	switch($dd){
		case 0:
		return "激活的状态";
		break;
		case 1:
		return "正常的状态";
		break;
		default:
		return "未知状态";
		break;
	}
}
 ?>