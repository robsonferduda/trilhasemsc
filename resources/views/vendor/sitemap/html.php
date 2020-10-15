<!DOCTYPE html>
<html>
<head>
	<title><?= $channel['title'] ?></title>
</head>
<body>
	<h1><a href="<?= $channel['link'] ?>"><?= $channel['title'] ?></a></h1>
	<ul>
		<?php foreach ($items as $item) : ?>
		<li>
			<a href="<?= $item['loc'] ?>"><?= (empty($item['title'])) ? $item['loc'] : $item['title'] ?></a>
			<small>(last updated: <?= date('Y-m-d\TH:i:sP', strtotime($item['lastmod'])) ?>)</small>
			<?php
            if (! empty($item['images'])) {
                echo '<ul>';
                foreach ($item['images'] as $image) {
                    echo '<li>';
                    echo "<a href=".str_replace(' ', '%20',$image['url']).">".$image['url']."</a>".'<br>';
                    if (isset($image['title'])) {
                        echo 'Title: '.$image['title'].'<br>';
                    }
                    if (isset($image['caption'])) {
                        echo 'Caption: '.$image['caption'].'';
                    }
                    echo '</li>';
                }
                echo '</ul>';
            }
            ?>
		</li>
		<?php endforeach; ?>
	</ul>
</body>
</html>