<div class="container mb-4">
    <h1 class="title">Nossas notícias</h1>
</div>
<?php if (! empty($news) && is_array($news)): ?>
    
    <?php foreach ($news as $news_item): ?>
        <div class="mx-6 box">
            <h3 class="title"><?= esc($news_item['title']) ?></h3>

            <div class="main">
                <?= esc($news_item['body']) ?>
            </div>
            <p><a href="/news/<?= esc($news_item['slug'], 'url') ?>">Ver notícia</a></p>

        </div>
        <?php endforeach ?>

    <?php else: ?>

        <h3>Sem notícias</h3>

        <p>Não foi possível carregar as notícias.</p>

    <?php endif ?>