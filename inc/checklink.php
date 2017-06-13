<?php
function checkLink($test)
{
    if (preg_match("#https?://www\.youtube\.com/watch\?v=#i",$test))
    {
        $beginning = strpos($test, "https://www.youtube.com/watch?v=");
        $end = 43;
        $url1 = substr($test, $beginning, $end);
        $test = preg_replace("#https?://www\.youtube\.com/watch\?v=.{11}#i", "", $test);
        $urlbien = substr_replace($url1,"embed/",24,8);
        echo "<p>.$test.</p>";
        echo '<div class="embed-responsive embed-responsive-16by9">';
        echo '<p><iframe src='.$urlbien.' allowfullscreen></iframe></p>';
        echo "</div>";
    }
    else if (preg_match("#https?://www\.dailymotion\.com/video/.{7}#i",$test))
    {
        $beginning = strpos($test, "http://www.dailymotion.com/video/");
        $end = 40;
        $url = substr($test, $beginning, $end);
        $urlbien = preg_replace("#https?://www\.dailymotion\.com/video/#i", "http://www.dailymotion.com/embed/video/", $url);
        $test = preg_replace("#https?://www\.dailymotion\.com/video/.{7}#i", "", $test);
        echo "<p>".$test."</p>";
        echo '<div class="embed-responsive embed-responsive-16by9">';
        echo '<p><iframe src='.$urlbien.' allowfullscreen></iframe>';
        echo "</div>";
    }
    else if (preg_match("#/media/.+\.(jpe?g|gif|bmp|png)#i",$test))
    {
        $beginning = strpos($test, "/media/");
        $end = 39;
        $url1 = substr($test, $beginning, $end);
        $exp = substr($test, $beginning, $end+5);
        $expbien = preg_replace("# #","",$exp);
        $ext = ".".preg_replace("#/media/.+\.#","",$expbien);
        $test = preg_replace("#/media/.+\.(jpe?g|gif|bmp|png)#i","",$test);
        $urlbien = '/ensisocial/data'.$url1.$ext;
        echo '<p>'.$test.'</p>';
        echo '<div>';
        echo '<p><img src="'.$urlbien.'" class="img-responsive" alt="'.$ext.'"></p>';
        echo "</div>";
    }
    else if (preg_match("#/media/.+\.mp3#i",$test))
    {
        $beginning = strpos($test, "/media/");
        $end = 39;
        $url1 = substr($test, $beginning, $end);
        $exp = substr($test, $beginning, $end+4);
        $expbien = preg_replace("# #","",$exp);
        $ext = ".".preg_replace("#/media/.+\.#","",$expbien);
        $test = preg_replace("#/media/.+\.mp3#i","",$test);
        $urlbien = '/ensisocial/data'.$url1.$ext;
        echo '<p>'.$test.'</p>';
        echo '<div>';
        echo '<p><audio src="'.$urlbien.'" controls></audio></p>';
        echo "</div>";
    }
    else if (preg_match("#/media/.+\.(mp4|mped|wav)#i",$test))
    {
        $beginning = strpos($test, "/media/");
        $end = 39;
        $url1 = substr($test, $beginning, $end);
        $exp = substr($test, $beginning, $end+4);
        $expbien = preg_replace("# #","",$exp);
        $ext = ".".preg_replace("#/media/.+\.#","",$expbien);
        $test = preg_replace("#/media/.+\.(mp4|mped|wav)#i", "", $test);
        $urlbien = '/ensisocial/data'.$url1.$ext;
        echo '<p>'.$test.'</p>';
        echo '<div class="embed-responsive embed-responsive-16by9">';
        echo '<p><video src='.$urlbien.' controls></video></p>';
        echo "</div>";
    }
    else if (preg_match("#/media/.+\.pdf#i",$test))
    {
        $beginning = strpos($test, "/media/");
        $end = 39;
        $url1 = substr($test, $beginning, $end);
        $exp = substr($test, $beginning, $end+5);
        $expbien = preg_replace("# #","",$exp);
        $ext = ".".preg_replace("#/media/.+\.#","",$expbien);
        $test = preg_replace("#/media/.+\.pdf#i","",$test);
        $urlbien = '/ensisocial/data'.$url1.$ext;
        echo '<p>'.$test.'</p>';
        echo '<div class="embed-responsive embed-responsive-16by9">';
        echo '<p><embed src="'.$urlbien.'" type="application/pdf"'.$ext.'"></p>';
        echo "</div>";
    }
    else
    {
        echo '<p>'.$test.'</p>';
    }
}
?>
