<?php 
ini_set('post_max_size',"200M");
ini_set('max_execution_time', 120);
ini_set('memory_limit',"256M");
ini_set('max_input_vars',"1000");
echo 'post_max_size in bytes = ' . ini_get('post_max_size');
echo 'max_input_vars in bytes = ' . ini_get('max_input_vars');
phpinfo();

exit;?>
