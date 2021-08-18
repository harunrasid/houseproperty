<?php

/* @var $this yii\web\View */

$this->title = 'home page';
?>
<body>
    <?php   
    	if(isset($_GET['mm']) && !empty($_GET['mm']) && ($_GET['mm']>0 ) ): 
			$pid = $_GET['mm'] ;
		else:
			$pid = 2 ;
		endif;
	    $api_url = 'https://cms.elite-soft.io/real-estate-assets/'.$pid;

	    // Read JSON file
	    $json_data = file_get_contents($api_url);
	    
	    // Decode JSON data into PHP array
	    $asset = json_decode($json_data);
		//print_r( $asset->media_assets);
    ?>

<div class="wrapper">
<?php
	//echo $_SERVER['HTTP_REFERER'];
	//echo "<br>";
	$contact_url =  $_SERVER['HTTP_HOST']."/dashboard/property/contacts?mm=".$pid;
?>
			<div class="inner">
				<h3>Open Homes</h3><br>
				<div id="myCarousel" class="carousel slide" data-ride="carousel">
					<!-- Indicators -->
					<ol class="carousel-indicators">
						<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
						<li data-target="#myCarousel" data-slide-to="1"></li>
						<li data-target="#myCarousel" data-slide-to="2"></li>
					</ol>

					<!-- Wrapper for slides -->
					<div class="carousel-inner">
						<?php
						$key =1;
							foreach ( $asset->media_assets as $value ) {
							if($key==1):
							    $cls = 'item active'; 
							else:
							    $cls = 'item'; 
							endif;            
						?>                            
								<div class="<?php echo $cls; ?>">
									<img src="<?php echo $value->url?>" alt="Los Angeles">
								</div>
						<?php 
						     $key++;
						  } 
						?>					
					</div>

					<!-- Left and right controls -->
					<a class="left carousel-control" href="#myCarousel" data-slide="prev">
						<span class="glyphicon glyphicon-chevron-left"></span>
						<span class="sr-only">Previous</span>
					</a>
					<a class="right carousel-control" href="#myCarousel" data-slide="next">
						<span class="glyphicon glyphicon-chevron-right"></span>
						<span class="sr-only">Next</span>
					</a>
				</div><br>
        <div class="container">
            <i class="fas fa-car fa-2x"></i>&nbsp;<?php echo $asset->parking; ?>
            <i class="fas fa-toilet fa-2x"></i>&nbsp;<?php echo $asset->bath_room; ?>
            <i class="fas fa-bed fa-2x"></i>&nbsp;<?php echo $asset->bed_room; ?>
            <i class="far fa-square fa-2x"></i>&nbsp;<?php echo $asset->area; ?> <sup>2</sup>
        </div>
        <br>
        <p class="text-under-carousel">Number of Bedroom , Bathroom , Garage , Area of Land</p>
        <br>
        <p align ="center">
			<a href="contacts">
				<?php		
				include 'theme/phpqrcode/qrlib.php';
				$text = $contact_url;				
				/*QRcode::png($text);*/
				$file = "theme/images/".$pid.".png";					
				$ecc = 'M';
				$pixel_size = 6;
				$frame_size = 5;		
				
				QRcode::png($text, $file, $ecc, $pixel_size, $frame_size);
				echo "<img src='".$file."'>";		
				?>
					
			</a>
        </p>
        <p class="qrcode-text">Scan To Register</p>
        <br>


				</form>
			</div>
		</div>
	</body>


