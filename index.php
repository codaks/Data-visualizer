<?php 
$rows=0;
session_start();
$col=0;
    $rows=0;
    $_SESSION['status'] =  'Inactive';
    $_SESSION['mean'] = 0;
    $_SESSION['median'] = 0;
    $_SESSION['mode'] = 0;
  if(isset($_GET['Import']))
  {
    $_SESSION['file'] =  $_GET['file'];
    $_SESSION['status']='Active';
    $file = $_SESSION['file'];
    $f = fopen($file, "r");
    while (($line = fgetcsv($f)) !== false) {
      $col=0;
            foreach ($line as $cell) {
              $col=$col+1;      
            }
            
          $rows=$rows+1;
    }
    fclose($f);
    if(isset($_GET['result']))
    {
      $_SESSION['status']='Active';
      $command = escapeshellcmd('python C:/xampp/htdocs/Mini/stat.py cereal_breakfast.csv calories n '.$_GET['colum']);
      $output = shell_exec($command);
      $str_arr = explode (" ", $output);
      $_SESSION['mean'] = $str_arr[0];
      $_SESSION['median'] = $str_arr[2];
      $_SESSION['mode'] = $str_arr[4];
    }
  }
?>
<!DOCTYPE html>
<html>
<title>Analysis Dashbord</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="tobe.css" type="text/css">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="tobe.js"></script>
<style>
html,body,h1,h2,h3,h4,h5 {font-family: "Raleway", sans-serif}
table {
  margin-top:40px;
  border-collapse: collapse;
  border-spacing: 0;
  width: 100%;
  border: 1px solid #ddd;
}

th, td {
  text-align: left;
  padding: 8px;
}
th
{
  font-size:15pt;
  background-color: black;
  color:white;
}
tr:nth-child(even){background-color: white}
</style>
<body class="w3-light-grey">

<!-- Top container -->
<div class="w3-bar w3-top w3-black w3-large" style="z-index:3 ">
  <button class="w3-bar-item w3-button w3-hide-large w3-hover-none w3-hover-text-light-grey" onclick="w3_open();"><i class="fa fa-bars"></i>  Menu</button>
  <div style="float:left"><span class="w3-bar-item w3-right" >Analyse To Predict Powered By AI BOAT </span></div>
</div>

<!-- Sidebar/menu -->



