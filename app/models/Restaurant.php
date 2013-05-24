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
		$restaurant  = new Restaurant;
		$restaurant->logo ="/restau/mcdonald-big-mac_gallery2.jpg";
		$restaurant->categorie ="Gras";
		$restaurant->nom ="MacDo";
		$restaurant->save();
		$restaurant  = new Restaurant;
		$restaurant->logo ="/restau/10379_01_00.jpg";
		$restaurant->categorie ="Illimité";
		$restaurant->nom ="Flunch";
		$restaurant->save();
		$restaurant  = new Restaurant;
		$restaurant->logo ="/restau/snack-americain-vintage-tommys-diner-7-944x615.jpg";
		$restaurant->categorie ="Gras";
		$restaurant->nom ="Tommy's";
		$restaurant->save();
		$restaurant  = new Restaurant;
		$restaurant->logo ="/restau/pizza-del-arte-paris-1349599210.jpg";
		$restaurant->categorie ="Rafine";
		$restaurant->nom ="Del Arte";
		$restaurant->save();
		$restaurant  = new Restaurant;
		$restaurant->logo ="/restau/BuffetChinois.jpg";
		$restaurant->categorie ="Illimité";
		$restaurant->nom ="Chinois";
		$restaurant->save();
		$restaurant  = new Restaurant;
		$restaurant->logo ="/restau/burger-danys.jpg";
		$restaurant->categorie ="Gras";
		$restaurant->nom ="Dany's burger";
		$restaurant->save();
		$restaurant  = new Restaurant;
		$restaurant->logo ="/restau/1837-coffret-salade.jpg";
		$restaurant->categorie ="Sandwich";
		$restaurant->nom ="Class Croute";
		$restaurant->save();
		$restaurant  = new Restaurant;
		$restaurant->logo ="/restau/a8174542-0438-11df-9293-2147a92c2c7c.jpg";
		$restaurant->categorie ="Pas cher";
		$restaurant->nom ="Sandwich Carrefour";
		$restaurant->save();
		$restaurant  = new Restaurant;
		$restaurant->logo ="/restau/KFC_home.png";
		$restaurant->categorie ="Gras";
		$restaurant->nom ="KFC";
		$restaurant->save();
		$restaurant  = new Restaurant;
		$restaurant->logo ="/restau/b3138210.jpg";
		$restaurant->categorie ="Gras";
		$restaurant->nom ="Quick";
		$restaurant->save();
		$restaurant  = new Restaurant;
		$restaurant->logo ="/restau/diet.jpg";
		$restaurant->categorie ="-";
		$restaurant->nom ="Ne mange pas !";
		$restaurant->save();
		$restaurant  = new Restaurant;
		$restaurant->logo ="/restau/97538710.jpg";
		$restaurant->categorie ="-";
		$restaurant->nom ="Gamelle";
		$restaurant->save();
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