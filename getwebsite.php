<?php
$servername = "localhost";
$username = "root"; // Change this if necessary
$password = "root"; // Change this if necessary
$database = "webbuilder"; // Your database name

// Create a connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

// Fetch data from the `website` table
$sql = "SELECT * FROM website";
$result = $conn->query($sql);

$websites = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $websites[] = $row;
    }
}

$conn->close();
?>

<ul>
    <?php foreach ($websites as $site): ?>
        <li>
            <a href="javascript:void(0)" class="w3-hover-opacity" onclick="openImg('<?php echo htmlspecialchars($site['title']); ?>')">
                <button class="w3-bar-item w3-button"><?php echo htmlspecialchars($site['title']); ?></button>
            </a>
        </li>
    <?php endforeach; ?>
</ul>

<!-- Display Section -->
<?php foreach ($websites as $site): ?>
    <div class="d-flex justify-content-center">
    <div id="<?php echo htmlspecialchars($site['title']); ?>" class="picture w3-display-container" style="display:none">
        <span onclick="this.parentElement.style.display='none'" 
        class="w3-display-topright w3-button w3-transparent w3-text-white">&times;</span>
        
        <div class="col-md-4 pb-3">
            <div class="card">
                <img src="<?php echo htmlspecialchars($site['image']); ?>" class="card-img-top" alt="Image">
                <div class="card-body text-center">
                    <h5 class="card-title"><?php echo htmlspecialchars($site['title']); ?></h5>
                    <p class="card-text"><?php echo htmlspecialchars($site['description']); ?></p>
                    <a href="<?php echo htmlspecialchars($site['view']); ?>" class="btn btn-primary" target="_blank">View</a>
                    <a href="#" class="btn btn-success" onclick="openPopup(this)">Buy</a>
                </div>
            </div>
        </div>
    </div>
    </div>
<?php endforeach; ?>

<script>
function openImg(title) {
    // Hide all sections
    let sections = document.querySelectorAll('.picture');
    sections.forEach(section => {
        section.style.display = 'none';
    });

    // Show the selected section
    document.getElementById(title).style.display = 'block';
}
</script>
