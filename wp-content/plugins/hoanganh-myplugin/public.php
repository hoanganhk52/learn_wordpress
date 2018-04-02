<?php

require_once HOANGANH_MP_PLUGIN_PATH . 'includes/support.php';

class HoanganhMp {

    public function init() {
        //1. thay doi toan bo title
//        add_filter('the_title', array($this, 'theTitle'));

        //2. ham su dung 2 tham so cua hook the_title
        //        add_filter('the_title', array($this, 'theTitle2'), 10, 2);

        //3. ham su dung 2 tham so cua hook the_title
        //        add_filter('the_title', array($this, 'theTitle3'), 10, 2);

//        add_action('wp_footer', array($this, 'showFunction'));

//        add_filter('the_content', array($this, 'theContent'), 10, 1);

//        remove_filter('the_content', 'convert_smilies', 20);

//        remove_all_filters('the_content');
//        echo '<br/>' . has_filter('the_content', 'convert_smilies');

        add_filter('the_content', array($this,'changeString'));
        add_filter('the_title', array($this,'changeString'));
    }

    public function theTitle() {
        return 'New title';
    }

    public function theTitle2($title, $id) {
        if ($id == 1) {
            $title = 'Xin chào';
        }

        return $title;
    }

    public function theTitle3($title, $id) {
        if ($id == 1) {
            $title = str_replace('Hello world!', 'Xin chào wordpress!', $title);
        }

        return $title;
    }

    public function showFunction() {
        ZendvnMpSupport::showFunc('widget_title');
    }

    public function theContent($content) {
        global $post;
        //        echo '<pre>';
        //        print_r($post);
        //        echo '</pre>';
        if ($post->post_type == 'post') {
            $content .= 'sadhflksdjfhasdkjfhsadkljhasdkjf';
        }

        return $content;
    }

    public function changeString($text){
        //Xu ly ma lenh $content
        // $text = $content - $title
        if(current_filter() == 'the_title'){
            if(!is_page()){
                $text .= ' - my title';
            }
        }

        if(current_filter() == 'the_content'){
            $text .= ' LOLOLOLOLOLOLOLOLOLOLOLOLOLOLOLOLOLOLOLOLOLOLOLO';
        }

        return $text;
    }
}