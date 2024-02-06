<?php
$conn = new mysqli("localhost", "root", "", "worldswinners");

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>LoL Dev Blog</title>
        <link rel="stylesheet" href="articleStyle.css" type="text/css" />
        <script src="script.js" defer></script> 
</head>
<body>
<div class="banner"> 
        <!-- <div class="bannerimage"> <img  src="LOL.jpg" alt="Lol icon" width="100" height="50"> </div> -->
        <button onclick = "window.location.href='article.php';" class="banner button"> Home </button>
        <button onclick = "window.location.href='database.php';" class="banner button">Database</button>
        <button onclick = "window.location.href='upload.php';" class="banner button"> Upload Article </button>

</div>
<h1 class="heading1">
    League of Legends Dev Blog
</h1>
<div class="content">
    <img id="catgif" alt="CatDance.gif" width="300" height="200"
    src="https://images.contentstack.io/v3/assets/blt731acb42bb3d1659/blt3059b669e85f219f/655d6e2c94a247fb9334a3bb/112723_02CatDance.gif"> 
    <p class="content2"> 
    
    Here is a collection of articles 
    Hi, I'm Ezra “Riot Phlox” Lynn, game designer on objective changes for Season 2024, and I'm here to tell you a tale about cat cultists, Ornn pillars, mech fights, and a new look for Baron Nashor.

It all began in February when we were doing early planning for the 2024 Gameplay Changes. One of our high-level goals was to change League of Legends at a strategic level, specifically in the late game. 
We knew we wanted some sort of “strategic differentiation” at the time—ways to improve and shake up League macro and strategy. We also wanted to create additional differences between lanes, particularly to make top lane more valuable.

We started looking at objectives and found that some were feeling a bit stale. The Baron/Dragon dance had been going on for years, with the last big change in 2019, and Baron himself hadn't changed in forever. 
Rift Herald had some core problems around satisfaction and making top lane less enjoyable, so that was another place we looked at.

General game pacing and predictability were other spots that seemed enticing. We were still early in the process at the time so we had a few more brainstorming sessions and some early paperkitting before 
getting to work throwing together some messy prototypes to see if there was an interesting direction to go in.
A Game in Three Phases

The first iteration we tried was breaking the game up into three distinct phases, initiated by specific triggers: the early game (0-14 minutes or 2 dragons taken) when plates were alive, the mid game 
(ends when the Horde dies or when Baron spawned at 25 minutes), and the late game.

The big question was “Is it interesting to have a clear delineation between phases of the game, and is it interesting that these change variably? Was it worthwhile to have plates coming and going based 
on objectives instead of an exact timer?

The three phases initially tested okay. The variable transitions themselves were pretty cool, and the phases led to a lot of interesting contextual game states and pretty different games depending on who got 
ahead and how. However, their trigger conditions needed a lot of work. We also tried out some iterations around an alternate resource system called “Essence” or player-driven gamestate swaps, but these didn't pan out. 
We learned that there was a lot of room in the objective flow around Baron pit that could be improved at every point of the game along the way.
Early Game: So Many Cats

To add some variety, we tried out a new style of objective: a cat cult made up of Whisker Little Legends. This was a pile (clowder? cluster? colony?) of cats that spawned in threes every minute, slowly filling up the Baron pit.

The cats didn't do much, but we wanted to find out if there was merit to a horde boss instead of a second Herald. Second Herald was always a bit of an odd duck—it can never get tower plates and lanes are mostly done, 
so it often never gets taken or, when taken, is used so poorly it might as well not have been. It seemed a fruitful spot to change this flow up.
    </p>
    
</div>

<div class="content">
    <!-- retreive database articles -->
    <strong>Recent articles (latest 3): </strong> 
    <table class="content2">
        <tr class="articlesContainerHead"> 
            <td class="articleItem1"><strong> Article Name:</td> 
            <td class="articleItem2"><strong> Date of article:</td> 
            <td class="articleItem2"><strong> tag:</td> 
            <td class="articleHeading"><strong> Article content:</td> 
        </tr>
        <?php
        $result = $conn->query("SELECT * FROM articles ORDER BY date DESC LIMIT 3;");
        foreach($result as $row){
        ?>
        <tr class="articlesContainer">
            <td class="articleItem1"><?php echo $row['articlename']?></td>
            <td class="articleItem2"><?php echo $row['date']?></td>
            <td class="articleItem2"><?php echo $row['tags']?></td>
            <!-- <td class="articleItem3"><?php echo $row['Body']?></td> -->
            <td class="articleItem4">
                <div class="previewContent"><?php echo substr($row['Body'], 0, 200) . '...'; ?> </div>
                <div class="articleContent"><?php echo $row['Body']?></div>
                <!-- Changes hover button if article content <200 char -->
                <?php if (strlen(($row['Body'])) >= 200): ?>
                    <button class="seeArticleButton">Open/Close Article</button>
                <?php else: ?>
                    <button class="seeArticleButton2">Full article shown</button>
                <?php endif; ?>
            </td>
        </tr>

        <?php
        }
        ?>
    </table>
</div>

<div class="content">
    <strong>Behind the Bop: Steve Aoki - Remix Rumble I Teamfight Tactics</strong> 

    <div class="video-container">
    <iframe width="560" height="315" src="https://www.youtube.com/embed/XXcFQgaamDU?si=-tgmEO1D-uNwBOyz" 
        title="YouTube video player" frameborder="0" 
        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
        allowfullscreen>
    </iframe>
    </div>
</div>


<div class="footer">
    Footer notes and stuff 
</div>
</body>
</html>
