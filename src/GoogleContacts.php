<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace GCG\Contacts;

use \JSend\JSendResponse;
/**
 * Description of GoogleContact
 *
 * @author jam
 */
class GoogleContacts extends \GCG\Core\AbstractMongoConnection {
    private $contactsdb = null;
    private function getContactsdb() {
        if ($this->contactsdb === null) {
            $this->contactsdb = $this->getMongoConnection()->contacts;
        }
        return $this->contactsdb;
    }
    
    
}
