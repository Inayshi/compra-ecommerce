<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>

<style>
	 body {
        font-family: 'Poppins', sans-serif;
    }
    .change-link {
		
		border-radius: 20px;
		margin-bottom: 5px;
    }
  </style>
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

	<?php include 'includes/navbar.php'; ?>
	 

		

	  <div class="content-wrapper">
	    <div class="container">

	      <!-- Main content -->
	      <section class="content">
	        <div class="row">
	        	<div class="col-sm-9">
				<h1 class="page-header" style="font-weight: bold; font-size: 24px; font-family: 'Poppins', sans-serif;">Your Cart </h1>
					
				
				<h4 style="font-size: 20px; font-family: 'Poppins', sans-serif;"> Delivery Address: <button class="change-link btn btn-success ml-2" style="border-radius: 20px;" data-toggle="modal" data-target="#addressModal">Change</button> </h4>
					<div class="box box-solid" style="padding: 5px;">    
						<div class="box-body">
						<span id="selectedBuyer" style="font-weight: bold; font-size: 18px; font-family: 'Poppins', sans-serif;"><?php echo $user['firstname'] . ' ' . $user['lastname']; ?></span> <br>
						<span id="selectedContact" style="font-size: 14px; font-family: 'Poppins', sans-serif;"><?php echo (!empty($user['contact_info'])) ? $user['contact_info'] : '<a href="profile.php"> Update Contact Info </a>'; ?></span> <br>
						<span id="selectedAddress" style="font-size: 14px; font-family: 'Poppins', sans-serif;"><?php echo (!empty($user['address'])) ? $user['address'] : 'N/a'; ?></span>

							</div>
					</div>

	        		<div class="box box-solid">
	        			<div class="box-body">
		        		<table class="table table-bordered">
		        			<thead>
		        				<th></th>
		        				<th>Photo</th>
		        				<th>Name</th>
		        				<th>Price</th>
		        				<th width="20%">Quantity</th>
		        				<th>Subtotal</th>
		        			</thead>
		        			<tbody id="tbody">
		        			</tbody>
		        		</table>
	        			</div>
	        		</div>

					
	        		<?php
	        			if(isset($_SESSION['user'])){
	        				echo "<h5 style='font-weight: bold'>Payment Method: </h5>
							<div class='d-flex'>
								<div id='paypal-button'></div>
								<br>
								</div>";
	        			}
	        			else{
	        				echo "
	        					<h4>You need to <a href='login.php'>Login</a> to checkout.</h4>
	        				";
	        			}
	        		?>

					<button type='button' class='btn btn-success ml-2' style='border-radius: 20px;' onclick="completeOrder('Cash on Delivery')">Cash on Delivery</button>

	        	</div>
	        	<div class="col-sm-3">
	        		<?php include 'includes/sidebar.php'; ?>
	        	</div>
	        </div>
	      </section>
	     
	    </div>
	  </div>
  	<?php $pdo->close(); ?>
  	<?php include 'includes/footer.php'; ?>
</div>

<?php include 'includes/scripts.php'; ?>


<script>
var total = 0;
var selectedBuyer = $('#selectedBuyer').text();
var selectedContact = $('#selectedContact').text();
var selectedAddress = $('#selectedAddress').text();

$(function(){
	$(document).on('click', '.cart_delete', function(e){
		e.preventDefault();
		var id = $(this).data('id');
		$.ajax({
			type: 'POST',
			url: 'cart_delete.php',
			data: {id:id},
			dataType: 'json',
			success: function(response){
				if(!response.error){
					getDetails();
					getCart();
					getTotal();
				}
			}
		});
	});

	$(document).on('click', '.minus', function(e){
		e.preventDefault();
		var id = $(this).data('id');
		var qty = $('#qty_'+id).val();
		if(qty>1){
			qty--;
		}
		$('#qty_'+id).val(qty);
		$.ajax({
			type: 'POST',
			url: 'cart_update.php',
			data: {
				id: id,
				qty: qty,
			},
			dataType: 'json',
			success: function(response){
				if(!response.error){
					getDetails();
					getCart();
					getTotal();
				}
			}
		});
	});


	$(document).on('click', '.add', function(e){
		e.preventDefault();
		var id = $(this).data('id');
		var qty = $('#qty_'+id).val();
		qty++;
		$('#qty_'+id).val(qty);
		$.ajax({
			type: 'POST',
			url: 'cart_update.php',
			data: {
				id: id,
				qty: qty,
			},
			dataType: 'json',
			success: function(response){
				if(!response.error){
					getDetails();
					getCart();
					getTotal();
				}
			}
		});
	});

	getDetails();
	getTotal();

	$(document).on('click', '#paypal-button-trigger', function(e){
        e.preventDefault();
        $('#paypalModal').modal('show');
    });

});

function getDetails(){
	$.ajax({
		type: 'POST',
		url: 'cart_details.php',
		dataType: 'json',
		success: function(response){
			$('#tbody').html(response);
			getCart();
		}
	});
}

