# 🛒 Madhusanka Grocery Store

A complete Grocery Store Management System developed for **Madhusanka Store**. This web application provides a seamless shopping experience for customers and a comprehensive management dashboard for administrators.

## 🌟 Features

### 👤 Customer Panel
* **User Authentication:** Secure registration and login system.
* **Product Browsing:** View products by category (Fruits, Vegetables, Meat, etc.).
* **Smart Search:** Search functionality (`search_page.php`) to find items quickly.
* **Shopping Cart:** Add items to cart, update quantities, and view totals.
* **Wishlist:** Save items for later (`wishlist.php`).
* **Checkout System:** Streamlined checkout process for placing orders.
* **Order History:** View past orders and payment status.
* **Profile Management:** Update user details and passwords.

### 🛡️ Admin Dashboard
* **Dashboard Overview:** View total products, active orders, and user statistics.
* **Product Management:** * Add new products with images (`admin_products.php`).
    * Update existing product details and pricing.
    * Delete products.
* **Order Management:** View, handle, and update the status of customer orders (`admin_orders.php`).
* **User Management:** View and manage registered users and admins.
* **Messages:** Read inquiries sent via the contact form.

## 🛠️ Technology Stack

* **Frontend:** HTML5, CSS3 (Custom styling), JavaScript
* **Backend:** PHP (Native)
* **Database:** MySQL
* **Server:** Apache (via XAMPP/WAMP)

## 📂 Project Structure

```text
/GROCERY STORE
├── css/                 # Stylesheets for different pages
├── images/              # UI assets and icons
├── project images/      # Product images (apples, meat, etc.)
├── uploaded_img/        # Directory for user/admin uploaded content
├── js/                  # JavaScript logic (script.js)
├── config.php           # Database connection configuration
├── shop_db.sql          # Database import file
├── admin_*.php          # Administrator pages
└── [page].php           # User pages (home, shop, cart, etc.)
