
/*
   Plugin Name: JotaEle Likes
   Plugin URI: https://www.jotaele.me
   description: Un plugin para gestionar likes a artículos de forma local mediante AJAX
   Version: 2.3
   Author: JotaEle Díaz
   Author URI: https://www.jotaele.me
   License: GPL2 - Based on https://stackoverflow.com/questions/74582542/like-button-with-counter-on-wordpress-post
*/

jQuery(document).ready(function () {
		
	if (jQuery('.user_vote').length) {
		let postId = jQuery('.user_vote').attr("data-post_id");
		
		let userLikes = sessionStorage.getItem("userLikes");
		userLikes = userLikes ? JSON.parse(userLikes) : [];
		
		let userAlreadyVoted = userLikes.some(v => v.postId === postId);
		
		userAlreadyVoted && jQuery('.user_vote').parent().addClass("user_voted");
		userAlreadyVoted && jQuery('body').addClass("user-previously-voted");
		
		var heartSound = new Audio(jotaeleLikesAjax.themeDirURI+"/img/heartsound.mp3");
		var unheartSound = new Audio(jotaeleLikesAjax.themeDirURI+"/img/unheartsound.mp3");
	}
		
	jQuery(".user_vote").on("click", function(e){
        e.preventDefault();
		
		var userLikes = sessionStorage.getItem("userLikes");
		userLikes = userLikes ? JSON.parse(userLikes) : [];
		
		let votebutton = jQuery(this);
		let votericon = jQuery('.jotaele-likes-voter');
		let post_id = jQuery(this).attr("data-post_id");
        let nonce = jQuery(this).attr("data-nonce");
		heartSound.play();
		votebutton.parent().addClass("user_voting");
		votericon.addClass("gelatina btn-shockwave");
		setTimeout(function() {votericon.removeClass('gelatina btn-shockwave');}, 1000);
		

    jQuery.ajax({
        type: "post",
        dataType: "json",
        url: jotaeleLikesAjax.ajaxurl,
        data: { action: "jotaele_likes_vote", post_id: post_id, nonce: nonce },
        success: function (response) {
			var voteCount = response.vote_count;
			var voteId = response.vote_nonce;
				
			if (response.type == "success") {
				jQuery(".vote_counter").html(voteCount);
				setTimeout(function() {votebutton.parent().removeClass('user_voting');}, 800);
				votebutton.parent().addClass("user_voted");
				jQuery('body').addClass("user_voted");
				
				let voteObject = { postId: post_id, voteId: voteId };
				!(userLikes.some(function(v) { 
					return v.postId === post_id; 
				}))
				&& userLikes.push(voteObject);
								 
				sessionStorage.setItem("userLikes", JSON.stringify(userLikes));
				console.log("¡Yuju! Un like! :D");
			} else {
				console.log("Ups, voto no añadido...");
				votebutton.parent().removeClass("user_voted user_voting");
			}
        },
    });
    });
	
	jQuery(".user_unvote").on("click", function(e){
        e.preventDefault();
		
		var userLikes = sessionStorage.getItem("userLikes");
		userLikes = userLikes ? JSON.parse(userLikes) : [];

		let unvotebutton = jQuery(this);
		let votericon = jQuery('.jotaele-likes-voter');
		let post_id = jQuery(this).attr("data-post_id");
		let nonce = jQuery(this).attr("data-nonce");

		//Check if userLikes object with current post_id is in SessionStorage
		let voteObject = userLikes.find(v => v.postId === post_id);
		let voteId = voteObject ? voteObject.voteId : 0;	
		
		unheartSound.play();
		unvotebutton.parent().addClass("user_unvoting");
		votericon.addClass("agitado btn-shockwave");
		
		setTimeout(function() {votericon.removeClass('agitado btn-shockwave');}, 1000);

    jQuery.ajax({
        type: "post",
        dataType: "json",
        url: jotaeleLikesAjax.ajaxurl,
        data: { action: "jotaele_likes_unvote", post_id: post_id, nonce: nonce, vote_id: voteId },
        success: function (response) {
			if (response.type == "success") {
				jQuery(".vote_counter").html(response.vote_count);
					setTimeout(function() {unvotebutton.parent().removeClass('user_unvoting');}, 800);
					unvotebutton.parent().removeClass("user_voted");

					userLikes = userLikes.filter(v => v.postId !== post_id);
					sessionStorage.setItem("userLikes", JSON.stringify(userLikes));
					console.log("¡Vaya! ¡Has quitado el like! :(");
			} else {
				console.log("Ups, voto no retirado...");
				unvotebutton.parent().removeClass("user_voted user_unvoting");
			}
        },
    });
    });
});
