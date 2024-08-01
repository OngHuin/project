<?php 
require_once('Heading.php');
require_once ('AccessControl.php');
require_once('DatabaseCode.php');
loggedin();
?>

<button type="button" id="btnall" name="btnall" onclick="filterCards('all');">All</button>
<button type="button" id="btnsociety" name="btnsociety" onclick="filterCards('society');">Society</button>
<button type="button" id="btnclub" name="btnclub" onclick="filterCards('club');">Club</button>
<button type="button" id="btnother" name="btnother" onclick="filterCards('other');">Other</button>

<style>
        /* Card styles */
        #content {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            padding: 20px;
        }

        .card {
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            width: 300px;
            transition: transform 0.3s;
            margin: 10px;
        }

        .card img {
            width: 100%;
            height: auto;
        }

        .card .container {
            padding: 20px;
        }

        .card h4 {
            margin: 0;
            font-size: 20px;
        }

        .card button {
            background-color: #008CBA;
            color: white;
            border: none;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 10px 0;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .card button:hover {
            background-color: #005f73;
        }

        /* Card hover effect */
        .card:hover {
            transform: scale(1.05);
        }
    </style>

<div id="content">
    <?php
    $clubsociety = getAll('clubsociety');

    if ($clubsociety) {
        while ($row = mysqli_fetch_assoc($clubsociety)) {
            $type = strtolower($row['CSCategory']); 
            $name = htmlspecialchars($row['CSName'], ENT_QUOTES);
            $link = strtolower(str_replace(' ', '', $name)) . '.php'; 
            $image = strtolower(str_replace(' ', '', $name)) . '.png'; 
            
            echo '<div class="card ' . $type . '">
                    <img src="' . $image . '" alt="' . $name . '">
                    <div class="container">
                        <h4><b>' . $name . '</b></h4>
                        <button type="button" onclick="window.location.href=\'' . $link . '\';">Learn More</button>
                    </div>
                  </div>';
        }
    } else {
        echo 'Failed to fetch data from the database.';
    }
    ?>
</div>

<script>
    function filterCards(type) {
        var cards = document.getElementsByClassName('card');
        for (var i = 0; i < cards.length; i++) {
            if (type === 'all') {
                cards[i].style.display = 'block';
            } else {
                if (cards[i].classList.contains(type)) {
                    cards[i].style.display = 'block';
                } else {
                    cards[i].style.display = 'none';
                }
            }
        }
    }
</script>
