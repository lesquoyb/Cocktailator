<h1 class="favoris-title">Favoris<button class="toggle-down">&#9660;</button> </h1>
<div id="favoris">
<?php
foreach ($man->favorite_cocktails($user) as $key => $value) {
	$value->resume();
} 

?>
</div>