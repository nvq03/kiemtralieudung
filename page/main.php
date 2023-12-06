<style>
    .dialog {
    position: fixed;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    z-index: 10;
    display: flex;
    align-items: center;
    justify-content: center;
    visibility: hidden;
    opacity: 0;
    transition: opacity linear 0.2s;
    z-index: 9999;
}

.input {
    width: 150px;
    padding: 12px 20px;
    margin: 8px 0;
    border-radius: 15px;
    box-sizing: border-box;
  }

.overlay-close {
    position: absolute;
    width: 100%;
    height: 100%;
    cursor: default;
}

.dialog:target {
    visibility: visible;
    opacity: 1;
}


.overlay {
    background-color: rgba(0, 0, 0, 0.3);
}

.dialog-body {
    max-width: 500px;
    position: relative;
    padding: 16px;
    background-color: #fff;
    z-index: 2;
}

.text {

display: block;
color: black;
width: 150px;
font-size: 16px;
font-weight: 600;
text-align: center;
text-decoration: none;

}

.dialog-close-btn {
    position: absolute;
    top: 2px;
    right: 6px;
    font-size: 35px;
    text-decoration: none;
    color: #333;
}

.input1 {
    width: 300px;
    padding: 12px 20px;
    margin: 8px 0;
    border-radius: 10px;
    box-sizing: border-box;
  }

  .selection {
    width: 200px;
    height: 30px;
  }

  .selection option {
    font-size: 15px;
  }

  .text {

display: block;
color: black;
width: 150px;
font-size: 18px;
font-weight: 700;
color: green;
text-align: center;
text-decoration: none;

}

</style>


<?php
include("connect.php");

$medicine = "SELECT name  FROM medicine";
$name_medicine = $mysqli->query($medicine);

// Truy vấn cơ sở dữ liệu để lấy danh sách thuốc
$sql = "SELECT doctor.name AS doctor_name, patient.name AS patient_name FROM prescription 
        JOIN doctor ON prescription.iddoctor = doctor.id 
        JOIN patient ON prescription.idpatient = patient.id";
$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
    // Lặp qua từng dòng kết quả và lấy giá trị id
    while ($row = $result->fetch_assoc()) {
        $doctor_name = $row['doctor_name'];
        $patient_name = $row['patient_name'];

    }
} else {
    echo "Không có kết quả.";
}

$mysqli->close();
?>
<main>
    <form method="POST" action="index.php?page=ktld" style="height: 460px; padding: 20px;">
        <h2>Điền thông tin bệnh nhân</h2><br>
        <label for="doctor-name">Tên bác sĩ</label>
        <p class="text"><?php echo "$doctor_name" ?></p>
        <label for="patient-name">Tên bệnh nhân</label>
        <p class="text"><?php echo "$patient_name" ?></p>
        <label>Chọn thuốc: </label>
        <br>
        <select class="selection" name="selected-option" id="selected-option">
            <?php
            // Kiểm tra và tạo các tùy chọn từ kết quả truy vấn
            if ($name_medicine->num_rows > 0) {
                while ($row = $name_medicine->fetch_assoc()) {
                    $name = $row['name'];
                    echo "<option value='$name'>$name</option>";
                }
            }
            ?>
        </select>
        <br>
        <br>
        <br>
        <input class="button" type="submit" value="Tiếp theo">
    </form>
</main>



