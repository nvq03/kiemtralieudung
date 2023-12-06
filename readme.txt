# README

## Mhóm 12

Project: Kiểm Tra Liều Dùng

  **Nhóm có các thành viên sau đây:

- Nguyễn Văn Quý: 40% đóng góp
  + Công việc: Code Backend cho web app
- Huỳnh Châu Nghị: 35% đóng góp
  + Công việc: Code giao diện cho web app
- Nguyễn Tuấn Việt: 25% đóng góp
  + Công việc: Thiết kế figma prototype

## Đề Tài Được Phân Công:

 Xây dựng môđun kê đơn thuốc và kiểm tra 

## Triển khai

Để triển khai sản phẩm, tôi đã xây dựng theo các bước sau:

1. **Tạo Bảng Phác Thảo Sơ Bộ Trên Figma**
   - thiết kế trên công cụ figma prototype
   - tạo các frame tương ứng với từng trang web app
   - chạy prototype để kiểm thử web app đúng yêu cầu hay chưa

2. **Cơ Sở Dữ Liệu**
   - Sử Dụng Mysql để tạo cơ sỏ dữ liệu
   - dùng xampp để có thể chạy được cơ sở dữ liệu
   - Tạo csdl và thêm các trường như sau:
     bảng bác sĩ gồm:    doctor(id,name)
     bảng bệnh nhân gồm: patient(id,name)
     bảng thuốc gồm:     medicine(id,name,dosemax,dosemin,frequency,daydosemin)
     bảng kê đơn gồm:  medicine(id,iddoctor,idpatient,date)
     bảng kê đơn chi tiết gồm:  medicine(id,idprescription,idmedicine,dose,frequency,quantity)
     

4. **Kiểm tra Liều dùng**
   - kiểm tra các tham số của liều dùng như: dosemin, dosemax, frequencymax, dose, frequency, maxsum
     maxsum = dosemax * requencymax
    +đây là đoạn mã để kiểm tra liều Dùng bằng ngôn ngữ php

        if ($dose > $dosemax || $dose < $dosemin) {
            echo "Lieu luong nam ngoai nguong max min";
        } elseif ($lan > $maxlan) {
            echo "Lieu luong nam ngoai tan suat toi da cho phep";
        } elseif ($dose * $lan > $maxsummg) {
            echo "Lieu luong vuot qua tong lieu dung cho phep";
        } else {
            echo "An Toan"
        }

   - nếu kiểm tra đúng sẽ thêm vào csdl nếu sai sẽ thông báo lỗi


## Từ phân tích đánh giá đề tài tôi bắt đầu đi code và xây dựng web app đáp ứng đúng với yêu cầu

 1. **Công cụ code webapp**
   - Vs Code
   - Ngôn ngữ php
   - code giao diện bằng html
   - sử dụng xampp để chạy web app và kết nối csdl

 1. **Các trang hiển thị của web app**
   - trang đầu tiên trangchu.php đây là trang thông tin tại đây người dùng 
     sẽ nhập tên bác sĩ và tên bệnh nhân để lưu vào csdl
   - trang main.php tại đây người dùng sẽ chọn loại thuốc cần kiểm tra và sau đó nhấn tiếp theo
   - trang ktld.php trang này sẽ là trang để kiểm tra liều dùng xem có hợp lệ hay không
      nếu hợp lệ sẽ di chuyển đến trang kedon còn không sẽ thông báo lỗi
   - trang kedon.php sẽ là trang hiển thị toàn bộ tất các thông tin người dùng đã nhập vào    
   - trang themthuoc.php trang này sẽ có chức năng thêm thuốc 
     bao gồm thêm thuốc,liều min, liều max, tần suất max,
   - trang lịch sử sẽ hiển thị dữ liệu người dùng có thể tìm kiếm, sửa, xoá dữ liệu tại đó  

