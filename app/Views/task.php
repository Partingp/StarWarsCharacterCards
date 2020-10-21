<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Star Wars Task</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" type="image/png" href="/favicon.ico"/>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="/Assets/CSS/task.css">
	<script src="/Assets/Javascript/task.js"></script>
</head>
<body>

<!-- HEADER: Star wars logo -->
<header align="center">
<img src = "/Assets/Images/starWarsLogo.png" />
</header>

<!-- Text, Button, Carousel -->
<div>

	<div align="center">
		 <h3 id="selectionText">SELECT 3 CHARACTERS! </h3> 
	</div>
	
	<div align="center">
	 <!--Text with buttons div-->
	 <button type="button" id="download" class="btn btn-success disabled">Download</button>
	 <button type="button" id="reset" class="btn btn-danger">Reset</button>
	</div>

	<div id="starWarsCharacters" class="carousel slide container-sm" data-interval="false">
		  <div class="carousel-inner container-sm">
				<?php
						function displayCharacters($characters)
						{			
							$index = 1;
							$len = count($characters);
							echo '<div class="carousel-item active">';
							echo '<div class="row">';
							foreach($characters as $character){ 
								echo '<div class="col-sm">';
								echo'<div class="card" style="max-width:300px">';
									echo '<img class="card-img-top" src="/Assets/Images/starWarsLogo.png" alt="Card image">';
									echo '<div class="card-body">';
										echo "<h4 class='card-title'>$character->name</h4>";
									echo '</div>';
								echo'</div>';
								echo'</div>';
								if($len == $index){	
									echo'</div>';
									echo'</div>';
									break;
								}
								if($index % 3 ==0 )
								{
									echo'</div>';
									if($index % 9 !=0  && $index !=0){
										echo '<div class="row">';
									}
								}
								if($index % 9 ==0 )
								{
									#Closes carousel-item div and creates a new one
									echo'</div>';
				
									echo '<div class="carousel-item">';
									echo '<div class="row">';
								}
								$index++;
							}

						}

						function &getCharacters($url,$characters)
						{
							$json = file_get_contents($url);
							$obj = json_decode($json);
							$next =  $obj->next;
							$characterInfo = $obj->results;

							$charactersFromPage = array();

							foreach($characterInfo as $character)
							{
								$charactersFromPage[]=$character;
							}

							$characters = array_merge($characters,$charactersFromPage);

							if($next!=null)
							{
								return getCharacters($next,$characters);
							}
							else{
								return $characters;
							}

						}

						$characters = &getCharacters('https://swapi.dev/api/people/',array());
						displayCharacters($characters);
						#echo json_encode($characters);

				?>
				<script> var charactersJSON = <?php echo json_encode($characters); ?> ;</script>

		  </div>
		  <a class="carousel-control-prev" href="#starWarsCharacters" role="button" data-slide="prev">
				<span class="carousel-control-prev-icon" aria-hidden="true"></span>
				<span class="sr-only">Previous</span>
		   </a>
		   <a class="carousel-control-next" href="#starWarsCharacters" role="button" data-slide="next">
				<span class="carousel-control-next-icon" aria-hidden="true"></span>
				<span class="sr-only">Next</span>
		   </a>
	</div>


</div>

<!-- -->

</body>
</html>
