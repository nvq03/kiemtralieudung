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
margin: 5px;

}

.text3 {

display: block;
color: black;
width: 150px;
font-size: 18px;
font-weight: 700;
color: green;
text-align: center;
text-decoration: none;
margin: 5px;

}

.text2 {

color: black;
width: 150px;
font-size: 16px;
font-weight: 600;
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

.medicine-info {
        display: flex;
        justify-content: space-between;
        margin-bottom: 20px;
        margin-left: 60px;
    }

    .medicine {
        text-align: center;
        margin-left: 30px;
        margin-right: 30px;
    }

    label {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }


.input1 {
    width: 300px;
    padding: 12px 20px;
    margin: 8px 0;
    border-radius: 10px;
    box-sizing: border-box;
  }

  .form-row {
  display: flex;
  align-items: center;
  margin-bottom: 10px;
}

.form-row label {
  flex: 1;
  margin-right: 10px;
}

.form-row input {
  flex: 2;
}
  
</style>


<?php
include "connect.php";



$info = "SELECT prescription.id as idp,doctor.name AS doctor_name, patient.name AS patient_name FROM prescription 
        JOIN doctor ON prescription.iddoctor = doctor.id 
        JOIN patient ON prescription.idpatient = patient.id";
$result_info = $mysqli->query($info);

if ($result_info->num_rows > 0) {
    // Lặp qua từng dòng kết quả và lấy giá trị id
    while ($row = $result_info->fetch_assoc()) {
        $doctor_name = $row['doctor_name'];
        $patient_name = $row['patient_name'];
        $idp = $row['idp'];

    }
} else {
    echo "Không có kết quả.";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy giá trị của select được chọn
    $selectedOption = $_POST['selected-option'];
    // echo  $selectedOption;

    // In giá trị đã chọn
    // echo "Bạn đã chọn: " . $selectedOption;
}
// echo  $selectedOption ;

$test = $selectedOption;
$sql = "SELECT dosemin,dosemax,frequency,medicine.name FROM medicine WHERE medicine.name = '$test'"; 
// echo   $sql ;
$result = $mysqli->query($sql); 
$row = $result->fetch_assoc(); 
$dosemin = $row['dosemin']; 
$dosemax = $row['dosemax']; 
$maxlan = $row['frequency'];
$testNew = $row['name'];

// echo $testNew; // 2
$id_medicine1 = null; // Khai báo biến $id_medicine1 với giá trị mặc định

 if (isset($_POST["xacnhan"])) {

    global $id_medicine;
    $dose = $_POST['dose'];
    $lan = $_POST['lan'];
    $quantity = $_POST['quantity'];
    $tenthuocnew = $_POST['tenthuoc'];
    $dosemin = $_POST['dosemin'];
    $dosemax = $_POST['dosemax'];
    $maxlan = $_POST['maxlan'];

    $maxsummg = $dosemax * $maxlan;

    if ($dose > $dosemax || $dose < $dosemin) {
        echo "Lieu luong nam ngoai nguong max min";
        header("Location: index.php?page=checkdose");
        echo $dosemax;
    } elseif ($lan > $maxlan) {
        header("Location: index.php?page=checkdose");
        echo "Lieu luong nam ngoai tan suat toi da cho phep";
    } elseif ($dose * $lan > $maxsummg) {
        header("Location: index.php?page=checkdose");
        echo "Lieu luong vuot qua tong lieu dung cho phep";
    } else {
                    // echo $testNew ;
    // echo "-----------------------";
    $idm = "SELECT id FROM medicine WHERE medicine.name = '$tenthuocnew'  ";
    // echo "Truy vấn : ".$idm ;

    $result_id = $mysqli->query($idm);
    if ($result_id->num_rows > 0) {
        // Lấy giá trị id từ dòng kết quả đầu tiên
        $row = $result_id->fetch_assoc();
        $id_medicine = $row['id'];
        
    } else {
        // sai
        echo "Không có kết quả. Vui lòng kiếm tra lại";
    }
    // echo $id_medicine;
    $id_medicine1 = $id_medicine;
    // print $id_medicine1;

    $sql_insert_prescription_detail = "INSERT INTO prescription_detail (idprescription, idmedicine, dose, frequency, quantity) 
        VALUES ($idp , $id_medicine1, $dose, $lan, $quantity)";
        // echo  $sql_insert_prescription_detail ;

    if ($mysqli->query($sql_insert_prescription_detail) === TRUE) {
        header("Location: index.php?page=kedon");
        echo "ok sucessfully";
    } else {
        echo "Lỗi: " . $sql_insert_prescription_detail . "<br>" . $mysqli->error;
    }
    }
    
}



?>

<main>
    <form method="post" action="" style="height: 630px; padding: 20px;">
    <h2>Bảng kiểm tra liều dùng</h2>
        <h3>Thông tin thuốc</h3>
        <div class="medicine-info">
            <div class="medicine">
                <label>Dose Min</label>
                <input class="text3" style="width: 60px;"type="text" id="dosemin" name="dosemin" value="<?php echo $dosemin ?>" readonly>
            </div>
            <div class="medicine">
                <label>Dose Max</label>
                <input class="text3" style="width: 60px;"type="text" id="dosemax" name="dosemax" value="<?php echo $dosemax ?>" readonly>
            </div>
            <div class="medicine">
                <label>Frequency</label>
                <input class="text3" style="width: 60px;"type="text" id="maxlan " name="maxlan" value="<?php echo $maxlan ?>" readonly>
            </div>
        </div>
        <h3>Nhập liều dùng để kê đơn</h3>
        </div>
<div class="form-row">
  <label for="tenthuoc">Tên Thuốc</label>
  <input class="input1" type="text" id="tenthuoc" name="tenthuoc" value="<?php echo $selectedOption ?>" readonly>
</div>
        <div class="form-row">
  <label for="dose">Liều dùng</label>
  <input class="input1" type="text" placeholder="Nhập Liều dùng" id="dose" name="dose">
</div>
<div class="form-row">
  <label for="lan">Tần suất</label>
  <input class="input1" type="text" placeholder="Nhập tần suất" id="lan" name="lan">
</div>
<div class="form-row">
  <label for="quantity">Số lượng</label>
  <input class="input1" type="text" placeholder="Nhập Số lượng" id="quantity" name="quantity">
  </div>
    <input class="button" type="submit" name="xacnhan" id="xacnhan" value="Tiếp theo">
    </form>

</main>





     <!-- // echo $testNew ;
    // echo "-----------------------";
    $idm = "SELECT id FROM medicine WHERE medicine.name = '$tenthuocnew'  ";
    // echo "Truy vấn : ".$idm ;

    $result_id = $mysqli->query($idm);
    if ($result_id->num_rows > 0) {
        // Lấy giá trị id từ dòng kết quả đầu tiên
        $row = $result_id->fetch_assoc();
        $id_medicine = $row['id'];
        
    } else {
        // sai
        echo "Không có kết quả. Vui lòng kiếm tra lại";
    }
    // echo $id_medicine;
    $id_medicine1 = $id_medicine;
    // print $id_medicine1;

    $sql_insert_prescription_detail = "INSERT INTO prescription_detail (idprescription, idmedicine, dose, frequency, quantity) 
        VALUES ($idp , $id_medicine1, $dose, $lan, $quantity)";
        // echo  $sql_insert_prescription_detail ;

    if ($mysqli->query($sql_insert_prescription_detail) === TRUE) {
        header("Location: index.php?page=kedon");
        echo "ok sucessfully";
    } else {
        echo "Lỗi: " . $sql_insert_prescription_detail . "<br>" . $mysqli->error;
    } -->
