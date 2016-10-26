jQuery(document).ready(function($) {

    /*Multiple select*/
    $(function () {
        $('#referrer').change(function () {
           // console.log($(this).val());
        }).multipleSelect({
           width: '100%'
        });
    });
    

});