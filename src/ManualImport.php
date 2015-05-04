<?php
namespace GCG\Contacts;

# use GCG\Contacts\GoogleContactsImport;
include 'GoogleContactsImport.php';

$googleContactsImport = new GoogleContactsImport();
$googleContactsImport->import('stpetegreens.csv');

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

