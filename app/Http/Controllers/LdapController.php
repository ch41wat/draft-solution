<?php

namespace App\Http\Controllers;

use App\User;
use Session;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class LdapController extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param  int  $id
     * @return Response
     */
	 
	 public function test($username)
	 {
		 
		 
		//$role = User::where('name', $username)->value('role');
			
		//echo $role;
		//exit();
			
		if(User::where('name',$username)->exists()){
			
			$email = User::where('name', $username)->value('email');
			$created_at = User::where('name', $username)->value('created_at');
			$sessionUser = session()->push('sessionUser', $username);
			$sessionEmail = session()->push('sessionEmail', $username);
			$getuser = session()->get('sessionUser');
			//print_r($getuser);
			//exit();
			$sessionCreate_at = session()->push('sessionCreated_at', $username);
			if(User::where('name',$username)->value('role')=='admin'){
				
				return redirect('/admin');
			}
			else if(User::where('name',$username)->value('role')=='sale'){
				return redirect('/en/sale/customer');
			}
			else if(User::where('name',$username)->value('role')=='saleadmin'){
				return '/en/sale/history';
			}
			else {
				return 'Your are not ready allow role from admin';
			}
			
		}
		else {
			User::create([
				'name' => $username,
			]);
		}
		
	 }
	 
	 
     public function logout(){
		return redirect('/login/');
	}
     
}
