<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Home page</title>
		<?php include "header.php";?>
	</head>
	<body>
<?php
error_reporting(0);
if(isset($_GET['asset_id']) && !empty($_GET['asset_id']) && ($_GET['asset_id']>0 ) ): 
	$pid = $_GET['asset_id'] ;
	$api_url = 'https://cms.elite-soft.io/real-estate-assets/'.$pid;

// Read JSON file
if( $json_data = file_get_contents($api_url) ):
//print($json_data);die;
// Decode JSON data into PHP array
$asset = json_decode($json_data);
//print_r( $asset->media_assets);
?>
<div class="wrapper">
<?php
	//echo $_SERVER['HTTP_REFERER'];
	$selp_url = "http://192.168.1.207/dashboard/";
	$directory_file_value =  "property/contacts?asset_id=".$pid;
	$contact_url = $selp_url.$directory_file_value;
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
				<h3>Auction</h3>
        <div class="container"> 
		    <p class="center"><?php echo $asset->address; ?></p>	
		</div><br>
        <div class="container">
        	<i class="fas fa-bed fa-2x"></i>&nbsp;<?php echo $asset->bed_room; ?>&nbsp;   
            <i class="fas fa-toilet fa-2x"></i>&nbsp;<?php echo $asset->bath_room; ?>&nbsp;   
             <i class="fas fa-car fa-2x"></i>&nbsp;<?php echo $asset->parking; ?>&nbsp;
            <i class="far fa-square fa-2x"></i>&nbsp;<?php echo $asset->area; ?> <sup>m2</sup>
        </div>
        <br>
         <!-- <p class="text-under-carousel">Number of Bedroom , Bathroom , Garage , Area of Land</p> -->
        <p class="text-under-carousel">Number of bed room, bath room, car port , land size 
    	<?php 
    		echo $asset->swimming_pool == 'yes' ? ' , swimming pool' : '';
    		echo $asset->tennis_court == 'yes' ? ' , tennis court' : '';
    	?>
          
     </p>
        <br>
        <p align ="center">
			<a href="<?php echo $contact_url; ?>">
				<?php		
				include 'phpqrcode/qrlib.php';
				//$text = $contact_url;				
				/*QRcode::png($text);*/
				//$url = "http://teqnininfotech.com";
				$url = $contact_url;
				$file = "images/".$pid.".png";					
				$ecc = 'M';
				$pixel_size = 6;
				$frame_size = 5;		
				//QRcode::png("http://www.abc.com", "test.png", "L", 4, 4);
				QRcode::png($url, $file, $ecc, $pixel_size, $frame_size);
				echo "<img src='".$file."'>";		
				?>
					
			</a>
        </p>
        <p class="qrcode-text">Scan To Register</p>
        <br>


				</form>
			</div>
		</div>
<?php	
else:
?>
<div class="wrapper">
	<div class="inner">
		<h3>Open Homes</h3><br>
        <p class="text-under-carousel">invalid URL</p> 
        <p class="qrcode-text">Sorry !...</p>		        
	</div>
</div>

	<?php	
endif;
else:
	?>
<div class="wrapper">
	<div class="inner">
		<h3>Open Homes</h3><br>
        <p class="text-under-carousel">invalid URL</p> 
        <p class="qrcode-text">Sorry !...</p>		        
	</div>
</div>
	<?php	
endif;
	?>
	</body>
</html>
