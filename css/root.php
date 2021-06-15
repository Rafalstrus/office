<?php
    header("Content-type: text/css; charset: UTF-8");
        $header = "rgba(26, 129, 194,0.5)";
        $backgroundGradientStart = "rgba(38,194,235,1)";
        $backgroundGradientStop ="rgba(11,47,143,1)";
        $textColor = "#ffffff";
        $footerColor = "rgba(8, 85,167,0.5)";
?>
:root {
  --backgroundGradientStart: <?php echo $backgroundGradientStart; ?>;
  --backgroundGradientStop: <?php echo $backgroundGradientStop; ?>;
  --header: <?php echo $header ?>;
  --textColor: <?php echo $textColor; ?>;
  --footer:<?php echo $footerColor; ?>;
}