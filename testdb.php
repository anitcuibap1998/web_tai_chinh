<?php 
echo md5(md5(substr(md5(time()), 0, 16)));
