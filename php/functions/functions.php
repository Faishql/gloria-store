<?php 

$conn = mysqli_connect( 'localhost', 'root', '', 'gloria_store');

function read($query) {
    global $conn;
    $result = mysqli_query( $conn, $query);
    
    while ( $row = mysqli_fetch_assoc($result) ) {
        $rows[] = $row;
    }
    
    return $rows;
}

// function popular($query) {
//     global $conn;
//     $result = mysqli_query( $conn, $query);
    
//     for ( $i = 0; i) {

//         $rows[] = $row;
//     }
    
//     return $rows;
// }

function create($data) {

    global $conn;
    // var_dump($data);die;

    $name = htmlspecialchars($data['name']);
    $price = htmlspecialchars($data['price']);
    $desc = htmlspecialchars($data['desc']);

    $img = upload();
    if ( !$img ) {
        return false;
    }

    $query = mysqli_query( $conn, "INSERT INTO products VALUES( '', '$name', $price, '$img', '$desc', NOW() )");

    return mysqli_affected_rows($conn);
}

function upload() {

    global $conn;

    $imgName = $_FILES['img']['name'];
    $imgType = $_FILES['img']['type'];
    $imgTmpName = $_FILES['img']['tmp_name'];
    $error = $_FILES['img']['error'];
    $imgSize = $_FILES['img']['size'];

    // check error
    if ( $error === 4 ) {
        echo "
            <script>
                alert('input a product image');
            </script>
        ";
        return false;
    }

    // check size
    if ( $imgSize > 1000000 ) {
        echo "
            <script>
                alert('your file is to large');
            </script>
        ";
        return false;
    }

    // check file type
    $validType = ['jpg', 'jpeg', 'png'];
    $imgType = explode('/', $imgType);
    $imgType = strtolower(end($imgType));
    // var_dump($imgType);die;
    if ( !in_array( $imgType, $validType)) {
        echo "
            <script>
                alert('your file type is not valid');
            </script>
        ";
        return false;
    }

    // generate new file name
    $newImgName = uniqid();
    $newImgName .= '.';
    $newImgName .= $imgType;
    // var_dump($newImgName);die;

    move_uploaded_file( $imgTmpName, '../img/' . $newImgName);

    return $newImgName;
    
     
}

function delete($id, $db) {

    global $conn;

    $query = mysqli_query( $conn, " DELETE FROM $db WHERE id = $id");

    return mysqli_affected_rows($conn);
}

function update($data) {

    global $conn;
    // var_dump($data);die;

    $id = $data['id'];
    $oldImg = htmlspecialchars($data['oldImg']);
    $name = htmlspecialchars($data['name']);
    $price = htmlspecialchars($data['price']);
    $desc = htmlspecialchars($data['desc']);

    
    
    if ( $_FILES['img']['error'] === 4 ) {
        $img = $oldImg;
    } else {
        $img = upload();
        if ( !$img ) {
            echo"<script>error</script>"; 
        }
    }
    
    

    $query = "UPDATE products SET id = '', product_name = '$name', price = $price, img = '$img', product_desc = '$desc', created = NOW() WHERE id = '$id'"  or die(mysqli_error($conn));
    $result = mysqli_query( $conn, $query);
    

    return mysqli_affected_rows($conn);
    
}

function encryptTb($name) {
     // Store the cipher method
    $encryption_iv = '1234567891011121';
    $ciphering = "AES-128-CTR";
    $encryption_key = "secretkey";
    // Use OpenSSl Encryption method
    $iv_length = openssl_cipher_iv_length($ciphering);
    $options = 0;
    return openssl_encrypt($name,$ciphering, $encryption_key, $options, $encryption_iv);
}

function decryptTb($enc) {
    $encryption_iv = '1234567891011121';
    $ciphering = "AES-128-CTR";
    $encryption_key = "secretkey";
    // Use OpenSSl Encryption method
    $iv_length = openssl_cipher_iv_length($ciphering);
    $options = 0;
    $decryption_iv = random_bytes($iv_length);
    // Store the decryption key
    $decryption_key = openssl_digest(php_uname(), 'MD5', TRUE);

    $dcr = openssl_decrypt($enc, $ciphering, $encryption_key, $options, $encryption_iv);
    return $dcr;
}

?>