<?php 
include('db.php'); 
include('header.php'); 

// Check admin session
if(!isset($_SESSION['admin'])){ header("Location: admin_login.php"); exit(); }

$id = $_GET['id'];
$res = mysqli_query($conn, "SELECT * FROM scholarships WHERE id = $id");
$row = mysqli_fetch_assoc($res);

if(isset($_POST['update'])){
    $t = mysqli_real_escape_string($conn, $_POST['t']); 
    $c = mysqli_real_escape_string($conn, $_POST['c']); 
    $d = $_POST['d']; 
    $i = mysqli_real_escape_string($conn, $_POST['i']); 
    $b = mysqli_real_escape_string($conn, $_POST['b']);
    
    $update_query = "UPDATE scholarships SET title='$t', country='$c', degree_level='$d', institution='$i', benefits='$b' WHERE id=$id";
    
    if(mysqli_query($conn, $update_query)){
        echo "<script>alert('Scholarship Updated!'); window.location='admin.php';</script>";
    }
}
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow border-0 p-4">
                <h4 class="fw-bold mb-4 text-primary">Edit Scholarship Details</h4>
                <form method="POST">
                    <div class="mb-3">
                        <label>Scholarship Title</label>
                        <input type="text" name="t" class="form-control" value="<?php echo $row['title']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label>Country</label>
                        <input type="text" name="c" class="form-control" value="<?php echo $row['country']; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label>Target Level</label>
                        <select name="d" class="form-select">
                            <option value="Bachelors" <?php if($row['degree_level'] == 'Bachelors') echo 'selected'; ?>>Bachelors</option>
                            <option value="Masters" <?php if($row['degree_level'] == 'Masters') echo 'selected'; ?>>Masters</option>
                            <option value="PhD" <?php if($row['degree_level'] == 'PhD') echo 'selected'; ?>>PhD</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>University</label>
                        <input type="text" name="i" class="form-control" value="<?php echo $row['institution']; ?>" required>
                    </div>
                    <div class="mb-4">
                        <label>Benefits</label>
                        <textarea name="b" class="form-control" rows="4"><?php echo $row['benefits']; ?></textarea>
                    </div>
                    <div class="d-flex gap-2">
                        <button name="update" class="btn btn-success w-100 py-2 fw-bold">Update Scholarship</button>
                        <a href="admin.php" class="btn btn-secondary w-100 py-2 fw-bold">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>