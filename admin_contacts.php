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
   $delete_message = $conn->prepare("DELETE FROM `message` WHERE id = ?");
   $delete_message->bind_param("i", $delete_id);
   $delete_message->execute();
   $delete_message->close();
   header('location:admin_contacts.php');
   exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>messages</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/home.css">
   <link rel="stylesheet" href="css/admn_Contacts.css">


</head>
<body>
   
<?php include 'admin_header.php'; ?>

<section class="messages">

   <h1 class="title">messages</h1>

   <div class="box-container">

   <?php
      $select_message = $conn->query("SELECT * FROM `message`");
      if($select_message->num_rows > 0){
         while($fetch_message = $select_message->fetch_assoc()){
   ?>
   <div class="box">
      <p> user id : <span><?= htmlspecialchars($fetch_message['user_id']); ?></span> </p>
      <p> name : <span><?= htmlspecialchars($fetch_message['name']); ?></span> </p>
      <p> number : <span><?= htmlspecialchars($fetch_message['number']); ?></span> </p>
      <p> email : <span><?= htmlspecialchars($fetch_message['email']); ?></span> </p>
      <p> message : <span><?= htmlspecialchars($fetch_message['message']); ?></span> </p>
      <a href="admin_contacts.php?delete=<?= $fetch_message['id']; ?>" onclick="return confirm('delete this message?');" class="delete-btn">delete</a>
   </div>
   <?php
         }
      }else{
         echo '<p class="empty">you have no messages!</p>';
      }
      $select_message->close();
   ?>

   </div>

</section>

<script src="js/script.js"></script>

</body>
</html>