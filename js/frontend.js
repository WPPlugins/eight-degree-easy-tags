jQuery(document).ready(function( $ ) {
//frontend jquery here
	$('.edet-font-data').each(function(){
		var tagColor = $(this).attr('edet-data-color');
		var tagAlignment = $(this).attr('edet-data-alignment');
		var tagWeight = $(this).attr('edet-data-font-weight');
		var tagStyle =$(this).attr('edet-data-font-style');
		var tagTransform=$(this).attr('edet-data-font-transform')
		$(this).closest('.edet-tag-cloud-flat').find('.edetCustomClassSecond').css({
			"text-align" : tagAlignment,
			"font-weight": tagWeight,
			"font-style": tagStyle,
			"text-transform": tagTransform,
		});
	});
	


	



});
















