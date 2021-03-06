<?php
    include('Session.php');
    if ($login_designation != "staff"){
        if($login_designation == "student"){
            header("location:dashboard_student.php");
        }else if($login_designation == "faculty"){
            header("location:dashboard_faculty.php");
        }else {
            header("location:login.php");
        }
    }
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        echo '<script language="javascript">alert("Sorry Network Connection Is Very Slow! Mail Not Sent"); window.location.href = "sendgrade.php"</script>';
    }

    if($_SERVER["REQUEST_METHOD"] == "POSTY") {
      	if(!empty($_FILES['attachedfiles']['name'])){
            $file_name = $_FILES['attachedfiles']['name'];
            $temp_name = $_FILES['attachedfiles']['tmp_name'];
            $file_type = $_FILES['attachedfiles']['type'];

            $from = $_POST['email'];
            $to = $_POST['towhom'];
            $subject = "Grades Of The Students";
            $message = $_POST['message'];

            $file = $temp_name;
            $content = chunk_split(base64_encode(file_get_contents($file)));
            $uid = md5(uniqid(time()));

            $header = "From: ".$from."\r\n";
            $header .= "Reply-To: ".$replyto."\r\n";
            $header .= "MIME-Version: 1.0\r\n";

            $header .= "Content-Type: multipart/mixed; boundary=\"".$uid."\"\r\n\r\n";
            $header .= "This is a multi-part message in MIME format.\r\n";


            $header .= "--".$uid."\r\n";
            $header .= "Content-Type:text/plain; charset=iso-8859-1\r\n";
            $header .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
            $header .= $message."\r\n\r\n";

            $header .= "--".$uid."\r\n";
            $header .= "Content-Type: ".$file_type."; name=\"".$file_name."\"\r\n";
            $header .= "Content-Transfer-Encoding: base64\r\n";
            $header .= "Content-Disposition: attachment; filename=\"".$file_name."\"\r\n\r\n";
            $header .= $content."\r\n\r\n";

            if(mail($to, $subject,"", $header)){
                echo "Mail Sent";
            }else{
                echo "Mail Not Sent, Server Busy";
            }
        }else{
            echo "Please Attach Some Files";
        }
    }
    ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="keywords" content="">

    <title>Upload: Data Science Course</title>

    <!-- Styles -->
    <link href="assets/css/page.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="assets/img/iitglogo.png">
    <link rel="icon" href="assets/img/iitglogo.png">

    <!--  Open Graph Tags -->
    <meta property="og:title" content="Data Science Course Webpage">
    <meta property="og:description" content=": IIT Guwahati is going to offer M Tech in
Data Science. The course is interdisciplinary and initiated jointly by CSE, EEE, and Math
departments.">
    <meta property="og:image" content="assets/img/datascience.jpeg">
    <meta property="og:url" content="http://thetheme.io/thesaas/">
    <meta name="twitter:card" content="summary_large_image">
  </head>

  <body>


              <!-- Navbar -->
          <nav class="navbar navbar-expand-lg navbar-light navbar-stick-dark" data-navbar="sticky">
            <div class="container">

              <div class="navbar-left">
                <button class="navbar-toggler" type="button">&#9776;</button>
                <a class="navbar-brand" href="index.php">
                  <img class="logo-dark" src="assets/img/iitglogo.png" height="50px" width="50px" alt="logo">
                  <img class="logo-light" src="assets/img/iitglogolight.png" height="50px" width="50px" alt="logo">
                </a>
              </div>

              <section class="navbar-mobile">
                <nav class="nav nav-navbar ml-auto">
                  
                   <a class="btn btn-sm btn-round btn-primary ml-lg-4 mr-2" href="https://outlook.office.com/mail/inbox" target="_blank">Send Mail Using Outlook</a>
                </nav>

                

<!--
                <div>
                  <a class="btn btn-sm btn-round btn-primary ml-lg-4 mr-2" href="#">Log in</a>
                </div>
-->
              </section>

            </div>
          </nav><!-- /.navbar -->


    <!-- Header -->
    <section class="section py-8" style="background-image: url(assets/img/upload.jpg)" data-overlay="5">

        <div class="container">
          <h2 class="text-white text-center lead-6">Email Facility</h2>
          <p class="text-white text-center opacity-80 lead-2">You can send mail to anywhere everywhere</p>
          <br>

          <div class="row">
            <form class="col-11 col-md-6 col-xl-5 mx-auto section-dialog bg-gray p-5 p-md-7" method="POST" enctype="multipart/form-data">


              <div class="form-group input-group input-group-lg">
                <div class="form-group">
                <input class="form-control" placeholder="Send Message To" name="towhom" type="text">
              </div>
              </div>
              <div class="form-group input-group input-group-lg">
                <div class="custom-file">
                <input type="file" class="custom-file-input" id="customFile" name="attachedfiles" accept="application/pdf">
                <label class="custom-file-label" for="customFile">Attach file</label>
              </div>
              </div>

              <div class="form-group input-group input-group-lg">
                <div class="form-group">
                <textarea class="form-control" placeholder="Message" name="message" rows="3"></textarea>
              </div>
              </div>

              <button class="btn btn-block btn-lg btn-success">Send Mail</button>
            </form>
          </div>

        </div>
      </section>
<!-- /.header -->


    <!-- Main Content -->
    <main class="main-content">


      <!--
      |‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
      | Populate the page
      |‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒‒
      !-->
<!--
      <section class="section bg-gray overflow-hidden" id="advertisement">
        <div class="container">
          <div class="row">

            <div class="col-md-6 align-self-center text-center text-md-left">
              <h2>About the Course</h2><br>
              <p>Data science is a multi-disciplinary field that uses scientific methods, processes, algorithms and systems to extract knowledge and insights from structured and unstructured data. Data science is the same concept as data mining and big data: "use the most powerful hardware, the most powerful programming systems, and the most efficient algorithms to solve problems"</p>
              <br>
              <a class="btn btn-lg btn-round btn-primary shadow-3" href="#">Apply Now</a>
            </div>

            <div class="col-md-5 mx-auto text-center mt-8 mt-md-0">
              <img src="assets/img/dataidea.jpg" alt="..." data-aos="fade-up">
            </div>

          </div>
        </div>
      </section>
-->


    </main>


    <!-- Footer -->
    <footer class="footer">
        <div class="container text-center">

          

          <p class="small">Copyright © 2019 IIT Guwahati, All rights reserved.</p>

        </div>
      </footer><!-- /.footer -->


    <!-- Scripts -->
    <script src="assets/js/page.min.js"></script>
    <script src="assets/js/script.js"></script>

</body>
</html>









