<?php
/**
 * Template part for displaying voter liker
 * 
 * @package jotaele
 */

?>

<div class="jotaele-likes-voter-wrapper single position-relative container">
	<div class="jotaele-likes-voter">
		<audio id="heartsound" preload="auto">
			<source src="<?php echo get_stylesheet_directory_uri(); ?>/img/heartsound.mp3" type="audio/mp3">
		</audio>
		<?php /* <audio id="unheartsound" preload="auto"><source src="<?php echo get_stylesheet_directory_uri(); ?>/img/unheartsound.mp3" type="audio/mp3"></audio>	*/ ?>
		<i class="heartfull"></i>
		<?php
		$linkVote = admin_url('admin-ajax.php?action=jotaele_likes_vote&post_id='.$post->ID.'&nonce='.$nonce);
		$linkUnVote = admin_url('admin-ajax.php?action=jotaele_likes_unvote&post_id='.$post->ID.'&nonce='.$nonce);
		echo '<button type="button" aria-labelledby="likevoter-label" class="user_vote wrapper-voto" data-nonce="' . $nonce . '" data-post_id="' . $post->ID . '" href="' . $linkVote . '"><span id="likevoter-label" hidden>Me gusta este artículo</span></button>';
		//echo '<button type="button" aria-labelledby="likeunvoter-label" class="user_unvote wrapper-voto" data-nonce="' . $nonce . '" data-post_id="' . $post->ID . '" href="' . $linkVote . '"><span id="likeunvoter-label" hidden>Retirar voto</span></button>';
		?>
	</div>					
</div>