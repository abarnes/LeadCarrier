$(document).ready(function() {
                $.get('/API/form_info.php', function(data) {
                    $('#LeadCarrierForm').html(data);
                });
});