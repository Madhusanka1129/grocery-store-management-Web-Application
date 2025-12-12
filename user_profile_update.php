<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'] ?? null;

if(!isset($user_id)){
   header('location:login.php');
   exit();
}

// Fetch current user profile data
$select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
$select_profile->bind_param("i", $user_id);
$select_profile->execute();
$result = $select_profile->get_result();
$fetch_profile = $result->fetch_assoc();
$select_profile->close();

if(isset($_POST['update_profile'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);

   $update_profile = $conn->prepare("UPDATE `users` SET name = ?, email = ? WHERE id = ?");
   $update_profile->bind_param("ssi", $name, $email, $user_id);
   $update_profile->execute();
   $update_profile->close();

   $image = $_FILES['image']['name'];
   $image = filter_var($image, FILTER_SANITIZE_STRING);
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'uploaded_img/'.$image;
   $old_image = $_POST['old_image'];

   if(!empty($image)){
      if($image_size > 2000000){
         $message[] = 'image size is too large!';
      }else{
         $update_image = $conn->prepare("UPDATE `users` SET image = ? WHERE id = ?");
         $update_image->bind_param("si", $image, $user_id);
         $update_image->execute();
         if($update_image){
            move_uploaded_file($image_tmp_name, $image_folder);
            if($old_image != '' && file_exists('uploaded_img/'.$old_image)){
               unlink('uploaded_img/'.$old_image);
            }
            $message[] = 'image updated successfully!';
         };
         $update_image->close();
      };
   };

   $old_pass = $_POST['old_pass'];
   $update_pass = md5($_POST['update_pass']);
   $update_pass = filter_var($update_pass, FILTER_SANITIZE_STRING);
   $new_pass = md5($_POST['new_pass']);
   $new_pass = filter_var($new_pass, FILTER_SANITIZE_STRING);
   $confirm_pass = md5($_POST['confirm_pass']);
   $confirm_pass = filter_var($confirm_pass, FILTER_SANITIZE_STRING);

   if(!empty($update_pass) && !empty($new_pass) && !empty($confirm_pass)){
      if($update_pass != $old_pass){
         $message[] = 'old password not matched!';
      }elseif($new_pass != $confirm_pass){
         $message[] = 'confirm password not matched!';
      }else{
         $update_pass_query = $conn->prepare("UPDATE `users` SET password = ? WHERE id = ?");
         $update_pass_query->bind_param("si", $confirm_pass, $user_id);
         $update_pass_query->execute();
         $message[] = 'password updated successfully!';
         $update_pass_query->close();
      }
   }

   // Refresh profile data after update
   $select_profile = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
   $select_profile->bind_param("i", $user_id);
   $select_profile->execute();
   $result = $select_profile->get_result();
   $fetch_profile = $result->fetch_assoc();
   $select_profile->close();

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>update user profile</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/home.css">
   <link rel="stylesheet" href="css/user_profile.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<section class="update-profile">

   <h1 class="title">update profile</h1>

   <form action="" method="POST" enctype="multipart/form-data">
      <img src="uploaded_img/<?= htmlspecialchars($fetch_profile['image'] ?? ''); ?>" alt="">
      <div class="flex">
         <div class="inputBox">
            <span>username :</span>
            <input type="text" name="name" value="<?= htmlspecialchars($fetch_profile['name'] ?? ''); ?>" placeholder="update username" required class="box">
            <span>email :</span>
            <input type="email" name="email" value="<?= htmlspecialchars($fetch_profile['email'] ?? ''); ?>" placeholder="update email" required class="box">
            <span>update pic :</span>
            <input type="file" name="image" accept="image/jpg, image/jpeg, image/png" class="box">
            <input type="hidden" name="old_image" value="<?= htmlspecialchars($fetch_profile['image'] ?? ''); ?>">
         </div>
         <div class="inputBox">
            <input type="hidden" name="old_pass" value="<?= htmlspecialchars($fetch_profile['password'] ?? ''); ?>">
            <span>old password :</span>
            <input type="password" name="update_pass" placeholder="enter previous password" class="box">
            <span>new password :</span>
            <input type="password" name="new_pass" placeholder="enter new password" class="box">
            <span>confirm password :</span>
            <input type="password" name="confirm_pass" placeholder="confirm new password" class="box">
         </div>
      </div>
      <div class="flex-btn">
         <input type="submit" class="btn" value="update profile" name="update_profile">
         <a href="home.php" class="option-btn">go back</a>
      </div>
   </form>

</section>

<?php include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>