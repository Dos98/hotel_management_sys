<?php require_once("db_connection.php"); ?>
<?php require_once("header.php"); ?>
<?php require_once("functions.php"); ?>
<?php session_start(); ?>
<?php confirm_logged_in(); ?>
<script type="text/javascript">
var cin,cout;
var date_diff_indays = function(date1, date2) {
dt1 = new Date(date1);
dt2 = new Date(date2);
return String(Math.floor((Date.UTC(dt2.getFullYear(), dt2.getMonth(), dt2.getDate()) - Date.UTC(dt1.getFullYear(), dt1.getMonth(), dt1.getDate()))/(1000 * 3600 * 24)));
}
function countNumberOfDaysLeft(){
    var x,y;
    var num;
    x=document.getElementById("today").value;
    y=document.getElementById("checkin").value;
    num=date_diff_indays(x,y);
    if(x){if(y){
        if(num>0)
            document.getElementById("nod_left").value = num;
        else{
            document.getElementById("checkin").value = y;
            document.getElementById("today").value = x;
            num=date_diff_indays(y,x);
            document.getElementById("nod_left").value = num;
        }
    }
    }
}
function countNumberOfDays(){
  var x,y;
  var num;
  x=document.getElementById("checkin").value;
  y=document.getElementById("checkout").value;
  num=date_diff_indays(x,y);
  if(x){if(y){
    if(num>0)
    document.getElementById("nod").value = num;
    else{
        document.getElementById("checkin").value = y;
        cin=y;
        console.log(cin);
        document.getElementById("checkout").value = x;
        cout=x;
        console.log(cout);
        num=date_diff_indays(y,x);
        document.getElementById("nod").value = num;
    }
  }
}
myFinal();
}
function cinclear() {
  document.getElementById("checkin").value = "";
  document.getElementById("nod").value = "";
  document.getElementById(cin).className="date-item";
  myFinal();
}
function coutclear() {
  document.getElementById("checkout").value = "";
  document.getElementById("nod").value = "";
  document.getElementById(cout).className="date-item";
  myFinal();
}
function firstClick(x) {
  if(document.getElementById("checkin").value == "" ){
    if(cin)
      document.getElementById(cin).className="date-item";
      document.getElementById(x).className="date-item is-active";
      document.getElementById("checkin").value = x;
      cin=x;
      countNumberOfDays();
  }
  else if(document.getElementById("checkout").value == "" ){
    if(cout)
    document.getElementById(cout).className="date-item";
    document.getElementById(x).className="date-item is-active";
    document.getElementById("checkout").value = x;
    cout=x;
    countNumberOfDays();
}
}
function myFinal() {
    countNumberOfDaysLeft();
    if(document.getElementById("checkin").value != "" && document.getElementById("checkout").value != "" )
    {
        document.getElementById("submit").className="button is-primary";
    }
    else
    {
        document.getElementById("submit").className="button is-primary is-hidden";
    }
}
</script>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BOOK ROOM</title>
    <link rel="stylesheet" type="text/css" href="css/grid-gallery.css">
    <link rel="stylesheet" type="text/css" href="css/public.css">

  </head>
  <body>
    <div class="container section">
      <div class="container is-fluid ">
        <figure class="avatar image is-128x128 ">
          <img src="images/DC.png" alt="LOGO OF HOTEL WEBSITE">
          <figcaption><i>Travellers Home</i></figcaption>
        </figure>
      </div>
      <hr>
      <div class="columns section">
        <div class="column is-4">
          <div class="title">BOOKING ROOM</div>
        </div>
      </div>
    <hr>
    <form action="room_select.php" autocomplete="off" method="post" target="_self">
      <div class="columns">
        <div class="column is-4">
          <div class="field">
            <label class="label">CHECKIN DATE</label>
            <div class="control">
              <input class="input is-primary" name="cin" id="checkin" type="text" placeholder="checkin date" readonly>
            </div>
          </div>
          <div class="field">
            <label class="label">CHECKOUT DATE</label>
            <div class="control">
              <input class="input is-primary" name="cout" id="checkout" type="text" placeholder="checkout date" readonly>
            </div>
          </div>
            <div class="field is-hidden">
                <div class="control">
                    <input class="input" name="nod_left" id="nod_left" type="text" readonly>
                </div>
            </div>
          <br>
          <br>
          <div class="field is-grouped is-grouped-multiline">
            <div class="control">
              <div class="tags has-addons">
                <span class="tag is-info">No. of days of Booking :</span>
                <div class="column is-2 ">
                 <span class="tag is-success is-rounded">
                   <input class="input is-info is-small is-focused" id="nod" type="text" name="nod_booking" value ="" size="62" placeholder="count" readonly></span>
                 </div>
              </div>
            </div>
          </div>
        <section class="section">
          <div class="field level-item is-grouped ">
              <p class="control">
                  <a href="c_form.php" class="button is-light">
                      Back
                  </a>
              </p>
            <a>      </a>
            <div class="control">
              <button class="button is-primary is-hidden" type="submit" id="submit" name="submit_button" value="Create Booking" onclick="myFinalSelect()">SUBMIT</button>
            </div>
          </div>
        </section>
       </div>
     </form>
      <div class="column is-2">
        <div class="field">
          <label class="label">CHECKIN DATE CLEAR</label>
          <div class="control">
            <button class="button is-warning" type="button" onclick="cinclear()">Clear</button>
          </div>
        </div>
        <div class="field">
          <label class="label">CHECKOUT DATE CLEAR</label>
          <div class="control">
            <button class="button is-warning" type="button" onclick="coutclear()">Clear</button>
          </div>
        </div>
      </div>
      <div class="column is-4">
        <div class="calendar">
          <div class="calendar-header">
            <div><?php echo date("F"); echo " "; echo date("Y");?></div>
          </div>
          <div class="calendar-container">
            <div class="calendar-header">
              <div class="calendar-date">Sun</div>
              <div class="calendar-date">Mon</div>
              <div class="calendar-date">Tue</div>
              <div class="calendar-date">Wed</div>
              <div class="calendar-date">Thu</div>
              <div class="calendar-date">Fri</div>
              <div class="calendar-date">Sat</div>
            </div>
            <div class="calendar-body">
              <?php
                $d=cal_days_in_month(CAL_GREGORIAN,date("m"),date("Y"));
                $x=date('j');
                for($y = 1; $y<=date("N", mktime(0,0,0,date("m"),1,date("Y"))); $y++){
                  echo "<div class=\"calendar-date is-disabled\"><button class=\"date-item\" type=\"button\"> </button></div>";
                }
                if($x>1)
                {
                  for($y = 1; $y <date("j"); $y++)
                  {
                    echo "<div class=\"calendar-date is-disabled\"><button class=\"date-item\" type=\"button\">$y</button></div>";
                  }
                }
                  $x=date("j");
                  $today=date("m").",".$x.",".date("Y");
                  echo "<input class=\"input is-hidden\" name=\"today\" id=\"today\" type=\"text\" value={$today} readonly>";
                for(; $x<=$d ;$x++)
                {
                  $id=date("m").",".$x.",".date("Y");
                  echo "<div class=\"calendar-date\"><button class=\"date-item\" type=\"button\" id=\"$id\" onclick=\"firstClick('$id')\">$x</button></div>";
                }
                for($y = 6; $y>date("w", mktime(0,0,0,date("m"),$d,date("Y"))); $y--){
                  echo "<div class=\"calendar-date is-disabled\"><button class=\"date-item\" type=\"button\"></button></div>";
                }
                ?>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="columns">
      <div class="column is-4 is-offset-6">
        <div class="calendar">
          <div class="calendar-header">
            <div><?php echo date('F', strtotime('+1 months')); echo " "; echo date("Y");?></div>
          </div>
          <div class="calendar-container">
            <div class="calendar-header">
              <div class="calendar-date">Sun</div>
              <div class="calendar-date">Mon</div>
              <div class="calendar-date">Tue</div>
              <div class="calendar-date">Wed</div>
              <div class="calendar-date">Thu</div>
              <div class="calendar-date">Fri</div>
              <div class="calendar-date">Sat</div>
            </div>
            <div class="calendar-body">
              <?php
                $d=cal_days_in_month(CAL_GREGORIAN,date("m")+1,date("Y"));
                for($y = 0; $y<date("w", mktime(0,0,0,date("m")+1,1,date("Y"))); $y++){
                  echo "<div class=\"calendar-date is-disabled\"><button class=\"date-item\" type=\"button\"></button></div>";
                }
                for($x=1; $x<=$d ;$x++)
                {
                  $id=(date("m")+1).",".$x.",".date("Y");
                  echo "<div class=\"calendar-date\"><button class=\"date-item\" type=\"button\" id=\"$id\" onclick=\"firstClick('$id')\">$x</button></div>";
                }
                for($y = 6; $y>date("w", mktime(0,0,0,date("m")+1,$d,date("Y"))); $y--){
                  echo "<div class=\"calendar-date is-disabled\"><button class=\"date-item\" type=\"button\"></button></div>";
                } ?>
            </div>
          </div>
        </div>
      </div>
    </div>
    <hr>

  </body>
  <footer class="footer">
    <div class="container">
      <div class="content has-text-centered">
        <p>
          <strong>DC hotels</strong> by <a href="">Ayush Dosaj, Poorvit Jain, Medha Reddy</a>. The source code is licensed
          <a href="">VIT</a>. The website content
          is licensed.
        </p>
        <p>
          <a class="icon" href="https://github.com/">
            <i class="fa fa-github"></i>
          </a>
        </p>
      </div>
    </div>
  </footer>
</html>
