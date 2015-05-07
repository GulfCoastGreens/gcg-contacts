<?php

$input = fgets(STDIN);



// Initialize Composer autoloader
try {
    if (!file_exists($autoload = __DIR__ . '/vendor/autoload.php')) {
        throw new \Exception('Composer dependencies not installed. Run `make install --directory app/api`');
    }
    require_once $autoload;

    //Access configuration values from default location (/usr/local/etc/gpg/default)
    $config = new \Configula\Config('/usr/local/etc/gpg/default');
    // The connection configuration        
    $gafixedConfig = (array) $config->gafixedConfig;
    function cmp($a, $b) {
        // each($a)['value']
        if (each($a)['value']['start'] == each($b)['value']['start']) {
            return 0;
        }
        return (each($a)['value']['start'] < each($b)['value']['start']) ? -1 : 1;
    }
    usort($gafixedConfig, "cmp");
    while (!feof($input)) {
        $line = fgets($input);
        $arr = [];
        foreach ($gafixedConfig as $column => $parse) {
            $arr[] = substr($line,$parse['start'],$parse['length']);
        }
        fwrite(STDOUT, implode(",", $arr) . "\n");
    }
    fclose($input);
} catch (Exception $ex) {
    echo 'Caught exception: ', $ex->getMessage(), "\n";
}
