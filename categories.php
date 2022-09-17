<?php require 'helpers/init.php' ?>

<?php
$pageDetails = [
  'title' => "Product Details | Adverto"
];

Includes::custom_include('includes/header.php', $pageDetails, true);

if (!isset($_GET['cat_id'])) {
  header("location: index.php");
}

$cat_id = $_GET['cat_id'];

    $data_q = "SELECT * FROM `product` WHERE category_id = ?";

    $data_stmt = mysqli_prepare($connection, $data_q);

    mysqli_stmt_bind_param($data_stmt, "s", $cat_id);

    mysqli_stmt_execute($data_stmt);

    $product_category = mysqli_stmt_get_result($data_stmt);

?>
<body>
     <!--Navigation bar-->
<?php Includes::custom_include('includes/nav.php', $pageDetails, true);  ?>
       <!--end of Navigation bar-->
       <!--Product detail container-->
       <div class="container-fluid bg-secondary py-5">
            <h4 class="advert_list_title">Category🧮: <?php echo getCategoryById($cat_id); ?></h4>
           <div class="container">
               
           <!-- detail -->

<?php while($product = mysqli_fetch_assoc($product_category)): ?>
<?php if(getAdvertByProductId($product['product_id'])['status'] == "Accepted"): ?>
<div class="card mb-3 shadow bg-body rounded  p-3 bg-dark">
    <div class="row">
        <div class="col-sm-12 card-body col-xs-12 col-md-6 col-lg-6">
              <a href="product-details.php?ad_id=<?php echo  getAdvertByProductId($product['product_id'])['ad_id'] ?>">
                <img src="banners/<?php echo getAdvertByProductId($product['product_id'])['banner']; ?>" height="100%" class="card-img-top" alt="Product Details">
              </a>
        </div>
        <div class="col-sm-12 col-xs-12 col-md-6 col-lg-6">
             <div class="card-body ">
    <h5 class="card-title tex"><a href="product-details.php?ad_id=<?php echo  getAdvertByProductId($product['product_id'])['ad_id'] ?>"><?php echo $product['title'] ?></a></h5>
        <p class="card-text"><?php echo $product['description'] ?></p>
      </p>
        <div class="d-flex justify-content-between">
            <div class="price-frame bg-dark text-white p-2">
                        <p class="card__price my-auto">&#8358;<?php echo $product['product_price'] ?></p>
                 </div>
            <div class="add_to_cart">
                <a class="btn btn-outline-success" href="product-details.php?ad_id=<?php echo  getAdvertByProductId($product['product_id'])['ad_id'] ?>">View Product</a>
            </div>
        </div>
        <p class="card-text mt-3">Published by: <strong class="text-muted "><?php echo getUserByEmail($product['owner'])['firstname']; ?> Store</strong></p>
  </div>
        </div>
    </div>
 
</div>

<?php endif; ?>

<?php endwhile; ?>
<!-- detail -->
</div>
       </div>
       <!--end of Product detail container-->
<?php Includes::custom_include('includes/footer.php', [], true);    ?>