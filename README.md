# PassMe
PassMe is an open source password manager for individual, family, small team use. Built on PHP with OOP styles.

*Please note that PassMe don't have a translate system as well as an English translation, so at the momment, the instructions, software language will entirely in Vietnamese.*

PassMe documentation in other language: [Tiếng Việt](README_vi.md)

![alt text](http://i.imgur.com/XUQBm96.png "Ảnh chụp màn hình PassMe")

## Features
- Manages accounts of online services and websites easily and secure. 
- Reponsive, works on most devices
- Give security advices about your accounts.
- Add new account/password to manage from built-in list of website and services such as Google, Facebook, Paypal,... or you can add your own website.
- ~~Your password will be encrypt and decrypt using your current password.~~ 

## Future plans
 - Encrypt password in database, and user can only decrypt and see it with their own unique password (not their current password use to login PassMe).
 - Translate to Vietnamese.
 - Add more services
 - Build an installation ! 

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

| Directory name | Content |
| ------  | ----------------------------------------------------------------------------------------------------------------- |
| assets     | Inculding resources, fonts, CSS, JS, images,... of PassMe |
| bootstrap    | Inculding resources, fonts, CSS, JS, images,... of PassMe based on Bootstrap|
| class| Inculding functions, classes, core of PassMe |
| config     | Inculding configuration file of PassMe |
| mailer     | Inculding PHPMailer library used to sent mail via SMTP protocol   |
| my     | Inculding template file inside website path /my/   |
| pages     | Page template, can be use to create new page (based on Flat Admin v4.3)  |
| template   | Template of header, menu, footer,... used across many pages |

## Customization
### Add more website/services
You can add more website/services by add more row to table 'pm_services'

Here is information of columns you need to fill in

| Column | Content                                                                                                          |
| ------  | ----------------------------------------------------------------------------------------------------------------- |
| id      | ID of services, INT type, leave blank as MySQL will auto_increment                                                   |
| name    | Short name of services, Varchar(50) type, UTF-8                                                                 |
| fullname| Full name of services, Varchar(100) type, UTF-8                                                                  |
| url     | URL to login page of services, Varchar(255) type, UTF-8                                               |
| img     | Images file name with extension, this is logo of services, Varchar(255) type, UTF-8, these images could be found in assets/img/   |

### Add more category
You can add more category by add more row to table 'pm_category'

Here is information of columns you need to fill in

| Column | Content                                                                                                          |
| ------  | ----------------------------------------------------------------------------------------------------------------- |
| id      | ID of category, INT type, leave blank as MySQL will auto_increment                                                  |
| name    | Name of category, Varchar(50) type, UTF-8                                                                           |

## Credits 
- Nguyễn Phúc Bảo (https://github.com/nguyenphucbao68)
- Flat Admin Template - No longer in development (https://github.com/tui2tone/)
- PHPMailer (https://github.com/PHPMailer/PHPMailer)
- Bootstrap (http://getbootstrap.com)
- jQuery (http://jquery.com)
- Roboto Font (https://fonts.google.com/specimen/Roboto)
- Material Design (https://material.io)
 
