<?php if (isset($sidebar)) { ?>
    <aside class="right">
        <?php
            foreach ($sidebar as $file) {
                $file="application/views/layouts/include/default/sidebar/".$file.".php";
                if(file_exists($file)) {
                    include($file);
               }
            }
        ?>
    </aside>
<?php } ?>