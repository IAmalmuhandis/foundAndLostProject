<?php require 'helpers/admin_init.php'; ?>
<?php require 'helpers/_index.php'; ?>

<?php
$pageDetails = [
  'title' => "Adverto Admin"
];

Includes::custom_include('includes/header.php', $pageDetails, true);

$productsData = "SELECT * FROM `product`";

$product_data_stmt = mysqli_prepare($connection, $productsData);

mysqli_stmt_execute($product_data_stmt);

$user_products = mysqli_stmt_get_result($product_data_stmt);

mysqli_stmt_close($product_data_stmt);

$peopleReached = 0;
while ($product = mysqli_fetch_assoc($user_products)) {
$peopleReached += countPeopleReached($product['owner'], $product['product_id'], "clicks");
}

$productsData = "SELECT * FROM `product`";

$product_data_stmt = mysqli_prepare($connection, $productsData);

mysqli_stmt_execute($product_data_stmt);

$user_products = mysqli_stmt_get_result($product_data_stmt);

mysqli_stmt_close($product_data_stmt);

$totalAdvertSales = 0;
while ($product = mysqli_fetch_assoc($user_products)) {
$totalAdvertSales += countPeopleReached($product['owner'], $product['product_id'], "advert_price");

}


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
        <h1 class="app-page-title">Overview</h1>

        <!--//app-card-->

        <div class="row g-4 mb-4">
          <div class="col-6 col-lg-3">
            <div class="app-card app-card-stat shadow-sm h-100">
              <div class="app-card-body p-3 p-lg-4">
                <h4 class="stats-type mb-1">Total Adverts</h4>
                <div class="stats-figure"><?php echo  getCount('advert');
                                          ?></div>
                <div class="stats-meta text-success">+20%</div>
              </div>
              <!--//app-card-body-->
              <a class="app-card-link-mask" href="#"></a>
            </div>
            <!--//app-card-->
          </div>
          <!--//col-->

          <div class="col-6 col-lg-3">
            <div class="app-card app-card-stat shadow-sm h-100">
              <div class="app-card-body p-3 p-lg-4">
                <h4 class="stats-type mb-1">Total Users</h4>
                <div class="stats-figure"><?php echo  getCount('users');
                                          ?></div>
                <div class="stats-meta text-success">+315%</div>
              </div>
              <!--//app-card-body-->
              <a class="app-card-link-mask" href="#"></a>
            </div>
            <!--//app-card-->
          </div>
          <!--//col-->
          <div class="col-6 col-lg-3">
            <div class="app-card app-card-stat shadow-sm h-100">
              <div class="app-card-body p-3 p-lg-4">
                <h4 class="stats-type mb-1">Advert Sales</h4>
                <div class="stats-figure">&#8358;<?php echo $totalAdvertSales; ?></div>
                <div class="stats-meta text-success">+13%</div>
              </div>
              <!--//app-card-body-->
              <a class="app-card-link-mask" href="#"></a>
            </div>
            <!--//app-card-->
          </div>
          <!--//col-->
          <div class="col-6 col-lg-3">
            <div class="app-card app-card-stat shadow-sm h-100">
              <div class="app-card-body p-3 p-lg-4">
                <h4 class="stats-type mb-1">Clicks</h4>
                <div class="stats-figure"><?php echo $peopleReached; ?></div>
                <div class="stats-meta text-success">+3%</div>
              </div>
              <!--//app-card-body-->
              <a class="app-card-link-mask" href="#"></a>
            </div>
            <!--//app-card-->
          </div>
          <!--//col-->
        </div>

        <!--//row-->
        <div class="row g-4 mb-4">
          <div class="col-12 col-lg-6">
            <div class="app-card app-card-progress-list h-100 shadow-sm">
              <div class="app-card-header p-3">
                <div class="row justify-content-between align-items-center">
                  <div class="col-auto">
                    <h4 class="app-card-title">Recent Adverts</h4>
                  </div>
                  <!--//col-->
                  <div class="col-auto">
                    <div class="card-header-action">
                      <a href="manage_adverts.php">View Adverts</a>
                    </div>
                    <!--//card-header-actions-->
                  </div>
                  <!--//col-->
                </div>
                <!--//row-->
              </div>
              <!--//app-card-header-->
              <div class="app-card app-card-orders-table shadow-sm mb-5">
                <div class="app-card-body">
                  <div class="table-responsive">
                    <table class="table app-table-hover mb-0 text-left">
                      <thead>
                        <tr>
                          <th class="cell">#</th>
                          <th class="cell">Title</th>
                          <th class="cell">AD Price</th>
                          <th class="cell">Status</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $recentAdverts = getRecent('advert');
                        ?>

                        <?php while ($advert = mysqli_fetch_assoc($recentAdverts)) : ?>
                          <tr>
                            <td><?php echo $advert['id']; ?></td>
                            <td><?php echo getProductById($advert['product_id'])['title']; ?></td>
                            <td>&#8358;<?php echo $advert['advert_price'] ?></td>
                            <td> 
                              <span class="badge bg-success"><?php echo $advert['status']; ?></span> 
                            </td>
                          </tr>

                        <?php endwhile; ?>
                      </tbody>
                    </table>
                  </div>
                  <!--//table-responsive-->

                </div>
                <!--//app-card-body-->
              </div>
              <!--//app-card-body-->
            </div>
            <!--//app-card-->
          </div>
          <!--//col-->
          <div class="col-12 col-lg-6">
            <div class="app-card app-card-stats-table h-100 shadow-sm">
              <div class="app-card-header p-3">
                <div class="row justify-content-between align-items-center">
                  <div class="col-auto">
                    <h4 class="app-card-title">Recent Users</h4>
                  </div>
                  <!--//col-->
                  <div class="col-auto">
                    <div class="card-header-action">
                      <a href="manage_users.php">View Users</a>
                    </div>
                    <!--//card-header-actions-->
                  </div>
                  <!--//col-->
                </div>
                <!--//row-->
              </div>
              <!--//app-card-header-->
              <div class="app-card app-card-orders-table shadow-sm mb-5">
                <div class="app-card-body">
                  <div class="table-responsive">
                    <table class="table app-table-hover mb-0 text-left">
                      <thead>
                        <tr>
                          <th class="cell">#</th>
                          <th class="cell">Email</th>
                          <th class="cell">Name</th>
                          <th class="cell">Phone</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $recentUsers = getRecent('users');
                        ?>

                        <?php while ($user = mysqli_fetch_assoc($recentUsers)) : ?>
                          <tr>
                            <td><?php echo $user['id']; ?></td>
                            <td><?php echo $user['email']; ?></td>
                            <td><?php echo $user['firstname'] . " " . $user['lastname']; ?></td>
                            <td> <span class="badge bg-success"><?php echo $user['phone']; ?></span> </td>
                          </tr>

                        <?php endwhile; ?>
                      </tbody>
                    </table>
                  </div>
                  <!--//table-responsive-->

                </div>
                <!--//app-card-body-->
              </div>
              <!--//app-card-body-->
            </div>
            <!--//app-card-->
          </div>
          <!--//col-->
        </div>
      </div>
      <!--//container-fluid-->
    </div>
  </div>
  <!--//app-content-->


  <?php Includes::custom_include('includes/footer.php', [], true);    ?>