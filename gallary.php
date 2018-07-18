<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style>
body {
  font-family: Verdana, sans-serif;
  margin: 0;
}

* {
  box-sizing: border-box;
}

.row > .column {
  padding: 0 8px;
}

.row:after {
  content: "";
  display: table;
  clear: both;
}

.column {
  float: left;
  width: 25%;
  
  margin-bottom: 20px;
}

/* The Modal (background) */
.modal {
  display: none;
  position: fixed;
  z-index: 1;
  padding-top: 100px;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto;
  background-color: black;
}

/* Modal Content */
.modal-content {
  position: relative;
  background-color: #fefefe;
  margin: auto;
  padding: 0;
  width: 90%;
  max-width: 1200px;
}

/* The Close Button */
.close {
  color:white;
  position: absolute;
  top: 10px;
  right: 25px;
  font-size: 35px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color:red;
  text-decoration: none;
  cursor: pointer;
}

.mySlides {
  display: none;
}

.cursor {
  cursor: pointer;
}

/* Next & previous buttons */
.prev,
.next {
  cursor: pointer;
  position: absolute;
  top: 50%;
  width: auto;
  padding: 16px;
  margin-top: -50px;
  color: white;
  font-weight: bold;
  font-size: 20px;
  transition: 0.6s ease;
  border-radius: 0 3px 3px 0;
  user-select: none;
  -webkit-user-select: none;
}

/* Position the "next button" to the right */
.next {
  right: 0;
  border-radius: 3px 0 0 3px;
}

/* On hover, add a black background color with a little bit see-through */
.prev:hover,
.next:hover {
  background-color: rgba(0, 0, 0, 0.8);
}

/* Number text (1/3 etc) */
.numbertext {
  color: #f2f2f2;
  font-size: 12px;
  padding: 8px 12px;
  position: absolute;
  top: 0;
}

img {
 
}

.caption-container {
  text-align: center;
  background-color: black;
  padding: 2px 16px;
  color: white;
}

.demo {
  opacity: 0.6;
}

.active,
.demo:hover {
  opacity: 1;
}

img.hover-shadow {
  transition: 0.3s;
}

.hover-shadow:hover {
  box-shadow: 0 6px 10px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}
</style>
<link href="css/styles.css" rel="stylesheet" type="text/css">
<body>
<h2 style="text-align:center">Gallary</h2>
<div class="container">
  
  <br/>
<div class="row">
  <?php 
  include'connectivitySitedb.php';
  $sql="select * from images";
   $result = $con->query($sql) or die($con->error);

   $no=1;
  while($row=$result->fetch_assoc())
   { 
    $imgId=$row["imgId"];
   $imgLink=$row["imgLink"];
   $links[$no]=$imgLink;
   $no++;
   }
   

   if(isset($_GET["addimage"]))
   {
     $imageupload="images/megan.jpg";
    addimage($imageupload);
   }


 
 $nimg=$result->num_rows;  //no of images
  //echo "number of rows: " . $result->num_rows;
for($i=1;$i<=$nimg;$i++)
{
    echo '<div class="column">';
    echo' <img src='.$links[$i].' style="width:100%" onclick="openModal();currentSlide('.$i.');"class="hover-shadow cursor">';
    echo '</div>';
}
  echo'<div id="myModal" class="modal">';
  echo' <span class="close cursor" onclick="closeModal()">&times;</span>';
  echo'<div class="modal-content">';
    
     
    for($i=1; $i<=$nimg; $i++)
    {
      echo'<div class="mySlides">';
      echo'<div class="numbertext">'.$i.'/'.$nimg.'</div>';
      echo'<img src='.$links[$i].' style="width:100%">';
      echo'</div>';
    }
    echo'<a class="prev" onclick="plusSlides(-1)">&#10094;</a>';
    echo'<a class="next" onclick="plusSlides(1)">&#10095;</a>';


echo'  </div>';
echo'</div>';
?>
<script>
function openModal() {
  document.getElementById('myModal').style.display = "block";
}

function closeModal() {
  document.getElementById('myModal').style.display = "none";
}

var slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("demo");
  var captionText = document.getElementById("caption");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
      slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
      dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
  captionText.innerHTML = dots[slideIndex-1].alt;
}
</script>

      
</body>

</html>
