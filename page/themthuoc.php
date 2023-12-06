<style>
  .input1 {
    width: 300px;
    padding: 12px 10px;
    border-radius: 10px;
  }
</style>

<?php 
include "connect.php"; // Đường dẫn tới tệp kết nối cơ sở dữ liệu

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Lấy dữ liệu từ biểu mẫu
  $namemedicine = $_POST["fname"];
  $dosemax = $_POST["dosemax"];
  $dosemin = $_POST["dosemin"];
  $frequency = $_POST["frequency"];

  // Tạo truy vấn INSERT để chèn dữ liệu vào bảng medicine
  $sql = "INSERT INTO medicine (name, dosemax, dosemin, frequency)
          VALUES ('$namemedicine', '$dosemax', '$dosemin', '$frequency')";

  if ($mysqli->query($sql) === TRUE) {
      header("Location: index.php");
  } else {
      echo "Lỗi: " . $sql . "<br>" . $mysqli -> error;
  }
}

?>

<main>
  <form method="post" action="#" style="height: 600px; padding: 20px;">
    <h2>Điền thông tin thuốc</h2><br>
    <label for="fname">Tên thuốc</label>
    <input class="input1" type="text" placeholder="Nhập tên thuốc" id="name" name="fname"><br>
    <label for="lname">Liều dùng tối đa</label>
    <input class="input1" type="text" placeholder="Nhập liều dùng tối đa" id="dosemax" name="dosemax"><br>
    <label for="lname">Liều dùng tối thiểu</label>
    <input class="input1" type="text" placeholder="Nhập liều dùng tối thiểu" id="dosemin" name="dosemin"><br>
    <label for="lname">Tần suất Tối Đa</label>
    <input class="input1" type="text" placeholder="Nhập tần suất dùng" id="frequency" name="frequency"><br>
      <input class="button" type="submit" value="Thêm thuốc">
  </form>
</main>