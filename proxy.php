<?php
// proxify url to bypass CORS limitation
echo htmlspecialchars_decode(file_get_contents($_GET['url']))
?>