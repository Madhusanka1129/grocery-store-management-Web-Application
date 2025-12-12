<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'] ?? null;

if(!isset($user_id)){
   header('location:login.php');
   exit();
}

if(isset($_POST['add_to_wishlist'])){

   $pid = $_POST['pid'];
   $pid = filter_var($pid, FILTER_SANITIZE_STRING);
   $p_name = $_POST['p_name'];
   $p_name = filter_var($p_name, FILTER_SANITIZE_STRING);
   $p_price = $_POST['p_price'];
   $p_price = filter_var($p_price, FILTER_SANITIZE_STRING);
   $p_image = $_POST['p_image'];
   $p_image = filter_var($p_image, FILTER_SANITIZE_STRING);

   $check_wishlist_numbers = $conn->prepare("SELECT * FROM `wishlist` WHERE name = ? AND user_id = ?");
   $check_wishlist_numbers->bind_param("si", $p_name, $user_id);
   $check_wishlist_numbers->execute();
   $check_wishlist_numbers->store_result();

   $check_cart_numbers = $conn->prepare("SELECT * FROM `cart` WHERE name = ? AND user_id = ?");
   $check_cart_numbers->bind_param("si", $p_name, $user_id);
   $check_cart_numbers->execute();
   $check_cart_numbers->store_result();

   if($check_wishlist_numbers->num_rows > 0){
      $message[] = 'already added to wishlist!';
   }elseif($check_cart_numbers->num_rows > 0){
      $message[] = 'already added to cart!';
   }else{
      $insert_wishlist = $conn->prepare("INSERT INTO `wishlist`(user_id, pid, name, price, image) VALUES(?,?,?,?,?)");
      $insert_wishlist->bind_param("iisis", $user_id, $pid, $p_name, $p_price, $p_image);
      $insert_wishlist->execute();
      $message[] = 'added to wishlist!';
   }
   
   $check_wishlist_numbers->close();
   $check_cart_numbers->close();
}

if(isset($_POST['add_to_cart'])){

   $pid = $_POST['pid'];
   $pid = filter_var($pid, FILTER_SANITIZE_STRING);
   $p_name = $_POST['p_name'];
   $p_name = filter_var($p_name, FILTER_SANITIZE_STRING);
   $p_price = $_POST['p_price'];
   $p_price = filter_var($p_price, FILTER_SANITIZE_STRING);
   $p_image = $_POST['p_image'];
   $p_image = filter_var($p_image, FILTER_SANITIZE_STRING);
   $p_qty = $_POST['p_qty'];
   $p_qty = filter_var($p_qty, FILTER_SANITIZE_STRING);

   $check_cart_numbers = $conn->prepare("SELECT * FROM `cart` WHERE name = ? AND user_id = ?");
   $check_cart_numbers->bind_param("si", $p_name, $user_id);
   $check_cart_numbers->execute();
   $check_cart_numbers->store_result();

   if($check_cart_numbers->num_rows > 0){
      $message[] = 'already added to cart!';
   }else{

      $check_wishlist_numbers = $conn->prepare("SELECT * FROM `wishlist` WHERE name = ? AND user_id = ?");
      $check_wishlist_numbers->bind_param("si", $p_name, $user_id);
      $check_wishlist_numbers->execute();
      $check_wishlist_numbers->store_result();

      if($check_wishlist_numbers->num_rows > 0){
         $delete_wishlist = $conn->prepare("DELETE FROM `wishlist` WHERE name = ? AND user_id = ?");
         $delete_wishlist->bind_param("si", $p_name, $user_id);
         $delete_wishlist->execute();
         $delete_wishlist->close();
      }

      $insert_cart = $conn->prepare("INSERT INTO `cart`(user_id, pid, name, price, quantity, image) VALUES(?,?,?,?,?,?)");
      $insert_cart->bind_param("iisiss", $user_id, $pid, $p_name, $p_price, $p_qty, $p_image);
      $insert_cart->execute();
      $message[] = 'added to cart!';
      
      $insert_cart->close();
   }
   
   $check_cart_numbers->close();
   if(isset($check_wishlist_numbers)) $check_wishlist_numbers->close();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>home page</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/home.css">
   

</head>
<body>
   
<?php include 'header.php'; ?>

<div class="home-bg">

   <section class="home">

      <div class="content">
         <span>don't panic, go organice</span>
         <h3>Reach For A Healthier You With Organic Foods</h3>
         <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Iusto natus culpa officia quasi, accusantium explicabo?</p>
         <a href="about.php" class="btn">about us</a>
      </div>

   </section>

</div>

<section class="home-category">

   <h1 class="title">shop by category</h1>

   <div class="box-container">

      <div class="box">
         <img src="images/cat-1.png" alt="">
         <h3>fruits</h3>
         <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Exercitationem, quaerat.</p>
         <a href="category.php?category=fruits" class="btn">fruits</a>
      </div>

      <div class="box">
         <img src="images/cat-2.png" alt="">
         <h3>meat</h3>
         <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Exercitationem, quaerat.</p>
         <a href="category.php?category=meat" class="btn">meat</a>
      </div>

      <div class="box">
         <img src="images/cat-3.png" alt="">
         <h3>vegitables</h3>
         <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Exercitationem, quaerat.</p>
         <a href="category.php?category=vegitables" class="btn">vegitables</a>
      </div>

      <div class="box">
         <img src="images/cat-4.png" alt="">
         <h3>fish</h3>
         <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Exercitationem, quaerat.</p>
         <a href="category.php?category=fish" class="btn">fish</a>
      </div>

   </div>

</section>

<section class="products">

   <h1 class="title">latest products</h1>

   <div class="box-container">

   <?php
      $select_products = $conn->query("SELECT * FROM `products` LIMIT 6");
      if($select_products->num_rows > 0){
         while($fetch_products = $select_products->fetch_assoc()){ 
   ?>
   <form action="" class="box" method="POST">
      <div class="price">$<span><?= $fetch_products['price']; ?></span>/-</div>
      <a href="view_page.php?pid=<?= $fetch_products['id']; ?>" class="fas fa-eye"></a>
      <img src="uploaded_img/<?= $fetch_products['image']; ?>" alt="">
      <div class="name"><?= $fetch_products['name']; ?></div>
      <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
      <input type="hidden" name="p_name" value="<?= $fetch_products['name']; ?>">
      <input type="hidden" name="p_price" value="<?= $fetch_products['price']; ?>">
      <input type="hidden" name="p_image" value="<?= $fetch_products['image']; ?>">
      <input type="number" min="1" value="1" name="p_qty" class="qty">
      <input type="submit" value="add to wishlist" class="option-btn" name="add_to_wishlist">
      <input type="submit" value="add to cart" class="btn" name="add_to_cart">
   </form>
   <?php
      }
   }else{
      echo '<p class="empty">no products added yet!</p>';
   }
   $select_products->close();
   ?>

   </div>

</section>

<?php
// home.php - before including footer
// Clean up any remaining result sets
if (isset($conn) && $conn->more_results()) {
    while ($conn->next_result()) {
        if ($result = $conn->store_result()) {
            $result->free();
        }
    }
}

include 'footer.php';
?>


<script src="js/script.js"></script>

</body>
</html>