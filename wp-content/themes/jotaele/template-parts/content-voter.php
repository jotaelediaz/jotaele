<?php
/**
 * Template part for displaying voter liker
 * 
 * @package jotaele
 */

?>

<div class="jotaele-likes-voter-wrapper single position-relative container">
	<div class="jotaele-likes-voter">
		<i class="heartfull"></i>
		<?php
		
		$nonceLike = wp_create_nonce( 'jotaele_likes_vote_nonce_'.$post->ID);
		$nonceUnlike = wp_create_nonce( 'jotaele_likes_unvote_nonce_'.$post->ID);

		$linkVote = admin_url('admin-ajax.php?action=jotaele_likes_vote&post_id='.$post->ID.'&nonce='.$nonceLike);
		$linkUnvote = admin_url('admin-ajax.php?action=jotaele_likes_unvote&post_id='.$post->ID.'&nonce='.$nonceUnlike);
		
		echo '<button type="button" aria-labelledby="likevoter-label" class="user_vote wrapper-voto" data-post_id="' . $post->ID . '" href="' . $linkVote . '" data-nonce="' . $nonceLike . '"><span id="likevoter-label" hidden>Me gusta este artículo</span></button>';
		
		echo '<button type="button" aria-labelledby="likeunvoter-label" class="user_unvote wrapper-voto" data-nonce="' . $nonceUnlike . '" data-post_id="' . $post->ID . '" href="' . $linkUnvote . '"><span id="likeunvoter-label" hidden>Retirar voto</span></button>';
		?>
	</div>					
</div>