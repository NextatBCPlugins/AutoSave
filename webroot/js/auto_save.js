$(document).ready( function() {
	$("#countUp").click(function(){
		if(parseInt($("#countval").val()) < 300){
			$("#countval").val(parseInt($("#countval").val()) + 10);
		}
	});
	$("#countDown").click(function(){
		if(parseInt($("#countval").val()) > 30){
			$("#countval").val(parseInt($("#countval").val()) - 10);
		}
	});
});