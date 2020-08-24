console.log("I am Ready");

function switchAuth() {
    const signinForm = "#signin-form";
    const signupForm = "#signup-form";
    $("#signin").on("click", function () {
        $(signinForm).removeClass("d-none");
        $(signinForm).addClass("d-block");
        $(signupForm).removeClass("d-block");
        $(signupForm).addClass("d-none");
    });

    $("#signup").on("click", function () {
        $(signupForm).removeClass("d-none");
        $(signupForm).addClass("d-block");
        $(signinForm).removeClass("d-block");
        $(signinForm).addClass("d-none");
    })

    $("#signup-btn").on("click", function () {
        $(signupForm).removeClass("d-none");
        $(signupForm).addClass("d-block");
        $(signinForm).removeClass("d-block");
        $(signinForm).addClass("d-none");
    })

    $("#signin-btn").on("click", function () {
        $(signinForm).removeClass("d-none");
        $(signinForm).addClass("d-block");
        $(signupForm).removeClass("d-block");
        $(signupForm).addClass("d-none");
    });
}

$(function () {
    $("#backtop").hide();
    $(window).on("scroll", function () {
        if ($(this).scrollTop() > 300) {
            $("#backtop").show();
        }

        if ($(this).scrollTop() < 300) {
            $("#backtop").hide();
        }
    })
    $('#backtop').on("click", function () {
        $('#body').animate({
            scrollTop: 0
        }, 200);
    });
});

$(function () {
    $("#showPass").on("click", function (e) {
        e.preventDefault();
        let inputP = document.getElementById("inputPass");
        let inputCP = document.getElementById("inputCPassword");
        if (inputP.type === "password" || inputCP.type === "password") {
            inputP.type = "text";
            inputCP.type = "text";
            $("#eyeicon").toggleClass("fa-eye-slash");
        } else {
            inputP.type = "password";
            inputCP.type = "password";
            $("#eyeicon").toggleClass("fa-eye");
        }
    })
})

$(function () {
    $('.toast').toast('show');
});