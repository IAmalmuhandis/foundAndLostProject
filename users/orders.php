<?php require 'helpers/user_init.php'; ?>
<?php require 'helpers/_orders.php'; ?>

<?php
$pageDetails = [
  'title' => "Orders | Adverto"
];

Includes::custom_include('includes/header.php', $pageDetails, true);

?>
<body class="bg-secondary">
    
    <!--Navigation bar-->
        <?php Includes::custom_include('includes/nav.php', [], true);    ?>
       <!--end of Navigation bar -->

       <!-- Order page-->
       <div class="container-fluid py-5 ">
        <div class="container text-center">
            <div class="card text-white bg-dark shadow p-5">
                <h1 class="lead bg-secondary py-4">MY ORDERS</h1>
                <div class="card-body">
                   <table class="table table-hover text-white">
                       <thead>
                               <th>#</th>
                               <th>Product Title</th>
                               <th>Date Time</th>
                               <th>Amount</th>
                               <th>Quantity</th>
                               <th>Order Status</th>
                       </thead>
                           <tbody>
                        <?php $counter = 1; ?>
                        <?php while($order = mysqli_fetch_assoc($orders)): ?>
                    <tr>
                            <td class="col-md-2 col-xs-12 col-sm-12 col-lg-2">
                                    <?php echo $counter++; ?>
                            </td>
                            <td class="col-md-2 col-xs-12 col-sm-12 col-lg-2">
                                <?php echo getProductById($order['product_id'])['title'] ?>
                            </td>
                            <td class="col-md-2 col-xs-12 col-sm-12 col-lg-2">
                                <?php echo $order['datetime'] ?>
                            </td>
                            <td class="col-md-4 col-xs-12 col-sm-12 col-lg-4">
                                <?php echo $order['amount']; ?>
                            </td>
                            <td class="col-md-2 col-xs-12 col-sm-12 col-lg-2">
                                x<?php echo $order['quantity'] ?>
                            </td>
                            <td class="col-md-2 col-xs-12 col-sm-12 col-lg-2">
                                <h3 class="lead mr-auto bg-success rounded p-2" >
                                    <?php echo $order['status']; ?>
                                </h3>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                           </tbody>
                   </table>
                  
                </div>
            </div>
        </div>
       </div>
       <!-- end of Order page-->
<?php Includes::custom_include('includes/footer.php', [], true);    ?>