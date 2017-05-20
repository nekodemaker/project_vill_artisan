window.onload = function () {


    function htmlMessages(idreceiver, arrayMessages) {
        var res = "";
        for (var i = 0; i < arrayMessages.length; i++) {
            if (arrayMessages[i].id_sender == idreceiver) {
                res += "<div class='his_message'>" + arrayMessages[i].text_message + "</div>";
            } else {
                res += "<div class='your_message'>" + arrayMessages[i].text_message + "</div>";
            }
        }
        return res;
    }
    /* Ajax event for create a message in user/crafter profile page */
    $(".form-submit").click(function () {
        var message = $(this).prev().prev()[0].value;
        var idReceiver = $(this).prev()[0].value;
        var thiselem = $(this);
        var data = "text-message=" + message + "&id-receiver=" + idReceiver;
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "index.php?action=sendMessageTo", //Relative or absolute path to response.php file
            data: data,
            success: function (data) {
                var res = htmlMessages(idReceiver, data.messages);
                var chatcontainerElem = thiselem.parent().parent()[0].children[1];
                chatcontainerElem.innerHTML = res;
            },
            error: function (data) {
                console.log("ERROR");
            }
        });
    });

    /* Ajax event for create article in crafter profile page*/
    $("#create-article-form").submit(function () {
        var data = $(this).serialize();
        var form = document.forms.namedItem("create-article-form");
        var formdata = new FormData(form);

        $.ajax({
            type: "POST",
            dataType: "json",
            processData: false,
            contentType: false,
            url: "index.php?action=createArticle", //Relative or absolute path to response.php file
            data: formdata,
            success: function (data) {
                if (data['success'] != undefined) {
                    $(".message-block").html("<h6>Votre article est crée</h6>");
                } else {
                    $(".message-block").html(data['error']);
                }
            },
            error: function (data) {
                console.log("ERROR AJAX");
            }
        });
        return false;
    });

    /* JS FOR ADMIN PART */

    var userrows = $('table.table-users tr');
    var villagerrow = userrows.filter('.villager-row');
    var crafterrow = userrows.filter('.crafter-row');

    $('#button-all-users').click(function () {
        villagerrow.show();
        crafterrow.show();
    });

    $('#button-only-crafter').click(function () {
        crafterrow.show();
        villagerrow.hide();
    });

    $('#button-only-villager').click(function () {
        villagerrow.show();
        crafterrow.hide();
    });
    /*END JS FOR ADMIN PART */
};