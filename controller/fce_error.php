<?php
if(!empty($error_msg))
{
    echo $error_msg;
    $error_msg=null;
}
else if(!empty($msg))
{
    echo $msg;
    $msg=null;
}

?>