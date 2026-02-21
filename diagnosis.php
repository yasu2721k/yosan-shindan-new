<?php require 'header.php'; ?>
<?php
$p = isset($_GET['p']) ? intval($_GET['p']) : 1;
?>

<div class="ke top-main">
  <header class="sn-header">
    <h1 class="">
      <img src="assets/img/logo.png" class="" alt="">
    </h1>
  </header>

  <div class="ke-1">
    <img src="assets/img/k-<?php echo $p; ?>.png" class="" alt="">
  </div>

  <div class="ke-2">
    <img src="assets/img/k-11.png" class="" alt="">
  </div>

  <div class="ke-3">
    <img src="assets/img/t-15.png" class="" alt="">
  </div>
  <div class="ke-4">
    <img src="assets/img/k-13.png" class="" alt="">
  </div>
</div>

<?php require 'footer.php'; ?>