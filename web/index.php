<?php
    $repo_prefix = 'repository.cache-sk-';
    $files_prefix = './files/';
    $ignore_files = array('.htaccess','.gitkeep','index.php');

	if (isset($_GET["path"])){
        if (false !== strpos($_GET["path"],$repo_prefix)){
		    header("Location: https://cache-sk.github.io/kodirepo/repository.cache-sk/".$_GET["path"]);
        } else {
            header("Location: ".$files_prefix.$_GET["path"]);
        }
		die;
	}
	$contents = file_get_contents("https://cache-sk.github.io/kodirepo/");
	preg_match_all('/.*'.$repo_prefix.'([0-9]+.[0-9]+.[0-9]+).zip.*/', $contents, $matches);
    
    $files = array_filter(scandir($files_prefix), function($item){
        global $files_prefix, $ignore_files;
        return is_file($files_prefix.$item) && !in_array($item,$ignore_files);
    });
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 3.2 Final//EN">
<html>
<body>
<a href="<?=$repo_prefix?><?=$matches[1][0]?>.zip"><?=$repo_prefix?><?=$matches[1][0]?>.zip</a><br/>
<?php
    foreach ($files as $fname){
        echo("<a href=\"$fname\">$fname</a><br/>\n");
    }
?>
</body>
</html>