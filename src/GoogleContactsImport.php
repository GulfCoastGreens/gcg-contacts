<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace GCG\Contacts;

use Goodby\CSV\Import\Standard\Lexer;
use Goodby\CSV\Import\Standard\Interpreter;
use Goodby\CSV\Import\Standard\LexerConfig;
use \JSend\JSendResponse;
use GCG\Contacts\GoogleContactsImport;

/**
 * Description of GoogleContactsImport
 *
 * @author James Jones
 */
class GoogleContactsImport extends GCG\Contacts\GoogleContacts {

    //put your code here
    public function import($filename) {

        $lexer = new Lexer(new LexerConfig());
        $lexer->setToCharset('UTF-8') // Customize target encoding. Default value is null, no converting.
                ->setFromCharset('UTF-16LE'); // Customize CSV file encoding. Default value is null.
        $interpreter = new Interpreter();
        $interpreter->addObserver(function(array $row) {
            $this->evaluate([
                'county_code' => $row[0],
                'voter_id' => $row[1],
                'name_last' => $row[2],
                'name_suffix' => $row[3],
                'name_first' => $row[4],
                'name_middle' => $row[5],
                'suppress_address' => $row[6],
                'residence_address_line_1' => $row[7],
                'residence_address_line_2' => $row[8],
                'residence_city' => $row[9],
                'residence_state' => $row[10],
                'residence_zipcode' => $row[11],
                'mailing_address_line_1' => $row[12],
                'mailing_address_line_2' => $row[13],
                'mailing_address_line_3' => $row[14],
                'mailing_city' => $row[15],
                'mailing_state' => $row[16],
                'mailing_zipcode' => $row[17],
                'mailing_country' => $row[18],
                'gender' => $row[19],
                'race' => $row[20],
                'birth_date' => $row[21],
                'registration_date' => $row[22],
                'party_affiliation' => $row[23],
                'precinct' => $row[24],
                'precinct_group' => $row[25],
                'precinct_split' => $row[26],
                'precinct_suffix' => $row[27],
                'voter_status' => $row[28],
                'congressional_district' => $row[29],
                'house_district' => $row[30],
                'senate_district' => $row[31],
                'county_commission_district' => $row[32],
                'school_board_district' => $row[33],
                'daytime_area_code' => $row[34],
                'daytime_phone_number' => $row[35],
                'daytime_phone_extension' => $row[36]
            ]);


            // do something here.
            // for example, insert $row to database.
        });
        $lexer->parse($filename, $interpreter);
    }

    public function evaluate(array $rawcontact) {
        $googlecontacts = $this->getContactsdb()->googlecontacts;
        $insert_status = $googlecontacts->insert($rawcontact);
        if(!$insert_status) {
            echo "failed insert";
        } else {
            echo '.';
        }
    }
}
