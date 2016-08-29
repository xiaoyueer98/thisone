$(document).ready(function(){
	$("#username").mouseenter(function(){
		$(".head_con .head_list").show();
	});
	$("#username").mouseleave(function(){
		$(".head_con .head_list").hide();
	});
})