<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-top:43px;">
  <h5 style="float:left;margin-left:20px;">Browse Your Dataset Here</h5>
  <form action="index.php" action=GET>
      <input type="file" name="file" id="file" style = "margin-top:11px;">
      <input type="submit" name="Import" value="Upload">
    </form>


  <!-- Header -->
  <header class="w3-container" style="padding-top:5px">
    <h5><b><i class="fa fa-dashboard"></i> My Plots</b></h5>
  </header>

  <div class="w3-row-padding w3-margin-bottom">
    <div  class="w3-quarter" >
      
      <div class="rows" style="border-radius:3px;background: white;box-shadow: 2px 2px 6px grey;">
        <div class="w3-left"><img src="https://img.icons8.com/color/70/000000/replicate-rows.png"></div>
        <div class="w3-right">
          <h3><?php echo $rows ?></h3>
        </div>
        <div class="w3-clear"></div>
        <h4  style="margin-left:10px ">Rows</h4>
      </div>
    </div>
    <div class="w3-quarter">
      <div class="rows" style="border-radius:3px;background: white;box-shadow: 2px 2px 6px grey; ">
        <div class="w3-left"><img src="https://img.icons8.com/color/70/000000/add-column.png"></div>
        <div class="w3-right">
          <h3><?php echo $col?></h3>
        </div>
        <div class="w3-clear"></div>
        <h4 style="margin-left:10px ">Columns</h4>
      </div>
    </div>
    <div class="w3-quarter">
      <div class="rows" style="border-radius:3px;background: white;box-shadow: 2px 2px 6px grey; ">
        <div class="w3-left"><img src="https://img.icons8.com/bubbles/70/000000/gender-neutral-user.png"></div>
        <div class="w3-right">
          <h3>50</h3>
        </div>
        <div class="w3-clear" ></div>
        <h4 style="margin-left:10px ">Users</h4>
      </div>
    </div>
    <div class="w3-quarter">
      <div class="rows" style="border-radius:3px;height:124px;background: white;box-shadow: 2px 2px 6px grey; ">
        <div class="w3-left"><img src="https://img.icons8.com/flat_round/70/000000/share.png"></div>
        <div class="w3-right">
          <h3>23</h3>
        </div>
        <div class="w3-clear"></div>
        <h4 style="margin-left:10px ">Shares</h4>
      </div>
    </div>
  </div>
  <hr>
  <?php
    if($_SESSION['status']=="Active")
    {
  ?>
<div>
<div class = "myinfer" style  ="width:25%;background-color:rgb(165, 170, 231) ; color:black;">
  <form action = "plot.php" method = GET >
    <h1 class ="infer" style="font-size:30px;color:black;" >  My inference</h1>
    <ul class="row">
    <div><a style  = "color:black;">X axis:</a>
    <?php

    
      $m = 1;
      $row = 1;
      $file = $_SESSION['file'];
    
    echo '
    <div class="custom-select" style="width:200px;">
    <select name = "x">';
    echo "<option >Select Column </option>";
    $f = fopen($file, "r");
    while (($line = fgetcsv($f)) !== false) {
            foreach ($line as $cell) {
              echo "<option value='".htmlspecialchars($cell)."'>" . htmlspecialchars($cell) . "</option>";     
            }
            if($m==1)
              break;
          $m++;
    }
    fclose($f);
    echo '</select>
  </div>
    ';
    
    ?>
    
  </div>
  <div><a style  = "color:black;">Y axis:</a>
  <?php 
    echo '
    <div class="custom-select" style="width:200px;">
    <select name = "y">';
    echo "<option >Select Column </option>";
    $f = fopen($file, "r");
    while (($line = fgetcsv($f)) !== false) {
            foreach ($line as $cell) {
              echo "<option value='".htmlspecialchars($cell)."'>" . htmlspecialchars($cell) . "</option>";     
            }
            if($m==1)
              break;
          $m++;
    }
    $_SESSION['rows']=$rows;
    $_SESSION['col']=$col;
    fclose($f);
    echo '</select>
  </div> 
    ';
  
  ?>
    
       </div>

   <button class="button button2" name = "plot">Submit</button>
   </form>
   </div>
    </ul>
  
  <div class="plot"><img src="chart.jpg" width="100%" height="100%" align="center">

  </div>
</div>


<?php

            if(isset($_GET['Import']))
            { 
              $m = 1;
              $row = 1;
              $file = $_SESSION['file'];
              echo "<div style = 'width: 100%; height: 600px; overflow: scroll;'><table style = 'font-size:12pt;'>\n\n";
              $f = fopen($file, "r");
              while (($line = fgetcsv($f)) !== false) {
                      echo "<tr>";
                      foreach ($line as $cell) {
                        if($m==1)
                          echo '<th style = "text-transform: uppercase;">' . htmlspecialchars($cell) . "</th>"; 
                        else
                          echo "<td>" . htmlspecialchars($cell) . "</td>";
                      }
                      $m=2;
                      echo "</tr>\n";
              }
              fclose($f);
              echo "\n</table></div>";
              }
        ?>

<!-- This is for statical analysis-->
<form action = "plot.php" method = GET>
<div style="margin-top:40px;height:250px;background-color:rgb(196, 204, 210) ;clear:both;position:static;  ">
          <ul class="row">
        <div><a >Descriptive Statistics</a>
          <div class="custom-select" style="width:200px;">
          <select>
            <option value="0">Select Option:</option>
            <option value="1">Mean</option>
            <option value="2">Mode</option>
            <option value="3">Median</option>
            <option value="4">Variance</option>
            <option value="5">Standered Devation</option>  
          </select>
        </div>
        </div>


    <div><a >Columns</a>
      <div class="custom-select" style="width:200px;">
      <select name = "colum">
        <option value="0">Select Column:</option>
        <?php 
            $f = fopen($file, "r");
            while (($line = fgetcsv($f)) !== false) {
                    foreach ($line as $cell) {
                      echo "<option value='".htmlspecialchars($cell)."'>" . htmlspecialchars($cell) . "</option>";     
                    }
                    if($m==1)
                      break;
                  $m++;
            }
            fclose($f);
            echo '</select> ';
        ?>
      </select>
    </div>
    </div>
  </ul>
  <button class=" button2"style="float:left;margin-top:10.5%;background-color: #4CAF50; /* Green */
  border: none;
  color: white;
  position: relative;
  padding: 10px 15px;

  text-decoration: none;
  cursor: pointer;
  -webkit-transition-duration: 0.4s;
  transition-duration: 0.4s;" name = "result">Submit</button>
    <h1>The Data for the Followign</h1>
    <ul class="row" style="margin :3.5%;margin-left:1%">
       <a  style="margin:30%;margin-left:15%">Mean</a>
     </ul>
       <div style="float:left;width:11%;height:40px;background-color:rgb(162, 162, 162);margin-top:4%;
       border-radius: 5px;
       padding: 2px;  ">0
       </div>
       <ul class="row" style="margin :3.5%;">
          <a  style="margin:30%;">Median</a>
        </ul>
          <div style="float:left;width:11%;height:40px;background-color:rgb(162, 162, 162);margin-top:4%;
          border-radius: 5px;
          padding: 2px;  ">
          0
          </div>
          <ul class="row" style="margin :3.5%;">
             <a  style="margin:30%;">Mode</a>
           </ul>
             <div style="float:left;width:11%;height:40px;background-color:rgb(162, 162, 162);margin-top:4%;
             border-radius: 5px;
             padding: 2px;  ">0
             </div>
          </div>
      </form>

      <?php } ?>

  
  <div class="w3-container">
    <h5>Recent Users</h5>
    <ul class="w3-ul w3-card-4 w3-white">
      <li class="w3-padding-16">
        <img src="/w3images/avatar2.png" class="w3-left w3-circle w3-margin-right" style="width:35px">
        <span class="w3-xlarge">Mike</span><br>
      </li>
      <li class="w3-padding-16">
        <img src="/w3images/avatar5.png" class="w3-left w3-circle w3-margin-right" style="width:35px">
        <span class="w3-xlarge">Jill</span><br>
      </li>
      <li class="w3-padding-16">
        <img src="/w3images/avatar6.png" class="w3-left w3-circle w3-margin-right" style="width:35px">
        <span class="w3-xlarge">Jane</span><br>
      </li>
    </ul>
  </div>
  <hr>

  <div class="w3-container">
    <h5>Recent Comments</h5>
    <div class="w3-row">
      <div class="w3-col m2 text-center">
        <img class="w3-circle" src="/w3images/avatar3.png" style="width:96px;height:96px">
      </div>
      <div class="w3-col m10 w3-container">
        <h4>John <span class="w3-opacity w3-medium">Sep 29, 2014, 9:12 PM</span></h4>
        <p>Keep up the GREAT work! I am cheering for you!! Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p><br>
      </div>
    </div>

    <div class="w3-row">
      <div class="w3-col m2 text-center">
        <img class="w3-circle" src="/w3images/avatar1.png" style="width:96px;height:96px">
      </div>
      <div class="w3-col m10 w3-container">
        <h4>Bo <span class="w3-opacity w3-medium">Sep 28, 2014, 10:15 PM</span></h4>
        <p>Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p><br>
      </div>
    </div>
  </div>
  <br>
  
  <!-- Footer -->
  <footer class="w3-container w3-padding-16 w3-light-grey">
    <h4>FOOTER</h4>
    <p>Powered by <a href="https://www.aiboat.co.in" target="_blank">AI BOAT</a></p>
  </footer>

  <!-- End page content -->
