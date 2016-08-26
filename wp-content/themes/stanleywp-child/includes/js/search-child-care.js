jQuery( document ).on( 'click', '.ajax-button', function() {

//alert(search_child_care.ajax_url);
    // var post_id = jQuery(this).data('id');

    var formData = jQuery('#search-child-care-form').serialize();
    //console.log(formValue['fname']);

    jQuery.ajax({
        url : search_child_care.ajax_url,
        type : 'post',
        data : {
            action : 'search_child_care',
            formData : formData
        },
        success : function( response ) {
            jQuery('#search-child-care-results').html(response);
        }
    });

    return false;

});

jQuery(document).ready(function($) {
    /*Multiple select*/
    $(function () {
        $('#lang').change(function () {
            console.log($(this).val());
        }).multipleSelect({
            width: '100%'
        });
    });

});
