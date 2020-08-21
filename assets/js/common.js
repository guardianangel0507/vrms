console.log("I am Ready");

function switchAuth() {
    $("#signin").click(function(){
        $("#signin-form").removeClass("d-none");
        $("#signin-form").addClass("d-block");
        $("#signup-form").removeClass("d-block");
        $("#signup-form").addClass("d-none");
    });

    $("#signup").click(function(){
        $("#signup-form").removeClass("d-none");
        $("#signup-form").addClass("d-block");
        $("#signin-form").removeClass("d-block");
        $("#signin-form").addClass("d-none");
    })
}