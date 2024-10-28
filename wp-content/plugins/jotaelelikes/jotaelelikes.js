jQuery(document).ready(function () {
		
	if (jQuery('.user_vote').length) {
		var userLikes = localStorage.getItem("userLikes");
		userLikes = userLikes ? userLikes.split(",") : [];
		let postId = jQuery('.user_vote').attr("data-post_id");
		
		
		userLikes.includes(postId) && jQuery('.user_vote').parent().addClass("user_voted");
		userLikes.includes(postId) && jQuery('body').addClass("user_voted");
	}
		
	jQuery(".user_vote").on("click", function(e){
        e.preventDefault();
		let votebutton = jQuery(this);
		let post_id = jQuery(this).attr("data-post_id");
		let votericon = jQuery('.jotaele-likes-voter');
		jQuery("#heartsound").get(0).play();
        nonce = jQuery(this).attr("data-nonce");
		votebutton.parent().addClass("user_voting");
		votericon.addClass("gelatina btn-shockwave");
		setTimeout(function() {votericon.removeClass('gelatina btn-shockwave');}, 1000);
		

    jQuery.ajax({
        type: "post",
        dataType: "json",
        url: myAjax.ajaxurl,
        data: { action: "jotaele_likes_vote", post_id: post_id, nonce: nonce },
        success: function (response) {
			if (response.type == "success") {
				jQuery(".vote_counter").html(response.vote_count);
				setTimeout(function() {votebutton.parent().removeClass('user_voting');}, 800);
				votebutton.parent().addClass("user_voted");
				jQuery('body').addClass("user_voted");
				!(userLikes.includes(post_id)) && userLikes.push(post_id);
				localStorage.setItem("userLikes", userLikes.toString());
				console.log("Yuju! Un like! :D");
			} else {
				console.log("Voto no añadido!");
			}
        },
    });
    });
	
	jQuery(".user_unvote").on("click", function(e){
        e.preventDefault();
        post_id = jQuery(this).attr("data-post_id");
        nonce = jQuery(this).attr("data-nonce");
		
		let votebutton = jQuery(this);
		let votericon = jQuery('.jotaele-likes-voter');

		votebutton.parent().addClass("user_unvoting");
		jQuery("#unheartsound").get(0).play();
		votericon.addClass("agitado");
		setTimeout(function() {votericon.removeClass('agitado');}, 1000);

    jQuery.ajax({
        type: "post",
        dataType: "json",
        url: myAjax.ajaxurl,
        data: { action: "jotaele_likes_unvote", post_id: post_id, nonce: nonce },
        success: function (response) {
        if (response.type == "success") {
            jQuery(".vote_counter").html(response.vote_count);
				setTimeout(function() {votebutton.parent().removeClass('user_unvoting');}, 800);
				votebutton.parent().removeClass("user_voted");
				userLikes = userLikes.filter(e => e !== post_id);
				localStorage.setItem("userLikes", userLikes.toString());
				console.log("Vaya! Has quitado el like! :(");
        } else {
            console.log("Voto no retirado!");
            }
        },
    });
    });
});
