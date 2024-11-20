jQuery(document).ready(function ($) {
    $("#generate-btn").on("click", function () {
        var postID = $("#name-generator").data("post-id");
        $("#error-message").text("");
        $("#name-suggestions").empty();

        // Disable the button to prevent multiple clicks
        $(this).prop("disabled", true);

        $.ajax({
            url: nameGenerator.ajax_url,
            type: "POST",
            data: {
                action: "generate_names",
                post_id: postID,
                security: nameGenerator.security,
            },
            success: function (response) {
                if (response.success) {
                    response.data.forEach(function (name) {
                        $("<li>").text(name).hide().appendTo("#name-suggestions").fadeIn(500);
                    });
                } else {
                    $("#error-message").text(
                        response.data || "An error occurred while fetching names."
                    );
                }
            },
            error: function () {
                $("#error-message").text("An error occurred. Please try again.");
            },
            complete: function () {
                // Re-enable the button after AJAX completes
                $("#generate-btn").prop("disabled", false);
            },
        });
    });
});
