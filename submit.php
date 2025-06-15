<?php

$date = $_POST['date'] ?? '';
$content = $_POST['content'] ?? '';

if (!$date || !$content) {
    echo "エラー：日付または内容が未入力です。";
    exit;
}

// 日付を曜日付きに変換
$timestamp = strtotime($date);
$weekdays = ["日", "月", "火", "水", "木", "金", "土"];
$weekday_en = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
$day_of_week = $weekday_en[date("w", $timestamp)];
$formatted_date = date("Y-m-d", $timestamp) . "-" . $day_of_week;

$xmlFile = 'diary.xml';

if (!file_exists($xmlFile)) {
    $template = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n<diary>\n</diary>";
    file_put_contents($xmlFile, $template);
}

$doc = new DOMDocument('1.0', 'UTF-8');
$doc->preserveWhiteSpace = false;
$doc->formatOutput = true;
$doc->load($xmlFile);

// <entry>
$entry = $doc->createElement('entry');

// <date>
$dateElem = $doc->createElement('date', $formatted_date);
$entry->appendChild($dateElem);

// <content>（CDATA なしで改行保持）
$contentElem = $doc->createElement('content');
$contentText = $doc->createTextNode($content);
$contentElem->appendChild($contentText);
$entry->appendChild($contentElem);

// 追加して保存
$doc->documentElement->appendChild($entry);
$doc->save($xmlFile);

echo shell_exec('cd');

// shell_exec('git add diary.xml && git commit -m "update from web UI" && git push origin main');

// echo shell_exec('git add diary.xml');
//shell_exec('git commit -m "update from web UI"');

echo "保存しました！<br><a href='form.html'>戻る</a>";

$repoPath = 'C:\\inetpub\\wwwroot\\form-entry';
$git = '"C:\\Program Files\\Git\\cmd\\git.exe"'; // ←正しいパス

$commands = [
    "cd /d $repoPath && $git add diary.xml",
    "cd /d $repoPath && $git commit -m \"update from web UI\"", 
    "cd /d $repoPath && $git push"      
];

foreach ($commands as $cmd) {
    $output = shell_exec($cmd . ' 2>&1');
    echo "<pre><b>Command:</b> $cmd\n$output</pre><hr>";
}

?>
