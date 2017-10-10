<div class="wrap">
    <h2>My Page Setting</h2>
    <p>Cau hinh plugin</p>
    <form action="options.php" method="post" id="hoanganh-mp-form-setting" enctype="multipart/form-data">
        <?php  echo settings_fields('hoanganh_mp_options')?>
        <?php  echo do_settings_sections($this->_menuSlug)?>

        <p class="submit">
            <input type="submit" name="submit" value="Save change" class="button button-primary">
        </p>
    </form>
</div>