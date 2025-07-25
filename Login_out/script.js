// function chuyendoiForm(formType) {
//     // Ẩn tất cả các form
//     const allForms = document.querySelectorAll('.form-section');
//     allForms.forEach(form => form.classList.add('hidden'));

//     // Hiển thị form được chọn
//     switch(formType) {
//         case 'login':
//             document.getElementById('login-form').classList.remove('hidden');
//             break;
//         case 'register':
//             document.getElementById('register-form').classList.remove('hidden');
//             break;
//         case 'forgot_password':
//             document.getElementById('forgotPass-form').classList.remove('hidden');
//             break;
//     }
// }

// function login(event) {
//     event.preventDefault();
    
//     const email = document.getElementById('email').value;
//     const password = document.getElementById('password').value;

//     // Kiểm tra email
//     if (!validateEmail(email)) {
//         alert('Email không hợp lệ!');
//         return false;
//     }

//     // Kiểm tra mật khẩu
//     if (password.length < 6) {
//         alert('Mật khẩu phải có ít nhất 6 ký tự!');
//         return false;
//     }

//     // Gửi form (có thể thay thế bằng AJAX call)
//     return true;
// }

// function register(event) {
//     event.preventDefault();

//     const name = document.getElementById('register-name').value;
//     const email = document.getElementById('register-email').value;
//     const password = document.getElementById('register-password').value;
//     const confirmPassword = document.getElementById('register-confirm-password').value;
//     const otp = document.getElementById('register-otp').value;
//     const confirmOtp = document.getElementById('register-confirm-otp').value;

//     // Kiểm tra tên
//     if (name.trim().length < 2) {
//         alert('Vui lòng nhập họ tên hợp lệ!');
//         return false;
//     }

//     // Kiểm tra email
//     if (!validateEmail(email)) {
//         alert('Email không hợp lệ!');
//         return false;
//     }

//     // Kiểm tra mật khẩu
//     if (password.length < 6) {
//         alert('Mật khẩu phải có ít nhất 6 ký tự!');
//         return false;
//     }

//     // Kiểm tra mật khẩu xác nhận
//     if (password !== confirmPassword) {
//         alert('Mật khẩu xác nhận không khớp!');
//         return false;
//     }

//     // Kiểm tra OTP
//     if (otp !== confirmOtp) {
//         alert('Mã xác nhận không khớp!');
//         return false;
//     }

//     return true;
// }

// function forgotPass(event) {
//     event.preventDefault();

//     const email = document.getElementById('email').value;
//     const otp = document.getElementById('otp').value;
//     const newPassword = document.getElementById('register-password').value;
//     const confirmPassword = document.getElementById('register-confirm-password').value;

//     // Kiểm tra email
//     if (!validateEmail(email)) {
//         alert('Email không hợp lệ!');
//         return false;
//     }

//     // Kiểm tra mật khẩu mới
//     if (newPassword.length < 6) {
//         alert('Mật khẩu mới phải có ít nhất 6 ký tự!');
//         return false;
//     }

//     // Kiểm tra mật khẩu xác nhận
//     if (newPassword !== confirmPassword) {
//         alert('Mật khẩu xác nhận không khớp!');
//         return false;
//     }

//     return true;
// }

// // Hàm kiểm tra email hợp lệ
// function validateEmail(email) {
//     const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
//     return re.test(String(email).toLowerCase());
// }   