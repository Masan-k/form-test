<?php   


$repoPath = 'C:\\inetpub\\wwwroot\\form-entry';
$git = '"C:\\Program Files\\Git\\cmd\\git.exe"';
$commands = [    
    "cd /d $repoPath && $git add diary.xml",
    "cd /d $repoPath && $git commit -m \"update from web UI\"", 
    "cd /d $repoPath && $git push"      
    // "$git --version", // Gitのバージョン表示
    // "cd /d $repoPath && $git status", // リポジトリの状態確認
    // "cd /d $repoPath && $git remote -v"      

];

putenv('HOME=C:\\\\Users\\gituser');
foreach ($commands as $cmd) {
    $output = shell_exec($cmd . ' 2>&1');
    echo "<pre><b>Command:</b> $cmd\n$output</pre><hr>";
}

?>
