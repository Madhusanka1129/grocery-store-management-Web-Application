<?php

@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'] ?? null;

if(!isset($admin_id)){
   header('location:login.php');
   exit();
}

if(isset($_POST['update_order'])){

   $order_id = $_POST['order_id'];
   $update_payment = $_POST['update_payment'];
   $update_payment = filter_var($update_payment, FILTER_SANITIZE_STRING);
   $update_orders = $conn->prepare("UPDATE `orders` SET payment_status = ? WHERE id = ?");
   $update_orders->bind_param("si", $update_payment, $order_id);
   $update_orders->execute();
   $update_orders->close();
   $message[] = 'payment has been updated!';

}

if(isset($_GET['delete'])){

   $delete_id = $_GET['delete'];
   $delete_orders = $conn->prepare("DELETE FROM `orders` WHERE id = ?");
   $delete_orders->bind_param("i", $delete_id);
   $delete_orders->execute();
   $delete_orders->close();
   header('location:admin_orders.php');
   exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>orders</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/home.css">
   <link rel="stylesheet" href="css/admin_orders.css">

</head>
<body>
   
<?php include 'admin_header.php'; ?>

<section class="placed-orders">

   <h1 class="title">placed orders</h1>

   <div class="box-container">

      <?php
         $select_orders = $conn->query("SELECT * FROM `orders`");
         if($select_orders->num_rows > 0){
            while($fetch_orders = $select_orders->fetch_assoc()){
      ?>
      <div class="box">
         <p> user id : <span><?= htmlspecialchars($fetch_orders['user_id']); ?></span> </p>
         <p> placed on : <span><?= htmlspecialchars($fetch_orders['placed_on']); ?></span> </p>
         <p> name : <span><?= htmlspecialchars($fetch_orders['name']); ?></span> </p>
         <p> email : <span><?= htmlspecialchars($fetch_orders['email']); ?></span> </p>
         <p> number : <span><?= htmlspecialchars($fetch_orders['number']); ?></span> </p>
         <p> address : <span><?= htmlspecialchars($fetch_orders['address']); ?></span> </p>
         <p> total products : <span><?= htmlspecialchars($fetch_orders['total_products']); ?></span> </p>
         <p> total price : <span>$<?= htmlspecialchars($fetch_orders['total_price']); ?>/-</span> </p>
         <p> payment method : <span><?= htmlspecialchars($fetch_orders['method']); ?></span> </p>
         <form action="" method="POST">
            <input type="hidden" name="order_id" value="<?= $fetch_orders['id']; ?>">
            <select name="update_payment" class="drop-down">
               <option value="" selected disabled><?= htmlspecialchars($fetch_orders['payment_status']); ?></option>
               <option value="pending">pending</option>
               <option value="completed">completed</option>
            </select>
            <div class="flex-btn">
               <input type="submit" name="update_order" class="option-btn" value="update">
               <a href="admin_orders.php?delete=<?= $fetch_orders['id']; ?>" class="delete-btn" onclick="return confirm('delete this order?');">delete</a>
            </div>
         </form>
      </div>
      <?php
         }
      }else{
         echo '<p class="empty">no orders placed yet!</p>';
      }
      $select_orders->close();
      ?>

   </div>

</section>

<script src="js/script.js"></script>

</body>
</html>