<style>

.text1 {

color: black;
width: 150px;
font-size: 15px;
font-weight: 600;
text-decoration: none;

}

.text {

display: block;
color: black;
width: 110px;
font-size: 14px;
font-weight: 600;
color: green;
text-align: center;
text-decoration: none;

}

.input1 {
    width: 300px;
    padding: 8px 10px;
    margin: 8px 0;
    border-radius: 10px;
    box-sizing: border-box;
  }


.phom{
    background-color: transparent;height: 80px;

}

.button {
    border: none;
    outline: none;
    height: 40px;
    text-align: center;
    width: 100px;
    cursor: pointer;
    margin-top: 4px;
    margin-left: 10px;
    background: rgb(14, 172, 93);
    padding: 10px 0;
    border-radius: 6px;
    color: #fff;
    font-size: 0.8rem;
    font-weight: 600;
    transition: 0.2s ease;
  }

</style>


<?php
   include "connect.php";


   $sql = "SELECT pd.id, pd.dose as dose, pd.frequency as frequency, pd.quantity as quantity , d.name AS doctor_name, p.name AS patient_name, m.name AS medicine_name, pr.date
   FROM prescription_detail pd
   INNER JOIN prescription pr ON pd.idprescription = pr.id
   INNER JOIN doctor d ON pr.iddoctor = d.id
   INNER JOIN patient p ON pr.idpatient = p.id
   INNER JOIN medicine m ON pd.idmedicine = m.id";
    $thongtin = $mysqli->query($sql);

?>


<main>
<form class="phom" action="index.php?page=timkiem" method="post">
<div class="search" style="display: flex;text-align: center;width: auto;" >
 <input class="input1" placeholder="Tìm kiếm ID kê đơn,bác sĩ hoặc bênh nhân" type="text" name="tukhoa"> 
 <input class="button" name="timkiem" type="submit" value="Tìm kiếm"><br>
 </div>
</form>




<form action="#" style="height: auto;padding: 10px;">
        <h1>Thông Tin Đơn Thuốc</h1>
        <div class="container-thongtin" style="  border: 1px solid #000;padding: 5px;">
            <table class="table" style="  border-collapse: separate;border-spacing: 5px;">
                <tr>
                    <th>ID Kê Đơn</th>
                    <th>Bác sĩ</th>
                    <th>Bệnh nhân</th>
                    <th>Tên thuốc</th>
                    <th>Liều dùng</th>
                    <th>Tần suất</th>
                    <th>Số lượng</th>
                    <th>Ngày kê</th>
                    <th>Điều chỉnh</th>
                </tr>

    <?php
        if ($thongtin->num_rows > 0) {
            while ($row = $thongtin->fetch_assoc()) {
                $id = $row['id'];
                $doctorName = $row['doctor_name'];
                $patientName = $row['patient_name'];
                $medicineName = $row['medicine_name'];
                $dose = $row['dose'];
                $frequancy = $row['frequency'];
                $quantity = $row['quantity'];
                $date = $row['date'];
                ?>
                <div class="kedon">
                    <tr>
                        <td><p class="text"><?php echo $id; ?></p></td>
                        <td><p class="text"><?php echo $doctorName; ?></p></td>
                        <td><p class="text"><?php echo $patientName; ?></p></td>
                        <td><p class="text"><?php echo $medicineName; ?></p></td>
                        <td><p class="text"><?php echo $dose; ?>mg</p></td>
                        <td><p class="text"><?php echo $frequancy; ?> lần</p></td>
                        <td><p class="text"><?php echo $quantity; ?></p></td>
                        <td><p class="text"><?php echo $date; ?></p></td>
                        <td><a href="index.php?page=edit&id=<?php echo $id; ?>">Sửa</a> <a href="index.php?page=delete&id=<?php echo $id; ?>"> Xóa</a></td>
                    </tr>
                </div>
                <?php
            }
        } else {
            echo "Không có kết quả.";
        }
        ?>

            </table>
        </div>
    </form>

</main>
