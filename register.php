<?php include('db.php'); include('header.php'); ?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="glass-card p-5">
                <h3 class="fw-bold text-center mb-4">Student Register</h3>
                <form method="POST">
                    <div class="mb-3"><label>Full Name</label><input type="text" name="name" class="form-control" required></div>
                    <div class="mb-3"><label>Email</label><input type="email" name="email" class="form-control" required></div>
                    <div class="mb-3"><label>CNIC</label><input type="text" name="cnic" class="form-control" placeholder="12345-1234567-1" required></div>
                    <button type="submit" name="reg" class="btn btn-primary w-100 py-2">Create Account</button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
if(isset($_POST['reg'])){
    $n = $_POST['name']; $e = $_POST['email']; $c = $_POST['cnic'];
    $q = "INSERT INTO students (name, email, cnic) VALUES ('$n', '$e', '$c')";
    if(mysqli_query($conn, $q)){
        $_SESSION['sid'] = mysqli_insert_id($conn);
        echo "<script>alert('Registered!'); window.location='profile.php';</script>";
    }
}
?>