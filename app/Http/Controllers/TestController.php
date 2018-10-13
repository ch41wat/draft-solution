<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class TestController extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */
     public function store()
     {
       $inputName = Input::only('name');
	   $inputPassword = Input::only('password');
       print_r($inputName);
	   print_r($inputPassword);
       exit();
	   
	if(isset($inputName) && isset($inputPassword)){

    $adServer = "ldap://eastwater.adinfra";

    $ldap = ldap_connect($adServer);

    $username = $_POST['name'];
    $password = $_POST['password'];
	//$password = 'P@ssw0rd';

    $ldaprdn = $username.'@eastwater.adinfra';

    ldap_set_option($ldap, LDAP_OPT_PROTOCOL_VERSION, 3);
    ldap_set_option($ldap, LDAP_OPT_REFERRALS, 0);

    $bind = @ldap_bind($ldap, $ldaprdn, $password);
	//echo $bind;
	//exit();

    if ($bind) {
        $filter="(sAMAccountName=$username)";
		echo($filter);
		exit();
        $result = ldap_search($ldap,"dc=EASTWATER,dc=ADINFRA",$filter);
        ldap_sort($ldap,$result,"sn");
        $info = ldap_get_entries($ldap, $result);
        for ($i=0; $i<$info["count"]; $i++)
        {
			$user = $info[$i]["samaccountname"][0];

			//header("location: http://127.0.0.1:8000/test/.$user");
			//header("location: http://127.0.0.1:8000/api/chklogin");
			exit(2);
			if($info['count'] > 1)
            break;
            echo "<p>You are accessing <strong> ". $info[$i]["sn"][0] .", " . $info[$i]["givenname"][0] ."</strong><br /> (" . $info[$i]["samaccountname"][0] .")</p>\n";
            echo $info[$i]["samaccountname"][0];
			echo '<pre>';
            var_dump($info);
            echo '</pre>';
			echo $info[$i]["sn"][0];
            $userDn = $info[$i]["distinguishedname"][0];
		}
        @ldap_close($ldap);
    } else {
        $msg = "User Not Found On Active Directory Server";
        echo $msg;
    }
	
	
    }

	}
}
