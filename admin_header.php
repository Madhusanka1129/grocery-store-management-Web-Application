<?php
// admin_header.php
// REMOVED: session_start() - Session is already started in main files

$admin_id = $_SESSION['admin_id'] ?? null;

// Display messages if set
if(isset($message)){
   foreach($message as $msg){
      echo '
      <div class="message">
         <span>'.$msg.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}

// Check if admin is logged in
if(!isset($admin_id)){
   header('location:login.php');
   exit();
}

// Fetch admin profile for header
$select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
$select_profile->bind_param("i", $admin_id);
$select_profile->execute();
$result = $select_profile->get_result();
$fetch_profile = $result->fetch_assoc();
$select_profile->close();
if(isset($result)) $result->close();
?>

<header class="header">

      <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/admin_header.css">

   <div class="flex">

      <a href="admin_page.php" class="logo">Admin<span>Panel</span></a>

      <nav class="navbar">
         <a href="admin_page.php">home</a>
         <a href="admin_products.php">products</a>
         <a href="admin_orders.php">orders</a>
         <a href="admin_users.php">users</a>
         <a href="admin_contacts.php">messages</a>
      </nav>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="user-btn" class="fas fa-user"></div>
      </div>

      <div class="profile">
         <img src="uploaded_img/<?= htmlspecialchars($fetch_profile['image'] ?? ''); ?>" alt="">
         <p><?= htmlspecialchars($fetch_profile['name'] ?? ''); ?></p>
         <a href="admin_update_profile.php" class="btn">update profile</a>
         <a href="logout.php" class="delete-btn">logout</a>
         <div class="flex-btn">
            <a href="login.php" class="option-btn">login</a>
            <a href="register.php" class="option-btn">register</a>
         </div>
      </div>

   </div>

</header>