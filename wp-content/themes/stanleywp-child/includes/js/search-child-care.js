jQuery( document ).on( 'click', '.ajax-button', function() {

//alert(search_child_care.ajax_url);
    // var post_id = jQuery(this).data('id');

    var formData = jQuery('#search-child-care-form').serialize();
    //console.log(formValue['fname']);
    jQuery('#search-child-care-results').html("");
    jQuery.ajax({
        url : search_child_care.ajax_url,
        type : 'post',
        data : {
            action : 'search_child_care',
            formData : formData
        },
        done : function( response ) {
            response = jQuery.parseJSON(response);
            //alert(response.mockup);
            jQuery('#search-child-care-results').html(response.mockup);
            render_google_maps();
            initMap(response.map_marker_information);
           // console.log(response.map_marker_information);
        }
    });

    return false;

});

var map;
function initMap(map_marker_information) {
    var myLatLng = {lat: 41.2983782, lng: -72.9376795};
    map = new google.maps.Map(document.getElementById('map'), {
        center: myLatLng,
        zoom: 12
    });

    jQuery.each(map_marker_information,function(key,value){
        //console.log(value);
        var markerLatLng = {lat: Number(value.latLng.lat), lng: Number(value.latLng.lng)};

        var marker = new google.maps.Marker({
            position: markerLatLng,
            map: map,
            title: 'Search Child Care - All Our Kin'
        });


        var infowindow = new google.maps.InfoWindow({
            content: value.markerInformation,
        });

        marker.addListener('click', function() {
            infowindow.open(map, marker);
        });
    });

}


function render_google_maps(){
    jQuery('#search-page-left').css("display", "block");
    jQuery('#search-page-right').removeClass('col-lg-12');
    jQuery('#search-page-right').addClass('col-lg-7');
}

jQuery(document).ready(function($) {
    /*Multiple select*/
    $(function () {
        $('#lang').change(function () {
           // console.log($(this).val());
        }).multipleSelect({
            width: '100%'
        });
    });

});
