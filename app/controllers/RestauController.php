<?php
class RestauController  extends BaseController {

	public function getIndex(){
		$mesRestaurants = Restaurant::with(array('vouloir','vouloir.user'))->get() ;
        $user = Input::get('id',0);
        $username='';
        if($user)
        	$username = User::find($user);
		$usersOk=array();
		$usersNotOk=array();
        foreach ($mesRestaurants as $k => $v){
			foreach ($v->vouloir as $voeux){
				if ($voeux->interesse){
					$usersOk[]=$voeux;
				}else{
					$usersNotOk[]=$voeux;
				}
			}
		}
		$allUser = User::all();
        return View::make('restaurant.choix-restau')
        	->with('mesRestaurants',$mesRestaurants)
        	->with('allUser',$allUser)
        	->with('usersNotOk',$usersNotOk)
        	->with('usersOk',$usersOk)
        	->with('id_user',$user)
        	->with('username',$username);
	}

	public function postIndex(){
        $restau = Input::get('restos');
        $user = Input::get('user');
        $pour = Input::get('pour');
        switch ($pour) {
        	case "true":
        		$voeux = new Vouloir();
				$txt = $voeux->voeuxInteresse($restau,$user);
				break;
        	case "false":
        		$voeux = new Vouloir();
				$txt = $voeux->voeuxIninteresse($restau,$user);
				break;
        	default:
        		$voeux = new Vouloir();
        		foreach ($restau as $k=>$v) {
        			$txt[$k]=$voeux->getInteret($k);
        		}
        }
        return Response::json($txt);
    }
}