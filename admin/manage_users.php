<?php require 'helpers/admin_init.php'; ?>
<?php require 'helpers/_manage_users.php'; ?>

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
			            <h1 class="app-page-title mb-0">Manage Adverto Users</h1>
				    </div>
			    </div><!--//row-->
                   <div class="app-card app-card-orders-table shadow-sm mb-5">
						    <div class="app-card-body">
							    <div class="table-responsive">
							        <table class="table app-table-hover mb-0 text-left">
										<thead>
											<tr>
												<th class="cell"></th>
												<th class="cell">Avatar</th>
												<th class="cell">Email</th>
												<th class="cell">Full Name</th>
												<th class="cell">Phone</th>
												<th class="cell">Delivery Address</th>
												<th class="cell">Action</th>
											</tr>
										</thead>
										<tbody>
									<?php $counter = 1; ?>
									<?php while ($user = mysqli_fetch_assoc($users)) : ?>
										<tr>
												<td class="cell">#<?php echo $counter++; ?></td>
												<td class="cell">
													<img src="../users/<?php echo $user['avatar']; ?>" width="40" alt="avatar">
												</td>
																																			<td class="cell"><?php echo $user['email']; ?></td>
												<td class="cell"><span class="truncate">
													<?php echo $user['firstname'] . " " . $user['lastname']; ?>
												</span></td>
												<td class="cell"><?php echo $user['phone'] ?></td>
												<td class="cell"><?php echo $user['delivery_address']; ?></td>
												<td class="cell">
													<a class="btn-sm app-btn-secondary" href="?delete=<?php echo $user['email'];?>">Delete</a>
												</td>
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