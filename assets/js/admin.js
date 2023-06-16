;(function ($) {
    $(document).ready(function () {
        $(".mytheme-app-notice .notice-dismiss").on("click", function () {
            $.post(MythemeAdminObj.ajaxUrl, {
                action: "homlist_app_notice_dismiss",
                dismiss: 1,
                nonce: MythemeAdminObj.nonce
            }, function (data) {

            });
        });

    });
})(jQuery);