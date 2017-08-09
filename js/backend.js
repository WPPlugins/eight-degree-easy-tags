    jQuery(document).ready(function($){//backend jquery here
    	$('.edet-color-field').wpColorPicker();
    	$('.edet-toggle-field').prev().data('is_visible', true);
        $('.edettogglelink').click(function() {
        	$(this).data('edet_visible', !$(this).data('edet_visible'));
        	$(this).parent().next('.edet-toggle-field').slideToggle();
        	$(this).children().toggleClass('edet-menu-open');

        	return false;
        });

        $('.edet-taxonomy').hide();  
        $(".edet-taxonomy-select").each(function () {
         var name = $(this).attr("id");
         if ($("[id=" + name + "]:checked").length == 1) {
            var sel = $(this).attr( 'id');
            $('.edet-taxonomy').hide();
            $('.' + sel).show();
        }
        });    

        $('body').on('change','.edet-options-select',function() {

            var selVal = $(this).val( );
            $('.edet-taxonomy').hide();
            $('.' + selVal).show();
            
        });

        $('body').on('change','.edet-template-change',function(){
            var thisVal=$(this).val();
            $('.edet-tag-cloud-wrapper').attr('class','edet-tag-cloud-wrapper');
            $('.edet-tag-cloud-wrapper').addClass(thisVal);
        });


    });