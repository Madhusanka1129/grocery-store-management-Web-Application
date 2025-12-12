<?php

@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'] ?? null;

if(!isset($admin_id)){
   header('location:login.php');
   exit();
}

if(isset($_GET['delete'])){

   $delete_id = $_GET['delete'];
   
   // Prevent admin from deleting themselves
   if($delete_id == $admin_id){
      $message[] = 'You cannot delete your own account!';
   } else {
      $delete_users = $conn->prepare("DELETE FROM `users` WHERE id = ?");
      $delete_users->bind_param("i", $delete_id);
      if($delete_users->execute()){
         $message[] = 'User deleted successfully!';
      } else {
         $message[] = 'Failed to delete user!';
      }
      $delete_users->close();
   }
   
   // Redirect with message
   header('location:admin_users.php');
   exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>users</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/home.css">
   <link rel="stylesheet" href="css/admin_user.css">

</head>
<body>
   
<?php include 'admin_header.php'; ?>

<section class="user-accounts">

   <h1 class="title">user accounts</h1>

   <div class="box-container">

      <?php
         $select_users = $conn->query("SELECT * FROM `users`");
         if($select_users->num_rows > 0){
            while($fetch_users = $select_users->fetch_assoc()){
               // Skip displaying current admin
               if($fetch_users['id'] == $admin_id) continue;
      ?>
      <div class="box">
         <img src="uploaded_img/<?= htmlspecialchars($fetch_users['image']); ?>" alt="">
         <p> user id : <span><?= htmlspecialchars($fetch_users['id']); ?></span></p>
         <p> username : <span><?= htmlspecialchars($fetch_users['name']); ?></span></p>
         <p> email : <span><?= htmlspecialchars($fetch_users['email']); ?></span></p>
         <p> user type : <span style=" color:<?php if($fetch_users['user_type'] == 'admin'){ echo 'orange'; } ?>"><?= htmlspecialchars($fetch_users['user_type']); ?></span></p>
         <a href="admin_users.php?delete=<?= $fetch_users['id']; ?>" onclick="return confirm('Are you sure you want to delete this user?');" class="delete-btn">delete</a>
      </div>
      <?php
            }
         } else {
            echo '<p class="empty">No users found!</p>';
         }
         $select_users->close();
      ?>
   </div>

</section>

<script src="js/script.js"></script>

</body>
</html>