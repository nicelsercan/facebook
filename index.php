<!DOCTYPE html>
<html>
  <head>
		<meta charset="utf-8"/>
	</head>
	<body>
		<?php
			require 'src/facebook.php';
			$config = array(
			
				'appId' => '450658154997347',
				'secret' => '7f065542c6877abf78fcea4a88827c13'
			);
			
			$facebook = new Facebook($config);
			$user_id = $facebook->getUser();
			
			if($user_id){
				
				try{
					$params = array(
						'fields' => 'name'
					);
					
					$user = $facebook->api('/me', $params);
					echo "Hoşgeldin:" . $user['name'];
				}
				catch(FacebookApiException $e){
					
					echo "Hata ! ". $e->getMessage();
				}
			}
			else{
				
				$config = array(
					
					'scope' => 'publish_stream,friends_about_me',
					'redirect_uri' => 'https://apps.facebook.com/anketimm'				
				);
				
				$login_url = $facebook->getLoginUrl($config);
				echo "<script>top.location.href = '$login_url' </script>";
			}
		?>
	</body>
</html>
