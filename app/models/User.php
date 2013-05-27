<?php

use Illuminate\Auth\UserInterface;

class User extends Eloquent {

	protected $table = 'user';
    protected $primaryKey = 'id';
   	public $timestamps = false;
    public function Vouloir(){
        return $this->hasMany('vouloir','id_user');
    }
	public function allUser(){
    	$restau = User::all();
    	return $restau;
    }
    public function addUsers(){
        $users = array("Thomas","Rémi","Imed","Adrien","Philippe","Séverine","Anthony","François","Léo","Florent","Vincent");
        foreach ($users as $k => $v) {
            $user  = new User;
            $user->pseudo =$v;
            $user->save();
        }
    }
}