function getTotal(){
	$.ajax({
		type: 'POST',
		url: 'cart_total.php',
		dataType: 'json',
		success:function(response){
			total = response;
		}
	});
}

function completeOrder(paymentMethod) {
    var selectedBuyer = $('#selectedBuyer').text();
    var selectedContact = $('#selectedContact').text();
    var selectedAddress = $('#selectedAddress').text();

    if (paymentMethod === 'Cash on Delivery') {
        // Update the AJAX call to include the payment method
        $.ajax({
            type: 'POST',
            url: 'sales_cod.php',
            data: {
                pay: 'Cash on Delivery',
                buyer: selectedBuyer,
                contact: selectedContact,
                address: selectedAddress,
                paymentMethod: paymentMethod  // Include the payment method
            },
            success: function(response) {
                // Optionally, you can redirect the user to another page
                window.location = 'profile.php';
            },
            error: function(xhr, status, error) {
                // Handle errors if needed
                console.error(error);
            }
        });
    } 
}


$(document).on('click', '.address-selection', function(e) {
    e.preventDefault();
    var selectedBuyer = $(this).find('.list-group-item-heading').text();
    var selectedContact = $(this).find('.list-group-item-text:first').text();
    var selectedAddress = $(this).data('address');

    $('#selectedBuyer').text(selectedBuyer);
    $('#selectedContact').text(selectedContact);
    $('#selectedAddress').text(selectedAddress);

    $('#addressModal').modal('hide');
});



</script>



<div class="modal fade" id="addressModal">
    <div class="modal-dialog" style="font-family: 'Poppins', sans-serif;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title"><b>Select Delivery Address</b></h4>
            </div>
            <div class="modal-body">
                <!-- List of Delivery Addresses -->
                <div class="list-group">
                    <!-- Default Address -->
                   <a href="#" class="list-group-item address-selection" data-address="<?php echo $user['address']; ?>">
					<h4 class="list-group-item-heading" style="font-weight: bold;"><?php echo $user['firstname'] . ' ' . $user['lastname']; ?></h4>
					<p class="list-group-item-text">
						<?php echo (!empty($user['contact_info'])) ? $user['contact_info'] . '<br>' : ''; ?>
					</p>
					<p>
					<?php echo (!empty($user['address'])) ? $user['address'] : 'N/a'; ?>
					</p>
				</a>

				<?php
				for ($i = 2; $i <= 3; $i++) {
					$buyerKey = 'buyer' . $i;
					$contactInfoKey = 'contact_info' . $i;
					$addressKey = 'address' . $i;

					if (!empty($user[$buyerKey]) && !empty($user[$addressKey])) {
						?>
						<a href="#" class="list-group-item address-selection" data-address="<?php echo $user[$addressKey]; ?>">
							<h4 class="list-group-item-heading" style="font-weight: bold;"><?php echo $user[$buyerKey]; ?></h4>
							<p class="list-group-item-text">
								<?php echo (!empty($user[$contactInfoKey])) ? $user[$contactInfoKey] . '<br>' : ''; ?>
								
							</p>
							<p>
							<?php echo $user[$addressKey]; ?>
							</p>
						</a>
						<?php
					}
				}
				?>

				<h5 style="padding: 20px; text-align: center;"> You can add two (2) additional delivery addresses. Edit <a href="profile.php"> profile </a> to update or add. </h5>

                 
                </div>
            </div>
        </div>
    </div>
</div>

                 
					
                </div>
					

					
                </div>
				
            </div>
			
        </div>
		
    </div>
	
</div>


<!-- Paypal Express -->
<script>
 paypal.Button.render({
        env: 'sandbox', // change for production if app is live,
        client: {
            sandbox: 'AazrxFJ12JmlcbgqOmF25eFhKtqqfnplheq9f-y6jKrK3in4lGuKToHkEYDM_pYxdZjJDz6wZZbap43W',
            // production: 'AaBHKJFEej4V6yaArjzSx9cuf-UYesQYKqynQVCdBlKuZKawDDzFyuQdidPOBSGEhWaNQnnvfzuFB9SM'
        },
        commit: true,
        style: {
            color: 'gold',
            size: 'small'
        },
        payment: function(data, actions) {
            return actions.payment.create({
                payment: {
                    transactions: [
                        {
                            amount: { 
                                total: total, 
                                currency: 'PHP' 
                            }
                        }
                    ]
                }
            });
        }, 
        onAuthorize: function(data, actions) {

			var selectedBuyer = $('#selectedBuyer').text();
			var selectedContact = $('#selectedContact').text();
			var selectedAddress = $('#selectedAddress').text();

            return actions.payment.execute().then(function(payment) {
                var redirectUrl = 'sales.php?pay=' + payment.id +
                    '&buyer=' + encodeURIComponent(selectedBuyer) +
                    '&contact=' + encodeURIComponent(selectedContact) +
                    '&address=' + encodeURIComponent(selectedAddress);

                window.location = redirectUrl;
            });
        },
}, '#paypal-button');
</script>

</body>
</html>