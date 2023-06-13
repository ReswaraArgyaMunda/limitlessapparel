<?php
require 'connect.php';
?>

<?php
function query_products($limit, $type, $sex, $search){


    global $conn; // Menambahkan deklarasi global untuk menggunakan variabel $conn

    $sql = '';

    if($sex == ''){
        $sql = "SELECT * FROM products WHERE name LIKE '%$search%' AND sex LIKE '%$sex%' AND type LIKE '%$type%' LIMIT $limit";
    }
    else{
        $sql = "SELECT * FROM products WHERE name LIKE '%$search%' AND sex ='$sex' AND type LIKE '%$type%' LIMIT $limit";
    }


    $result = $conn->query($sql);
    
    // Menampilkan hasil query products
    if ($result->num_rows > 0) {

        while ($row = $result->fetch_assoc()) {

            $id_product = $row['id'];
            $name_product = $row['name'];
            $type_product = $row['type'];
            $sex_product = $row['sex'];
            $price = number_format($row['price'], 0, ',', '.');
            $stock = $row['stock'];
          
            $product_img = $name_product . ".jpg"; // Nama file gambar dengan ekstensi .png

            echo '<div class="row" onclick="window.location.href=\'product.php?product-id=' . $id_product . '\'">';
            echo '<div class="card">';
            echo '<div class="boxcard">';
            echo '<div class="imgBx">';
            echo '<img src="../assets/image/' . $product_img . '" alt="' . $name_product . '" />';
            echo '</div>';
            echo '<div class="text">';
            echo '<p class="category">' . $type_product . '</p>';
            echo '<label for="check" class="next">';
            echo '<h3>' . $name_product . '</h3>';
            echo '</label>';
            echo '<p class="price">Rp. ' . $price .'</p>';
            echo '</div>';
            echo '<input type="checkbox" id="check" />';
            echo '<div class="contentBx"></div>';
            echo '</div>';
            echo '</div>';
            echo '</div>';

        }
    } 
    else {
        echo '<i style="text-align:center"> <h2> <br> <br> Tidak ada produk untuk saat ini </h2> </i>';
    }
    // Menutup koneksi database

}


function query_product(){
 
      
    global $conn; // Menambahkan deklarasi global untuk menggunakan variabel $conn
    
    $id_product = $_GET['product-id'];

    $sql = "SELECT * FROM products WHERE id = '$id_product' LIMIT 1";

    $result = $conn->query($sql);
    
    // Menampilkan hasil query products
    if ($result->num_rows > 0) {

        while ($row = $result->fetch_assoc()) {

            $id_product = $row['id'];
            $name_product = $row['name'];
            $type_product = $row['type'];
            $sex_product = $row['sex'];
            $price = number_format($row['price'], 0, ',', '.');
            $stock = $row['stock'];
          
            $product_img = $name_product . ".jpg"; // Nama file gambar dengan ekstensi .png

            echo '<div class="product-display">';
            echo '<img src="../assets/image/' . $product_img . '" />';
            echo '</div>';

            echo '<div class="product-info">';
            echo '<div class="buy-form">';
            echo '<p style="text-transform: uppercase">Category: ' . $type_product . '</p>';
            echo '<h2 class="product-name">' . $name_product . '</h2>';
            echo '<p style="text-transform: uppercase; font-size: 13px">Stock: ' . $stock . '</p>';
            echo '<h3 style="font-size: 23px">Rp.' . $price .'</h3>';
            echo '<hr style="margin-bottom: 2rem; margin-top: 1rem;" />';

            echo '<form action="../function/add_product.php" method="POST">';
            echo '<div class="input-form">';

            echo '<select name="size-option" id="size-option" required>';
            echo '<option value="" selected disabled>Size</option>';
            
            echo '<option value="S" >S</option>';
            echo '<option value="M" >M</option>';
            echo '<option value="L" >L</option>';
            echo '<option value="XL" >XL</option>';
            echo '<option value="XXL" >XXL</option>';
            echo '<option value="XXXL" >XXXL</option>';

            echo '</select>';

            echo '<select name="sex-option" id="sex-option" required>';
            echo '<option value="" selected disabled>Sex</option>';
            if($sex_product == 'MALE'){
                echo '<option value="MALE" >MALE</option>';
            }
            else{
                echo '<option value="FEMALE" >FEMALE</option>';
            }
            echo '</select>';

            echo '<select name="color-option" id="color-option" required>';
            echo '<option value="" selected disabled>Color</option>';
            echo '<option value="Ori"> ORIGINAL </option>';
            echo  '</select>';

            echo '</div>';

            
            echo '<div class="input-form-2">';
            echo '<label for="" style="font-weight: 200; font-size: 18px">Quantity:</label>';
            echo '<input type="number" min="0" max="100" value="1" id="qty-input" name="product-qty">';
            echo '<hr style="margin-top: 2rem; margin-bottom: 1rem;" />';
            echo '</div>';

            echo '<p style="display: none" id="price-temp">'. $row['price'] .'</p>';
            echo '<input type="text" name="username-session" value="' . $_SESSION['session_username'] . '" style="display:none;">';
            echo '<input type="text" name="product-id" value="' . $id_product . '" style="display:none;">';

            echo '<div class="total-price" id="total-price">';
            echo '<p style="text-align: right; font-weight:600; font-size:18px;">Total: <span id="total-price-value">Rp.' . $price . '</span></p>';
            echo '</div>';

            echo '<div class="button-submit">';
            echo '<button class="btn-2" onclick="window.history.back()">BACK</button>';
            echo '<button class="btn-2" type="submit" value="submit" name="submit">NEXT</button>';
            echo '</div>';

       

            echo '</form>';
            echo '</div>';
            echo '</div>';


        }
    } 
    else {
        echo '<i style="text-align:center"> <h2> <br> <br> Produk Tidak Ditemukan </h2> </i>';
    }


}



