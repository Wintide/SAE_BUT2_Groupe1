<!DOCTYPE html>
<html>
<body>

<h1>My First Heading</h1>
<p>My first paragraph.</p>
<?php


$command = escapeshellcmd('../../sae/bin/python template_test.py');
$output = shell_exec($command);

?>
<img src = "../images/graphe.png">

</body>
</html>
