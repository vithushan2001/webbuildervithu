<?php
session_start();
session_unset(); // Clear session variables
session_destroy(); // Destroy the session

// Prevent back button from accessing the previous session
echo "<script>
    window.localStorage.clear(); 
    window.sessionStorage.clear();
    window.location.href = 'login.php';
</script>";
exit;
?>
