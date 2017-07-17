<?php


class ErrorRep
{
    function exist($code)
	{
		 $list = ["1A","2A","3A","1B","2B","3B","4B","5B","6B","7B","1C","2C","3C","4C","5C","6C"];
		 If (in_array($code,$list)) {
			 return true;
		 }
		 else
		 {
			 return false;
		 }
	}

	// Function that return Error Messages/Infomation Messages from Code
    function ectt($code)
	{
		switch ($code)
		{
			case "1A":
  				echo "Thông tin bạn nhập không chính xác hoặc còn thiếu, xin hãy kiểm tra lại.";
				break;
			case "2A":
				echo "Mật khẩu xác nhận không giống với mật khẩu mới.";
				break;
			case "3A":
				echo "Mật khẩu hiện tại không đúng, xin hãy kiểm tra lại.";
				break;


			case "1B":
			    echo "Email của bạn không trùng khớp với tài khoản nào!";
				break;
			case "2B":
			    echo "Mật khẩu của bạn không đúng!";
				break;
			case "3B":
			    echo "Tài khoản chưa được xác minh, xin hãy xác minh tài khoản của bạn. Nếu bạn không nhận được thư, xin hãy truy cập.";
                break;
			case "4B":
			    echo "Email này đã được sử dụng cho tài khoản khác. Xin hãy thử lại!";
                break;
            case "5B":
			    echo "Chúng tôi đã gửi link có kèm hướng dẫn xác minh tài khoản đến email của bạn. Xin hãy kiểm tra cả hộp thư chính và hộp thư spam.";
                break;
			case "6B":
			    echo "Xin hãy nhập email được dùng để đăng nhập tài khoản, bạn sẽ nhận được thư hướng dẫn khôi phục mật khẩu.";
                break;
			case "7B":
			    echo "Chúng tôi đã gửi một email khôi phục mật khẩu đến địa chỉ email của bạn. Xin hãy bấm vào đường dẫn được gửi trong thư để khôi phục mật khẩu.";
                break;

			case "1C":
			    echo "Yêu cầu không được thực hiện. Xin hãy thử lại sau.";
                break;
			case "2C":
			    echo "Email bạn nhập không đúng! Xin hãy kiểm tra và thử lại.";
                break;
      case "3C":
          echo "Yêu cầu không được thực hiện. Xin hãy thử lại sau.";
         break;
    	case "4C":
          echo "Đã thêm tài khoản mới thành công.";
          break;
      case "5C":
          echo "Đã lưu các thông tin tài khoản đăng nhập thành công.";
          break;
  		case "6C":
           echo "Đã cập nhật thông tin hồ sơ thành công.";
           break;


		}
	}
}
