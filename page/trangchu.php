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
</style>


<?php
include("connect.php");


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($doctor_name) || empty($patient_name)) {
        echo "Vui lòng điền đầy đủ thông tin bác sĩ và bệnh nhân.";
    } else {
        // Kiểm tra xem tên bác sĩ và tên bệnh nhân có phải là chuỗi ký tự không
        if (!preg_match("/^[a-zA-Z ]*$/", $doctor_name) || !preg_match("/^[a-zA-Z ]*$/", $patient_name)) {
            echo "Vui lòng chỉ nhập các ký tự chữ cái và khoảng trắng.";
        } 
    }
    // Lấy dữ liệu từ biểu mẫu
    $doctor_name = $_POST["doctor-name"];
    $patient_name = $_POST["patient-name"];

    // Tạo truy vấn INSERT để chèn dữ liệu vào bảng doctor
    $sql_doctor = "INSERT INTO doctor (name) VALUES ('$doctor_name')";
    $doctor = $mysqli->query($sql_doctor);

    // Kiểm tra xem truy vấn INSERT cho bảng doctor có thành công hay không
    if ($doctor === TRUE) {
        // Lấy id của bác sĩ vừa được chèn
        $doctor_id = $mysqli->insert_id;

        // Tạo truy vấn INSERT để chèn dữ liệu vào bảng patient
        $sql_patient = "INSERT INTO patient (name) VALUES ('$patient_name')";
        $patient = $mysqli->query($sql_patient);

        // Kiểm tra xem truy vấn INSERT cho bảng patient có thành công hay không
        if ($patient === TRUE) {
            // Lấy id của bệnh nhân vừa được chèn
            $patient_id = $mysqli->insert_id;

            // Lấy ngày hiện tại
            $date = date("Y-m-d");

            // Tạo truy vấn INSERT để chèn dữ liệu vào bảng prescription
            $sql_prescription = "INSERT INTO prescription (iddoctor, idpatient, date) VALUES ('$doctor_id', '$patient_id', '$date')";
            $prescription = $mysqli->query($sql_prescription);


            // Kiểm tra xem truy vấn INSERT cho bảng prescription có thành công hay không
            if ($prescription === TRUE) {
                header("Location: index.php?page=main");
                exit; // Thêm lệnh exit để dừng thực thi mã PHP
            } else {
                echo "Lỗi: " . $sql_prescription . "<br>" . $mysqli->error;
            }
        } else {
            echo "Lỗi: " . $sql_patient . "<br>" . $mysqli->error;
        }
    } else {
        echo "Lỗi: " . $sql_doctor . "<br>" . $mysqli->error;
    }
}
?>

<main>
    <form method="post" action="#" style="height: 460px; padding: 20px;">
        <h2>Điền thông tin bệnh nhân</h2><br>
        <label for="doctor-name">Tên bác sĩ</label>
        <input class="input1" type="text" placeholder="Nhập Tên" id="doctor-name" name="doctor-name" required><br>
        <label for="patient-name">Tên bệnh nhân</label>
        <input class="input1" type="text" placeholder="Nhập Tên" id="patient-name" name="patient-name" required><br>
        <br>
        <input class="button" type="submit" value="Tiếp theo">
    </form>
</main>