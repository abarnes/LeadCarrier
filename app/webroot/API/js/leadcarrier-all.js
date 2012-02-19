$(document).ready(function() {
                $.get('/API/form_all.php', function(data) {
                    $('#LeadCarrierForm').html(data);
                });
});