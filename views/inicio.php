<?php
    $auth = $_SESSION['auth'] ?? false;

    if(!$auth) {
        header("Location: /login");
    }
?>

<script src="js/index.js">
</script>