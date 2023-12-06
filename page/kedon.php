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

.name {

display: block;
color: black;
width: 130px;
font-size: 18px;
font-weight: 700;
color: green;
text-align: center;
text-decoration: none;

}

.row {
  display: flex;
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

$sql = "SELECT pd.id, pd.dose as dose, pd.frequency as frequency, pd.quantity as quantity , d.name AS doctor_name, p.name AS patient_name, m.name AS medicine_name, m.dosemin as dosemin, m.dosemax as dosemax, m.frequency as frequencymax, pr.date
FROM prescription_detail pd
INNER JOIN prescription pr ON pd.idprescription = pr.id
INNER JOIN doctor d ON pr.iddoctor = d.id
INNER JOIN patient p ON pr.idpatient = p.id
INNER JOIN medicine m ON pd.idmedicine = m.id";
 $kedon = $mysqli->query($sql);

if ($kedon->num_rows > 0) {
    // Lặp qua từng dòng kết quả và lấy giá trị id
    while ($row = $kedon->fetch_assoc()) {
        $id = $row['id'];
        $doctorName = $row['doctor_name'];
        $patientName = $row['patient_name'];
        $medicineName = $row['medicine_name'];
        $dosemin = $row['dosemin'];
        $dosemax = $row['dosemax'];
        $frequencymax = $row['frequencymax'];
        $dose = $row['dose'];
        $frequancy = $row['frequency'];
        $quantity = $row['quantity'];
        $date = $row['date'];
    }
} else {
    echo "Không có kết quả.";
}

$mysqli->close();
?>
<main>
    <form method="post" action="index.php?page=lichsu" style="height: 600px; padding: 20px;">
        <h2>Chi tiết kê đơn</h2><br>
        <div class="row">
        <div class="column" style="margin-left: 40px;margin-right: 40px;">
            <label class="text1" style="font-size: 18px;font-weight: 700;width: 130px;" for="doctor-name">Tên bác sĩ</label>
            <span class="name"><?php echo "$doctorName" ?></span>
        </div>
        <div class="column"style="margin-left: 40px;margin-right: 40px;">
            <label class="text1" style="font-size: 18px;font-weight: 700;width: 130px;" for="patient-name">Tên bệnh nhân</label>
            <span class="name"><?php echo "$patientName" ?></span>
        </div>
        </div><br>
        <label>Thông tin liều dùng: </label><br>
        <div class="medicine">
        <p class="text1">Tên thuốc:</p><p class="text"><?php echo "$medicineName" ?></p>|
        <p class="text1">Liều dùng min:</p><p class="text"><?php echo "$dosemin" ?>mg</p>|
        <p class="text1">Liều dùng max:</p><p class="text"><?php echo "$dosemax" ?>mg</p>|
        <p class="text1">Tần suất max:</p><p class="text"><?php echo "$frequencymax" ?> lần</p>
        </div>
        <br>
        <div class="medicine">
        <p class="text1">Liều dùng:</p><p class="text"><?php echo "$dose" ?>mg</p>|
        <p class="text1">Tần Suất:</p><p class="text"><?php echo "$frequancy" ?> lần</p>|
        <p class="text1">Số lượng:</p><p class="text"><?php echo "$quantity" ?></p>
        </div><br>
        <h3> Ngày kê đơn: <?php echo $date; ?></h3>
        <br> <br>
        <input class="button" type="submit" value="Kê Đơn">
    </form>
</main>