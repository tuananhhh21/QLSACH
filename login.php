<?php
// Kết nối đến cơ sở dữ liệu
$servername = "mysql-3ef37b68-iamtanh-21.l.aivencloud.com";
$username = "avnadmin";
$password = "AVNS_Kq5b35n5qXaxFcNv6nw";
$database = "defaultdb";
$port = 22133;

try {
    $conn = new PDO("mysql:host=$servername;port=$port;dbname=$database", $username, $password);
    // Thiết lập chế độ báo lỗi và chế độ tùy chỉnh
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Kết nối cơ sở dữ liệu thất bại: " . $e->getMessage();
}

// Đăng nhập
if(isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM User WHERE TenUser = :username AND MatKhau = :password");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
    $stmt->execute();

    if($stmt->rowCount() > 0) {
        // Đăng nhập thành công, chuyển hướng người dùng đến trang "sach.php"
        header("Location: ../View/sach.php");
        exit(); // Dừng script để đảm bảo không có mã HTML nào khác được thực thi
    } else {
        echo "Tên đăng nhập hoặc mật khẩu không đúng!";
    }
}


?>

