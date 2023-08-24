<section class="section">
    <div class="container">
        <h2 class="title"><?= esc($title) ?></h2>
        <div class="is-danger"><?= validation_list_errors() ?></div>
        <div class="is-danger"><?= session()->getFlashdata('error') ?></div>
        <form action="/news/create" method="post">
            <?= csrf_field() ?>
            <div class="field">
                <label class="label" for="title">Título</label>
                <div class="control">
                    <input class="input" type="input" name="title" value="<?= set_value('title') ?>">

                </div>
            </div>

            <div class="field">
                <label class="label" for="body">Texto</label>
                <div class="control">
                    <textarea class="textarea" name="body" placeholder="Texto da notícia."><?= set_value('body') ?></textarea>
                </div>
            </div>

            <div class="control">
                <button type="submit" name="submit" value="Criar nova notícia" class="button is-link">Criar nova notícia</button>
            </div>
        </form>
    </div>
</section>
