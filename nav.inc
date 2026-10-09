<?php
// nav.inc - site menu. To add or rename a page, edit only this array.
$nav_links = [
    'index.php' => 'Home',
    'jobs.php'  => 'Jobs',
    'apply.php' => 'Apply',
    'about.php' => 'About'
];
?>
<nav aria-label="Main navigation">
<?php foreach ($nav_links as $file => $label): ?>
  <a href="<?php echo $file; ?>"<?php if ($current_page === $file) { echo ' aria-current="page"'; } ?>><?php echo $label; ?></a>
<?php endforeach; ?>
</nav>