<?php
/*  
	"Μισθοδοσία online" - Εφαρμογή άντλησης και παρουσίασης οικoνομικών στοιχείων από αρχεία XML
    Copyright (C) 2011 Βελέντζας Αλέξανδρος (fractalbit@gmail.com)

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see http://www.gnu.org/copyleft/gpl.html.
*/

/* *********** ΓΕΝΙΚΗ ΠΕΡΙΓΡΑΦΗ ΛΕΙΤΟΥΡΓΙΑΣ ΑΡΧΕΙΟΥ *********** */
// Το αρχείο αυτό γίνεται include στα αρχεία της εφαρμογής και φορτώνει όλα τα απαραίτητα αρχεία για τη λειτουργία της
/* *********** ΤΕΛΟΣ ΓΕΝΙΚΗΣ ΠΕΡΙΓΡΑΦΗΣ *********** */

// error_reporting(E_ALL); ini_set('display_errors', '1');

if(!file_exists('config.inc.php')) die('To arxeio config.inc.php de vrethike. Parakaloume diavaste <a href="https://github.com/fractalbit/misthodosia-online/blob/master/readme.md">tin tekmiriosi</a>');

include('./functions.inc.php');
include('./config.inc.php');
include('./efpp.class.php');


include('./ranks.php');
include('./eapCodes.php');
if(file_exists('./passwords.php')){
    include('./passwords.php');
}else{
    $protected = array();
}

$session_path = trailingslashit(APP_DIR) . 'session_data';
if(!empty($session_path)) fSession::setPath($session_path);
fSession::setLength('1 hour');
fSession::open();

fAuthorization::setAuthLevels(
    array(
        'admin' => 100,
        // 'user'  => 50,
        // 'guest' => 25
    )
);


$admin = new efpp_user(SUPER_USER, SUPER_PASS, false);
