<?php
// Initialize the session
session_start();

// If session variable is not set it will redirect to login page
if(!isset($_SESSION['username']) || empty($_SESSION['username'])){
  header("location: login.php");
  exit;
}

?>



<!DOCTYPE html>
<!--Jake Cairns /15085733/ComputerScience/Project-->
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Javascript With Jake</title>
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
	<link rel="stylesheet" href="/CodeMirror/midnight.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:700" rel="stylesheet">
   <div class="page-header">
        <h1>Hi, <b><?php echo htmlspecialchars($_SESSION['username']); ?></b>. Welcome to JavaScript with Jake</h1>
    </div>
    <p><a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a></p>

    <audio controls>
      <source src="podcast.wav" type="audio/ogg">
    Your browser does not support the audio element.
    </audio>


</head>
<body onload="setupLesson(currentLesson);">

	<style>

	n_background {
			/* from {background-color: #f00;} */
				from {background-color: #e6ffcc;}
				to {background-color: #ccd4c4;}
		}
			@keyframes lesson_header {
				/* from {background-color: #f00;} */
					from {transform: rotate(0deg);}
					to {transform: rotate(-180deg);}
			}


		html, body{
			margin: 0;
			padding: 0;
			width: 100%;
			height: 100%;

			overflow: hidden !important;
		}


		.sides{
			width: 50%;
			height: 100%;
			float: left;
			z-index: 99;
		}

		textarea{
			width: 100%;
			height: 100%;

			margin: 0;
			padding: 19px;

			font-size: 14pt;
		}

		.CodeMirror{

			height: 100% !important;
			border: 2px solid black;
			font-family: monospace;
			font-size: 16px;

			box-shadow: 4px 0 20px grey;
		}

		button{

			float : right;
			position: relative;
			top: -45px;
			right: calc(10% + 65px);
			padding: 10px  20px;
			font-weight: 600;
		}



		/* Left Side */
		.lesson_container{
			font-family: sans-serif;
			padding: 30px;
			border: 1px solid black;
			animation: lesson_background;
			animation-duration: 1.75s;
			animation-iteration-count: infinite;
			animation-direction: alternate;
      background-color: #e6ffcc;
		  padding-right: 30px;
      padding-bottom: 1000px;

		}
		.lesson_container h1{
			padding: 0;
			margin: 0;
			font-family: 'Roboto Condensed', sans-serif;
		}




		.lessonDescription code{
			width: 100%;
			height: auto;
			background: #333;
			color: white;
		}






		#splashscreen{
			position: absolute;
			width: 100%;
	    height: 100%;
	    top: 0;
	    left: 0;
	    z-index: 100;
	    background: black;
			opacity: 1;
			transition: 1s;
			color: white;
			font-family: 'Roboto Condensed', sans-serif;
		}
		#splashscreen h2{
			margin: 0;
			margin-top: 30px;
			font-size: 35pt;
			color: #ddd;
		}
		#splashscreen a{
			text-decoration: underline;
			color: #e6ffcc;
			cursor: pointer;
		}
		#splashscreen.hidden{
			opacity: 0;
			visibility: hidden;
		}

	</style>

	 <div id ="splashscreen" class="hidden">
		 <center>
			 	<br/><br/><br/>
    		<img style="width: 300px;height: 300px;" src="https://upload.wikimedia.org/wikipedia/commons/6/6a/JavaScript-logo.png" />
				<h2>With Jake !</h2>
				<br/><br/><br/><br/><br/>
				<a onclick='document.getElementById("splashscreen").classList = "hidden";' class="enter_link">Click here to enter on the website &rarr;</a>
		 </center>

	</div>

	<div class="sides left_side">		<!-- Left Side -->
		<div class="lesson_container">

			<h1>Lesson <span class="lessonNumber"></span> of 10</h1>

			<p class="lessonDescription"></p>

		</div>
	</div>

	<div class="sides">		<!-- Right Side -->
		<button onclick="runCode();">Run Code &rarr;</button>
		<textarea name="code" id="code" ></textarea>


	</div>





	<!-- Create a simple CodeMirror instance -->
	<link rel="stylesheet" href="codemirror/codemirror.css">
	<script src="codemirror/codemirror.js"></script>
	<script>

  function detectIE() {
      var ua = window.navigator.userAgent;

      var msie = ua.indexOf('MSIE ');
      if (msie > 0) {
          // IE 10 or older => return version number
          return parseInt(ua.substring(msie + 5, ua.indexOf('.', msie)), 10);
      }

      var trident = ua.indexOf('Trident/');
      if (trident > 0) {
          // IE 11 => return version number
          var rv = ua.indexOf('rv:');
          return parseInt(ua.substring(rv + 3, ua.indexOf('.', rv)), 10);
      }

      var edge = ua.indexOf('Edge/');
      if (edge > 0) {
         // Edge (IE 12+) => return version number
         return parseInt(ua.substring(edge + 5, ua.indexOf('.', edge)), 10);
      }

      // other browser
      return false;
  }


  // if(detectIE()!=false){alert("This browser is outdated! Please Install Google Chrome");}



		var editor = CodeMirror.fromTextArea(document.getElementById("code"), {
			lineNumbers: true
		});
		editor.setOption("theme", "midnight");


		var currentLesson = 1;   // variable for number of lessons
		var userName;
		var subStage = 0;

		var setupLesson = function(_lesson) {  //sets lesson with get elemennt and gets the lesson number                      <span style=\"font-family: courier;\">Var</span>

			document.getElementsByClassName("lessonNumber")[0].innerHTML = new String(_lesson);

			switch  (_lesson) {

				case 1:
					//lesson 1
					document.getElementsByClassName("lessonDescription")[0].innerHTML =  "<BR/><BR/>I created a variable called  <span style=\"font-family: courier;\">name</span> which is just one line of code that initiates an instance of the variable and reserves it plus sets the currect name as John. please change the name through the Javascript text editor on the right hand side of this page. You can currently see a generic name called john, please change this to your name. Then click the run code button. <br><br>  <code>\ var name = John;<\/code>   ";
					editor.setValue("// Javascript Code Exercise "+_lesson+" - Hello World!\n\nvar name = \"John\";");

					break;

				case 2:
					// lesson 2 - question 1
					document.getElementsByClassName("lessonDescription")[0].innerHTML = "Brilliant, "+ userName+ "!<BR/><BR/> JavaScript consists of a few things and so the idea of JavaScript (js) with jake is that we are touching a variety of topics with quick short lessons.<br><br> Firstly, All code in Javascript must be written inside script tags. You can see opening and closing script tags below.<br/><br/> <code>&lt;script&gt;&lt;\/script&gt;<\/code> <br><br> Even though the scripts tags are not visable on the text editor they are there just not visable. \n The next few questions are about basic Syntax in Javascript, Please answer the following questions correctly to move on to lesson 3 <br><br> 1) Add two numbers using <code>\+<\/code> syntax. <br><br> 2) Subtract last number with any other number , using <code>\-<\/code> syntax. <br><br> 3) Use the Multiplication syntaxt <code>\*<\/code> for last question . ";
					editor.setValue("// Javascript Code Exercise " + _lesson + "!\n\n\n  ");

					break;

				case 3:
						// lesson 2 - question 2
						document.getElementsByClassName("lessonDescription")[0].innerHTML = "Well Done! , "+ userName+ "!<BR/><BR/> Now we have used the Adding, subtracting and multiplication syntax in java. <BR/><BR/> Next i would like you to complete some similar tasks with the same syntax but with a specific integers in mind. <br><br> 1) get to the number 40 using the <code>\*<\/code> syntax  <br><br> 2) get to the number 100 using the <code>\+<\/code> syntax  <br><br> 3) get to the number 200 using the <code>\-<\/code> syntax  ";
						editor.setValue("// Javascript Code Exercise " + _lesson + "!\n\n\n  ");

					break;

					case 4:
							// lesson 2 - Question 3
							document.getElementsByClassName("lessonDescription")[0].innerHTML = "Great, Nearly half way complete, "+ userName+ "!<BR/><BR/>  hello";
							editor.setValue("// Javascript Code Exercise " + _lesson + "!\n\n\n  ");

						break;
					case 5:
								// lesson
								document.getElementsByClassName("lessonDescription")[0].innerHTML = "Well Done! , "+ userName+ "!<BR/><BR/>  hello";
								editor.setValue("// Javascript Code Exercise " + _lesson + "!\n\n\n  ");

							break;

					 case 6:
										// lesson 3
										document.getElementsByClassName("lessonDescription")[0].innerHTML = "Well Done!, "+ userName+ "!<BR/><BR/> JavaScript consits of a few things and so the idea of JavaScript (js) with jake is that we are touching a variety of topics with quick short lessons.<br><br> Firstly, All code in Javascript must be written inside script tags. You can see opening and closing script tags below.<br/><br/> <code>&lt;script&gt;&lt;\/script&gt;<\/code> <br><br> Even though the scripts tags are not visable on the text editor they are there just not visable. \n The next few lessons are about basic Syntax in Javascript, Firstly i would like you to add two numbers together with the add syntax <code>\+<\/code>  and then run the code to get the output answer. <br><br> Please use the add symbol inbetween your two numbers then run code on the text editor.   ";
										editor.setValue("// Javascript Code Exercise " + _lesson + "!\n\n\n  ");

						break;


				default:
					alert("Lesson Not Found");
					break;

			}

		}




		var runCode = function() {
			let code = editor.getValue();
			let results = eval(code);

			switch  (currentLesson) {

				case 1:

					if (
						typeof name == "string" &&
						name != "John"
					 ){

					 	alert("Hello "+name+"!");
						userName = name;

						currentLesson++;
						setupLesson(currentLesson);
					} else {
						lessonFailed();
					}

					break;

					// first question for 2nd lesson
				case 2:
					if (editor.getValue().indexOf("+") > -1 || editor.getValue().indexOf("-") > -1){

						 subStage++;
						 alert("Well Done your Answer was "+ results);
						 setupLesson(currentLesson);

					 } else if(editor.getValue().indexOf("*") > -1 && subStage == 2)  {

						 alert("Well Done your Answer was "+ results+"\nYou have completed all 3 of these maths tasks...");
						 lessonSuccess();

				   } else {

						 lessonFailed();

					 }

					break;



				case 3:

						if (results == 40 && editor.getValue().indexOf("*") > -1 || results == 100 && editor.getValue().indexOf("+") > -1){

					 		subStage++;
					 		alert("Well Done your Answer was "+ results);
					 		setupLesson(currentLesson);

				 		} else if(results == 200 && editor.getValue().indexOf("-") > -1 && subStage == 2) {

					 	alert("Well Done your Answer was "+ results+"\nYou have completed all 3 of these maths tasks...");
					 	lessonSuccess();

				 		} else {

					 	lessonFailed();

				 		}

				break;
				 case 4:

						if(results == "2018, 11, 24)") {
							alert("Well Done your Answer was "+ results);
 								lessonSuccess();
 							} else {
 								lessonFailed();
 							}




							case 5:
									if (

										 editor.getValue().indexOf("*") > -1){
										 alert("Well Done your Answer was "+ results);

										 lessonSuccess();
										 } else {
										 lessonFailed();
									 }


						break;

				default:
					alert("Lesson Not Found");
					break;

			}

		}




    // lesson sucess which initiates next lesson
		var lessonSuccess = function() {
			// well done

		//	console.log("LESSON SUCCESS");

			currentLesson++;
			subStage = 0;
			setupLesson(currentLesson);
		}




    // Lesson failed initates message from console
		var lessonFailed = function() {

			console.log("LESSON FAILED");
			alert("Failed, please read the instructions on the left hand side and try again");
			setupLesson(currentLesson);
		}







	</script>


</body>
</html>
