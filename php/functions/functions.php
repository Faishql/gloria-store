<?php

$conn = mysqli_connect("localhost", "root", "", "gloria_store");

function read($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}

function create($data)
{
    global $conn;
    // var_dump($data);die;

    $name = htmlspecialchars($data["name"]);
    $price = htmlspecialchars($data["price"]);
    $desc = htmlspecialchars($data["desc"]);

    $img = upload();
    if (!$img) {
        return false;
    }

    $query = mysqli_query($conn, "INSERT INTO products VALUES( '', '$name', $price, '$img', '$desc', NOW() )");

    return mysqli_affected_rows($conn);
}

function upload()
{
    global $conn;

    $imgName = $_FILES["img"]["name"];
    $imgType = $_FILES["img"]["type"];
    $imgTmpName = $_FILES["img"]["tmp_name"];
    $error = $_FILES["img"]["error"];
    $imgSize = $_FILES["img"]["size"];

    // check error
    if ($error === 4) {
        echo "
            <script>
                alert('input a product image');
            </script>
        ";
        return false;
    }

    // check size
    if ($imgSize > 1000000) {
        echo "
            <script>
                alert('your file is to large');
            </script>
        ";
        return false;
    }

    // check file type
    $validType = ["jpg", "jpeg", "png"];
    $imgType = explode("/", $imgType);
    $imgType = strtolower(end($imgType));
    // var_dump($imgType);die;
    if (!in_array($imgType, $validType)) {
        echo "
            <script>
                alert('your file type is not valid');
            </script>
        ";
        return false;
    }

    // generate new file name
    $newImgName = uniqid();
    $newImgName .= ".";
    $newImgName .= $imgType;
    // var_dump($newImgName);die;

    move_uploaded_file($imgTmpName, "../img/" . $newImgName);

    return $newImgName;
}

function delete($id, $db)
{
    global $conn;

    $query = mysqli_query($conn, " DELETE FROM $db WHERE id = $id");

    return mysqli_affected_rows($conn);
}

function update($data)
{
    global $conn;
    // var_dump($data);die;

    $id = $data["id"];
    $oldImg = htmlspecialchars($data["oldImg"]);
    $name = htmlspecialchars($data["name"]);
    $price = htmlspecialchars($data["price"]);
    $desc = htmlspecialchars($data["desc"]);

    if ($_FILES["img"]["error"] === 4) {
        $img = $oldImg;
    } else {
        $img = upload();
        if (!$img) {
            echo "<script>error</script>";
        }
    }

    ($query = "UPDATE products SET id = '', product_name = '$name', price = $price, img = '$img', product_desc = '$desc', created = NOW() WHERE id = '$id'") or die(mysqli_error($conn));
    $result = mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function encryptTb($name)
{
    // Store the cipher method
    $encryption_iv = "1234567891011121";
    $ciphering = "AES-128-CTR";
    $encryption_key = "secretkey";
    // Use OpenSSl Encryption method
    $iv_length = openssl_cipher_iv_length($ciphering);
    $options = 0;
    return openssl_encrypt($name, $ciphering, $encryption_key, $options, $encryption_iv);
}

function decryptTb($enc)
{
    $encryption_iv = "1234567891011121";
    $ciphering = "AES-128-CTR";
    $encryption_key = "secretkey";
    // Use OpenSSl Encryption method
    $iv_length = openssl_cipher_iv_length($ciphering);
    $options = 0;
    $decryption_iv = random_bytes($iv_length);
    // Store the decryption key
    $decryption_key = openssl_digest(php_uname(), "MD5", true);

    $dcr = openssl_decrypt($enc, $ciphering, $encryption_key, $options, $encryption_iv);
    return $dcr;
}

function getProducts()
{
    $newArrivals = read(" SELECT * FROM products ORDER BY created DESC LIMIT 4");

    // var_dump($carts);
    // die();

    $temp = [];

    for ($i = 0; $i <= count($newArrivals); $i++) {
        if ($i % 2 === 0) {
            $temp[] = [array_slice($newArrivals, $i, 2)];
        }
    }

    return $temp;
}

function getCarts()
{
    global $conn;

    $id_user = $_SESSION["id"];

    $result = mysqli_query($conn, "SELECT carts.id_cart, products.product_name, products.price, products.img, carts.quantity FROM carts INNER JOIN products ON carts.id_product = products.id INNER JOIN user ON carts.id_user = user.id WHERE carts.id_user = $id_user");

    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    if (isset($rows)) {
        return $rows;
    } else {
        return null;
    }
}

function addCart($data)
{
    // var_dump($data[1]);
    // die();
    global $conn;

    $id_user = htmlspecialchars($data["id_user"]);
    $id_product = htmlspecialchars($data["id_product"]);
    $quantity = htmlspecialchars($data["quantity"]);

    $result = mysqli_query($conn, "SELECT carts.id_cart, products.product_name, products.price, products.img, carts.quantity FROM carts INNER JOIN products ON carts.id_product = products.id INNER JOIN user ON carts.id_user = user.id WHERE products.id = $id_product AND user.id = $id_user");
    $fetch = mysqli_fetch_assoc($result);

    if (mysqli_num_rows($result) === 1) {
        $id_cart = $fetch["id_cart"];
        $final_quantity = $fetch["quantity"] + $quantity;
        if ($final_quantity > 20) {
            return "too much";
        } else {
            $query = mysqli_query($conn, "UPDATE carts SET quantity = $final_quantity WHERE carts.id_cart = $id_cart");
        }
    } else {
        $query = mysqli_query($conn, "INSERT INTO carts VALUES( '', $id_user, $id_product, $quantity)");
    }
    return mysqli_affected_rows($conn);
}

// function checkout()
// {
// }

function delCart($data)
{
    global $conn;

    $id_cart = $data["id_cart"];

    $query = mysqli_query($conn, " DELETE FROM carts WHERE id_cart = $id_cart");

    return mysqli_affected_rows($conn);
}

function clearCart($data)
{
    global $conn;

    $id_user = $data["id_user"];

    $query = mysqli_query($conn, " DELETE FROM carts WHERE id_user = $id_user");

    return mysqli_affected_rows($conn);
}

?>
