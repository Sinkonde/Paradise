<?php
namespace App\Traits;

use App\Models\Guardian;
use App\Models\User;
use App\Models\UserActivePhone;
use App\Models\UserPhone;

trait SaveGuardian{
    public $user_id;
    public $user_data = [];
    public $guardian_id;
    public $password;

    function storeUser($data){
        $this->user_id = User::create($data)->id;
    }

    function updateUser($user, $data){
        User::find($user)->update($data);
        return;
    }

    function storePhone($request){
        if (count(explode(',', $request->phone))) {
            $i = 1;
            foreach (explode(',', $request->phone) as $phone) {
                $user_phone_id = UserPhone::create(['user_id' => $this->user_id, 'phone' => $phone])->id;

                //make default phone
                if($i == 1){
                    UserActivePhone::updateOrCreate(['user_id' => $this->user_id],['user_phone_id' => $user_phone_id]);
                }
                $i++;
            }
        }
    }

    function updatePhone($userphone, $data){
        return UserPhone::find($userphone)->update($data);
    }

    function storeGuardian($request){
        $this->guardian_id = Guardian::create(array_merge(['user_id'=>$this->user_id, 'work' => !is_null($request->work) ? $request->work :'Mkulima', 'location' =>"Mbeya", 'address' => 'Mbeya'], null !== $request->only(['addres'])?$request->only(['addres']):''))->id;
    }

    function updateGuardian($guardian, $data){
        return Guardian::find($guardian)->update($data);
    }


    function saveGuardian($request, $readyData=false){
        if ($readyData) {
            $this->prepareUSerDataFromRequest($request);
        }
        
        if (!is_null($this->user_data['email'])) {
            $this->user_data['password'] = $this->password;
        }

        $this->storeUser($this->user_data);
        $this->storePhone($request);

        $this->storeGuardian($request);
    }

    function startUpdateGuardianGuardian($request, $readyData=false){
        if ($readyData) {
            $this->prepareUSerDataFromRequest($request);
        }
        $this->updateUser($request->u_g, $this->user_data);
        $this->updateGuardian($request->guardian, $request->only(['work', 'location', 'address']));
    }

    //first run this before run saveGuardian()
    function prepareUSerDataFromRequest($request , $extra = array(), $only=['first_name', 'second_name', 'sur_name', 'gender', 'email']){
        return $this->user_data = array_merge($request->only($only), $extra);
    }

    //Update user
}
