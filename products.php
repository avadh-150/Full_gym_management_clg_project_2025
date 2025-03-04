
 <?php include "include/header.php"; ?>

 <!-- <link rel="stylesheet" href="css/plan.css"> -->
<style>
  
/* product css */
.product-card {
  border: 1px solid #ddd;
  border-radius: 10px;
  padding: 15px;
  transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
  text-align: center;
  background-color: #fff;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: space-between;
  height: 100%;
}

.product-card:hover {
  transform: scale(1.05);
  box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
}

.product-card img {
  /* width: 100%; */
  height: 200px;
  object-fit: cover;
  margin-bottom: 15px;
  border-radius: 10px;
}

.product-card h4 {
  font-size: 18px;
  font-weight: bold;
  margin-bottom: 10px;
}

.product-card p {
  font-size: 16px;
  color: #555;
  margin-bottom: 15px;
}

.add-to-cart-btn {
  background-color: #28a745;
  color: white;
  padding: 10px 20px;
  border-radius: 5px;
  border: none;
  font-size: 16px;
  cursor: pointer;
  transition: background-color 0.3s ease;
  width: 100%;
}

.add-to-cart-btn:hover {
  background-color: #218838;
}

.row {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
}

.col-lg-4, .col-md-6, .col-sm-12 {
  display: flex;
  justify-content: center;
}
</style>
</head>

<body>

  <!-- Navigation -->
  <?php include "include/nav.php"; ?>


  <!-- Products Section -->
  <section class="section element-animate">
    <div class="container">
      <div class="row">
      <div class="col-md-12">
                <?php
                $cate = $_GET['category'] ;
                include 'admin/dbcon.php';
                $sql2 = "select pc.name AS category_name from products p,product_categories pc where pc.id=p.category_id AND pc.id=$cate";
                $result2 = mysqli_query($con, $sql2);
                if (mysqli_num_rows($result2) > 0) {
                    $row2 = mysqli_fetch_assoc($result2);
                ?>
                    <ol class="breadcrumb">
                        <li><a href="index.php">Home </a> / </li> 
                        <li><a href="gallery.php"> <?php echo $row2['category_name']; ?></a></li>
                    </ol>
                <?php
                } else {
                    echo '<div class="error-message">Category Not Found</div>';
                }
                ?>
            </div>
        <?php
        include 'admin/dbcon.php';
        $category = $_GET['category'] ?? '';
        $sql = "SELECT * FROM products WHERE category_id = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("i", $category);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
          while ($product = $result->fetch_assoc()) {
        ?>
            <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
              <a href="single_product.php?pid=<?=$product['id']?>">

                <div class="product-card product-content">
                  <img src="admin/uploads/products/<?= $product['image'] ?>" alt="<?= $product['name'] ?>" class="img-fluid">
                  <h4><?= substr($product['name'],0,50),'...' ?></h4>
                  <p>Price: Rs.<?= number_format($product['price'], 2) ?></p>
                  <form action="" method="POST" style="width: 100%;">
                    <input type="hidden" class="quantity-input" name="qty" value="1">
                    <input type="hidden" name="product_name" value="<?= $product['name'] ?>">
                    <input type="hidden" name="product_price" value="<?= $product['price'] ?>">
                    <button type="submit" class="add-to-cart-btn addTocart"  value="<?= $product['id']?>"><i class="fa-solid fa-cart-shopping"></i> Add to Cart</button>

                  </form>
                </div>
              </a>
            </div>
        <?php
          }
        } else {
          echo "<div class='col-12'><p class='text-center'>No products available in this category.</p></div>";
        }
        ?>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <?php include "include/footer.php"; ?>

</body>

</html>