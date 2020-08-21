console.log("I am Ready");

function switchAuth() {
    const signinForm = "#signin-form";
    const signupForm = "#signup-form";
    $("#signin").on("click", function(){
        $(signinForm).removeClass("d-none");
        $(signinForm).addClass("d-block");
        $(signupForm).removeClass("d-block");
        $(signupForm).addClass("d-none");
    });

    $("#signup").on("click", function(){
        $(signupForm).removeClass("d-none");
        $(signupForm).addClass("d-block");
        $(signinForm).removeClass("d-block");
        $(signinForm).addClass("d-none");
    })
}