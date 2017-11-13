<?php
?>
<html>
    <head>
        <title>Company Chatroom</title>
        <link rel="icon" href="mona-lisa.jpg">
        <style>
            body {
                background-color: white;
            }
            #nav {
                margin-bottom: -25px;
                position: relative;
                z-index: 1;
            }
            #search {
                width: 320px;
                font-family: "Helvetica";
                font-size: 15px;
                position: absolute;
                left: 200px;
                top: 32px;
                border: 1px solid black;
            }
            /* #searchSubmit {
                width: 50px;
                position: absolute;
                left: 250px;
                top: 32px;
                border: 1px solid black;
            }    */
            h1 {
                font-family: "Zapfino";
                font-size: 23px;
                color:black;
                text-align: center;
            }
            h3 {
                font-family: "Helvetica";
                font-size: 17px;
                text-align: center;
            }
            h4 {
                font-family: "Helvetica";
                font-size: 13px;
                text-align: center;
            }
            #contributors {
                display: inline-block;
                width: 300px;
                height: 54px;
                background-color: #e6e6e6;
                margin-right: 10px;
                vertical-align: top;
                border-top: 1px solid black;
                border-left: 1px solid black;
                border-right: 1px solid black;
                border-bottom: none;
            }
            #host {
                display: inline-block;
                width: 297px;
                height: 300px;
                background-color: #e6e6e6;
                margin-right: 10px;
                vertical-align: top;
                position: relative;
                border: 1px solid black;
            }
            #hostButton {
                color: purple;
            }
            #playback { 
                float:left; 
                width:612px; 
                height: 184px;
                background-color: #e6e6e6;
                clear:both;
                border: 1px solid black;

            }
            #audio {
                text-align: center;
            }
            #chat {
                display: inline-block;
                position:relative;
                width: 600px;
                height: 647px;
                background-color: #e6e6e6;
                margin-right: 10px;
                vertical-align: top;
                border: 1px solid black;
            }
            #chatlogs {
                font-family: "Helvetica";
                font-size: 15px; 
                height: 407px;
                background-color: white;
                margin-left: 15px;
                margin-right: 15px;
                padding-left: 10px;
                padding-top: 10px;
                padding-right: 10px;
            }
            #loadingChat {
                position:absolute;
                font-family: "Helvetica";
                font-size: 16px;
                right: 300px;
                top: 45%;
            }
            #enterChatname {
                margin-top: 5px;
                margin-bottom: 5px;
                padding-left: 2px;
            }
            /* #actualChatname:focus {
                outline: none;
            } */
            #actualChatname {
                font-family: "Helvetica";
                font-size: 16px;
                width:95.5%;
                margin-left:13px;
                margin-top: 10px;
                padding-top: 10px;
                border: none;
                padding-left: 10px;
                padding-bottom: 10px;
            }
            #enterMessage {
                font-family: "Helvetica";
                margin-left: 14px;
                display: inline-block;
                position:relative;
                width:95.5%;
            }
            #msg {
                font-family: "Helvetica";
                font-size: 16px;
                width: 100%;
                height: 60px;
                border: 1px solid #e6e6e6;
                padding-top: 10px;
                padding-left: 10px;
                padding-bottom: 10px;
                padding-right: 10px;
            }
            /* #msg:focus {
                outline: none;
            } */
            #sendButton {
                position: absolute;
                bottom:5px;
                right:0px;
            }
        </style>
        <script src="http://code.jquery.com/jquery-1.9.0.js"></script>
    </head>
    <body>
        <div id="nav">
            <h1>Company Chatroom</h1>    
        </div>
        <input id="search" type="text" placeholder="Search..." />
        <!-- <button id="searchSubmit" type="submit" /> -->
        <div id="host">
            <h3><a id="hostButton" href="#">Welcome Video 1.1</a></h3>
            <img id="photo" src="bppl.jpg" width="614">
            <div id="playback">
                <h3>Hi (your name here)!</h3>
                <h3>Welcome to the team!</h3>
                <h3>Please get to know your chatroom...</h3>
                <div id="audio">
                    <audio controls>
                        <source src="turkishmarch.mp3" type="audio/mpeg">
                      Your browser does not support the audio element.
                      </audio>
                </div>
            </div>
        </div>
        
        <div id="contributors">
            <h3><a href="#">Library</a></h3>
        </div>

        <div id="chat">
            <h3>Chat</h3>

            <div id="chatlogs">
                <table id="chatlogsTable">
                </table>
            </div>

            <form name="form1">
                    <div id="enterChatname">
                        <input id="actualChatName" type="text" name="uname" placeholder="Enter your employee id..." maxlength="15" /><br />
                    </div>
                    <div id="enterMessage">
                        <textarea id="msg" name="msg" placeholder="Enter a message..." maxlength="160"></textarea><br />
                        <a id="sendButton" href="#" onclick="submitChat()">Send message</a><br /><br />
                    </div>
            </form>

        </div>

        <div id="loadingChat">
            <p>Loading...</p>
        </div>

        <script>
            $( "#host" ).hide();
            $( "#host" ).show( "fast" );
            $( "#contributors" ).hide();
            $( "#contributors" ).fadeIn( 2000 );
            $( "#loadingChat" ).show();
            $( "#loadingChat" ).delay(1300).fadeOut( "fast" );
            $( "#chat" ).hide();
            $( "#chat" ).delay(1500).show( "fast" );
            
            function submitChat() {
                if(form1.uname.value == '' || form1.msg.value == ''){
                        alert('all fields are required');
                        return;
                }
                var uname = form1.uname.value;
                var msg = form1.msg.value;
                var xmlhttp = new XMLHttpRequest();
        
                xmlhttp.onreadystatechange = function(){
                        if(xmlhttp.readyState==4&&xmlhttp.status==200){
                                document.getElementById('chatlogs').innerHTML = xmlhttp.responseText;
                        }
                }
                xmlhttp.open('GET','tpainsert.php?uname='+uname+'&msg='+msg, true);
                xmlhttp.send();
            }

            $(document).ready(function(e) {
                    $.ajaxSetup({cache:false});
                    setInterval(function() {$('#chatlogs').load('logs.php');}, 2000);
            });
        </script>
    </body>
</html>