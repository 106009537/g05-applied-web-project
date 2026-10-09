<?php
// header.inc - shared <head> and site header.
// Pages set $page_title BEFORE including this file.
$current_page = basename($_SERVER['PHP_SELF']);
if (!isset($page_title)) { $page_title = "Quokka Recovery Program"; }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo htmlspecialchars($page_title); ?></title>
  <link rel="stylesheet" href="styles.css">
<?php if (!empty($page_css)): ?>
  <style>
<?php echo $page_css; ?>
  </style>
<?php endif; ?>
</head>
<body>
<header>
  <div class="header-content">
    <a href="index.php">
      <img class="logo" src="images/quokka_logo.png" alt="Quokka Recovery Program logo">
    </a>
    <?php include 'nav.inc'; ?>
    <a class="donate-button" href="#">Donate!</a>
  </div>
</header>