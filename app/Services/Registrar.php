<?php namespace App\Services;

use App\Categories;
use App\PivotCatUser;
use App\User;
use Illuminate\Support\Facades\Input;
use Validator;
use Illuminate\Contracts\Auth\Registrar as RegistrarContract;
use Illuminate\Support\Facades\Auth;

class Registrar implements RegistrarContract {

	/**
	 * Get a validator for an incoming registration request.
	 *
	 * @param  array  $data
	 * @return \Illuminate\Contracts\Validation\Validator
	 */
	public function validator(array $data)
	{
		return Validator::make($data, [
			'name' => 'required|max:255',
			'email' => 'required|email|max:255|unique:users',
			'password' => 'required|confirmed|min:6',
            'mobile_number' => 'required',
            'dob'=>'required',
            'language'=>'required',
            'address'=>'required',
            'area'=>'required',
            'role'=>'required',
            'skill'=>'required',
		]);
	}

	/**
	 * Create a new user instance after a valid registration.
	 *
	 * @param  array  $data
	 * @return User
	 */
	public function create(array $data)
	{
        $fileName = 'null';
        if (Input::file('image')->isValid()) {
            $destinationPath = public_path('/images/uploads');
            $extension = Input::file('image')->getClientOriginalExtension();
            $fileName = time().'.'.$extension;
            Input::file('image')->move($destinationPath, $fileName);
        }
        $t1=0;$t2=0;$t3=0;
        if(isset($data['time'][0])){
            $t1=1;
        }
        if (isset($data['time'][1])){
            $t2=1;
        }
        if(isset($data['time'][2])){
            $t3=1;
        }
        $store=User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'mobile_number' => $data['mobile_number'],
            'dob'=> $data['dob'],
            'language'=> $data['language'],
            'address'=> $data['address'],
            'city'=> $data['area'],
            'role_id'=>$data['role'],
            'rate'=>$data['rate'],
            'image'=>$fileName,
            'morning'=>$t1,
            'afternoon'=>$t2,
            'evening'=>$t3,
            'skill'=>$data['skill'],
        ]);
        for ($i=0;$i<count($data['cat']);$i++){
            $Pivot_Cat=new PivotCatUser();
            $Pivot_Cat->users_id=$store->id;
            $Pivot_Cat->cat_id=$data['cat'][$i];
            $Pivot_Cat->save();
        }
		return $store;
	}

}
