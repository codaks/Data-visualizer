<?php 

session_start();
#$find = 0;
if(isset($_GET['find']))
{
  $col = $_GET['colum'];
  $command = escapeshellcmd('python C:/xampp/htdocs/Mini/stat.py cereal_breakfast.csv '.$col);
  $output = shell_exec($command);
  $str_arr = explode (" ", $output);
  $_SESSION['mean'] = $str_arr[0];
  $_SESSION['median'] = $str_arr[2];
  $_SESSION['mode'] = $str_arr[4];
  #$find = 1;
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
  <div style="float:left"><span class="w3-bar-item w3-right" >Analyse</span></div>
</div>

<!-- Sidebar/menu -->
<nav class="w3-sidebar w3-collapse w3-white w3-animate-left" style="z-index:3;width:300px;" id="mySidebar"><br>
<div class="mycontainer" style = "background:white;">
    <h5>Plots</h5>
<div class="w3-container w3-row">

  </div>
  
  
  </div>

  <div class="w3-bar-block" style = "">
    <a href="#" class="w3-bar-item w3-button w3-padding-16 w3-hide-large w3-dark-grey w3-hover-black" onclick="w3_close()" title="close menu"><i class="fa fa-remove fa-fw"></i>  Close Menu</a>
    <form action ="plot.php" method = GET>
      <button href="#" class="mynav w3-blue" name = "bar"><img src="https://img.icons8.com/android/24/000000/bar-chart.png">         Bar</button>
     <button href="#" class="mynav " name = "pie"><img src="https://img.icons8.com/metro/26/000000/pie-chart.png">       Pie</button>
     <button href="#" class="mynav " name = "scatter"><img src="https://img.icons8.com/ios/24/000000/line-chart.png">          Scatter</button>
     <button href="#" class="mynav " name = "Histogram"><img src="https://img.icons8.com/ios/24/000000/bar-chart-filled.png">       Histogram</button>
     <button href="#" class="mynav " name = "BoxPlot"><img src="https://img.icons8.com/material-rounded/24/000000/box.png">       BoxPlot </button>
     <button href="#" class="mynav " name = "linear"><img src="https://img.icons8.com/material-rounded/24/000000/graph.png">        linear</button>
     <button href="#" class="mynav " nane = "scatterList"><img src="https://img.icons8.com/android/24/000000/scatter-plot.png">     Scatter Hist</button>
     <button href="#" class="mynav " name = "BarHorizontal"><img src="https://img.icons8.com/ios-glyphs/30/000000/bar-chart.png">     Bar Horizontal </button>
     <button href="#" class="mynav " name = "scatter Plot"><img src="https://img.icons8.com/windows/32/000000/stackoverflow.png">        StackPlot</button>
     <button href="#" class="mynav " name = "steam Plot"><img src="https://img.icons8.com/ios/24/000000/bar-chart-filled.png">       Stem plot</button>
     <button href="#" class="mynav " name= "simple"><img src="https://img.icons8.com/metro/26/000000/cosine.png">       Simple Plot</button>
     <button href="#" class="mynav " name= "stacked"><img src="https://img.icons8.com/material-two-tone/30/000000/bar-chart.png">       Stacked Bargraph</button>
    </form>

  </div>
</nav>


<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:300px;margin-top:43px;">
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
          <h3><?php echo $_SESSION['rows']?></h3>
        </div>
        <div class="w3-clear"></div>
        <h4  style="margin-left:10px ">Rows</h4>
      </div>
    </div>
    <div class="w3-quarter">
      <div class="rows" style="border-radius:3px;background: white;box-shadow: 2px 2px 6px grey;">
        <div class="w3-left"><img src="https://img.icons8.com/color/70/000000/add-column.png"></div>
        <div class="w3-right">
          <h3><?php echo $_SESSION['col'] ?></h3>
        </div>
        <div class="w3-clear"></div>
        <h4 style="margin-left:10px ">Columns</h4>
      </div>
    </div>
    <div class="w3-quarter">
      <div class="rows" style="border-radius:3px;background: white;box-shadow: 2px 2px 6px grey;">
        <div class="w3-left"><img src="https://img.icons8.com/bubbles/70/000000/gender-neutral-user.png"></div>
        <div class="w3-right">
          <h3>50</h3>
        </div>
        <div class="w3-clear" ></div>
        <h4 style="margin-left:10px ">Users</h4>
      </div>
    </div>
    <div class="w3-quarter">
      <div class="rows" style="border-radius:3px;height:124px;background: white;box-shadow: 2px 2px 6px grey;">
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
<div>
<div class = "myinfer">
  <form action = "plot.php" method = GET >
    <h1 class ="infer" style="font-size:30px" >  My inference</h1>
    <ul class="row">
    <div><a style  = "color:white;">X axis:</a>
    <?php

    if($_SESSION['status']=="Active")
    {
      $m = 1;
      $row = 1;
      $file = $_SESSION['file'];
    
    echo '
    <div class="custom-select" style="width:200px;">
    <select name ="x">';
    echo "<option>Select Column </option>";
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
  <div><a style  = "color:white;">Y axis:</a>
  <?php 
    echo '
    <div class="custom-select" style="width:200px;">
    <select name = "y">';
    echo "<option>Select Column </option>";
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
  }
  ?>
    
       </div>

   <button class="button button2" name = "plot">Submit</button>
   </form>
   </div>
    </ul>
    
  <div class="plot">
  <?php 
        if(isset($_GET['bar']))
        {
          $command = escapeshellcmd('python C:/xampp/htdocs/Mini/graph.py '.$_SESSION['file'].' '.$_SESSION['x'].' '.$_SESSION['y']);
          $output = shell_exec($command);
          echo  '<a href= "n.png"><img src="n.png" width="100%" height="100%" align="center"></a>';
        }
        else if(isset($_GET['linear']))
        {
          $command = escapeshellcmd('python C:/xampp/htdocs/Mini/linear.py '.$_SESSION['file'].' '.$_SESSION['x'].' '.$_SESSION['y']);
          $output = shell_exec($command);
          echo  '<a href= "n.png"><img src="n.png" width="100%" height="100%" align="center"></a>';
        }
        else if(isset($_GET['stacked']))
        {
          $command = escapeshellcmd('python C:/xampp/htdocs/Mini/command.py '.$_SESSION['file'].' '.$_SESSION['x'].' '.$_SESSION['y'].' '.'stackbar');
          $output = shell_exec($command);
          echo  '<a href= "n.png"><img src="n.png" width="100%" height="100%" align="center"></a>';
        }
        else if(isset($_GET['scatter']))
        {
          $command = escapeshellcmd('python C:/xampp/htdocs/Mini/scatter.py '.$_SESSION['file'].' '.$_SESSION['x'].' '.$_SESSION['y']);
          $output = shell_exec($command);
          echo  '<a href= "n.png"><img src="n.png" width="100%" height="100%" align="center"></a>';
        }
        else if(isset($_GET['BarHorizontal']))
        {
          $command = escapeshellcmd('python C:/xampp/htdocs/Mini/command.py '.$_SESSION['file'].' '.$_SESSION['x'].' '.$_SESSION['y'].' '.'barh');
          $output = shell_exec($command);
          echo  '<a href= "n.png"><img src="n.png" width="100%" height="100%" align="center"></a>';
        }
        else if(isset($_GET['plot']))
        {
          $command = escapeshellcmd('python C:/xampp/htdocs/Mini/graph.py '.$_SESSION['file'].' '.$_GET['x'].' '.$_GET['y']);
          $output = shell_exec($command);
          echo  '<a href= "n.png"><img src="n.png" width="100%" height="100%" align="center"></a>';
          $_SESSION['x']=$_GET['x'];
          $_SESSION['y']=$_GET['y'];
        }
        else
        {
            echo '<img src="Demo Graph.jpg" width="100%" height="100%" align="center">';
        }
    ?>    
  
  
  </div>
</div>
<br><br><br>
<h1 style = "margin-top:30px;">Here Is Your Dataset</h1>
<?php

            if(isset($_GET['Import']) or $_SESSION['status']="Active")
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
              }
              fclose($f);
              echo "\n</table></div>";
              }
        ?>

