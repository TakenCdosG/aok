var zipCodeLatLng = {};

jQuery( document ).on( 'click', '.ajax-button', function() {


    var formData = jQuery('#search-child-care-form').serialize();
    var zip_code = jQuery('#zip_code').val();

    if(zip_code == ''){
        zip_code = '06510';
    }
    jQuery('#search-child-care-results').html("");

    jQuery.get( "https://maps.googleapis.com/maps/api/geocode/json", { address : zip_code, key : 'AIzaSyD8gQGcG1dHoyC_99gy-Vvus4XAXHCN2oE'} )
        .done(function( data ) {
             zipCodeLatLng = {lat: data.results[0].geometry.location.lat, lng: data.results[0].geometry.location.lng};
           // console.log(zipCodeLatLng);
            jQuery.ajax({
                url : search_child_care.ajax_url,
                type : 'post',
                data : {
                    action : 'search_child_care',
                    formData : formData,
                    zipCodeLatLng : zipCodeLatLng
                },
                success : function( response ) {
                    response = jQuery.parseJSON(response);
                    //alert(response.mockup);
                    jQuery('#search-child-care-results').html(response.mockup);
                    jQuery('#count-results .col-lg-12').html(response.message);
                    render_google_maps();
                    initMap(response.map_marker_information);
                }
            });
        });




    return false;

});

var map;

function initMap(map_marker_information) {

    map = new google.maps.Map(document.getElementById('map'), {
        center: zipCodeLatLng,
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
    jQuery('#search-page-right').removeClass('col-lg-12').addClass('col-lg-7');
}

jQuery(document).ready(function($) {

    if($_POST["from_home"] == "from_home"){
        jQuery('.ajax-button').trigger('click');
    }

    /*Multiple select*/
    $(function () {
        $('#lang').change(function () {
           // console.log($(this).val());
        }).multipleSelect({
            width: '100%'
        });
        $('#age').change(function () {
           // console.log($(this).val());
        }).multipleSelect({
           width: '100%'
        });
    });

});
