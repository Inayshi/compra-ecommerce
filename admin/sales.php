<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Sales History
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Sales</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header with-border">
              <div class="pull-right">
                <form method="POST" class="form-inline" action="sales_print.php">
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right col-sm-8" id="reservation" name="date_range">
                  </div>
                  <button type="submit" class="btn btn-success btn-sm btn-flat" name="print"><span class="glyphicon glyphicon-print"></span> Print</button>
                </form>
              </div>
            </div>

            <!-- Status Filter  -->
            <div class="form-group" style="margin-left: 2%; width: 30%;">
            <label for="statusFilter">Filter by Status:</label>
            <select class="form-control" id="statusFilter">
                <option value="all">All</option>
                <option value="In Progress">In Progress</option>
                <option value="Delivered">Delivered</option>
                <option value="--">--</option>
            </select>
            </div>

            <script>

           
            </script>

            <!-- End of Status Filter -->

            <div class="box-body">
              <table id="example1" class="table table-bordered">
                <thead>
                  <th class="hidden"></th>
                  <th>Date</th>
                  <th>Buyer Name</th>
                  <th>Transaction#</th>
                  <th>Amount</th>
                  <th>Full Details</th>
                  <th>Status</th>
                </thead>
                <tbody>
                <?php
    $conn = $pdo->open();

    try{
      $stmt = $conn->prepare("SELECT *, sales.id AS salesid FROM sales LEFT JOIN users ON users.id=sales.user_id ORDER BY sales_date DESC");
      $stmt->execute();
      foreach($stmt as $row){
        $stmt_details = $conn->prepare("SELECT * FROM details LEFT JOIN products ON products.id=details.product_id WHERE details.sales_id=:id");
        $stmt_details->execute(['id'=>$row['salesid']]);
        $total = 0;
        foreach($stmt_details as $details){
          $subtotal = $details['price']*$details['quantity'];
          $total += $subtotal;
        }
        echo "
          <tr>
            <td class='hidden'></td>
            <td>".date('M d, Y', strtotime($row['sales_date']))."</td>
            <td>".$row['firstname'].' '.$row['lastname']."</td>
            <td>".$row['pay_id']."</td>
            <td>₱ ".number_format($total, 2)."</td>
            <td><button type='button' class='btn btn-info btn-sm btn-flat transact' data-id='".$row['salesid']."'><i class='fa fa-search'></i> View</button></td>
             <td>
              <select class='form-control action-select' data-id='".$row['salesid']."'>
                <option> -- </option>
                <option value='In Progress'".(($row['sales_status'] == 'In Progress') ? ' selected' : '').">In Progress</option>
                <option value='Delivered'".(($row['sales_status'] == 'Delivered') ? ' selected' : '').">Delivered</option>
              </select>
            </td>
          </tr>
        ";
      }
    }
    catch(PDOException $e){
      echo $e->getMessage();
    }

    $pdo->close();
  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>
     
  </div>
  
    <?php include '../includes/profile_modal.php'; ?>

</div>
<!-- ./wrapper -->

<?php include 'includes/scripts.php'; ?>
<!-- Date Picker -->
<script>
$(function(){
  //Date picker
  $('#datepicker_add').datepicker({
    autoclose: true,
    format: 'yyyy-mm-dd'
  })
  $('#datepicker_edit').datepicker({
    autoclose: true,
    format: 'yyyy-mm-dd'
  })

  //Timepicker
  $('.timepicker').timepicker({
    showInputs: false
  })

  //Date range picker
  $('#reservation').daterangepicker()
  //Date range picker with time picker
  $('#reservationtime').daterangepicker({ timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A' })
  //Date range as a button
  $('#daterange-btn').daterangepicker(
    {
      ranges   : {
        'Today'       : [moment(), moment()],
        'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
        'This Month'  : [moment().startOf('month'), moment().endOf('month')],
        'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
      },
      startDate: moment().subtract(29, 'days'),
      endDate  : moment()
    },
    function (start, end) {
      $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
    }
  )
  
  $(document).on('change', '.action-select', function(){
    var id = $(this).data('id');
    var status = $(this).val();
   

    $.ajax({
      type: 'POST',
      url: 'update_action.php', 
      data: {id: id, sales_status: status},
      success: function(response){  
      }
    });
  });
});

</script>
<script>

$(function(){
                $('#statusFilter').change(function() {
                    var selectedStatus = $(this).val().toLowerCase();
                    if (selectedStatus === 'all') {
                        // Show all rows if 'All' is selected
                        $('#example1 tbody tr').show();
                    } else {
                        // Hide all rows, then show only the selected status
                        $('#example1 tbody tr').hide();
                        $('#example1 tbody tr').filter(function() {
                            return $(this).find('select.action-select').val().toLowerCase() === selectedStatus;
                        }).show();
                    }
                });
            });
            
$(function(){
  $(document).on('click', '.transact', function(e){
    e.preventDefault();
    $('#transaction').modal('show');
    var id = $(this).data('id');
    $.ajax({
      type: 'POST',
      url: 'transact.php',
      data: {id:id},
      dataType: 'json',
      success: function(response) {
        $('#date').html(response.date);
        $('#sales_status').html(response.sales_status);
        $('#sales_recipient').html(response.sales_recipient);
				$('#sales_contact_info').html(response.sales_contact_info);
				$('#sales_address').html(response.sales_address);
				$('#pay_method').html(response.pay_method);
        $('#transid').html(response.transaction);
        $('#detail').prepend(response.list);
        $('#total').html(response.total);
    }


  
    });
  });

  $("#transaction").on("hidden.bs.modal", function () {
      $('.prepend_items').remove();
  });
});
</script>
</body>
</html>
