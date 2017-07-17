# PassMe
PassMe is an open source password manager for individual, family, small team use. Built on PHP with OOP styles.*

*Please note that PassMe don't have a translate system as well as an English translation, so at the momment, the instructions, software language will entirely in Vietnamese.*

![alt text](http://i.imgur.com/XUQBm96.png "Ảnh chụp màn hình PassMe")

## Features
- Manages accounts of online services and websites easily and secure. 
- Reponsive, works on most devices
- Give security advices about your accounts.
- Add new account/password to manage from built-in list of website and services such as Google, Facebook, Paypal,... or you can add your own website.
- ~~Your password will be encrypt and decrypt using your current password.~~ 

## Installation
### Requirements 
- PHP 5.3 or newer.
- MySQL database.
- HTTP server: Apache, Ngix,...
- Have basic knowledge of PHP and MySQL.

### Instructions
- Clone or download our lastest release to your server directory.
- Import file passme.sql into your MySQL database.
- In your config directory, open dbconfig.php file and change config parameters of database connection, website path and website name.
- In order to sent mail (SMTP), open file class/class.user.php, go to line 119, from there, chagne config parameters of SMTP.

## Directory structure

| Directory name | Nội dung |
| ------  | ----------------------------------------------------------------------------------------------------------------- |
| assets     | Inculding resources, fonts, CSS, JS, images,... of PassMe |
| bootstrap    | Inculding resources, fonts, CSS, JS, images,... of PassMe based on Bootstrap|
| class| Inculding functions, classes, core of PassMe |
| config     | Inculding configuration file of PassMe |
| mailer     | Inculding PHPMailer library used to sent mail via SMTP protocol.   |
| my     | Inculding template file inside website path /my/   |
| pages     | Page template, can be use to create new page (based on Flat Admin v4.3)  |
| template   | Template of header, menu, footer,... used across many pages |

## Customization
### Add more website/services
Bạn có thể thêm nhà cung cấp dịch vụ bằng cách thêm một dòng mới vào bảng 'pm_services'

Dưới đây là thông tin về mỗi cột mà bạn cần nhập

| Tên cột | Nội dung                                                                                                          |
| ------  | ----------------------------------------------------------------------------------------------------------------- |
| id      | ID của dịch vụ, dạng INT, nên để trống, CSDL sẽ tự động tăng dần                                                  |
| name    | Tên ngắn gọn của dịch vụ, dạng Varchar(50), UTF-8                                                                 |
| fullname| Tên đầy đủ của dịch vụ, dạng Varchar(100), UTF-8                                                                  |
| url     | Đường dẫn đến trang đăng nhập của dịch vụ, dạng Varchar(255), UTF-8                                               |
| img     | Tên file ảnh gồm cả đuôi file, là logo của dịch vụ, dạng Varchar(255), UTF-8, ảnh này nằm ở thư mục assets/img/   |

### Add more category
Bạn có thể thêm chuyên mục cho tài khoản bằng cách thêm một dòng mới vào bảng 'pm_category'

Dưới đây là thông tin về mỗi cột mà bạn cần nhập

| Tên cột | Nội dung                                                                                                          |
| ------  | ----------------------------------------------------------------------------------------------------------------- |
| id      | ID của dịch vụ, dạng INT, nên để trống, CSDL sẽ tự động tăng dần                                                  |
| name    | Tên chuyên mục, dạng Varchar(50), UTF-8                                                                           |

## Credits 
- Nguyễn Phúc Bảo (https://github.com/nguyenphucbao68)
- Flat Admin Template - No longer in development (https://github.com/tui2tone/)
- PHPMailer (https://github.com/PHPMailer/PHPMailer)
- Bootstrap (http://getbootstrap.com)
- jQuery (http://jquery.com)
- Roboto Font (https://fonts.google.com/specimen/Roboto)
- Material Design (https://material.io)
 
