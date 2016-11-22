<html>
<head>
<title>Book search using google books api</title>
<body class="<?php if(!isset($_GET['view'])) { echo 'default'; } else { echo $_GET['view']; } ?>" bgcolor="#E6E6FA">
<h1>Book search using Google books api</h1>

	<?php

   
   
  error_reporting(E_ALL);
    
    // setting api version for google search api
    $v = isset($_GET['v']) ? $_GET['v'] : '1';
    // setting user api key for google book search api
    $key = isset($_GET['key']) ? $_GET['key'] : 'AIzaSyAb1JdGlnkBt6ZpnFoj3mmerKEpBJK7Qyg';
    // setting IP
    $ip = isset($_GET['ip']) ? $_GET['ip'] : $_SERVER['REMOTE_ADDR'];
    // setting default search value
    $query = isset($_GET['q']) ? $_GET['q'] : '0307387941';
    //default type
    $type = isset($_GET['type']) ? $_GET['type'] : 'isbn';
  

		$params = 'q=isbn:'.urlencode($query).'';


	if(isset($_GET['q'])): 
    //if Google Books Search API has been queried using the form
    
    echo '<p class="control"><a class="refresh" href="'.basename(__FILE__).'">Try another search?</a></p>'."\n";
    
    // url for google search
    $url = 'https://www.googleapis.com/books/v'.$v.'/volumes?key='.$key.'&userIp='.$ip.'&'.$params.''; 
	
    //build request and send to Google Ajax Search API
    $request = file_get_contents($url);
    
    //decode json object(s) out of response from Google Ajax Search API
    $data = json_decode($request,true);
   
	$totalItems = $data['totalItems']; 

	//make sure some results were returned, show results as html with result numbering and pagination
	if ($totalItems > 0) {
		


		?>



      <?php
               if(isset($_GET['q']))
               {
               	   $q= $_GET['q'];

               	 }

            else 
              echo "missing ISBN";
                
          ?>



		<h2 class="mainHeading">


          


		Results of your Google Books &quot;
		<?php echo $type; ?>
		&quot; 
		search for &quot;
		<?php echo @$_GET['q']; ?>
		&quot; 
		(About <?php echo $totalItems; ?> matches)
		</h2>	
		<ul>
		<?php foreach ($data['items'] as $item) { ?>
			<li>
				<p>
				<a href="<?php echo rawurldecode($item['volumeInfo']['canonicalVolumeLink']); ?>">
				<?php echo $item['volumeInfo']['title']; ?>
					
				</a>
				</p>
				<p>
					<img src="<?php echo rawurldecode($item['volumeInfo']['imageLinks']['smallThumbnail']); ?>" />
					<br />
					
					author: <?php echo $item['volumeInfo']['authors'][0]; ?>
					<br />
					page(s): <?php echo $item['volumeInfo']['pageCount']; ?>
					<br />
					id: <?php echo $item['volumeInfo']['industryIdentifiers'][0]['identifier']; ?>
					<br>
					 isbn: <?php  echo $_GET['q']; ?> 
					<br />
					<a class="expand" href="<?php echo rawurldecode($item['accessInfo']['webReaderLink']); ?>">preview</a>
                     
                     
                    <form action="bookssecond.php" method="post">
                    <table width="200" height="10" >

                    <tr>
                    <td width="200" height="10">
                    <tr>
                 Title:   <input type="label" name="title" value="<?php echo $item['volumeInfo']['title']; ?>" >
                   </tr>
                 </td>
                
                 </br>
                
                 <td width="200" height="10">
                 <tr>
                 Author:   <input type="label" name="authors" value=" <?php echo $item['volumeInfo']['authors'][0]; ?>" >
                  </tr>
                 </td>
                
                 <br>
                
                 <td width="200" height="10">
                 <tr>
                   Page Count: <input type="label" name="pageCount" value=" <?php echo $item['volumeInfo']['pageCount']; ?>">
                  </tr>
                  </td>
                
                   <br>
                 
                   
                     <td width="200" height="10">
                     <tr>
                   ISBN:  <input type="label" name="isbn" value=" <?php  echo $_GET['q']; ?>" >
                     </tr>
                    </td>
                    </tr>
                
                    </table>
                    
                    Add Notes : <input type="textbox" name="notes" value="">     
                   


                     <input type="submit" name="submit" value="submit">
                    	
                    </form>
					<br />
				</p>
			</li>
		<?php } ?>
		</ul>
     <?php 
 }
	 ?>
    
    <?php
    else: //show form and allow the user to check for Google Book search results
    ?>
    

         <!-- VALIDATION  -->     
     <script type="text/javascript">
     	
    function validate(inputnum)
     {
     	var num= /^\d{13}$/;
     	if(inputnum.value.match(num) )
     	{
     		alert("the ISBN number is valid");

     	}
     	else
     	{
     		alert("The ISBN number is invalid");
     	}
     }

     </script>
             
      <!-- VALIDATION ENDS HERE-->


    <form id="searchForm" name="searchForm" action="<?php echo basename(__FILE__); ?>" method="get">
        <fieldset id="searchBox">
            <label>Find Book :</label>
            <input class="text" id="inputnum" name="q" type="text" placeholder="Enter ISBN Number" onfocus="this.value=''; this.onfocus=null;" required />
       
           <button onclick='validate(inputnum);'>Submit</button>

    

        </fieldset>


    </form>
    


    <?php
    //end submit isset if statement on line 73
    endif;
    ?>
	</div><!-- end div main -->
</div><!-- end container div -->


</body>
</html>