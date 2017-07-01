<?php
$host = '110.170.149.35';
$ports = array(21,22,2222, 25, 80, 81, 110, 443, 3306);

foreach ($ports as $port)
{
    $connection = fsockopen($host, $port);

    if (is_resource($connection))
    {
        echo '<h2>' . $host . ':' . $port . ' ' . '(' . getservbyport($port, 'tcp') . ') is open.</h2>' . "\n";

        fclose($connection);
    }

    else
    {
        echo '<h2>' . $host . ':' . $port . ' is not responding.</h2>' . "\n";
    }
}
?>