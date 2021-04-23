<?php
if ((int)$current_user['privileges'] < 2) {

    exit('Unauthorized');
}
?> 