<?php 
// 1. Sab se pehle session start aur buffering
session_start();
ob_start(); 

include('db.php'); 
include('header.php'); 

// 2. Login Logic ko HTML se upar rakhein
if(isset($_POST['login'])){
    $username = $_POST['user'];
    $password = $_POST['pass'];

    if($username == "umair" && $password == "umair123"){ // Password check karein jo aapne rakha hai
        $_SESSION['admin_logged_in'] = true;
        header("Location: admin.php");
        exit(); // Redirect ke baad script rokna zaroori hai
    } else {
        echo "<script>alert('Invalid Credentials');</script>";
    }
}
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card p-4 shadow border-0">
                <h4 class="text-center mb-4">Admin Login</h4>
                <form method="POST">
                    <div class="mb-3">
                        <label>Username</label>
                        <input type="text" name="user" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label>Password</label>
                        <input type="password" name="pass" class="form-control" required>
                    </div>
                    <button type="submit" name="login" class="btn btn-primary w-100">Login</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php 
// 3. Output flush karein
ob_end_flush(); 
?>