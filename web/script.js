/*window.onload = function () {
    var errorBlock = document.querySelector('#error-block');
    var successBlock = document.querySelector('#success-block');
    var xmlhttp = new XMLHttpRequest();
    var formLogin = document.forms["login-form"];
    var formRegister = document.forms["register-form"];
    var formCreateArticle = document.forms["create-article-form"];
    var buttonsShowArticle = document.querySelectorAll(".show-article");
    var formCreateComment = document.forms["post-comment"];
    var formChangePassword = document.forms["change-password-form"];
    var formShowProfile = document.querySelectorAll(".show-profile-form");
    var authorArticleLink = document.querySelectorAll(".showProfileLink");
    var formDeleteComment = document.querySelectorAll(".delete-comment-form");
    var deleteCommentLink = document.querySelectorAll(".deleteCommentLink");
    var formEditArticle = document.querySelectorAll("#edit-article-form");

    function submitOnLogin() {
        xmlhttp.open("POST", "?action=login", true);
        formLogin.onsubmit = function () {
            xmlhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                }
            };

            xmlhttp.send();
            return false;
        };
    };

    function submitOnRegister() {
        formRegister.onsubmit = function () {
            xmlhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                }
            };
            xmlhttp.open("POST", "?action=register", true);
            xmlhttp.send();
        };
    };


    function submitOnCreateArticle() {
        formCreateArticle.onsubmit = function () {
            xmlhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                }
            };
            xmlhttp.open("POST", "?action=createArticle", true);
            xmlhttp.send();
        };
    };

    function clickOnShowArticle() {
        for (var i = 0; i < buttonsShowArticle.length; i++) {
            buttonsShowArticle[i].onsubmit = function () {
                xmlhttp.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                    }
                };
                xmlhttp.open("POST", "?action=showArticle", true);
                xmlhttp.send();
            }.bind(i);
        }
    };

    function submitOnCreateComment() {
        formCreateComment.onsubmit = function () {
            xmlhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                }
            };
            console.log("here");
            xmlhttp.open("POST", "?action=createComment", true);
            xmlhttp.send();
        };
    };

    function submitOnChangePassword() {
        formCreateComment.onsubmit = function () {
            xmlhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                }
            };
            xmlhttp.open("POST", "?action=changePassword", true);
            xmlhttp.send();
        };
    };

    function submitOnShowProfile() {
        for (var i = 0; i < authorArticleLink.length; i++) {
            authorArticleLink[i].parentNode.onsubmit = function () {
                xmlhttp.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                    }
                };
                xmlhttp.open("POST", "?action=showProfile", true);
                xmlhttp.send();
            };
            authorArticleLink[i].onclick = function () {
                this.parentElement.submit();
            };
        }
    };

    function submitOnDeleteComment() {
        for (var i = 0; i < deleteCommentLink.length; i++) {
            deleteCommentLink[i].parentNode.onsubmit = function () {
                xmlhttp.onreadystatechange = function () {
                    if (this.readyState == 4 && this.status == 200) {
                    }
                };
                xmlhttp.open("POST", "?action=deleteComment", true);
                xmlhttp.send();
            };
            deleteCommentLink[i].onclick = function () {
                this.parentElement.submit();
            };
        }
    };

    function submitOnEditArticle() {
        formEditArticle.onsubmit = function () {
            xmlhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                }
            };
            xmlhttp.open("POST", "?action=editArticle", true);
            xmlhttp.send();
        };
    };
    if (formLogin != undefined)
        submitOnLogin();
    if (formRegister != undefined)
        submitOnRegister();
    if (formCreateArticle != undefined)
        submitOnCreateArticle();
    if (buttonsShowArticle != undefined)
        clickOnShowArticle();
    if (formCreateComment != undefined)
        submitOnCreateComment();
    if (formChangePassword != undefined)
        submitOnChangePassword();
    if (formShowProfile != undefined)
        submitOnShowProfile();
    if (formDeleteComment != undefined)
        submitOnDeleteComment();
    if (formEditArticle != undefined)
        submitOnEditArticle();

    var element = document.getElementsByClassName("chat");
    for(var i=0; i < element.length; i++){
        element[i].scrollTop = element[i].scrollHeight;
    }

};*/

$( "#clickme" ).click(function() {
    $( "#book" ).show( "slow", function() {
        // Animation complete.
    });
});

$(":file").filestyle({icon: false});



$(document).on('click', '.arrow_slide_down_button', function(event){
    event.preventDefault();

    $('html, body').animate({
        scrollTop: $( $.attr(this, 'href') ).offset().top
    }, 500);
});