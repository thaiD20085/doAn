$(document).ready(function () {
    $('.form-control').focusin(function () {
        $(this).parent().children('label').addClass('label-toggle');
        console.log();
    })
    $('.form-control').focusout(function () {
        if ($(this).val() === '') {
            $(this).parent().children('label').removeClass('label-toggle');
        }
    })
});
var app = new Vue({
    el: '#app',
    data: {
        txtUser: '',
        txtPassword: '',
        txtPassword2: '',
        txtEmail: '',
        txtPhone: '',
        user_error: '',
        pass_error: '',
        pass2_error: '',
        email_error: '',
        phone_error: '',
        complete: false,
    },
    methods: {
        kiemTra: function (e) {
            //Dừng sự kiện tiếp theo của form
            e.preventDefault();
            //Xóa lỗi
            this.user_error = '';
            this.pass_error = '';
            this.pass2_error = '';
            this.email_error = '';
            this.phone_error = '';
            this.complete = false;
          

            //Kiểm tra User

            if (this.txtUser == '') {
                this.user_error = 'Vui lòng nhập tên đăng nhập';
            } else if (this.txtUser.length < 4) {
                this.user_error = 'Tên đăng nhập phải nhiều hơn 4 ký tự';
            } else if (this.txtUser.length > 20) {
                this.user_error = 'Tên đăng nhập phải ít hơn 20 ký tự';
            } else if (this.txtUser[0] == ' ') {
                this.user_error = 'Tên đăng nhập không được bắt đầu bằng khoảng trống';
            } else {
                console.log(this.txtUser);
                console.log(this.txtUser.length);
                for (i = 0; i < this.txtUser.length; i++) {
                    a = this.txtUser[i].charCodeAt(0);
                    console.log('index' + i + ':' + this.txtUser[i] + ' ' + a);
                    if (a >= 48 && a <= 57) { } else
                        if (a >= 97 && a <= 122) { } else
                            if (a >= 65 && a <= 90) { } else
                                this.user_error = 'Tên đăng nhập không được chứa ký tự đặc biệt';
                }
            }
            //Kiểm tra Password
            if (this.txtPassword == '') {
                this.pass_error = 'Vui lòng nhập mật khẩu';
            }
            else if (this.txtPassword.length < 6) {
                this.pass_error = 'Vui lòng nhập mật khẩu có độ dài ít nhất 6 ký tự';
            }
            else if (this.txtPassword2 != this.txtPassword) {
                this.pass2_error = 'Mật khẩu không giống';
            }
            //Kiểm tra Email
            if (this.txtEmail == '') {
                this.email_error = 'Vui lòng nhập email';
            } else if (!this.validateEmail(this.txtEmail)) {
                this.email_error = 'Vui lòng nhập email đúng định dạng';
            }
            //Kiểm tra số điện thoại
            if(this.txtPhone == ''){
                this.phone_error = 'Vui lòng nhập số điện thoại';
            } else if(this.txtPhone.length < 5){
                this.phone_error = 'Vui lòng nhập số điện thoại ít nhất 5 ký tự';
            } else if(isNaN(this.txtPhone)){
                this.phone_error = 'Vui lòng chỉ nhập số và không chứa khoảng trống';
            }
            //Đã check xong
            this.complete = true;
            return false;
        },
        validateEmail: function (email) {
            if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email)) {
                return true;
            }
            return false;
        },
        thongBaoDangNhap: function () {
            if (!this.complete) {
                return false;
            }
            if (this.user_error == '' && this.pass_error == '' &&
                this.pass2_error == '' && this.email_error =='' && this.phone_error=='') {
                alert("Đăng ký thành công!");
                window.location.replace('../index.html');
                //Xóa đánh dấu kiểm tra----
                // this.complete = false;
                return true;
            }
            return false;
        },

    }
}); 