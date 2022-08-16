/*
Author       : Dreamguys
Template Name: Doccure - Bootstrap Template
Version      : 1.0
*/

(function($) {
    "use strict";

	// Pricing Options Show

	$('#pricing_select input[name="rating_option"]').on('click', function() {
		if ($(this).val() == 'price_free') {
			$('#custom_price_cont').hide();
		}
		if ($(this).val() == 'custom_price') {
			$('#custom_price_cont').show();
		}
		else {
		}
	});

	// Education Add More

    $(".education-info").on('click','.trash', function () {
		$(this).closest('.education-cont').remove();
		return false;
    });

    $(".add-education").on('click', function () {

		let educationcontent = $('#education-blank').clone();
		educationcontent.css('display', 'flex')
        educationcontent.removeAttr('id')

        $(".education-info").append(educationcontent);
        return false;
    });

	// Experience Add More

    $(".experience-info").on('click','.trash', function () {
		$(this).closest('.experience-cont').remove();
		return false;
    });

    $(".add-experience").on('click', function () {

		var experiencecontent = $('#experience-blank').clone();
        experiencecontent.css('display', 'flex')
        experiencecontent.removeAttr('id')

        $(".experience-info").append(experiencecontent);
        return false;
    });

	// Awards Add More

    $(".awards-info").on('click','.trash', function () {
		$(this).closest('.awards-cont').remove();
		return false;
    });

    $(".add-award").on('click', function () {

        var regcontent = $('#awards-blank').clone();
        regcontent.css('display', 'flex')
        regcontent.removeAttr('id')

        $(".awards-info").append(regcontent);
        return false;
    });

	// Membership Add More

    $(".membership-info").on('click','.trash', function () {
		$(this).closest('.membership-cont').remove();
		return false;
    });

    $(".add-membership").on('click', function () {

        var membershipcontent = $('#memberships-blank').clone();
        membershipcontent.css('display', 'flex')
        membershipcontent.removeAttr('id')

        $(".membership-info").append(membershipcontent);
        return false;
    });

	// Registration Add More

    $(".registrations-info").on('click','.trash', function () {
		$(this).closest('.reg-cont').remove();
		return false;
    });

    $(".add-reg").on('click', function () {

        var regcontent = $('#reg-blank').clone();
        regcontent.css('display', 'flex')
        regcontent.removeAttr('id')

        $(".registrations-info").append(regcontent);
        return false;
    });

})(jQuery);
