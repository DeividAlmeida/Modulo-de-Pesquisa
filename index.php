<?php
error_reporting(0);
require_once('controller/main.php');
require_once('mod/index.html');
?>
<script>
    vue.dimensoes= <?php echo $dimensoes?>,
    vue.perguntas= <?php echo $perguntas?>,
    vue.matriz= <?php echo $perguntas?>  
</script>