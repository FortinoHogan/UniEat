<?php

$conn = mysqli_connect("localhost", "root", "", "unieat");

function query($query)
{

    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];

    while ($row = mysqli_fetch_assoc($result)) {

        $rows[] = $row;
    }

    return $rows;
}

// CRUD CUSTOMER
function registerCustomer($data)
{

    global $conn;

    $email = $data['email'];
    $username = $data['username'];
    $phone_number = $data['phoneNumber'];
    $password = mysqli_real_escape_string($conn, $data['password']);
    $confirmPassword = mysqli_real_escape_string($conn, $data['confirmPassword']);

    $result = mysqli_query($conn, "SELECT email FROM customers WHERE email = '$email'");

    if (mysqli_fetch_assoc($result)) {
        echo "
        <script>
            alert('Email sudah terdaftar silahkan login!');
        </script>
        ";
        return false;
    }

    if ($password !== $confirmPassword) {
        echo "
            <script>
                alert('Konfirmasi password tidak sesuai');
            </script>
        ";
        return false;
    }
    $password = password_hash($password, PASSWORD_DEFAULT);

    $last_id_query = mysqli_query($conn, "SELECT id FROM customers ORDER BY id DESC LIMIT 1");
    $last_id_result = mysqli_fetch_assoc($last_id_query);
    $last_id = $last_id_result ? (int)substr($last_id_result['id'], 2) : 0;
    $new_id = "CU" . str_pad($last_id + 1, 3, "0", STR_PAD_LEFT);

    mysqli_query($conn, "INSERT INTO customers VALUES('$new_id', '$username', '$email', '$phone_number', '$password')");

    return mysqli_affected_rows($conn);
}

// CRUD ADMIN
function registerAdmin($data)
{
    global $conn;

    $email = $data['email'];
    $username = $data['username'];
    $phone_number = $data['phoneNumber'];
    $password = 'abcde123';
    $gender = $data['gender'];

    $result = mysqli_query($conn, "SELECT email FROM admins WHERE email = '$email'");

    if (mysqli_fetch_assoc($result)) {
        echo "
        <script>
            alert('Email sudah terdaftar silahkan login!');
        </script>
        ";
        return false;
    }

    $password = password_hash($password, PASSWORD_DEFAULT);

    $last_id_query = mysqli_query($conn, "SELECT id FROM admins ORDER BY id DESC LIMIT 1");
    $last_id_result = mysqli_fetch_assoc($last_id_query);
    $last_id = $last_id_result ? (int)substr($last_id_result['id'], 2) : 0;
    $new_id = "AD" . str_pad($last_id + 1, 3, "0", STR_PAD_LEFT);

    mysqli_query($conn, "INSERT INTO admins VALUES('$new_id', '$username', '$email', '$phone_number', '$gender', '$password')");

    return mysqli_affected_rows($conn);
}

