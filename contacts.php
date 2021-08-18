<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Home page</title>
		<?php include "header.php";?>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="https://code.jquery.com/jquery-1.10.2.js"></script>		
		<script src="https://sweetalert.js.org/assets/sweetalert/sweetalert.min.js"></script>	
	</head>

	<body>
    <?php 
    error_reporting(0);
    if(isset($_GET['asset_id']) && !empty($_GET['asset_id']) && ($_GET['asset_id']>0 ) ): 
		$pid = $_GET['asset_id'] ;
		$api_url = 'https://cms.elite-soft.io/real-estate-assets/'.$pid;	
    

    // Read JSON file
    if( $json_data = file_get_contents($api_url) ):
    
    // Decode JSON data into PHP array
    $asset = json_decode($json_data);
   //print_r( $asset->media_assets);

   ?>

		<div class="wrapper">
			<div class="inner">
				<h3>Contact</h3><br>
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
                    foreach ( $asset->media_assets as $value ):
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
                    endforeach;                        
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
                
				<form action="" id="searchForm" >
					<label class="form-group">
						<input type="hidden" name="pid" value="<?php echo $pid?>">
						<input type="text" class="form-control" name="first_name" minlength="2" maxlength="15" required>
						<span style="color: #262222;">First Name</span>
						<span class="border"></span>
					</label>
					<label class="form-group">
						<input type="text" class="form-control" name="last_name" minlength="2" maxlength="15" required>
						<span style="color: #262222;">Last Name</span>
						<span class="border"></span>
					</label>
					<label class="form-group">
						<input type="tel" class="form-control" name="mobile_number" minlength="8" maxlength="13" pattern="[0-9]*"  required>
						<span for="" style="color:#262222">Phone No.</span>
						<span class="border"></span>
					</label>
					<label class="form-group"> 
						<input type="text" class="form-control" name="email" minlength="8" maxlength="30" required>
						<span for="" style="color: #262222";>Email Address</span>
						<span class="border"></span>
					</label>
					<label class="form-group" >
						<label>Would you like to get more details about this Property?</label>
						<select name="is_more_details_selected" id="" class="form-control" required>
						<option value="1" class="options">Yes</option>
						<option value="0" class="options">No</option>
						<span class="border"></span>
						</select>
					</label>
					<label class="form-group" >
						<label>How would you like us to connect with you</label>
						<select name="connect_with" id="" class="form-control" required>
						<option value="WHATSAPP" class="options">Whatsapp</option>
						<option value="WECHAT" class="options">Wechat</option>						
						<option value="EMAIL" class="options">Email</option>
						<option value="SMS" class="options">SMS</option>
						<span class="border"></span>
						</select>
					</label>
					<label class="form-group" >
						<label>Would you like to get more details about similar property in our listing</label>
						<select name="is_similar_property_enabled" id="" class="form-control" required>
						<option value="1" class="options">Yes</option>
						<option value="0" class="options">No</option>
						<span class="border"></span>
						</select>
					</label>                 
					<button type="submit">Submit<i class="zmdi zmdi-arrow-right"></i></button>					
				</form>

	<script>
	
		$( "#searchForm" ).submit(function( event ) {
	
		event.preventDefault();		
		
		var $form = $( this ),
			pid = $form.find( "input[name='pid']" ).val(),
			first_name = $form.find( "input[name='first_name']" ).val(),
			last_name = $form.find( "input[name='last_name']" ).val(),
			mobile_number = $form.find( "input[name='mobile_number']" ).val(),
			is_more_details_selected = $form.find( "select[name='is_more_details_selected']" ).val(),
			connect_with = $form.find( "select[name='connect_with']" ).val(),
			is_similar_property_enabled = $form.find( "select[name='is_similar_property_enabled']" ).val(),
			email = $form.find( "input[name='email']" ).val(),
			
			url = "https://cms.elite-soft.io/real-estate-leads?users_permissions_user.id=66";

			$.post( url, {
					first_name: first_name,
					last_name: last_name , 
					is_more_details_selected : is_more_details_selected,
					connect_with : connect_with,
					is_similar_property_enabled : is_similar_property_enabled,
					email : email,
					mobile_number: mobile_number,					
					users_permissions_user: {"id": 65},
				 }).done(function(response){
					swal("Good job!", "submit successfully", "success");
			      //alert("success");
			      //window.location.replace("sucessfully?nm="+pid);
			});

			

		});
	</script>
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
