<!DOCTYPE html>
<head>
<title>view</title>
</head>
<body>
<?php
$a = glob("*.png");
rsort($a, SORT_NATURAL);
foreach($a as $im) {
    echo <<<EOT
<div id=$im>
    <div>$im</div>
    <img src="./$im">
</div>
<hr>
EOT;
}
?>
</body>
