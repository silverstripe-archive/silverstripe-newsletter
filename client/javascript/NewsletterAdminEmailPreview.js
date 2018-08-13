(function ($) {
    "use strict";

    $.entwine(
        'ss',
        function ($) {
            $('#Form_ItemEditForm_action_doSendPreview').entwine(
                {
                    onclick: function (e) {
                        var prompt = this.sendPrompt();

                        if (prompt !== null) {
                        }

                        return false;
                    },
                    sendPrompt: function () {
                        var message = 'Send a test email to:';

                        return prompt(message);
                    }
                }
            );
        }
    );
}(jQuery));
