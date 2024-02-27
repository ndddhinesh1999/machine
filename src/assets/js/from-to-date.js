
var dateFormat = "dd/mm/yy",
  fd = $('#frmdate').val();
td = $('#todate').val();
from = $("#from_date")
  .datepicker({

    changeMonth: true,
    changeYear: true,
    dateFormat: dateFormat,
    minDate: fd,
    maxDate: td,
  })
  .on("change", function() {
    var toMinDate = getDate(this);
    toMinDate.setDate(toMinDate.getDate(fd));
    to.datepicker("option", "minDate", toMinDate);
  }),
  to = $("#to_date").datepicker({

    changeMonth: true,
    changeYear: true,
    dateFormat: dateFormat,
    minDate: fd,
    maxDate: td,

  })
  .on("change", function() {
    var fromMaxDate = getDate(this);
    fromMaxDate.setDate(fromMaxDate.getDate(td));
    from.datepicker("option", "maxDate", fromMaxDate);
  });

function getDate(element) {
  var date;
  try {
    date = $.datepicker.parseDate(dateFormat, element.value);
  } catch (error) {
    date = null;
  }

  return date;
}
