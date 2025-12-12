<?php

@include 'config.php';

session_start();

if(isset($_POST['submit'])){

   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $pass = md5($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);

   // Using mysqli syntax
   $sql = "SELECT * FROM `users` WHERE email = ? AND password = ?";
   $stmt = $conn->prepare($sql);
   $stmt->bind_param("ss", $email, $pass);
   $stmt->execute();
   $stmt->store_result();
   
   if($stmt->num_rows > 0){
      
      $stmt->bind_result($id, $name, $email, $password, $user_type, $image);
      $stmt->fetch();
      
      if($user_type == 'admin'){
         $_SESSION['admin_id'] = $id;
         header('location:admin_page.php');
         exit();
      }elseif($user_type == 'user'){
         $_SESSION['user_id'] = $id;
         header('location:home.php');
         exit();
      }else{
         $message[] = 'no user found!';
      }
      
   }else{
      $message[] = 'incorrect email or password!';
   }
   
   $stmt->close();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/home.css">
   <link rel="stylesheet" href="css/login.css">

</head>
<body>

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
   
<section class="form-container">

   <form action="" method="POST">
      <h3>login now</h3>
      <input type="email" name="email" class="box" placeholder="enter your email" required>
      <input type="password" name="pass" class="box" placeholder="enter your password" required>
      <input type="submit" value="login now" class="btn" name="submit">
      <p>don't have an account? <a href="register.php">register now</a></p>
   </form>

</section>

</body>
</html>