</div>

<script>
// Get the Sidebar
var mySidebar = document.getElementById("mySidebar");

// Get the DIV with overlay effect
var overlayBg = document.getElementById("myOverlay");

// Toggle between showing and hiding the sidebar, and add overlay effect
function w3_open() {
  if (mySidebar.style.display === 'block') {
    mySidebar.style.display = 'none';
    overlayBg.style.display = "none";
  } else {
    mySidebar.style.display = 'block';
    overlayBg.style.display = "block";
  }
}

// Close the sidebar with the close button
function w3_close() {
  mySidebar.style.display = "none";
  overlayBg.style.display = "none";
}
</script>
<script>
var x, i, j, selElmnt, a, b, c;
/* Look for any elements with the class "custom-select": */
x = document.getElementsByClassName("custom-select");
for (i = 0; i < x.length; i++) {
  selElmnt = x[i].getElementsByTagName("select")[0];
  /* For each element, create a new DIV that will act as the selected item: */
  a = document.createElement("DIV");
  a.setAttribute("class", "select-selected");
  a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
  x[i].appendChild(a);
  /* For each element, create a new DIV that will contain the option list: */
  b = document.createElement("DIV");
  b.setAttribute("class", "select-items select-hide");
  for (j = 1; j < selElmnt.length; j++) {
    /* For each option in the original select element,
    create a new DIV that will act as an option item: */
    c = document.createElement("DIV");
    c.innerHTML = selElmnt.options[j].innerHTML;
    c.addEventListener("click", function(e) {
        /* When an item is clicked, update the original select box,
        and the selected item: */
        var y, i, k, s, h;
        s = this.parentNode.parentNode.getElementsByTagName("select")[0];
        h = this.parentNode.previousSibling;
        for (i = 0; i < s.length; i++) {
          if (s.options[i].innerHTML == this.innerHTML) {
            s.selectedIndex = i;
            h.innerHTML = this.innerHTML;
            y = this.parentNode.getElementsByClassName("same-as-selected");
            for (k = 0; k < y.length; k++) {
              y[k].removeAttribute("class");
            }
            this.setAttribute("class", "same-as-selected");
            break;
          }
        }
        h.click();
    });
    b.appendChild(c);
  }
  x[i].appendChild(b);
  a.addEventListener("click", function(e) {
    /* When the select box is clicked, close any other select boxes,
    and open/close the current select box: */
    e.stopPropagation();
    closeAllSelect(this);
    this.nextSibling.classList.toggle("select-hide");
    this.classList.toggle("select-arrow-active");
  });
}

function closeAllSelect(elmnt) {
  /* A function that will close all select boxes in the document,
  except the current select box: */
  var x, y, i, arrNo = [];
  x = document.getElementsByClassName("select-items");
  y = document.getElementsByClassName("select-selected");
  for (i = 0; i < y.length; i++) {
    if (elmnt == y[i]) {
      arrNo.push(i)
    } else {
      y[i].classList.remove("select-arrow-active");
    }
  }
  for (i = 0; i < x.length; i++) {
    if (arrNo.indexOf(i)) {
      x[i].classList.add("select-hide");
    }
  }
}

/* If the user clicks anywhere outside the select box,
then close all select boxes: */
document.addEventListener("click", closeAllSelect);
</script>

</body>
</html>
