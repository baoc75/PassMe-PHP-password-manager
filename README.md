# PassMe
PassMe là một chương trình quản lý mật khẩu mã nguồn mở dành cho cá nhân, gia đình, các tổ chức, nhóm nhỏ. Được xây dựng trên PHP theo hướng đối tượng (OOP).

*PassMe is an open source password manager for personal, family, small team use. Built on PHP with OOP styles.
Please note that PassMe don't have a translate system as well as an English translation, so at the momment, the instructions, software will entirely in Vietnamese.*

![alt text](http://i.imgur.com/XUQBm96.png "Ảnh chụp màn hình PassMe")

## Tính năng
- Quản lý tài khoản các tài khoản trực tuyến nhanh chóng và dễ dàng tại cùng một nơi. 
- Tương thích với nhiều thiết bị từ máy tính đến điện thoại di động.
- Đưa ra các gợi ý nhằm nâng cao bảo mật về các tài khoản của bạn.
- Thêm tài khoản/mật khẩu mới để quản lý từ danh sách các trang web, dịch vụ trực tuyến có sẵn như Facebook, Twitter, Google Plus, Paypal,... hoặc bạn có thể tự thêm trang web của riêng mình.
- ~~Mật khẩu của bạn khi lưu trữ đều được mã hóa và giải mã bằng chính mật khẩu hiện tại của bạn.~~ 

## Cài đặt
### Yêu cầu kĩ thuật
- Phiên bản PHP 5.3 hoặc mới hơn.
- Cơ sở dữ liệu MySQL.
- Máy chủ HTTP có thể là Apache, Ngix,...
- Có kiến thức cơ bản về PHP và MySQL.

### Hướng dẫn
- Clone hoặc download các release của PassMe về thư mục máy chủ của bạn.
- Import file passme.sql vào CSDL MySQL của bạn.
- Vào thư mục config, mở file dbconfig.php và chỉnh sửa các thông số CSDL, đường dẫn trang web và tên trang web.
- Để thay đổi thông số gửi mail (SMTP), mở file class/class.user.php, tìm dòng số 119, kể từ đây trở xuống hãy thay đổi các thông số SMTP.

## Cấu trúc thư mục và file

| Tên thư mục | Nội dung |
| ------  | ----------------------------------------------------------------------------------------------------------------- |
| assets     | Chứa các resource, font, CSS, JS, hình ảnh của dịch vụ,...|
| bootstrap    | Chứa các resource, font, CSS, JS, hình ảnh của dịch vụ,... dựa trên Bootstrap|
| class| Các hàm, lớp xử lí trong chương trình |
| config     | Chứa file thiết lập chương trình |
| mailer     | Chứa thư viên PHPMailer dùng để gửi thư thông qua giao thức SMTP   |
| my     | Thư mục chứa giao diện của các trang nằm trong /my/   |
| pages     | Giao diện mẫu, có thể dùng để tạo thêm trang mới (dựa trên giao diện Flat Admin v4.3)  |
| template   | Giao diện của header, menu, footer,... được sử dụng ở các trang |

## Tùy chỉnh thêm
### Thêm nhà cung cấp dịch vụ
Bạn có thể thêm nhà cung cấp dịch vụ bằng cách thêm một dòng mới vào bảng 'pm_services'

Dưới đây là thông tin về mỗi cột mà bạn cần nhập

| Tên cột | Nội dung                                                                                                          |
| ------  | ----------------------------------------------------------------------------------------------------------------- |
| id      | ID của dịch vụ, dạng INT, nên để trống, CSDL sẽ tự động tăng dần                                                  |
| name    | Tên ngắn gọn của dịch vụ, dạng Varchar(50), UTF-8                                                                 |
| fullname| Tên đầy đủ của dịch vụ, dạng Varchar(100), UTF-8                                                                  |
| url     | Đường dẫn đến trang đăng nhập của dịch vụ, dạng Varchar(255), UTF-8                                               |
| img     | Tên file ảnh gồm cả đuôi file, là logo của dịch vụ, dạng Varchar(255), UTF-8, ảnh này nằm ở thư mục assets/img/   |

### Thêm chuyên mục
Bạn có thể thêm chuyên mục cho tài khoản bằng cách thêm một dòng mới vào bảng 'pm_category'

Dưới đây là thông tin về mỗi cột mà bạn cần nhập

| Tên cột | Nội dung                                                                                                          |
| ------  | ----------------------------------------------------------------------------------------------------------------- |
| id      | ID của dịch vụ, dạng INT, nên để trống, CSDL sẽ tự động tăng dần                                                  |
| name    | Tên chuyên mục, dạng Varchar(50), UTF-8                                                                           |

## Credits 
- Nguyễn Phúc Bảo (https://github.com/nguyenphucbao68)
- Giao diện Flat Admin - Không còn được phát triển (https://github.com/tui2tone/)
- PHPMailer (https://github.com/PHPMailer/PHPMailer)
- Bootstrap (http://getbootstrap.com)
- jQuery (http://jquery.com)
- Roboto Font (https://fonts.google.com/specimen/Roboto)
- Material Design (https://material.io)
 
