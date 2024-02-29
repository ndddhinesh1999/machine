$(document).ready(function () {
    $(".datepicker").datepicker({
        inline: true,
        dateFormat: 'dd/mm/yy',
        changeMonth: true,
        changeYear: true,
        yearRange: '-70:+70'
    });
});