function editAdmin($data)
{
    global $conn;

    $id = $data['id'];
    $username = $data['username'];
    $email = $data['email'];
    $phoneNumber = $data['phoneNumber'];
    $gender = $data['gender'];

    $query = "UPDATE admins SET username = '$username', email = '$email', phone_number = '$phoneNumber', gender = '$gender' WHERE id = '$id'";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function deleteAdmin($id)
{

    global $conn;

    mysqli_query($conn, "DELETE FROM admins WHERE id = '$id'");
    return mysqli_affected_rows($conn);
}

// CRUD TENANT
function upload()
{
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    if ($error === 4) {
        echo "
        <script>
            alert('Logo must be choosen!');
        </script>
        ";
        return false;
    }

    $ekstensiValid = ['jpg', 'jpeg', 'png', 'gif', 'svg'];

    $ekstensigambar = explode('.', $namaFile);
    $ekstensigambar = strtolower(end($ekstensigambar));

    if (!in_array($ekstensigambar, $ekstensiValid)) {
        echo "
        <script>
            alert('Logo is not valid!');
        </script>
        ";
        return false;
    }

    if ($ukuranFile > 2000000) {
        echo "
        <script>
            alert('File size is too large!');
        </script>
        ";
        return false;
    }

    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensigambar;

    move_uploaded_file($tmpName, './styles/images/tenant-logos/' . $namaFileBaru);
    return $namaFileBaru;
}
function registerTenant($data)
{
    global $conn;

    $username = $data['username'];
    $email = $data['email'];
    $phoneNumber = $data['phoneNumber'];
    $password = 'asdas123';

    $gambar = upload();
    if (!$gambar) {
        return false;
    }
    $password = password_hash($password, PASSWORD_DEFAULT);

    $last_id_query = mysqli_query($conn, "SELECT id FROM tenants ORDER BY id DESC LIMIT 1");
    $last_id_result = mysqli_fetch_assoc($last_id_query);
    $last_id = $last_id_result ? (int)substr($last_id_result['id'], 2) : 0;
    $new_id = "TN" . str_pad($last_id + 1, 3, "0", STR_PAD_LEFT);

    $query = "INSERT INTO tenants VALUES ('$new_id','$username', '$email', '$phoneNumber', '$gambar', '$password')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function editTenant($data)
{
    global $conn;
    $id = $data['id'];
    $username = $data['username'];
    $email = $data['email'];
    $phoneNumber = $data['phoneNumber'];

    $query = "UPDATE tenants SET username = '$username', phone_number = '$phoneNumber', email = '$email' WHERE id = '$id'";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function deleteTenant($id)
{

    global $conn;

    mysqli_query($conn, "DELETE FROM tenants WHERE id = '$id'");
    return mysqli_affected_rows($conn);
}

// CRUD CATEGORY
function addCategory($data)
{

    global $conn;

    $category = $data['category'];
    $last_id_query = mysqli_query($conn, "SELECT id FROM categories ORDER BY id DESC LIMIT 1");
    $last_id_result = mysqli_fetch_assoc($last_id_query);
    $last_id = $last_id_result ? (int)substr($last_id_result['id'], 2) : 0;
    $new_id = "CA" . str_pad($last_id + 1, 3, "0", STR_PAD_LEFT);

    $query = "INSERT INTO categories VALUES ('$new_id','$category')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function deleteCategory($id)
{

    global $conn;

    mysqli_query($conn, "DELETE FROM categories WHERE id = '$id'");
    return mysqli_affected_rows($conn);
}

function editCategory($data)
{
    global $conn;

    $id = $data['id'];
    $name = $data['edit-category'];

    $query = "UPDATE categories SET name = '$name' WHERE id = '$id'";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

// CRUD ITEM

function uploadMenu()
{
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];

    if ($error === 4) {
        echo "
        <script>
            alert('Logo must be choosen!');
        </script>
        ";
        return false;
    }

    $ekstensiValid = ['jpg', 'jpeg', 'png', 'gif', 'svg'];

    $ekstensigambar = explode('.', $namaFile);
    $ekstensigambar = strtolower(end($ekstensigambar));

    if (!in_array($ekstensigambar, $ekstensiValid)) {
        echo "
        <script>
            alert('Logo is not valid!');
        </script>
        ";
        return false;
    }

    if ($ukuranFile > 2000000) {
        echo "
        <script>
            alert('File size is too large!');
        </script>
        ";
        return false;
    }

    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensigambar;

    move_uploaded_file($tmpName, './styles/images/menu-logos/' . $namaFileBaru);
    return $namaFileBaru;
}
function addItem($data)
{
    global $conn;

    $name = $data['name'];
    $price = $data['price'];
    $description = $data['description'];
    $tenant_id = $data['tenant_id'];

    $gambar = uploadMenu();
    if (!$gambar) {
        return false;
    }

    $last_id_query = mysqli_query($conn, "SELECT id FROM menus ORDER BY id DESC LIMIT 1");
    $last_id_result = mysqli_fetch_assoc($last_id_query);
    $last_id = $last_id_result ? (int)substr($last_id_result['id'], 2) : 0;
    $new_id = "IT" . str_pad($last_id + 1, 3, "0", STR_PAD_LEFT);

    $query = "INSERT INTO menus VALUES ('$new_id','$name', '$description', '$price', '$gambar', '$tenant_id')";
    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function deleteItem($id)
{
    global $conn;

    mysqli_query($conn, "DELETE FROM menus WHERE id = '$id'");
    return mysqli_affected_rows($conn);
}

// function editUploadMenu($defaultImage)
// {
//     $namaFile = $_FILES['']['name'];
//     $ukuranFile = $_FILES['gambar']['size'];
//     $error = $_FILES['gambar']['error'];
//     $tmpName = $_FILES['gambar']['tmp_name'];

//     if ($error === 4) {
//         echo "
//         <script>
//             alert('Logo must be choosen!');
//         </script>
//         ";
//         return false;
//     }

//     $ekstensiValid = ['jpg', 'jpeg', 'png', 'gif', 'svg'];

//     $ekstensigambar = explode('.', $namaFile);
//     $ekstensigambar = strtolower(end($ekstensigambar));

//     if (!in_array($ekstensigambar, $ekstensiValid)) {
//         echo "
//         <script>
//             alert('Logo is not valid!');
//         </script>
//         ";
//         return false;
//     }

//     if ($ukuranFile > 2000000) {
//         echo "
//         <script>
//             alert('File size is too large!');
//         </script>
//         ";
//         return false;
//     }

//     $namaFileBaru = uniqid();
//     $namaFileBaru .= '.';
//     $namaFileBaru .= $ekstensigambar;

//     move_uploaded_file($tmpName, './styles/images/menu-logos/' . $namaFileBaru);
//     return $namaFileBaru;
// }


// function updateItem($data)
// {
//     global $conn;

//     $id = $data['id'];
//     $name = $data['name'];
//     $price = $data['price'];
//     $description = $data['description'];
//     $defaultImage = './styles/images/menu-logos/' . $data['logo'];
//     $gambar = editUploadMenu($defaultImage);
//     if (!$gambar) {
//         return false;
//     }

//     $query = "UPDATE menus SET name = '$name', price = '$price', description = '$description', logo = '$gambar' WHERE id = '$id'";
//     mysqli_query($conn, $query);

//     return mysqli_affected_rows($conn);
// }