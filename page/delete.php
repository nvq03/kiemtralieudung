<?php 

include("connect.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    echo "không thấy id";
}

$sql = "DELETE FROM prescription_detail WHERE id = $id";
$delete = $mysqli->query($sql);

if ($delete) {
    header("Location: index.php?page=lichsu");
    exit; // Đảm bảo dừng thực thi mã sau khi chuyển hướng
} else {
    echo "Lỗi khi xóa dữ liệu.";
}



?>