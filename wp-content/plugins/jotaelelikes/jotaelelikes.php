<?php
   /*
   Plugin Name: JotaEle Likes
   Plugin URI: https://www.jotaele.me
   description: Un plugin para gestionar likes a artículos de forma local
   Version: 1.0
   Author: JotaEleDíaz
   Author URI: https://www.jotaele.me
   License: GPL2 - Based on https://stackoverflow.com/questions/74582542/like-button-with-counter-on-wordpress-post
   */

add_action("wp_ajax_jotaele_likes_vote", "jotaele_likes_vote");
add_action("wp_ajax_nopriv_jotaele_likes_vote", "jotaele_likes_vote");

//add_action("wp_ajax_jotaele_likes_unvote", "jotaele_likes_unvote");
//add_action("wp_ajax_nopriv_jotaele_likes_unvote", "jotaele_likes_unvote");

function jotaele_likes_vote()
{

    $vote_count = get_post_meta($_REQUEST["post_id"], "votes", true);
    $vote_count = ($vote_count == "") ? 0 : $vote_count;
    $new_vote_count = $vote_count+1;

    $vote = update_post_meta($_REQUEST["post_id"], "votes", $new_vote_count);

    if ($vote === false) {
        $result['type'] = "error";
        $result['vote_count'] = $vote_count;
    } else {
        $result['type'] = "success";
        $result['vote_count'] = $new_vote_count;
    }

    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        $result = json_encode($result);
        echo $result;
    } else {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }

    die();
}


function jotaele_likes_unvote()
{

    $vote_count = get_post_meta($_REQUEST["post_id"], "votes", true);
    $vote_count = ($vote_count == "") ? 0 : $vote_count;
    $new_vote_count = ($vote_count <= 0) ? 0 : $vote_count-1;

    $vote = update_post_meta($_REQUEST["post_id"], "votes", $new_vote_count);

    if ($vote === false) {
        $result['type'] = "error";
        $result['vote_count'] = $vote_count;
    } else {
        $result['type'] = "success";
        $result['vote_count'] = $new_vote_count;
    }

    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        $result = json_encode($result);
        echo $result;
    } else {
        header("Location: " . $_SERVER["HTTP_REFERER"]);
    }

    die();
}

function my_must_login()
{
    echo "You must log in to vote";
    die();
}




add_action('init', 'my_script_enqueuer');

function my_script_enqueuer()
{
    wp_register_script("my_voter_script", WP_PLUGIN_URL . '/jotaelelikes/jotaelelikes.js', array('jquery'));
    wp_localize_script('my_voter_script', 'myAjax', array('ajaxurl' => admin_url('admin-ajax.php')));

    wp_enqueue_script('jquery');
    wp_enqueue_script('my_voter_script');
}

?>