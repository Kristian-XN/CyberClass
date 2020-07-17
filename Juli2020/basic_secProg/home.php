<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="./css/main.css">
</head>
<body>
    <?php
        require_once './checkSession.php';

        if(!isset($_SESSION['username']))
        {
            header('Location: ./login.php');
            exit();
        }
    ?>
    <button class="tablink" onclick="openPage('Profile', this)">Profile</button>
    <button class="tablink" onclick="openPage('Forum', this)" id="defaultOpen">Forum</button>
    <a href="./logout.php"><button class="tablink">Logout</button></a>

    <div id="Profile" class="tabcontent">
    <h1>Hello there!</h1>
    </div>

    <div id="Forum" class="tabcontent">
    <table style="width:100%">
        <tr>
        <th>Total Forum: 5</th>
        </tr>
    </table><br>

    <table style="width:100%" border="1 px">
        <tr>
        <th style="width: 70%">Title</th>  
        <th style="width: 30%">Details</th>
        </tr>

        <tr>
        <td>
            <a href="#"><h3>Alasan CSRF token diperluakan dalam suatu website</h3></a>
        </td>
        <td>
            <p>By: <b>name<?php ?></b></p>
            <p>Replies: <b>5<?php ?></b></p>
        </td>
        </tr>

        <tr>
        <td>
            <a href="#"><h3>Penerapan mekanisme keamanan berlapis pada dunia nyata</h3></a>
        </td>
        <td>
            <p>By: <b>name<?php ?></b></p>
            <p>Replies: <b>120<?php ?></b></p>
        </td>
        </tr>
    </table><br>
    </div>
    <script>
    function openPage(pageName, thisPage)
    {
        var tabcontents, tablinks, i;

        tabcontents = document.getElementsByClassName("tabcontent");
        tablinks = document.getElementsByClassName("tablink");

        for(i = 0; i<tabcontents.length; i++)
        {
        tabcontents[i].style.display="none";
        }

        for(i = 0; i<tablinks.length; i++)
        {
        tablinks[i].style.backgroundColor="";
        }
        
        document.getElementById(pageName).style.display="block";
        thisPage.style.backgroundColor = 'gray';

    }
    document.getElementById("defaultOpen").click();
    </script>
</body>
</html> 