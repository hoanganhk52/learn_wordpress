<div class="wrap">
    <h2>My Page Setting</h2>
    <?php settings_errors($this->_menuSlug, false, false) ?>
    <p>Cau hinh plugin</p>
    <form action="options.php" method="post" id="hoanganh-mp-form-setting" enctype="multipart/form-data">
        <?php echo settings_fields('hoanganh_mp_options') ?>
        <?php echo do_settings_sections($this->_menuSlug) ?>
        <?php

            global $wpdb;

            $table = $wpdb->prefix . 'hoanganh_mp_article';
            $args = array(
                'title'     => 'this is a test',
                'picture'   => 'test3.png',
                'content'   => 'chi la test ma thoi',
                'status'    => 1
            );
//            $format = array('%s', '%s', '%s', '%d');

            $result = $wpdb->prepare($table, $args);

            echo '<pre>';
            print_r($result);
            echo '</pre>';
        ?>
    </form>
</div>