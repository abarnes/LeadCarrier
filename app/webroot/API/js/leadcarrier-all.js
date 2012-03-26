/*
 All code copyright 2012 Victoris Holdings, LLC
 
 Copying and/or modification of this code is prohibited.
*/
$(document).ready(function() {
                $.get('/API/form_all.php', function(data) {
                    $('#LeadCarrierForm').html(data);
                });
});