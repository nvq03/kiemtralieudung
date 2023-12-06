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

.text1 {

display: block;
color: black;
width: 115px;
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
    font-size: 18px;
font-weight: 700;
color: green;
text-align: center;
text-decoration: none;
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
width: 100px;
font-size: 18px;
font-weight: 700;
color: green;
text-align: center;
text-decoration: none;

}

.medicine {
        display: flex;
        flex-direction: row;
        align-items: center;
        border: 1px solid #000;
        border-radius: 15px;
    }

.medicine label,
.medicine p {
        margin-right: 10px;
    }

</style>


<?php
include("connect.php");

if (isset($_GET['id'])) {
    $id_get = $_GET['id'];
} else {
    echo "không thấy id";
}
echo $id_get;


$sql = "SELECT pd.id, pd.dose as dose, pd.frequency as frequency, pd.quantity as quantity , d.name AS doctor_name, p.name AS patient_name, m.name AS medicine_name, m.dosemin as dosemin, m.dosemax as dosemax, m.frequency as frequencymax, pr.date
FROM prescription_detail pd
INNER JOIN prescription pr ON pd.idprescription = pr.id
INNER JOIN doctor d ON pr.iddoctor = d.id
INNER JOIN patient p ON pr.idpatient = p.id
INNER JOIN medicine m ON pd.idmedicine = m.id
WHERE pd.id = $id_get";
 $kedon = $mysqli->query($sql);

if ($kedon->num_rows > 0) {
    // Lặp qua từng dòng kết quả và lấy giá trị id
    while ($row = $kedon->fetch_assoc()) {
        $id = $row['id'];
        $doctorName = $row['doctor_name'];
        $patientName = $row['patient_name'];
        $medicineName = $row['medicine_name'];
        $dose = $row['dose'];
        $frequency = $row['frequency'];
        $quantity = $row['quantity'];
    }
} else {
    echo "Không có kết quả.";
}

// Kiểm tra xem người dùng đã nhấn nút "Cập nhật" hay chưa
if (isset($_POST['sua'])) {
    // Lấy dữ liệu từ form
    $doctorname = $_POST['doctor'];
    $patientname = $_POST['patient'];
    $medicinename = $_POST['name_medicine'];
    $doseu = $_POST['dose'];
    $frequencyu = $_POST['frequency'];
    $quantityu = $_POST['quantity'];

    // Kiểm tra và gán giá trị mặc định nếu dữ liệu trống
    if (empty($doctorname)) {
        $doctorname = $doctorName;
    }
    if (empty($patientname)) {
        $patientname = $patientName;
    }
    if (empty($medicinename)) {
        $medicinename = $medicineName;
    }
    if (empty($doseu)) {
        $doseu = $dose;
    }
    if (empty($frequencyu)) {
        $frequencyu = $frequency;
    }
    if (empty($quantityu)) {
        $quantityu = $quantity;
    }

    $sql = "UPDATE prescription_detail pd
        INNER JOIN prescription pr ON pd.idprescription = pr.id
        INNER JOIN doctor d ON pr.iddoctor = d.id
        INNER JOIN patient p ON pr.idpatient = p.id
        INNER JOIN medicine m ON pd.idmedicine = m.id
        SET pd.dose = '$doseu', pd.frequency = '$frequencyu', pd.quantity = '$quantityu',
            d.name = '$doctorname', p.name = '$patientname', m.name = '$medicinename'
        WHERE pd.id = $id_get";
    $result = $mysqli->query($sql);
    // Kiểm tra kết quả của các câu truy vấn
    if ($result) {
        echo "Cập nhật dữ liệu thành công.";
        header("Location: index.php?page=lichsu");
    } else {
        echo "Lỗi trong quá trình cập nhật dữ liệu: ". $mysqli->error;
    }
}
?>
<main>
    <form method="post" action="" style="height: 600px; padding: 20px;">
        <h2>Sửa lại thông tin kê đơn</h2><br>
        <div class="form-row">
        <label for="tenthuoc">Tên Bác sĩ  </label>
        <input class="input1" type="text" id="tenthuoc" placeholder="<?php echo $doctorName ?>" name="doctor">
        </div>
        <div class="form-row">
        <label for="dose">Bệnh nhân</label>
        <input class="input1" type="text" placeholder="<?php echo $patientName ?>" id="dose" name="patient">
        </div>
        <div class="form-row">
        <label for="lan">Tên thuốc</label>
        <input class="input1" type="text" placeholder="<?php echo $medicineName ?>" id="lan" name="name_medicine">
        </div>
        <div class="form-row">
        <label for="lan">Liều dùng</label>
        <input class="input1" type="text" placeholder="<?php echo $dose ?>" id="lan" name="dose">
        </div>
        <div class="form-row">
        <label for="lan">Tần suất</label>
        <input class="input1" type="text" placeholder="<?php echo $frequency ?>" id="lan" name="frequency">
        </div>
        <div class="form-row">
        <label for="lan">Số lượng</label>
        <input class="input1" type="text" placeholder="<?php echo $quantity ?>" id="lan" name="quantity">
        </div>
        <br>
        <input class="button" name="sua" type="submit" value="Cập nhật">
    </form>
</main>