<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'] ?? null;

if(!isset($user_id)){
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
   <title>about</title>

   <!-- Bootstrap CSS -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/home.css">
   <link rel="stylesheet" href="css/about.css">

</head>
<body>
   
<?php include 'header.php'; ?>

<!-- About Section -->
<section class="about">
    <div class="container">
        <div class="row justify-content-center g-4">
            <div class="col-lg-5 col-md-6">
                <div class="box fade-in">
                    <img src="images/about-img-1.png" alt="Why Choose Us" class="img-fluid rounded">
                    <h3 class="text-primary mb-3">Why Choose Us?</h3>
                    <p class="text-muted">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quisquam, a quod, quis alias eius dignissimos pariatur laborum dolorem ad ullam iure, consequatur autem animi illo odit! Atque quia minima voluptatibus.</p>
                    <a href="contact.php" class="btn btn-primary">Contact Us</a>
                </div>
            </div>
            
            <div class="col-lg-5 col-md-6">
                <div class="box fade-in" style="animation-delay: 0.2s">
                    <img src="images/about-img-2.png" alt="What We Provide" class="img-fluid rounded">
                    <h3 class="text-primary mb-3">What We Provide?</h3>
                    <p class="text-muted">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quisquam, a quod, quis alias eius dignissimos pariatur laborum dolorem ad ullam iure, consequatur autem animi illo odit! Atque quia minima voluptatibus.</p>
                    <a href="shop.php" class="btn btn-primary">Our Shop</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Reviews Section -->
<section class="reviews">
    <div class="container">
        <h1 class="title mb-5">Client Reviews</h1>
        
        <div class="row g-4">
            <div class="col-lg-4 col-md-6">
                <div class="box fade-in">
                    <img src="images/pic-1.png" alt="Client" class="img-fluid rounded-circle">
                    <p class="mb-3">"Lorem ipsum dolor sit, amet consectetur adipisicing elit. Et voluptates sit earum, neque non cupiditate amet deserunt aperiam quas ex."</p>
                    <div class="stars mb-3">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <h3>John Deo</h3>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6">
                <div class="box fade-in" style="animation-delay: 0.1s">
                    <img src="images/pic-2.png" alt="Client" class="img-fluid rounded-circle">
                    <p class="mb-3">"Lorem ipsum dolor sit, amet consectetur adipisicing elit. Et voluptates sit earum, neque non cupiditate amet deserunt aperiam quas ex."</p>
                    <div class="stars mb-3">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <h3>Jane Smith</h3>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6">
                <div class="box fade-in" style="animation-delay: 0.2s">
                    <img src="images/pic-3.png" alt="Client" class="img-fluid rounded-circle">
                    <p class="mb-3">"Lorem ipsum dolor sit, amet consectetur adipisicing elit. Et voluptates sit earum, neque non cupiditate amet deserunt aperiam quas ex."</p>
                    <div class="stars mb-3">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <h3>Mike Johnson</h3>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6">
                <div class="box fade-in" style="animation-delay: 0.3s">
                    <img src="images/pic-4.png" alt="Client" class="img-fluid rounded-circle">
                    <p class="mb-3">"Lorem ipsum dolor sit, amet consectetur adipisicing elit. Et voluptates sit earum, neque non cupiditate amet deserunt aperiam quas ex."</p>
                    <div class="stars mb-3">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <h3>Sarah Wilson</h3>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6">
                <div class="box fade-in" style="animation-delay: 0.4s">
                    <img src="images/pic-5.png" alt="Client" class="img-fluid rounded-circle">
                    <p class="mb-3">"Lorem ipsum dolor sit, amet consectetur adipisicing elit. Et voluptates sit earum, neque non cupiditate amet deserunt aperiam quas ex."</p>
                    <div class="stars mb-3">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <h3>David Brown</h3>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6">
                <div class="box fade-in" style="animation-delay: 0.5s">
                    <img src="images/pic-6.png" alt="Client" class="img-fluid rounded-circle">
                    <p class="mb-3">"Lorem ipsum dolor sit, amet consectetur adipisicing elit. Et voluptates sit earum, neque non cupiditate amet deserunt aperiam quas ex."</p>
                    <div class="stars mb-3">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <h3>Emily Davis</h3>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'footer.php'; ?>

<!-- Bootstrap JS Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<!-- Custom JS -->
<script src="js/script.js"></script>

</body>
</html>