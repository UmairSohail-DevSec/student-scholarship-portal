<?php 
include('db.php'); 
include('header.php'); 

if(!isset($_SESSION['student_id'])){
    header("Location: student_auth.php");
    exit();
}

$sid = $_SESSION['student_id'];

// Student ki profile se last degree uthana
$profile_query = mysqli_query($conn, "SELECT last_degree FROM student_profiles WHERE student_id = '$sid' ORDER BY id DESC LIMIT 1");
$profile = mysqli_fetch_assoc($profile_query);
$last_degree = $profile['last_degree'] ?? 'Intermediate';

// Matching logic
$show_level = "";
if($last_degree == "Intermediate") { $show_level = "Bachelors"; }
elseif($last_degree == "Bachelors") { $show_level = "Masters"; }
elseif($last_degree == "Masters") { $show_level = "PhD"; }
else { $show_level = "Bachelors"; }

// --- SEARCH LOGIC ---
$search_query = "";
if(isset($_GET['search']) && !empty($_GET['search'])){
    $s = mysqli_real_escape_string($conn, $_GET['search']);
    // Search query: Name ya Country matching
    $search_query = "SELECT * FROM scholarships WHERE (title LIKE '%$s%' OR country LIKE '%$s%')";
} else {
    // Default Recommendation query
    $search_query = "SELECT * FROM scholarships WHERE degree_level = '$show_level'";
}
?>

<div class="container mt-4">
    <div class="text-end mb-3">
        <a href="student_auth.php" class="btn btn-outline-danger btn-sm rounded-pill px-3">Logout</a>
    </div>

    <div class="mb-4">
        <h2 class="fw-bold text-dark">Recommended for You</h2>
        <p class="text-muted">Based on your background in <b><?php echo $last_degree; ?></b>, we suggest <b><?php echo $show_level; ?></b> programs.</p>
    </div>

    <div class="row mb-5">
        <div class="col-md-8 offset-md-2">
            <form action="" method="GET" class="d-flex shadow-sm rounded-pill bg-white p-2">
                <input type="text" name="search" class="form-control border-0 rounded-pill ps-4" placeholder="Search by Country or Scholarship Name..." value="<?php echo $_GET['search'] ?? ''; ?>">
                <button type="submit" class="btn btn-primary rounded-pill px-4 ms-2">Search</button>
            </form>
        </div>
    </div>

    <div class="row">
        <?php
        $result = mysqli_query($conn, $search_query);

        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_assoc($result)){
                ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm border-0 p-3" style="border-radius:20px;">
                        <div class="card-body">
                            <span class="badge bg-primary mb-3 px-3 rounded-pill"><?php echo $row['degree_level']; ?></span>
                            <h5 class="fw-bold mb-2"><?php echo $row['title']; ?></h5>
                            <p class="text-muted mb-1 small"><i class="fa fa-university me-2"></i><?php echo $row['institution']; ?></p>
                            <p class="text-dark fw-bold mb-3"><i class="fa fa-globe-americas text-success me-2"></i><?php echo $row['country']; ?></p>
                            
                            <div class="p-2 rounded mb-4" style="background:#f8f9fa; font-size: 13px; color: #6c757d;">
                                <?php echo $row['benefits']; ?>
                            </div>
                            
                            <button class="btn btn-primary w-100 rounded-pill py-2 fw-bold" style="background: #003580;">Apply Now</button>
                        </div>
                    </div>
                </div>
                <?php
            }
        } else {
            echo "<div class='text-center py-5 w-100'><h4>No scholarships found matching your search.</h4><a href='main_portal.php' class='btn btn-link'>Show Recommendations</a></div>";
        }
        ?>
    </div>
</div>