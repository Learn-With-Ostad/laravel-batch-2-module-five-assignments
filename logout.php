<?php 
# logout 
if (isset($_POST['logout']))
{
    session_destroy();
}
?>