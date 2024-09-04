
<?php
session_start();
    //checking the form is submitted or not
    if(isset($_POST["submit"])){
        $user=$_POST['username'];
        $pass=$_POST['password'];
        if(isset($_POST['remme'])) {
            $remme=$_POST['remme'];
        } else {
            $remme='';
        }
        $sql = "SELECT * FROM users WHERE username='$user' and password=md5('$pass') and status=1";
        //connecting to db
        include("connection.php");
        //executing the query
        $qry=mysqli_query($conn, $sql) or die(mysqli_error($conn));
        //counting the affected rows
        $count=mysqli_num_rows($qry);

        //getting the users roles and id
        while($row=mysqli_fetch_array($qry)){
            $userid=$row['id'];
            $userrole=$row['role'];
            $image=$row['image'];

        }
        if($count==1){
            //setting the username and password cookie for 15 days
            if(!empty($remme)){
            setcookie("username", $user, time()+(60*60*24*15),"/");
            setcookie("password", $pass, time()+(60*60*24*15),"/");
            }
            //register the session
            $_SESSION["username"]=$user;
            $_SESSION["accesstime"]=date('Ymdhisa');
            $_SESSION["userid"]=$userid;
            $_SESSION["userrole"]=$userrole;
            $_SESSION["userimage"]=$image;
            //redirect if user valid
            if($userrole=="admin"){
            header("Location:index.php"); 
            }
            else{
                header("Location:index.php");

            }
        }
        else{
            echo "Login Failed";
        }
    }
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login </title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<style>
    body {
background-color:#e0b9b9;
overflow:hidden;
font-family: Blogger Sans, Blogger Sans; 
}
.arrow{
	margin-left:-25px;
}
.login-container {
	background-color: #FFE1C6;
	border-radius: 5px;
	box-shadow: 0px 0px 10px #888888;
	margin-top:50px;
	padding: 60px;
	width: 1355px;
    height:788px;

}
pre{
    font-family:Blogger Sans;
	font-size: 18px;
	margin-top:20px;
	margin-bottom:40px;

}
h1 {
	color: #333333;
    font-family:Blogger Sans;
    font-weight:bolder;
	font-size: 40px;
	margin-bottom: 8px;
	margin-top:0px;
	text-align: left;
  
}

form {
	display: flex;
	flex-direction: column;
}

input[type="text"],
input[type="password"]{
	border: none;
	border-radius: 5px;
	height: 50px;
	margin-bottom: 25px;
	padding: 25px;
    background-color: #D9D9D9;
    width:497px;
	font-size:22px;
    
}


button{
	background-color: #B77A71;
	border: none;
	border-radius: 50px;
	color: #FFFFFF;
    text-align:center;
	box-shadow: 0px 0px 10px #888888;
	cursor: pointer;
	font-size: 15px;
	font-weight:medium;
	height: 30px;
	margin-top: -1px;
	margin-left:445px;
	width: 125px; 
}


button:hover {
	background-color: #555555;
}

 

hr{
        height: 1px;
        background-color: #fffefe;
        border: 1px;
        border-top: 2px solid #fdfbfb;
	
      margin: 3rem 35rem 2rem -3rem;

      
    }
.images{
	
	position:absolute;
	padding:96px;
	margin-top:-46px;
	margin-left:-46px;

	
	
	
	
}
.image{
	position:static;
	margin-left:100px;
	margin-top:-5px;
}



.button1{
	background-color: #B77A71;
	border: none;
	border-radius: 50px;
	color: #FFFFFF;
    text-align:center;
	box-shadow: 0px 0px 10px #888888;
	cursor: pointer;
	font-size: 26px;
    font-family:Blogger Sans;
	font-weight:bold;
	height: 65px;
	margin-top: 0px;
	margin-left:40px;
	width: 445px; 
	padding:10px;

}


.button1:hover {
	background-color: #555555;
}
.forgot{
    margin-left: 350px;
    font-size: larger;
    margin-top:-25px;
    margin-bottom:45px;
    text-decoration: none;
}
.remember
{
    font-size:larger;
    margin-left:20px;
    margin-top:-25px;
}
    </style>
<body background="images/imagefinal.png" style="background-repeat: no-repeat; background-size: 50.3% 118%;">
<div class="container">
    <div class="row ">
      <div class="col-xl-6 ">
        <div class="login-container">

              <a href="index.php"><img src="images/left.png" width="30px"></a>
             <form> <a href ="userregister.php"><button><input type="submit" name="submit" value="REGISTER" style="color:white;border:none;background:none;"></FORM></a></button>
              <h1>Login</h1>
              <pre>Welcome! Please fill username and password to sign in to
your account.</pre>
    <form method="post" action="" name="login" enctype="multipart/form-data">
        <fieldset>
            
            <input type="text" name="username" placeholder="Username" value="<?php if(isset($_COOKIE['username'])){ echo $_COOKIE['username'];} else {echo '';}?>">
            <br>
            <input type="password" name="password" placeholder="Password" value="<?php if(isset($_COOKIE['password'])){ echo $_COOKIE['password'];} else {echo '';}?>">
            <br>
            <input class="form-check-input" type="checkbox" value="" id="form2Example31" checked > <div class="remember">Remember Me</div>
            <div class="forgot"><a href="forgot.php" style="text-decoration: none; color:black;">Forgot yout password?</a></div>
            <div class="button1"> <input type="submit" name="submit" value="Login" style="color:white;background:none; border:none; width:250px;"><br><br></div>
            
            
            <hr style="width:550px; margin-left:5px;">
              <div class="image">
              <img src="images/sev3n.png" width="300px"></div></div></div>
              <div class="col-xl-6">
       <div class="images">
            <img src="images/final.jpg" alt="boy meditating" height="788px" width="645px" >
      
        </fieldset>
    </form>
    
</body>
</html>