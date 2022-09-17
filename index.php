<?php require 'helpers/init.php' ?>
<?php require 'helpers/_index.php' ?>
<?php require 'helpers/_add_to_cart.php' ?>

<?php
$pageDetails = [
  'title' => "Home | Adverto"
];

Includes::custom_include('includes/header.php', $pageDetails, true);

?>

<body>
    <!--Navigation bar-->
<?php Includes::custom_include('includes/nav.php', $pageDetails, true);  ?>
       <!--end of Navigation bar-->
      <!--header-->
      <?php if(!isUserLoggedIn()): ?>
   <div class="container-fluid header text-white py-5">
       <div class="container py-5 my-5">
           <h1>Adverto</h1>
           <p>Take your business to the next level now! <br> We upload your sales product and  help you advertise your products and bring more traffic to your business </p>
                 <a href="users/signUp.php">  <button class="btn btn-success w-25" type="submit">Join Adverto</button></a>
       </div>
   </div>
   <?php  else: ?>
       <div class="container-fluid header text-white py-2">
       <div class="container">
           <h1>Adverto - View Products, add to cart and buy at anytime</h1>
       </div>
   </div>
    <?php endif; ?>
      <!--end of header-->
      <!--adverts body-->
      <div class="container-fluid py-5 bg-secondary text-white advert_lists">
          <h1 class="advert_list_title">Available Products</h1>
       <div class="row g-4 text-dark">


  <?php while($advert = mysqli_fetch_assoc($adverts)): ?>
    <?php $product = getProductById($advert['product_id']); ?>
  <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12 my-5">
    <div class="card h-100">
      <a href="product-details.php?ad_id=<?php echo $advert['ad_id'] ?>">
        <img src="banners/<?php echo $advert['banner']; ?>" class="card-img-top" alt="AD">
      </a>
      <div class="card-body">
        <h5 class="card-title"><a href="product-details.php?ad_id=<?php echo $advert['ad_id'] ?>"><?php echo $product['title'] ?></a></h5>
        <p class="card-text"><?php echo $product['description'] ?></p>
        <p class="card-text"><span class="emoji-left">Category🧮:</span>
        <a href="categories.php?cat_id=<?php echo $product['category_id']; ?>" class=""><?php echo getCategoryById($product['category_id']); ?></a>
      </p>
      </div>
      <div class="card-footer d-flex justify-content-between align-item-center">
                 <div class="price-frame bg-dark text-white p-2">
                        <p class="card__price my-auto">&#8358;<?php echo $product['product_price'] ?></p>
                </div>
              <?php if(isUserLoggedIn()) : ?>
                        <?php if(!isInCart($advert['product_id'], $email)):?>
                        <a href="?addToCart=<?php echo $advert['product_id']; ?>&quantity=<?php echo "1" ?>">
                              <div class="btn btn-outline-success">Add to Cart</div>
                            </a>
                  <?php else: ?>
                    <a href="#">
                              <div class="btn btn-outline-warning">Item in Cart</div>
                        </a>
                  <?php endif; ?>
            <?php else: ?>
            <a href="users/logIn.php">
                              <div class="btn btn-outline-success">Add to Cart</div>
                            </a>
              <?php endif ?>
                </div>
    </div>
  </div>
  <?php endwhile; ?>

</div>
      </div>
      <!--end of adverts body-->

<?php Includes::custom_include('includes/footer.php', [], true);    ?>