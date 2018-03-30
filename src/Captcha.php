<?php
namespace Jiangbianwanghai;

class Captcha
{
    public $length = 4;
    public $width  = 60;
    public $height = 20;

    public function generator($length, $width, $height)
    {
        $code = "";
        for ($i = 0; $i < $length; $i++) {
            $code .= rand(0, 9);
        }
        session_start();
        $_SESSION["helloweba_num"] = $code;
        Header("Content-type: image/PNG");
        $im      = imagecreate($width, $height);
        $black   = imagecolorallocate($im, 0, 0, 0);
        $gray    = imagecolorallocate($im, 200, 200, 200);
        $bgcolor = imagecolorallocate($im, 255, 255, 255);
        imagefill($im, 0, 0, $gray);
        imagerectangle($im, 0, 0, $width - 1, $height - 1, $black);
        $style = array(
            $black,
            $black,
            $black,
            $black,
            $black,
            $gray,
            $gray,
            $gray,
            $gray,
            $gray,
        );
        imagesetstyle($im, $style);
        $y1 = rand(0, $height);
        $y2 = rand(0, $height);
        $y3 = rand(0, $height);
        $y4 = rand(0, $height);
        imageline($im, 0, $y1, $width, $y3, IMG_COLOR_STYLED);
        imageline($im, 0, $y2, $width, $y4, IMG_COLOR_STYLED);
        for ($i = 0; $i < 80; $i++) {
            imagesetpixel($im, rand(0, $width), rand(0, $height), $black);
        }
        $strx = rand(3, 8);
        for ($i = 0; $i < $length; $i++) {
            $strpos = rand(1, 6);
            imagestring($im, 5, $strx, $strpos, substr($code, $i, 1), $black);
            $strx += rand(8, 12);
        }
        imagepng($im);
        imagedestroy($im);
    }
}

$captcha = new Captcha;
$captcha->generator(4, 60, 20);
