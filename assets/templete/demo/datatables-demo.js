// Call the dataTables jQuery plugin
$(document).ready(function () {
  $('#dataTable').DataTable();
  $('input[name="ranges"]').daterangepicker();
  $('#mauexport').DataTable({
    dom: 'Bfrtip',
    buttons: [
      'copy', 'csv', 'excel', 'pdf', 'print'
    ]
  });
});