<form action = "plot.php" method = GET>
<div style="margin-top:40px;height:250px;background-color:rgb(196, 204, 210) ;clear:both;position:static;  ">
          <ul class="row">
        <div><a >Descriptive Statistics</a>
          <br><br>
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
  transition-duration: 0.4s;" name = "find" >Submit</button>
    <h1>The Data for the Following</h1>
    <ul class="row" style="margin :3.5%;margin-left:1%">
       <a  style="margin:30%;margin-left:15%">Mean</a>
     </ul>
       <div style="float:left;width:12%;height:40px;background-color:rgb(162, 162, 162);margin-top:4%;
       border-radius: 5px;
       padding: 2px;  ">
       <?php 
              
                echo $_SESSION['mean'];
              
             ?>
       </div>
       <ul class="row" style="margin :3.5%;">
          <a  style="margin:30%;">Median</a>
        </ul>
          <div style="float:left;width:11%;height:40px;background-color:rgb(162, 162, 162);margin-top:4%;
          border-radius: 5px;
          padding: 2px;  ">
          <?php 
              
                echo $_SESSION['median'];
              
             ?>
          </div>
          <ul class="row" style="margin :3.5%;">
             <a  style="margin:30%;">Mode</a>
           </ul>
             <div style="float:left;width:11%;height:40px;background-color:rgb(162, 162, 162);margin-top:4%;
             border-radius: 5px;
             padding: 2px;  ">
             <?php 
             
                echo $_SESSION['mode'];
              
             ?>
             </div>
          </div>
      </form>


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
