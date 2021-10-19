#!/usr/bin/env php
<?php
// <xbar.title>Ethereum ETH Gas</bitbar.title>
// <xbar.version>v1.0</bitbar.version>
// <xbar.author>Brano Gege</bitbar.author>
// <xbar.author.github>2ge</bitbar.author.github>
// <xbar.desc>Ethereum GAS price forecast</bitbar.desc>
// <xbar.image>https://i.imgur.com/g5xQQCn.png</bitbar.image>
// <xbar.dependencies>php >= 6</bitbar.dependencies>
// <xbar.abouturl>https://ethgas.watch/</xbar.abouturl>

define('GAS_URL', 'https://ethgas.watch/api/gas');

$gas = curl(GAS_URL);
$gas = is_array($gas) ? $gas : die();
$out = array();

foreach($gas as $k => $v) {
    if(isset($v['gwei'])) {
        $out[] = "$k - {$v['gwei']} | href=https://ethgas.watch/";
        $last = $v['gwei'];
    }
}
echo "⛽ " . $last . "\n";
echo "---\n";
echo implode("\n", $out);

function curl($url)
{
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
    curl_close($ch);
    return @json_decode($output, true);
}

