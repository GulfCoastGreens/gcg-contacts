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
    public function getContactsdb() {
        if ($this->contactsdb === null) {
            $this->contactsdb = $this->getMongoConnection()->contacts;
        }
        return $this->contactsdb;
    }
    
    public function getGroupByName($name) {
        $groups = $this->getContactsdb()->groups;
        $group = $groups->findOne([ "Group" => $name ]);
        if (is_null($group)) {
            return new JSendResponse('fail', [
                "group" => "Group not found!"
            ]);
        }
        return new JSendResponse('success', $group);
    }
    public function addGroup($group) {
        echo "add group start\n";
        $result = $this->getGroupByName($group['Group']);
        if($result->isSuccess()) {
            return new JSendResponse('fail', [
                "group" => "Group already exists!"
            ]);
        }
        $groups = $this->getContactsdb()->groups;
        $insert_status = $groups->insert($group);
        echo "tried to add group\n";
        if(!$insert_status) {
            return new JSendResponse('error', "Group creation could not be performed!");
        } else {
            return $this->getGroupByName($group['Group']);
        }
    }
    
}
