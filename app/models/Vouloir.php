<?php

use Illuminate\Auth\UserInterface;

class Vouloir extends Eloquent {

	protected $table = 'vouloir';
    protected $primaryKey = 'id';
   	public $timestamps = false;
   	public function getVoeux($id_restaurant){
   		return Vouloir::where('id_restaurant','=',$id_restaurant)->get();
   	}
   	public function user()
    {
        return $this->belongsTo('User','id_user');
    }
	public function voeuxInteresse($id_restaurant,$id_user){
    	$affectedRows = Vouloir::where('id_restaurant','=',$id_restaurant)->where('id_user','=',$id_user)->where('create_at','=',date("Y-m-d",time()))->update(array('interesse' => 1));
		if($affectedRows==0){
			$voeux = new Vouloir();
	    	$voeux->id_restaurant = $id_restaurant;
	    	$voeux->id_user = $id_user;
	    	$voeux->interesse = 1;
	    	$voeux->create_at=date("Y-m-d",time()); 
	    	$voeux->save();
		}
		return $this->getInteret($id_restaurant);
    }
    public function voeuxIninteresse($id_restaurant,$id_user){
    	$affectedRows = Vouloir::where('id_restaurant','=',$id_restaurant)->where('id_user','=',$id_user)->where('create_at','=',date("Y-m-d",time()))->update(array('interesse' => 0));
		if($affectedRows==0){
			$voeux = new Vouloir();
	    	$voeux->id_restaurant = $id_restaurant;
	    	$voeux->id_user = $id_user;
	    	$voeux->interesse = 0;
	    	$voeux->create_at=date("Y-m-d",time()); 
	    	$voeux->save();
		}
		return $this->getInteret($id_restaurant);
    }
    public function getInteret($id_restaurant){
    	$voeux = Vouloir::with('user')->where('id_restaurant','=',$id_restaurant)->where('create_at','=',date("Y-m-d",time()))->get();
    	$usersOk="";
    	$usersNotOk="";
		foreach ($voeux as $voeu){
			if ($voeu->interesse){
				$usersOk.=$voeu->user->pseudo.' ';
			}else{
				$usersNotOk.=$voeu->user->pseudo.' ';
			}
		}
		return array('usersOk'=>$usersOk,'usersNotOk'=>$usersNotOk);
    }
}