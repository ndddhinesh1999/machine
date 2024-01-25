function search_get_branch() {
    var company_id = $('#search_company_id').val();
    $.get('attendance-report-ajax.php?action=get_branch', { company_id: company_id }, function (response) {
        $('#search_branch_id').html(response);
    });
}

$(document).ready(function () {
    $(".datepicker").datepicker({
        inline: true,
        dateFormat: 'dd/mm/yy',
        changeMonth: true,
        changeYear: true,
        yearRange: '-70:+70'
    });
    $('.datatable').DataTable();
});