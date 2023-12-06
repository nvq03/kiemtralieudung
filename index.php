<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/themthuoc.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Trang chủ</title>
</head>
<body>
    

    <?php 
     include("connect.php");
    ?>

<?php
include("page/navbar.php");

// Kiểm tra và hiển thị phần tương ứng
if (isset($_GET['page'])) {
    $page = $_GET['page'];
    
    switch ($page) {
        case 'trangchu':
            include("page/trangchu.php");
            break;
        case 'main':
            include("page/main.php");
            break;
        case 'ktld':
                include("page/ktld.php");
                break;
        case 'themthuoc':
            include("page/themthuoc.php");
            break;
        case 'kedon':
            include("page/kedon.php");
            break;
        case 'lichsu':
            include("page/lichsu.php");
            break;
        case 'timkiem':
                include("page/timkiem.php");
                break;
        case 'delete':
                include("page/delete.php");
                break;
        case 'edit':
                include("page/edit.php");
                break;
        case 'checkdose':
                include("page/checkdose.php");
                break;
        default:
            // Trang mặc định khi không khớp với bất kỳ trang nào
            include("page/main.php");
            break;
    }
} else {

  include("page/trangchu.php");

}

include("page/footer.php");
?>
    
</body>
</html>