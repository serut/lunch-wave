
<!DOCTYPE html>

<!--[if IE 7]>                  <html class="ie7 no-js" lang="en">     <![endif]-->
<!--[if lte IE 8]>              <html class="ie8 no-js" lang="en">     <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--> <html class="not-ie no-js" lang="en">  <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	
	<title>Dinner Time ! - Netwave  </title>
	<link rel="shortcut icon" href="/assets/restau/favicon.ico">
	<meta name="description" content="">
	<meta name="author" content="lmieulet">
	
	<!--[if !lte IE 6]><!-->
		<link rel="stylesheet" href="{{ asset("/assets/restau/style.css")}}" media="screen" />

		<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400,600,300,800,700,400italic|PT+Serif:400,400italic" />
		
		<link rel="stylesheet" href="{{ asset("/assets/restau/fancybox.min.css")}}" media="screen" />

		<link rel="stylesheet" href="{{ asset("/assets/restau/video-js.min.css")}}" media="screen" />

		<link rel="stylesheet" href="{{ asset("/assets/restau/audioplayerv1.min.css")}}" media="screen" />
	<!--<![endif]-->

</head>
<body>

<header id="header" class="container clearfix">

	<a href="#nothing" id="logo">
		<img src="{{ asset("/assets/restau/logo.png")}}" alt="Netwave" style="width: 180px;">
	</a>

	<nav id="main-nav">
		
		<ul>
			@if (!empty($id_user))
				<li>
					<a href="/">Deconnexion</a>
				</li>
			@endif
			
		</ul>

	</nav><!-- end #main-nav -->
	
</header><!-- end #header -->

<section id="content" class="container clearfix" style="display:none;">
	<h2 class="slogan align-center"> Bonjour <span id="pseudo"></span><br />
	Et bon appétit ! </h2>

	<h6 class="section-title">Tous les restaurants </h6>

	<ul class="projects-carousel" style="width: 1000px;">
		@if (!empty($mesRestaurants))
		<?php $number = 0; ?>
            @foreach ($mesRestaurants as $k => $v)
				<?php $number++; ?>
                <li data-id-restaurant="{{$v->id}}">
					<a href="#">
						<h3>{{$v->nom}}</h3><br>
						<img src="/assets{{$v->logo}}" alt="" width=220 height=140>
						<span class="categories success">
							<strong id="pour-{{$v->id}}">
								Chargement ..
							</strong>
						</span>
						<span class="categories error">
							<strong id="contre-{{$v->id}}">
								Chargement ..
							</strong>
						</span>
						<a style="float:left;" onclick="sajouter({{$v->id}})"><img src="{{ asset("/assets/restau/like.png")}}" width="50"></a>
						<a style="float:right;" onclick="seretirer({{$v->id}})"><img src="{{ asset("/assets/restau/dislike.png")}}" width="50"></a>
					</a>
				</li>
				@if($number==4)
					<div style="clear:both"></div>
					<?php $number = 0; ?>
				@endif
            @endforeach
        @endif
	</ul><!-- end .projects-carousel -->

</section><!-- end #content -->
<section id="connexion" class="container clearfix"  style="display:none;">
	<div class="align-center">
		@if (!empty($allUser))
		<h6>Connectez vous : </h6>
			<form method="get">
				<select id="user-select" name="id">
				@foreach ($allUser as $k => $v)
			  		<option value="{{$v->id}}">{{$v->pseudo}}</option>
				@endforeach
				</select> 
				<input type="submit" value="Valider" id="btn-connexion">
		    </form>
	    @endif
	</div>
</section><!-- end #connexion -->
<footer id="footer" class="clearfix">


</footer><!-- end #footer -->

<footer id="footer-bottom" class="clearfix">

	<div class="container">

		<ul>
			<li>@ 2013 Netwave</li>
		</ul>

	</div><!-- end .container -->

</footer><!-- end #footer-bottom -->

<!--[if !lte IE 6]><!-->
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="{{ asset("/assets/restau/jquery-1.7.1.min.js")}}"><\/script>')</script>
	<script src="{{ asset("/assets/restau/jquery.ui.widget.min.js")}}"></script>
	<script src="{{ asset("/assets/restau/respond.min.js")}}"></script>
	<script src="{{ asset("/assets/restau/jquery.easing-1.3.min.js")}}"></script>
	<script src="{{ asset("/assets/restau/jquery.fancybox.pack.js")}}"></script>
	<script src="{{ asset("/assets/restau/jquery.smartStartSlider.min.js")}}"></script>
	<script src="{{ asset("/assets/restau/jquery.cycle.all.min.js")}}"></script>
	<script src="{{ asset("/assets/restau/jquery.isotope.min.js")}}"></script>
	<script src="{{ asset("/assets/restau/audioplayerv1.min.js")}}"></script>
	<script src="{{ asset("/assets/restau/jquery.touchSwipe.min.js")}}"></script>
	<script src="{{ asset("/assets/restau/custom.js")}}"></script>
	<script type="text/javascript">
		@if (empty($id_user))
			$('#content').hide();
			$('#connexion').show();
		@else
			$('#connexion').hide();
			$('#content').show();
			$('#pseudo').html("{{$username->pseudo}}");
			var id_user={{$id_user}};
		@endif
		function sajouter(idRestau){
			$.ajax({
				dataType: "json",
				url:'/',
				type: "POST",
				async :true,
				data: {
					'restos':idRestau,
					'user':id_user,
					'pour':true,
				},
			}).done(function(json){
				updateLabels(json,idRestau)
			});
		}
		function seretirer(idRestau){
			$.ajax({
				dataType: "json",
				url:'/',
				type: "POST",
				async :true,
				data: {
					'restos':idRestau,
					'user':id_user,
					'pour':false,
				},
			}).done(function(json){
				updateLabels(json,idRestau)
			});
		}
		function updateLabels(json,idRestau){
			if(json['usersOk'].length ==0 ){
				$('#pour-'+idRestau).html("-");
			}else{
				$('#pour-'+idRestau).html(json['usersOk']);
			}
			if(json['usersNotOk'].length ==0 ){
				$('#contre-'+idRestau).html("-");
			}else{
				$('#contre-'+idRestau).html(json['usersNotOk']);
			}
		}

		window.setInterval(actualizeGrouped,5000);
		function actualizeGrouped(){
			var data={
				'restos':{},
				'user':id_user,
				'pour':'aucun',
			};
			$('.projects-carousel li').each(function(){
				data.restos[$(this).attr('data-id-restaurant')]=true;
			})
			$.ajax({
				dataType: "json",
				url:'/',
				type: "POST",
				async :true,
				data:data
			}).done(function(json){
				$.each(json,function(i,e){
					updateLabels(e,i);
				});
			});
			
		}
	</script>
<!--<![endif]-->
</body>
</html>