<?php

use Illuminate\Database\Seeder;
use App\User;

class UserDefaultSeeder extends Seeder
{
    
    public function run()
    {
        
        if(User::count() < 1) {

    		$password = 'prianti';

	    	User::create([
	    		'name' => 'Prianti',
				'email' => 'hola@prianti.mx',
				'password' => bcrypt($password)
	    	]);
	    }

    }
}
