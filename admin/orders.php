<?php require 'helpers/admin_init.php'; ?>
<?php require 'helpers/_orders.php'; ?>

<?php
$pageDetails = [
  'title' => "Adverto Admin"
];

Includes::custom_include('includes/header.php', $pageDetails, true);

?>


<body class="app">
  <header class="app-header fixed-top">
    <?php Includes::custom_include('includes/navbar.php', [], true);    ?>
    <!--//app-header-inner-->
    <?php Includes::custom_include('includes/sidebar.php', [], true);    ?>
    <!--//app-sidepanel-->
  </header>
  <!--//app-header-->

     
    <div class="app-wrapper">
	    
	    <div class="app-content pt-3 p-md-3 p-lg-4">
		    <div class="container-xl">
			    
			    <div class="row g-3 mb-4 align-items-center justify-content-between">
				    <div class="col-auto">
			            <h1 class="app-page-title mb-0">Adverto Orders</h1>
				    </div>
			    </div><!--//row-->
                   <div class="app-card app-card-orders-table shadow-sm mb-5">
						    <div class="app-card-body">
							    <div class="table-responsive">
							        <table class="table app-table-hover mb-0 text-left">
										<thead>
											<tr>
												<th class="cell"></th>
												<th class="cell">Product Title</th>
												<th class="cell">Seller</th>
												<th class="cell">Buyer</th>
												<th class="cell">Amount</th>
												<th class="cell">Status</th>
												<th class="cell">Order Date/Time</th>
												<th class="cell">Action</th>
												<th class="cell"></th>
											</tr>
										</thead>
										<tbody>
									<?php $counter = 1; ?>
									<?php while ($order = mysqli_fetch_assoc($orders)) : ?>
										<tr>
												<td class="cell">#<?php echo $counter++; ?></td>
												<td class="cell"><?php echo getProductById($order['product_id'])['title']; ?></td>

												<td class="cell"><?php echo getUserByEmail($order['seller_id'])['email'] ?></td>
												<td class="cell"><?php echo getUserByEmail($order['buyer_id'])['email'] ?></td>

												<td class="cell">&#8358;<?php echo $order['amount']; ?></td>

												<td class="cell" >
													<span class="btn-sm app-btn-secondary"><?php echo $order['status'] ?></span>
												</td>
												
												<td class="cell">
													<?php echo $order['datetime'] ?>
												</td>
												<td class="cell"><a class="btn-sm app-btn-secondary" href="../product-details.php?ad_id=<?php echo getAdvertByProductId($order['product_id'])['ad_id'] ?>">View</a></td>
											</tr>
									<?php endwhile; ?>
										</tbody>
									</table>
						        </div><!--//table-responsive-->
						       
						    </div><!--//app-card-body-->		
						</div><!--//app-card-->
		    </div><!--//container-fluid-->
	    </div><!--//app-content-->
    </div><!--//app-wrapper-->  
  <!--//app-content-->


  <?php Includes::custom_include('includes/footer.php', [], true);    ?>