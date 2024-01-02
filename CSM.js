$(document).ready(function(){
	$('#element_5').change(function(){
		var gross = parseFloat($('#element_5').val());
		var tare = parseFloat($('#element_6').val());
		var net = gross - tare;
		$('#element_7').val(net);
	});
});