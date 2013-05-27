<?php

class Restaurant extends Eloquent {
	 /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'restaurant';
    protected $primaryKey = 'id';
   	// Une moulinette entre les donneés de l'ancienne base de données vers la nouvelle
    public function initialisation(){
    	$resto = array(
    				array("/restau/mcdonald-big-mac_gallery2.jpg","MacDo"),
    				array("/restau/10379_01_00.jpg","Flunch"),
    				array("/restau/snack-americain-vintage-tommys-diner-7-944x615.jpg","Tommy's"),
    				array("/restau/pizza-del-arte-paris-1349599210.jpg","Del Arte"),
    				array("/restau/BuffetChinois.jpg","Chinois"),
    				array("/restau/burger-danys.jpg","Dany's burger"),
    				array("/restau/1837-coffret-salade.jpg","Class Croute"),
    				array("/restau/a8174542-0438-11df-9293-2147a92c2c7c.jpg","Sandwich Carrefour"),
    				array("/restau/KFC_home.png","KFC"),
    				array("/restau/b3138210.jpg","Quick"),
    				array("/restau/diet.jpg","Ne mange pas !"),
    				array("/restau/97538710.jpg","Gamelle"),
    				array("/restau/lapataterie2.jpg","La pataterie"),
				);
    	foreach ($resto as $k => $v) {
    		$restaurant  = new Restaurant;
			$restaurant->logo =$v[0];
			$restaurant->nom =$v[1];
			$restaurant->save();
    	}
    }
    public function vouloir()
    {
        return $this->hasMany('Vouloir','id_restaurant');
    }
	public function getStatisticByConversion($from,$to){
		$stats = Conversion::where('stats_date','<=',$to)->where('stats_date','>=',$from)->get();
		$data = array();
		foreach ($stats as $stat) {
			$data[]=array('increasing_conversion_rate' => $stat->increasing_conversion_rate,
						'not_handled_visits_conversion_rate' => $stat->not_handled_visits_conversion_rate,
						'handled_visits_conversion_rate' => $stat->handled_visits_conversion_rate,
						'stats_date' => strtotime($stat->stats_date));
		}
		return $stats;
	}
}