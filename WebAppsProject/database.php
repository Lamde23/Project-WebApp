<?php
$conn = new mysqli("localhost", "root", "", "worldswinners");
$mode = 'list';
if (isset($_REQUEST['mode']))
	$mode = $_REQUEST['mode'];
$sort = isset($_REQUEST['sort']) ? $_REQUEST['sort'] : 'desc';
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>LoL Dev Blog</title>
        <link rel="stylesheet" href="articleStyle.css" type="text/css" />

        <!-- On click event listener for show/close articles -->
        <script src="script.js" defer></script> 
    
</head>
<body>
<div class="banner"> 
        <!-- <div class="bannerimage"> <img  src="LOL.jpg" alt="Lol icon" width="100" height="50"> </div> -->
        <button onclick = "window.location.href='article.php';" class="banner button"> Home </button>
        <button onclick = "window.location.href='database.php';" class="banner button">Database</button>
        <button onclick = "window.location.href='upload.php';" class="banner button"> Upload Article </button>
</div>
    <div class="content">
    <h1 class="heading1"> Dev Blog Database </h1>
    </div>
    <div class="content">
        <ul>
            <li><a href="?mode=list">List all articles</a>
            <li><a href="?mode=tag">List all articles with specific tag</a>
        </ul>
        

        <?php
	if ($mode == 'list') {
?>

		<h1 class="heading1" >Article List:</h1>
        <form method="get">
            <label for="sort">Sort by Date:</label>
            <select name="sort" id="sort">
                <!-- asc= old to new, desc = newest to oldest (default) -->
                <option value="asc" <?php echo ($sort == 'asc') ? 'selected' : ''; ?>>Oldest</option>
                <option value="desc" <?php echo ($sort == 'desc') ? 'selected' : ''; ?>>Newest</option>
            </select>
            <input type="submit" value="Submit" />
        </form>
		<table class="content2">
        <tr class="articlesContainerHead"> 
            <td class="articleItem1"><strong> Article Name:     </strong></td> 
            <td class="articleItem2"><strong> Date of article:  </strong></td> 
            <td class="articleItem2"><strong> tag:              </strong></td> 
            <td class="articleHeading"><strong> Article content:  </strong></td> 
        </tr>
<?php
		$result = $conn->query("SELECT * FROM articles ORDER BY date $sort");
		foreach ($result as $row) {
?>
        <tr class="articlesContainer">
            <td class="articleItem1"><?php echo $row['articlename']?></td>
            <td class="articleItem2"><?php echo $row['date']?></td>
            <td class="articleItem2"><?php echo $row['tags']?></td>
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
<?php
    } elseif ($mode == 'tag'){
        $tag = 0;
        if (isset($_REQUEST['tag']))
            $tag = $_REQUEST['tag'];
?>
    <h1 class="heading1" >Article List by tag:</h1>
    <form method="get">
        <select name="tag">
<?php
        $result = $conn->query("SELECT DISTINCT tags from articles");
        foreach ($result as $row){
?>
        <option value="<?=$row['tags']?>"<?php
			if ($tag == $row['tags']) {echo "selected";}
			?>><?=$row['tags']?></option>
<?php
        }
?>
        </select>
        <input type="hidden" value="tag" name="mode" />
		<input type="submit" value="Submit" />
        <!-- <select name="sort" id="sort">
			<option value="asc" <?php echo ($sort == 'asc') ? 'selected' : ''; ?>>Ascending</option>
			<option value="desc" <?php echo ($sort == 'desc') ? 'selected' : ''; ?>>Descending</option>
		</select> -->
	</form>
        <?php
		if ($tag) {
			$query = $conn->prepare("SELECT * FROM articles WHERE tags = ? ORDER BY date $sort");
			$query->bind_param("s", $tag);
			$query->execute();
			$result = $query->get_result();
?>
    
    <table class="content2">
        <tr class="articlesContainerHead"> 
            <td class="articleItem1"><strong> Article Name:     </strong></td> 
            <td class="articleItem2"><strong> Date of article:  </strong></td> 
            <td class="articleItem2"><strong> tag:              </strong></td> 
            <td class="articleHeading"><strong> Article content:  </strong></td> 
        </tr>
<?php
		foreach ($result as $row) {
?>
        <tr class="articlesContainer">
            <td class="articleItem1"><?php echo $row['articlename']?></td>
            <td class="articleItem2"><?php echo $row['date']?></td>
            <td class="articleItem2"><?php echo $row['tags']?></td>
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
<?php
    }
}
?>

</div> 
</body>
</html>

