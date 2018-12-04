$('#type').change(function () {
  switch ($(this).val()) {
    case 'salaried':
      $('#baseSalary').prop("disabled", false);
      $('#hourlySalary').prop("disabled", true);
      $('#comission').prop("disabled", true);
      break;
    case 'comissioned':
      $('#comission').prop("disabled", false);
      $('#hourlySalary').prop("disabled", true);
      $('#baseSalary').prop("disabled", false);
      break;
    case 'hourly':
      $('#hourlySalary').prop("disabled", false);
      $('#baseSalary').prop("disabled", true);
      $('#comission').prop("disabled", true);
      break;
    default:
      break;
  }
});

$('#syndicate').change(function () {
  if ($(this).val() == '1') {
    $('#syndicateTax').prop("disabled", false);
  } else {
    $('#syndicateTax').prop("disabled", true);
  }
});