jQuery(document).ready(function() {

    jQuery("#emailLoginForm").submit(function(e){

        var formData = jQuery('#emailLoginForm').serialize();

        jQuery.ajax({
            url : email_login_form.ajax_url,
            type : 'post',
            data : {
                action : 'email_login_form',
                formData : formData
            },
            success : function( response ) {
                response = jQuery.parseJSON(response);
                console.log(response);
                if(response['user_exists']){

                    user_exists();
                }else{
                    user_no_exists(response['email']);
                }
            }
        });

        //prevent event default
        return false;

    });

});

function user_exists(){
    location.reload();
}

function user_no_exists(email){
    post('/register/', {email: email});
}

function post(path, params, method) {
    method = method || "post"; // Set method to post by default if not specified.

    // The rest of this code assumes you are not using a library.
    // It can be made less wordy if you use one.
    var form = document.createElement("form");
    form.setAttribute("method", method);
    form.setAttribute("action", path);

    for(var key in params) {
        if(params.hasOwnProperty(key)) {
            var hiddenField = document.createElement("input");
            hiddenField.setAttribute("type", "hidden");
            hiddenField.setAttribute("name", key);
            hiddenField.setAttribute("value", params[key]);

            form.appendChild(hiddenField);
        }
    }

    document.body.appendChild(form);
    form.submit();
}