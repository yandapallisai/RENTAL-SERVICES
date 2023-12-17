
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>display img</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .navbar {
            background-color: #333;
            overflow: hidden;
        }

        .navbar a {
            float: left;
            display: block;
            color: #f2f2f2;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        .navbar a:hover {
            background-color: #ddd;
            color: black;
        }

        .search-container {
            float: right;
        }

        .search-container input[type=text] {
            padding: 10px;
            margin-top: 8px;
            margin-right: 16px;
            border: none;
            font-size: 17px;
        }

        @media screen and (max-width: 600px) {
            .navbar a, .search-container {
                float: none;
                display: block;
                text-align: left;
                width: 100%;
                box-sizing: border-box;
            }

            .search-container {
                margin-top: 8px;
                margin-right: 0;
            }
        }
    </style>
</head>
<body>

<div class="navbar">
    <a href="#home">Home</a>
    <a href="#about">About</a>
    <a href="#contact">Contact</a>
    
    <div class="search-container">
        <form action="/search" method="get">
            <input type="text" placeholder="Search..." name="q">
            <button type="submit">Search</button>
        </form>
    </div>
</div>

<!-- Add your content here -->

</body>
</html>


<?php
$myconn = mysqli_connect('localhost', 'root', '', 'update_images');
$query = "SELECT * FROM images";

if ($run = mysqli_query($myconn, $query)) {
    $num_rows = mysqli_num_rows($run);
    if ($num_rows >= 1) {
        echo '<div class="flex-container">'; // Flex container

        while ($row = mysqli_fetch_assoc($run)) {
            echo '
            <div class="imgaln">
                <img src="data:image/jpeg/png/jpg;base64,' . base64_encode($row['image']) . '" alt="Image">
                <p>Your content goes here.</p>
            </div>
        ';
        
        }
        

        echo '</div>'; // Close the Flex container
    }
}
?>
<style>
    body {
        padding: 10px; /* Padding instead of negative margin on the body or a wrapper */
    }

    .flex-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        text-align: center; /* Center the images within the container */
    }

    .imgaln {
        margin: 10px;
        padding: 10px;
        border: 1px solid #ccc;
        box-sizing: border-box;
        flex: 0 0 calc(25% - 20px); /* Four images per row, adjust as needed */

        /* Ensure a minimum width for smaller screens */
        min-width: calc(25% - 20px); /* Four images per row, adjust as needed */
    }

    img {
        max-width: 100%;
        height: auto;
    }

    @media (max-width: 768px) {
        .imgaln {
            flex: 0 0 calc(50% - 20px); /* Two images per row on screens smaller than 768px */
            min-width: calc(50% - 20px); /* Two images per row on screens smaller than 768px */
        }
    }

    @media (max-width: 480px) {
        .imgaln {
            flex: 0 0 calc(100% - 20px); /* Single column on screens smaller than 480px */
            min-width: calc(100% - 20px); /* Single column on screens smaller than 480px */
        }
    }
  
</style>


