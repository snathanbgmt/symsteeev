$(document).ready(function(){
	$(".check").change(
		function(){
			$(".produit").css("display", "block");
			$(".check").each(function(){
				if (! $(this).is(':checked')) {
					$("." + $(this).attr('value')).css("display", "none");
				}
			});
		});
});