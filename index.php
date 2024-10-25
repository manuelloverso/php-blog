<?php
session_start();
?>


<?php
include './layout/header.php'
?>


<?php if (isset($_GET['message'])) : ?>
    <h2><?= $_GET['message'] ?></h2>
<?php endif; ?>



<?php include './layout/footer.php'; ?>