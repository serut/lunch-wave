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
    	$user  = new User;
		$user->pseudo ="Thomas";
		$user->save();
    	$user  = new User;
		$user->pseudo ="Rémi";
		$user->save();
    	$user  = new User;
		$user->pseudo ="Imed";
		$user->save();
    	$user  = new User;
		$user->pseudo ="Adrien";
		$user->save();
        $user  = new User;
        $user->pseudo ="Philippe";
        $user->save();
        $user  = new User;
        $user->pseudo ="Séverine";
        $user->save();
        $user  = new User;
        $user->pseudo ="Anthony";
        $user->save();
        $user  = new User;
        $user->pseudo ="François";
        $user->save();
        $user  = new User;
        $user->pseudo ="Léo";
        $user->save();
        $user  = new User;
        $user->pseudo ="Florent";
        $user->save();
        $user  = new User;
        $user->pseudo ="Vincent";
        $user->save();
    }

}