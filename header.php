<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>

<header class="header">

    <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <!-- custom css file link  -->
    <link rel="stylesheet" href="css/header.css">
    

   <div class="flex">

      <a href="admin_page.php" class="logo"> Madhusanka Store <span>.</span></a>

      <nav class="navbar">
         <a href="home.php">home</a>
         <a href="shop.php">shop</a>
         <a href="orders.php">orders</a>
         <a href="about.php">about</a>
         <a href="contact.php">contact</a>
      </nav>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="user-btn" class="fas fa-user"></div>
         <a href="search_page.php" class="fas fa-search"></a>
         <?php
            if(isset($user_id)){
               // Cart items count
               $count_cart_items = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
               $count_cart_items->bind_param("i", $user_id);
               $count_cart_items->execute();
               $count_cart_items->store_result();
               $cart_count = $count_cart_items->num_rows;
               $count_cart_items->close();
               
               // Wishlist items count
               $count_wishlist_items = $conn->prepare("SELECT * FROM `wishlist` WHERE user_id = ?");
               $count_wishlist_items->bind_param("i", $user_id);
               $count_wishlist_items->execute();
               $count_wishlist_items->store_result();
               $wishlist_count = $count_wishlist_items->num_rows;
               $count_wishlist_items->close();
            } else {
               $cart_count = 0;
               $wishlist_count = 0;
            }
         ?>
         <a href="wishlist.php"><i class="fas fa-heart"></i><span>(<?= $wishlist_count; ?>)</span></a>
         <a href="cart.php"><i class="fas fa-shopping-cart"></i><span>(<?= $cart_count; ?>)</span></a>
      </div>

      <div class="profile">
         <?php
            if(isset($user_id)){
               $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
               $select_profile->bind_param("i", $user_id);
               $select_profile->execute();
               $result = $select_profile->get_result();
               $fetch_profile = $result->fetch_assoc();
               $select_profile->close();
         ?>
         <img src="uploaded_img/<?= $fetch_profile['image']; ?>" alt="">
         <p><?= $fetch_profile['name']; ?></p>
         <a href="user_profile_update.php" class="btn">update profile</a>
         <a href="logout.php" class="delete-btn">logout</a>
         <div class="flex-btn">
            <a href="login.php" class="option-btn">login</a>
            <a href="register.php" class="option-btn">register</a>
         </div>
         <?php } ?>
      </div>

   </div>
   <script src="js/script.js"></script>
   <script> 
   </script>
</header>