function query_cart($username) {
    global $conn;
    
    $sql = "SELECT cart.id, cart.user_id, cart.product_id, cart.size, cart.sex, cart.color, cart.quantity, 
    products.name, products.type, products.price, (products.price * cart.quantity) as total_price 
    FROM cart 
    INNER JOIN products ON (cart.product_id = products.id) 
    WHERE cart.user_id = (SELECT id FROM users WHERE username='$username')";

    $result = $conn->query($sql);
    
    // Display the query results
    if ($result->num_rows > 0) {
        echo '<div class="col-lg-8">';
        echo '<div class="p-5">';
        echo '<div class="d-flex justify-content-between align-items-center mb-5">';
        echo '<h1 class="fw-bold mb-0 text-black">Shopping Cart</h1>';
        echo '</div>';

        while ($row = $result->fetch_assoc()) {
            $cart_id = $row['id'];
            $product_name = $row['name'];
            $type = $row['type'];
            $quantity = $row['quantity'];
            $total_price = number_format($row['total_price'], 0, ',', '.');
            $product_img = $product_name . ".jpg"; 

            echo '<hr class="my-4">';
            echo '<div class="row mb-4 d-flex justify-content-between align-items-center">';
            echo '<div class="col-md-2 col-lg-2 col-xl-2">';
            echo '<img src="../assets/image/' . $product_img . '" class="img-fluid rounded-3" alt="' . $product_name . '">';
            echo '</div>';
            echo '<div class="col-md-3 col-lg-3 col-xl-3">';
            echo '<h6 class="text-muted">' . $type . '</h6>';
            echo '<h6 class="text-black mb-0">' . $product_name . '</h6>';
            echo '</div>';
            echo '<div class="col-md-3 col-lg-3 col-xl-2 d-flex">';
            echo '<button class="btn btn-link px-2" onclick="this.parentNode.querySelector(\'input[type=number]\').stepDown()"><i class="fas fa-minus"></i></button>';
            echo '<input id="form1" min="0" name="quantity" value="' . $quantity . '" type="number" class="form-control form-control-sm" disabled/>';
            echo '<button class="btn btn-link px-2" onclick="this.parentNode.querySelector(\'input[type=number]\').stepUp()"><i class="fas fa-plus"></i></button>';
            echo '</div>';
            echo '<div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">';
            echo '<h6 class="mb-0">Rp. ' . $total_price . '</h6>';
            echo '</div>';
            
            echo '<div class="col-md-1 col-lg-1 col-xl-1 text-end">';
            echo '<a href="../function/remove_product.php?id-cart=' . $cart_id .'&username=' . $username . '" class="text-muted"><ion-icon style="font-size:23px" name="trash"></ion-icon></a>';
            echo '</div>';

            echo '</div>';
        }

        $sql2 = "SELECT sum(cart.quantity) as total_quantity, sum((products.price * cart.quantity)) as total_price FROM cart INNER JOIN products ON (cart.product_id = products.id) WHERE cart.user_id = (SELECT id FROM users WHERE username='$username')";
        $result2 = $conn->query($sql2);

        while ($row2 = $result2->fetch_assoc()) {
            $total_quantity = $row2['total_quantity'];
            $total_price = number_format($row2['total_price'], 0, ',', '.');

            echo '<hr class="my-4">';
            echo '<div class="pt-5">';
            echo '<h6 class="mb-0"><a href="products.php" class="text-body"><i class="fas fa-long-arrow-alt-left me-2"></i>Back to shop</a></h6>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '<div class="col-lg-4 bg-grey">';
            echo '<div class="p-5">';
            echo '<h3 class="fw-bold mb-5 mt-2 pt-1">Summary</h3>';
            echo '<hr class="my-4">';

            echo '<div class="d-flex justify-content-between mb-4">';
            echo '<h5 class="text-uppercase">Total items</h5>';
            echo '<h5>' . $total_quantity . '</h5>';
            echo '</div>';

            echo '<h5 class="text-uppercase mb-3">Shipping</h5>';
            echo '<div class="mb-4 pb-2">';
            echo '<select class="select">';
            echo '<option value="1">Standard-Delivery- Rp.50.000</option>';
            echo '<option value="2">Same-Day Rp.60.0000</option>';
            echo '<option value="3">Work-Day Rp.40.000</option>';
            echo '</select>';
            echo '</div>';

            echo '<hr class="my-4">';

            echo '<div class="d-flex justify-content-between mb-5">';
            echo '<h5 class="text-uppercase">Total price</h5>';
            echo '<h5>Rp.' . $total_price . '</h5>';
            echo '</div>';

            echo '<button type="button" class="btn btn-dark btn-block btn-lg" data-mdb-ripple-color="dark">Next</button>';
            echo '</div>';
            echo '</div>';
        }
    } else {
        echo '<i style="text-align:center"> <h2> <br> <br> Tidak ada produk dalam keranjang </h2> </i>';
    }
}

?>
