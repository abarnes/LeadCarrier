/*
 All code copyright 2012 Victoris Holdings, LLC
 
 Copying and/or modification of this code is prohibited.
*/
$(document).ready(function() {
                $.get('/API/form_select.php', function(data) {
                    $('#LeadCarrierForm').html(data);
                    $('#id-replace').val(getURLParameter('id'));
                });
});
            
function getURLParameter(name) {
                return decodeURI(
                    (RegExp(name + '=' + '(.+?)(&|$)').exec(location.search)||[,null])[1]
                );
}