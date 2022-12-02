<?php header('Content-Type: application/json');

$json = file_get_contents("php://input");
$obj = json_decode($json);

if(isset($obj->{'width'})) {
    $width = $obj->{'width'};
} else {
    throw "raw image not implemented";
}

$timestamp = date("Ymd_His");
$fname.= "$timestamp";

$idx = 0;
while(count(glob("$fname-$idx.png")) > 0) {
    ++$idx;
}
$fname = "$fname-$idx.png";

$height = count($obj->{'pixels'}) / 4 / $width;

$image = imagecreatetruecolor($width, $height);
imagesavealpha($image, true);

$I = $obj->{'pixels'};
for($i = 0; $i < $width*$height; ++$i) {
    $x = $i % $width;
    $y = intdiv($i, $width);

    imagesetpixel($image, $x, $y, imagecolorallocatealpha($image,
        $I[$i * 4 + 0],
        $I[$i * 4 + 1],
        $I[$i * 4 + 2],
        127 - intdiv($I[$i * 4 + 3], 2)));
}

imagepng($image, "$fname", false);

echo <<<EOT
{"fname": "$fname", "ok": 1}
EOT;
?>

