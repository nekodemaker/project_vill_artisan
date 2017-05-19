window.onload = function () {


    function htmlMessages(idreceiver,arrayMessages){
        var res="";
        for(var i=0;i<arrayMessages.length;i++){
            if(arrayMessages[i].id_sender == idreceiver){
                res+="<div class='his_message'>"+arrayMessages[i].text_message+"</div>";
            }else{
                res+="<div class='your_message'>"+arrayMessages[i].text_message+"</div>";
            }
        }
        return res;
    }
    $(".form-submit").click(function () {
        var message=$(this).prev().prev()[0].value;
        var idReceiver=$(this).prev()[0].value;
        var thiselem=$(this);
        var data="text-message="+message+"&id-receiver="+idReceiver;
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "index.php?action=sendMessageTo", //Relative or absolute path to response.php file
            data: data,
            success: function (data) {
                var res=htmlMessages(idReceiver,data.messages);
                var chatcontainerElem=thiselem.parent().parent()[0].children[1];
                chatcontainerElem.innerHTML=res;
            },
            error: function (data) {
                console.log("ERROR");
            }
        });
    });

        $("#create-article-form").submit(function () {
        var data=$(this).serialize();
        /*$.ajax({
            type: "POST",
            dataType: "json",
            url: "index.php?action=sendMessageTo", //Relative or absolute path to response.php file
            data: data,
            success: function (data) {
                var res=htmlMessages(idReceiver,data.messages);
                var chatcontainerElem=thiselem.parent().parent()[0].children[1];
                chatcontainerElem.innerHTML=res;
            },
            error: function (data) {
                console.log("ERROR");
            }
        });*/
    });
};