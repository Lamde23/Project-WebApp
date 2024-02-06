<?php
$conn = new mysqli("localhost", "root", "", "worldswinners");
session_start();
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $title = $_POST['title'];
    $date = $_POST['date'];
    $tags = $_POST['tagname'];
    $content = $_POST['content'];

    $sql = "INSERT INTO articles (articlename, date, tags, Body) VALUES ('$title', '$date', '$tags', '$content')";
    
    if ($conn->query($sql) === TRUE) {
        $_SESSION['status'] = "Article uploaded successfully!";
        // header('location: index.php');
        // exit;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
$conn->close();
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
    <div class="content">
        <h1 class="heading1"> Upload Dev Blog </h1>

        <!-- If article added to database, alert message shown with Article name-->
        <?php
        if(isset($_SESSION['status'])) { ?>
            <div class="alert">
                Success! <?php echo $_SESSION['status'];?> <br>
                "<?php echo htmlspecialchars($title, ENT_QUOTES, 'UTF-8'); ?>"
                <!-- <button type="button" class="close" > -->
                <span class="close" onclick="this.parentElement.style.display='none';">&times;</span>
            </div>
            <?php  
            unset($_SESSION['status']);
        }
        ?>
    </div>
    <div class="content">
        <div class ="content2">
            <form name="uploadArticle" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
            <h3>
                <label for="articlename" class="input">Article Title: </label>
                <input type="text" name="title" class="input" placeholder="Article Title (limit 100 char)" required maxlength="100">

                <label for="date">Article Date: </label>
                <input type="date" name="date" id="date" required>

                <label for="tags">Tag: </label>
                <input type="text" name="tagname" id="tagname" placeholder="Article Tag (limit 20 char)" required maxlength="20">
                <label for="content">Article Content: </label>
                <textarea name="content" id="textarea" placeholder="Enter article contents here (min 10 char)" required minlength="10"></textarea>
            </h3>
            <label class="label2"> Article ready for submission <input class="checkbox" type="checkbox" name="agree" required> </label>
            
            <h3>
                <input type="submit" name="submit" id="submit" value="submit">
            </h3>
            </form>
        </div>
        
    </div>

</body>
</html>