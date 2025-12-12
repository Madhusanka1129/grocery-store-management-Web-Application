<?php
// footer.php
?>

<footer class="footer">

   <link rel="stylesheet" href="css/footer.css">

   <section class="box-container">

      <div class="box">
         <h3>quick links</h3>
         <a href="home.php"> <i class="fas fa-angle-right"></i> home</a>
         <a href="shop.php"> <i class="fas fa-angle-right"></i> shop</a>
         <a href="about.php"> <i class="fas fa-angle-right"></i> about</a>
         <a href="contact.php"> <i class="fas fa-angle-right"></i> contact</a>
      </div>

      <div class="box">
         <h3>extra links</h3>
         <a href="cart.php"> <i class="fas fa-angle-right"></i> cart</a>
         <a href="wishlist.php"> <i class="fas fa-angle-right"></i> wishlist</a>
         <a href="login.php"> <i class="fas fa-angle-right"></i> login</a>
         <a href="register.php"> <i class="fas fa-angle-right"></i> register</a>
      </div>

      <div class="box">
         <h3>contact info</h3>
         <p> <i class="fas fa-phone"></i> +94 1201204 </p>
         <p> <i class="fas fa-phone"></i> +94 4125632 </p>
         <p> <i class="fas fa-envelope"></i> madhusankastor@gmail.com </p>
         <p> <i class="fas fa-map-marker-alt"></i> Madhusanka Store, Gall Road, Matara, Sri Lanka - 400104 </p>
      </div>

      <div class="box">
         <h3>follow us</h3>
         <a href="#"> <i class="fab fa-facebook-f"></i> facebook </a>
         <a href="#"> <i class="fab fa-twitter"></i> twitter </a>
         <a href="#"> <i class="fab fa-instagram"></i> instagram </a>
         <a href="#"> <i class="fab fa-linkedin"></i> linkedin </a>
      </div>

   </section>

   <p class="credit"> &copy; copyright @ <?= date('Y'); ?> by <span>S. P Madhusanka</span> | all rights reserved! </p>

</footer>

<script>
   // Footer functionality
document.addEventListener('DOMContentLoaded', function() {
    // Back to Top Button
    const backToTop = document.createElement('div');
    backToTop.className = 'back-to-top';
    backToTop.innerHTML = '<i class="fas fa-chevron-up"></i>';
    document.body.appendChild(backToTop);
    
    // Show/Hide back to top button
    window.addEventListener('scroll', () => {
        if (window.scrollY > 300) {
            backToTop.classList.add('active');
        } else {
            backToTop.classList.remove('active');
        }
    });
    
    // Scroll to top when clicked
    backToTop.addEventListener('click', () => {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });
    
    // Add current year to copyright
    const yearSpan = document.querySelector('.credit span');
    if (yearSpan) {
        yearSpan.textContent = `S. P Madhusanka ${new Date().getFullYear()}`;
    }
    
    // Social media link animations
    const socialLinks = document.querySelectorAll('.footer .box .social-links a');
    socialLinks.forEach(link => {
        link.addEventListener('mouseenter', function() {
            this.style.animation = 'pulse 0.6s ease';
        });
        
        link.addEventListener('mouseleave', function() {
            this.style.animation = '';
        });
    });
    
    // Newsletter form submission
    const newsletterForm = document.querySelector('.footer .newsletter form');
    if (newsletterForm) {
        newsletterForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const email = this.querySelector('input[type="email"]').value;
            
            if (email && validateEmail(email)) {
                // Simulate form submission
                this.innerHTML = `
                    <div class="success-message" style="color: var(--green); font-size: 1.6rem; text-align: center;">
                        <i class="fas fa-check-circle" style="font-size: 3rem; margin-bottom: 1rem;"></i>
                        <p>Thank you for subscribing!</p>
                        <p>We'll keep you updated with our latest offers.</p>
                    </div>
                `;
                
                // Reset form after 5 seconds
                setTimeout(() => {
                    this.innerHTML = `
                        <input type="email" name="email" placeholder="Enter your email" required>
                        <button type="submit">Subscribe</button>
                    `;
                }, 5000);
            } else {
                const input = this.querySelector('input[type="email"]');
                input.style.borderColor = '#e74c3c';
                input.style.boxShadow = '0 0 0 2px rgba(231, 76, 60, 0.2)';
                
                setTimeout(() => {
                    input.style.borderColor = 'rgba(255, 255, 255, 0.2)';
                    input.style.boxShadow = 'none';
                }, 3000);
            }
        });
    }
    
    function validateEmail(email) {
        const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return re.test(email);
    }
});
</script>