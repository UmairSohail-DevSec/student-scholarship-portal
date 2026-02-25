<?php 
session_start(); // Yeh lazmi hai
include('db.php'); 
include('header.php'); 

// Admin Password Protection - Match with login session name
if(!isset($_SESSION['admin_logged_in'])){ 
    header("Location: admin_login.php"); 
    exit();
}
// ... baki code wahi rahay ga

// Scholarship Add karne ki logic
if(isset($_POST['add'])){
    $t = mysqli_real_escape_string($conn, $_POST['t']); 
    $c = mysqli_real_escape_string($conn, $_POST['c']); 
    $d = $_POST['d']; 
    $i = mysqli_real_escape_string($conn, $_POST['i']); 
    $b = mysqli_real_escape_string($conn, $_POST['b']);
    
    mysqli_query($conn, "INSERT INTO scholarships (title, country, degree_level, institution, benefits) VALUES ('$t','$c','$d','$i','$b')");
}

// Delete karne ki logic
if(isset($_GET['del'])){ 
    $id = $_GET['del']; 
    mysqli_query($conn, "DELETE FROM scholarships WHERE id=$id"); 
    header("Location: admin.php");
    exit();
}
?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-3 bg-dark text-white p-4" style="min-height: 100vh;">
            <h4 class="fw-bold mb-4 text-warning">Admin Panel</h4>
            <hr>
            <form method="POST">
                <div class="mb-2">
                    <label class="small text-secondary">Scholarship Title</label>
                    <input type="text" name="t" class="form-control form-control-sm" required>
                </div>
                <div class="mb-2">
                    <label class="small text-secondary">Country</label>
                    <input type="text" name="c" class="form-control form-control-sm" required>
                </div>
                <div class="mb-2">
                    <label class="small text-secondary">Target Degree Level</label>
                    <select name="d" class="form-select form-select-sm">
                        <option value="Bachelors">Bachelors (For Inter Students)</option>
                        <option value="Masters">Masters (For Bachelors Students)</option>
                        <option value="PhD">PhD (For Masters Students)</option>
                    </select>
                </div>
                <div class="mb-2">
                    <label class="small text-secondary">University</label>
                    <input type="text" name="i" class="form-control form-control-sm" required>
                </div>
                <div class="mb-3">
                    <label class="small text-secondary">Benefits</label>
                    <textarea name="b" class="form-control form-control-sm" rows="3"></textarea>
                </div>
                <button name="add" class="btn btn-warning w-100 fw-bold">Save Scholarship</button>
            </form>
            <br>
            <a href="index.html" class="btn btn-outline-light btn-sm w-100">Logout Admin</a>
        </div>

        <div class="col-md-9 p-5">
            <h3 class="fw-bold mb-4">Manage Scholarship Records</h3>
            <div class="card shadow-sm border-0">
                <table class="table table-hover mb-0">
                    <thead class="table-primary">
                        <tr>
                            <th>Title</th>
                            <th>Target Level</th>
                            <th>Country</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $res = mysqli_query($conn, "SELECT * FROM scholarships ORDER BY id DESC");
                        while($row = mysqli_fetch_assoc($res)){ 
                        ?>
                        <tr>
                            <td><strong><?php echo $row['title']; ?></strong></td>
                            <td><span class="badge bg-info text-dark"><?php echo $row['degree_level']; ?></span></td>
                            <td><?php echo $row['country']; ?></td>
                            <td>
                                <a href="edit_scholarship.php?id=<?php echo $row['id']; ?>" class="btn btn-primary btn-sm me-2">
                                    <i class="fa fa-edit"></i> Edit
                                </a>

                                <a href="?del=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">
                                    <i class="fa fa-trash"></i> Delete
                                </a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>