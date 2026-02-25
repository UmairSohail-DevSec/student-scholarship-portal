<?php 
ob_start(); // Output buffering start (Headers error ko rokne ke liye)
include('db.php'); 

// --- Login Logic (HTML se pehle) ---
if(isset($_POST['login'])){
    $email = mysqli_real_escape_string($conn, $_POST['lemail']);
    $pass = $_POST['lpass'];
    $res = mysqli_query($conn, "SELECT * FROM students WHERE email='$email' AND password='$pass'");
    if(mysqli_num_rows($res) > 0){
        $user = mysqli_fetch_assoc($res);
        $_SESSION['student_id'] = $user['id'];
        header("Location: profile.php");
        exit(); // Redirect ke baad execution rokne ke liye
    } else {
        $login_error = "Invalid Credentials!";
    }
}

// --- Registration Logic (HTML se pehle) ---
if(isset($_POST['register'])){
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = $_POST['pass'];
    $cpass = $_POST['cpass'];

    if($pass !== $cpass){
        $reg_error = "Passwords do not match!";
    } else {
        $check = mysqli_query($conn, "SELECT * FROM students WHERE email='$email'");
        if(mysqli_num_rows($check) > 0){
            $reg_error = "Email already registered!";
        } else {
            if(mysqli_query($conn, "INSERT INTO students (name, email, password) VALUES ('$name', '$email', '$pass')")){
                echo "<script>alert('Success! Please Login now.');</script>";
            }
        }
    }
}

include('header.php'); 
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow-sm border-0 p-4" style="border-radius: 20px; background: #ffffff;">
                
                <?php if(isset($login_error)) echo "<div class='alert alert-danger'>$login_error</div>"; ?>
                <?php if(isset($reg_error)) echo "<div class='alert alert-danger'>$reg_error</div>"; ?>

                <div id="loginForm">
                    <h3 class="fw-bold mb-4 text-primary text-center"><i class="fas fa-sign-in-alt me-2"></i>Student Login</h3>
                    <form method="POST">
                        <div class="mb-3">
                            <label class="form-label">Email Address</label>
                            <input type="email" name="lemail" class="form-control rounded-pill ps-3" placeholder="example@mail.com" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Password</label>
                            <input type="password" name="lpass" class="form-control rounded-pill ps-3" placeholder="••••••••" required>
                        </div>
                        <button type="submit" name="login" class="btn btn-primary w-100 rounded-pill py-2 shadow-sm mb-3" style="background: #003580;">Login to Portal</button>
                    </form>
                    <p class="text-center small">Don't have an account? <a href="javascript:void(0)" onclick="toggleForms()" class="text-success fw-bold text-decoration-none">Register Here</a></p>
                </div>

                <div id="registerForm" style="display: none;">
                    <h3 class="fw-bold mb-4 text-success text-center"><i class="fas fa-user-plus me-2"></i>Create Account</h3>
                    <form method="POST">
                        <div class="mb-2">
                            <label class="form-label small">Full Name</label>
                            <input type="text" name="name" class="form-control rounded-pill" required>
                        </div>
                        <div class="mb-2">
                            <label class="form-label small">Email</label>
                            <input type="email" name="email" class="form-control rounded-pill" required>
                        </div>
                        <div class="mb-2">
                            <label class="form-label small">Password</label>
                            <input type="password" name="pass" class="form-control rounded-pill" required>
                        </div>
                        <div class="mb-4">
                            <label class="form-label small">Confirm Password</label>
                            <input type="password" name="cpass" class="form-control rounded-pill" required>
                        </div>
                        <button type="submit" name="register" class="btn btn-success w-100 rounded-pill py-2 shadow-sm mb-3">Register Now</button>
                    </form>
                    <p class="text-center small">Already have an account? <a href="javascript:void(0)" onclick="toggleForms()" class="text-primary fw-bold text-decoration-none">Login Here</a></p>
                </div>

            </div>
        </div>
    </div>
</div>

<script>
function toggleForms() {
    var login = document.getElementById("loginForm");
    var register = document.getElementById("registerForm");
    if (login.style.display === "none") {
        login.style.display = "block";
        register.style.display = "none";
    } else {
        login.style.display = "none";
        register.style.display = "block";
    }
}
</script>

<?php 
ob_end_flush(); // Buffer clean karein
?>