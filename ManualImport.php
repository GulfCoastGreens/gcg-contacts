<?php



// Initialize Composer autoloader
try {
    if (!file_exists($autoload = __DIR__ . '/vendor/autoload.php')) {
        throw new \Exception('Composer dependencies not installed. Run `make install --directory app/api`');
    }
    require_once $autoload;
    
    
    $filename = 'stpetegreens.csv';
    echo $filename;
    $googleContactsImport = new GCG\Contacts\GoogleContactsImport();
    // $googleContactsImport->import('stpetegreens.csv');
    $googleContactsImport->import($filename);
} catch (Exception $ex) {

}
    
//namespace GCG\Contacts;
//
//# use GCG\Contacts\GoogleContactsImport;
//include 'GoogleContactsImport.php';
//
//$googleContactsImport = new GoogleContactsImport();


/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

