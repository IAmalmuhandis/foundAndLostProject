<?php require 'helpers/admin_init.php'; ?>
<?php require 'helpers/_new_adverts.php'; ?>

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
			            <h1 class="app-page-title mb-0">New Adverts</h1>
				    </div>
			    </div><!--//row-->
                   <div class="app-card app-card-orders-table shadow-sm mb-5">
						    <div class="app-card-body">
							    <div class="table-responsive">
							        <table class="table app-table-hover mb-0 text-left">
										<thead>
											<tr>
												<th class="cell"></th>
												<th class="cell">AD ID</th>
												<th class="cell">Product Title</th>
												<th class="cell">Publisher</th>
												<th class="cell">AD Price</th>
												<th class="cell">Action</th>
												<th class="cell">View</th>
											</tr>
										</thead>
										<tbody>
									<?php $counter = 1; ?>
									<?php while ($advert = mysqli_fetch_assoc($newAdverts_result)) : ?>
										<tr>
												<td class="cell">#<?php echo $counter++; ?></td>
												<td class="cell"><?php echo $advert['ad_id']; ?></td>
												<td class="cell"><span class="truncate">
													<?php echo getProductById($advert['product_id'])['title']; ?>
												</span></td>
												<td class="cell">
													<?php echo getProductById($advert['product_id'])['owner']; ?>
												</td>
												<td class="cell">&#8358;<?php echo $advert['advert_price']; ?></td>
												<td class="cell">
													<a class="btn-sm app-btn-secondary" href="?status=Accepted&ad_id=<?php echo $advert['ad_id']; ?>">Accept</a>
													<a class="btn-sm app-btn-secondary" href="?status=Declined&ad_id=<?php echo $advert['ad_id']; ?>">Decline</a>
												</td>
												<td class="cell"><a class="btn-sm app-btn-secondary" href="../product-details.php?ad_id=<?php echo $advert['ad_id'] ?>">View</a></td>
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