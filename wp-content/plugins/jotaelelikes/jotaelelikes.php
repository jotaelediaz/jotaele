<?php
   /*
   Plugin Name: JotaEle Likes
   Plugin URI: https://www.jotaele.me
   description: Un plugin para gestionar likes a artículos de forma local
   Version: 2.3
   Author: JotaEle Díaz
   Author URI: https://www.jotaele.me
   License: GPL2 - Based on https://stackoverflow.com/questions/74582542/like-button-with-counter-on-wordpress-post
   */

add_action("wp_ajax_jotaele_likes_vote", "jotaele_likes_vote");
add_action("wp_ajax_nopriv_jotaele_likes_vote", "jotaele_likes_vote");

add_action("wp_ajax_jotaele_likes_unvote", "jotaele_likes_unvote");
add_action("wp_ajax_nopriv_jotaele_likes_unvote", "jotaele_likes_unvote");

function jotaele_likes_vote()
{
	// Verificamos el nonce para evitar peticiones maliciosas
	if (!wp_verify_nonce(sanitize_text_field($_REQUEST['nonce']), "jotaele_likes_vote_nonce_" . sanitize_text_field($_REQUEST['post_id']))) {
		wp_send_json_error(array('message' => 'Nonce no válido. ¿Estás haciendo algo extraño? 👿'));
		return;
	}

	$post_id = intval($_POST['post_id']);
    $vote_count = get_post_meta(sanitize_text_field($_POST["post_id"]), "votes", true);
    $vote_count = ($vote_count == "") ? 0 : $vote_count;
    $new_vote_count = $vote_count+1;

    $vote = update_post_meta(sanitize_text_field($_POST["post_id"]), "votes", $new_vote_count);

    if ($vote === false) {
        $result['type'] = "error";
        $result['vote_count'] = $vote_count;
    } else {
        $result['type'] = "success";
        $result['vote_count'] = $new_vote_count;
		
		// Generamos nuevo nonce que servirá de ID del voto para verificar el unvote si se produce.
		$result['vote_nonce'] = wp_create_nonce('jotaele_likes_vote_id_'.$post_id);
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
	// Verificamos el nonce para evitar peticiones maliciosas
	if (!wp_verify_nonce(sanitize_text_field($_POST['nonce']), "jotaele_likes_unvote_nonce_" . sanitize_text_field($_POST['post_id']))) {
		wp_send_json_error(array('message' => 'Nonce no válido. ¿Estás haciendo algo extraño? 💔'));
		return;
	}
	
	// Adicionalmente, para evitar que resten votos que no habían dado antes, hay que verificar el nonce correspondiente al id del voto que se generó en el momento de concederlo.
	if (!wp_verify_nonce(sanitize_text_field($_POST['vote_id']), "jotaele_likes_vote_id_" . sanitize_text_field($_POST['post_id']))) {
		wp_send_json_error(array('message' => 'Ese voto que intentas retirar no recuerdo que me lo hubieses dado antes... 🤨'));
		return;
	}
	
	$vote_count = get_post_meta($_POST["post_id"], "votes", true);
    $vote_count = ($vote_count == "") ? 0 : $vote_count;
    $new_vote_count = ($vote_count <= 0) ? 0 : $vote_count-1;

    $vote = update_post_meta($_POST["post_id"], "votes", $new_vote_count);

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

add_action('init', 'jotaele_script_enqueuer');

function jotaele_script_enqueuer()
{
    wp_register_script("jotaele_voter_script", WP_PLUGIN_URL . '/jotaelelikes/jotaelelikes.js', array('jquery'));
    wp_localize_script('jotaele_voter_script', 'jotaeleLikesAjax', array('ajaxurl' => admin_url('admin-ajax.php'), 'themeDirURI' => get_template_directory_uri()));

    wp_enqueue_script('jquery');
    wp_enqueue_script('jotaele_voter_script');
}

?>