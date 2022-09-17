<?php require 'helpers/init.php' ?>
<?php require 'helpers/_add_to_cart.php' ?>

<?php
$pageDetails = [
  'title' => "Product Details | Adverto"
];

Includes::custom_include('includes/header.php', $pageDetails, true);

if (!isset($_GET['ad_id'])) {
  header("location: index.php");
}else{
    $ad_id = $_GET['ad_id'];

    $clickQuery = "UPDATE `advert` SET `clicks` = `clicks` + 1 WHERE `ad_id`=?";

    $clickStmt = mysqli_prepare($connection, $clickQuery);

    mysqli_stmt_bind_param($clickStmt, "s", $ad_id);

    mysqli_stmt_execute($clickStmt);

    mysqli_stmt_close($clickStmt);
}

$ad_id = $_GET['ad_id'];
$advert = getAdvertById($ad_id);
$product = getProductById($advert['product_id']);

?>
<body>
     <!--Navigation bar-->
<?php Includes::custom_include('includes/nav.php', $pageDetails, true);  ?>
       <!--end of Navigation bar-->
       <!--Product detail container-->
       <div class="container-fluid bg-secondary py-5">
            <h4 class="advert_list_title">Product Details</h4>
           <div class="container">
               
<div class="card mb-3 shadow bg-body rounded  p-3 bg-dark">
    <div class="row">
        <div class="col-sm-12 card-body col-xs-12 col-md-6 col-lg-6">
              <img src="banners/<?php echo $advert['banner']; ?>" height="100%" class="card-img-top" alt="Product Details">
        </div>
        <div class="col-sm-12 col-xs-12 col-md-6 col-lg-6">
             <div class="card-body ">
    <h5 class="card-title tex"><a href="product-details.php?ad_id=<?php echo $advert['ad_id'] ?>"><?php echo $product['title'] ?></a></h5>
        <p class="card-text"><?php echo $product['description'] ?></p>
        <div class="d-flex justify-content-between">
          <div>
                 <div class="price-frame bg-dark text-white p-2">
                        <p class="card__price my-auto">&#8358;<?php echo $product['product_price'] ?></p>
                 </div>
          </div>
          <div>
            <p class="card-text"><span class="emoji-left">Category🧮:</span>
            <a href="categories.php?cat_id=<?php echo $product['category_id']; ?>" class=""><?php echo getCategoryById($product['category_id']); ?></a>
          </div>
        </div>
        
      </p>
        <form action="" method="POST" class="d-flex justify-content-between">
              <div class="amount  d-flex justify-content-between">
                <label class="p-2" for="">Quantity: </label>
                <input class="form-control amount_input me-2" name="quantity" value="1" min="1" max="10" type="number" >
            </div>
            <?php if(isUserLoggedIn()) : ?>
            <?php if(!isInCart($advert['product_id'], $email)):?>
              <input type="text" name="ad_id" value="<?php echo $advert['ad_id']; ?>" hidden>
              <input type="text" name="product_id" value="<?php echo $advert['product_id']; ?>" hidden>
            <p class="add_to_cart">
                <button class="btn btn-success" type="submit" name="addToCart">Add to cart</button>
            </p>
            <?php else : ?>
              <a class="add_to_cart" href="#">
                <button class="btn btn-warning">Item in Cart</button>
            </a>
            <?php endif; ?>
             <?php else: ?>
            <a href="users/logIn.php">
                              <div class="btn btn-success">Add to Cart</div>
                            </a>
              <?php endif ?>
        </form>
<p class="card-text mt-3">Published by: <strong class="text-muted "><?php echo getUserByEmail($advert['owner'])['firstname']; ?> Store</strong></p>
  </div>
        </div>
    </div>
 
</div>
</div>
       </div>
       <!--end of Product detail container-->
<?php Includes::custom_include('includes/footer.php', [], true);    ?>