<?php
// Connect to your 'jobs' database
$conn = mysqli_connect("localhost", "root", "", "jobs");

if(!$conn){
   die("Database connection failed: " . mysqli_connect_error());
}

// Get search filters from the URL (GET method)
$title = $_GET['title'] ?? '';
$location = $_GET['location'] ?? '';

// Query to fetch jobs based on search inputs
$query = "SELECT * FROM jobs WHERE job_title LIKE '%$title%' AND location LIKE '%$location%'";
$result = mysqli_query($conn, $query);
?>

   <?php
   if(mysqli_num_rows($result) > 0){
      while($row = mysqli_fetch_assoc($result)){
         echo "<div class='job'>";
         echo "<h3>" . htmlspecialchars($row['job_title']) . "</h3>";
         echo "<p><strong>Company:</strong> " . htmlspecialchars($row['company_name']) . "</p>";
         echo "<p><strong>Location:</strong> " . htmlspecialchars($row['location']) . "</p>";
         echo "<p><strong>Salary:</strong> " . htmlspecialchars($row['salary']) . "</p>";
         echo "<p><strong>Type:</strong> " . htmlspecialchars($row['job_type']) . "</p>";
         echo "<p><strong>Shift:</strong> " . htmlspecialchars($row['shift']) . "</p>";
         echo "<p><strong>Posted:</strong> " . htmlspecialchars($row['date_posted']) . "</p>";
         echo "</div>";
      }
   } else {
      echo "<p>No available jobs.</p>";
   }
   ?>
</section>