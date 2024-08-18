<?php 
    $jsonFilePath = './news.json';

    $jsonData = file_get_contents($jsonFilePath);
    $newsItems = json_decode($jsonData, true);
    if ($newsItems === null) {
        echo "Failed to load news.json";
        exit;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>News</title>
    <style>
        .news-item {
            margin-bottom: 20px;
        }
        .news-item img {
            width: 100px;
            height: auto;
        }
    </style>
</head>
<body>
    <div id="news-container">
        <?php foreach($newsItems as $item): ?>
            <div class="news-item">
                <?php if (!empty($item['image'])): ?>
                    <img src="<?= htmlspecialchars($item['image']) ?>" alt="<?= htmlspecialchars($item['title']) ?>">
                <?php endif; ?>
                <h3>
                    <a href="<?= htmlspecialchars($item['link']) ?>"><?= htmlspecialchars($item['title']) ?></a>
                </h3>
            </div>
        <?php endforeach; ?>    
    </div>
</body>
</html>
