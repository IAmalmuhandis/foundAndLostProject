<?php require 'helpers/admin_init.php'; ?>
<?php require 'helpers/_manage_adverts.php'; ?>

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
			            <h1 class="app-page-title mb-0">All Adverts</h1>
				    </div>
			    </div><!--//row-->
			   
			    
			    <nav id="orders-table-tab" class="orders-table-tab app-nav-tabs nav shadow-sm flex-column flex-sm-row mb-4">
				    <a class="flex-sm-fill text-sm-center nav-link active" id="orders-all-tab" data-bs-toggle="tab" href="#orders-all" role="tab" aria-controls="orders-all" aria-selected="true">All</a>
				    <a class="flex-sm-fill text-sm-center nav-link"  id="orders-paid-tab" data-bs-toggle="tab" href="#orders-paid" role="tab" aria-controls="orders-paid" aria-selected="false">Accepted</a>
				    <a class="flex-sm-fill text-sm-center nav-link" id="orders-pending-tab" data-bs-toggle="tab" href="#orders-pending" role="tab" aria-controls="orders-pending" aria-selected="false">Pending</a>
				    <a class="flex-sm-fill text-sm-center nav-link" id="orders-cancelled-tab" data-bs-toggle="tab" href="#orders-cancelled" role="tab" aria-controls="orders-cancelled" aria-selected="false">Declined</a>
				</nav>
				
				
				<div class="tab-content" id="orders-table-tab-content">
			        <div class="tab-pane fade show active" id="orders-all" role="tabpanel" aria-labelledby="orders-all-tab">
					    <div class="app-card app-card-orders-table shadow-sm mb-5">
						    <div class="app-card-body">
							    <div class="table-responsive">
							        <table class="table app-table-hover mb-0 text-left">
										<thead>
											<tr>
												<th class="cell">Order</th>
												<th class="cell">Product Title</th>
												<th class="cell">Publisher</th>
												<th class="cell">Status</th>
												<th class="cell">AD Price</th>
												<th class="cell">Action</th>
											</tr>
										</thead>
										<tbody>
								<?php while($allAdverts = mysqli_fetch_assoc($all_adverts)): ?>
											<tr>
												<td class="cell"><?php echo $allAdverts['ad_id'] ?></td>
												<td class="cell">
													<span class="truncate">
														<?php echo getProductById($allAdverts['product_id'])['title'] ?>
													</span></td>
												<td class="cell">
													<?php echo getUserByEmail($allAdverts['owner'])['email'] ?>
												</td>
												<td class="cell">
													<span class="badge <?php 
												if ($allAdverts['status'] == "Accepted") {
															echo "bg-success";
												}else if($allAdverts['status'] == "In Review"){
													echo "bg-warning";
														}else {
															echo "bg-danger";
														}
													?>">
													<?php echo $allAdverts['status'] ?>
												</span>
											
											
											</td>
												<td class="cell">&#8358;<?php echo $allAdverts['advert_price'] ?></td>

												<td class="cell">
													<a class="btn-sm app-btn-secondary" href="?delete=<?php echo $allAdverts['ad_id'];?>">Close Advert</a>
												</td>
											</tr>
								<?php endwhile; ?>
										</tbody>
									</table>
						        </div><!--//table-responsive-->
						       
						    </div><!--//app-card-body-->		
						</div><!--//app-card-->
			        </div><!--//tab-pane-->
				</div><!--//tab-content-->
				
				
			    
		    </div><!--//container-fluid-->
	    </div><!--//app-content-->
    </div><!--//app-wrapper-->  
  <!--//app-content-->


  <?php Includes::custom_include('includes/footer.php', [], true);    ?>