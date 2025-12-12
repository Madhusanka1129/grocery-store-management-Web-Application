<?php

@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'] ?? null;

if(!isset($admin_id)){
   header('location:login.php');
   exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>admin page</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/home.css">
   <link rel="stylesheet" href="css/admin_page.css">

</head>
<body>
   
<?php include 'admin_header.php'; ?>

<section class="dashboard">

   <h1 class="title">dashboard</h1>

   <div class="box-container">

      <div class="box">
      <?php
         $total_pendings = 0;
         $pending_status = 'pending'; // Create a variable
         $select_pendings = $conn->prepare("SELECT * FROM `orders` WHERE payment_status = ?");
         $select_pendings->bind_param("s", $pending_status);
         $select_pendings->execute();
         $result_pendings = $select_pendings->get_result();
         while($fetch_pendings = $result_pendings->fetch_assoc()){
            $total_pendings += $fetch_pendings['total_price'];
         }
         $select_pendings->close();
         if(isset($result_pendings)) $result_pendings->close();
      ?>
      <h3>$<?= $total_pendings; ?>/-</h3>
      <p>total pendings</p>
      <a href="admin_orders.php" class="btn">see orders</a>
      </div>

      <div class="box">
      <?php
         $total_completed = 0;
         $completed_status = 'completed'; // Create a variable
         $select_completed = $conn->prepare("SELECT * FROM `orders` WHERE payment_status = ?");
         $select_completed->bind_param("s", $completed_status);
         $select_completed->execute();
         $result_completed = $select_completed->get_result();
         while($fetch_completed = $result_completed->fetch_assoc()){
            $total_completed += $fetch_completed['total_price'];
         }
         $select_completed->close();
         if(isset($result_completed)) $result_completed->close();
      ?>
      <h3>$<?= $total_completed; ?>/-</h3>
      <p>completed orders</p>
      <a href="admin_orders.php" class="btn">see orders</a>
      </div>

      <div class="box">
      <?php
         $select_orders = $conn->query("SELECT COUNT(*) as count FROM `orders`");
         $orders_row = $select_orders->fetch_assoc();
         $number_of_orders = $orders_row['count'];
         $select_orders->close();
      ?>
      <h3><?= $number_of_orders; ?></h3>
      <p>orders placed</p>
      <a href="admin_orders.php" class="btn">see orders</a>
      </div>

      <div class="box">
      <?php
         $select_products = $conn->query("SELECT COUNT(*) as count FROM `products`");
         $products_row = $select_products->fetch_assoc();
         $number_of_products = $products_row['count'];
         $select_products->close();
      ?>
      <h3><?= $number_of_products; ?></h3>
      <p>products added</p>
      <a href="admin_products.php" class="btn">see products</a>
      </div>

      <div class="box">
      <?php
         $user_type = 'user'; // Create a variable
         $select_users = $conn->prepare("SELECT COUNT(*) as count FROM `users` WHERE user_type = ?");
         $select_users->bind_param("s", $user_type);
         $select_users->execute();
         $users_result = $select_users->get_result();
         $users_row = $users_result->fetch_assoc();
         $number_of_users = $users_row['count'];
         $select_users->close();
         if(isset($users_result)) $users_result->close();
      ?>
      <h3><?= $number_of_users; ?></h3>
      <p>total users</p>
      <a href="admin_users.php" class="btn">see accounts</a>
      </div>

      <div class="box">
      <?php
         $admin_type = 'admin'; // Create a variable
         $select_admins = $conn->prepare("SELECT COUNT(*) as count FROM `users` WHERE user_type = ?");
         $select_admins->bind_param("s", $admin_type);
         $select_admins->execute();
         $admins_result = $select_admins->get_result();
         $admins_row = $admins_result->fetch_assoc();
         $number_of_admins = $admins_row['count'];
         $select_admins->close();
         if(isset($admins_result)) $admins_result->close();
      ?>
      <h3><?= $number_of_admins; ?></h3>
      <p>total admins</p>
      <a href="admin_users.php" class="btn">see accounts</a>
      </div>

      <div class="box">
      <?php
         $select_accounts = $conn->query("SELECT COUNT(*) as count FROM `users`");
         $accounts_row = $select_accounts->fetch_assoc();
         $number_of_accounts = $accounts_row['count'];
         $select_accounts->close();
      ?>
      <h3><?= $number_of_accounts; ?></h3>
      <p>total accounts</p>
      <a href="admin_users.php" class="btn">see accounts</a>
      </div>

      <div class="box">
      <?php
         $select_messages = $conn->query("SELECT COUNT(*) as count FROM `message`");
         $messages_row = $select_messages->fetch_assoc();
         $number_of_messages = $messages_row['count'];
         $select_messages->close();
      ?>
      <h3><?= $number_of_messages; ?></h3>
      <p>total messages</p>
      <a href="admin_contacts.php" class="btn">see messages</a>
      </div>

   </div>

</section>

<script src="js/script.js"></script>

</body>
</html>