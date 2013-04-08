<?php if (!isset($sidebar)) { ?>
<aside class="right">
					
					<h2>Right Side Panel Content</h2>
				</aside>
    <div id="sidebar_container" class="right">
        <?php
            foreach ($sidebar as $file) {
                $file="application/views/layouts/include/default/sidebar/".$file.".php";
                if(file_exists($file )) {
                        include($file);
               }
            }
        ?>
    </div>
<?php } ?>