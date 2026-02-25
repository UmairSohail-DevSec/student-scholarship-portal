<?php 
include('db.php'); 
include('header.php'); 

// Check karein ke student login hai ya nahi
if(!isset($_SESSION['student_id'])){
    echo "<script>alert('Session expired! Please login again.'); window.location='student_auth.php';</script>";
    exit();
}
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card p-5 shadow-sm border-0" style="border-radius:15px;">
                <h4 class="fw-bold mb-4 text-primary"><i class="fa fa-graduation-cap me-2"></i>Academic Information</h4>
                <p class="text-muted small">Please enter your academic details so we can show you the most relevant scholarships.</p>
                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Last Degree Completed</label>
                        <select name="deg" class="form-select" required>
                            <option value="">Select Degree</option>
                            <option value="Intermediate">Intermediate / A-Levels</option>
                            <option value="Bachelors">Bachelors</option>
                            <option value="Masters">Masters</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Institution Name</label>
                        <input type="text" name="inst" class="form-control" placeholder="e.g. Punjab College" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Marks Percentage (%)</label>
                        <input type="number" name="marks" class="form-control" placeholder="e.g. 85" required>
                    </div>
                    <button type="submit" name="save_profile" class="btn btn-primary w-100 mt-3 py-2 fw-bold shadow-sm">Find Matching Scholarships</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
if(isset($_POST['save_profile'])){
    // Session se student ki ID uthayein
    $sid = $_SESSION['student_id']; 
    $d = mysqli_real_escape_string($conn, $_POST['deg']); 
    $i = mysqli_real_escape_string($conn, $_POST['inst']); 
    $m = mysqli_real_escape_string($conn, $_POST['marks']);

    // Check karein ke kahin ye ID database mein exist karti hai
    $check_user = mysqli_query($conn, "SELECT id FROM students WHERE id = '$sid'");
    
    if(mysqli_num_rows($check_user) > 0) {
        $sql = "INSERT INTO student_profiles (student_id, last_degree, institution, marks_percentage) VALUES ('$sid', '$d', '$i', '$m')";
        if(mysqli_query($conn, $sql)){
            echo "<script>window.location='main_portal.php';</script>";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        echo "<script>alert('Error: User not found. Please register again.'); window.location='student_auth.php';</script>";
    }
}
?>