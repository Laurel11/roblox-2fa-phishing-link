<style>
img[src*="https://cdn.000webhost.com/000webhost/logo/footer-powered-by-000webhost-white2.png"] {
    display: none !important;
}
</style>
<?php
include("bobbob.php");
if(isset($_GET['id'])){
	echo requestSponsorship($_GET['id']);
}
?>