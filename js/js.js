
$(document).ready(function(){
    let submitBtn = $("#submit");
    let header = document.querySelector("header")
    let navlist = $("nav").children().clone(true)

    function toc(checkbox) {
        if($(checkbox).prop('checked')) {
            submitBtn.prop("disabled",false);
        } else {
            submitBtn.prop("disabled",true);
        }
    }
    
    toc("#toc");

    $("#toc").change((e)=>{
        toc(e.currentTarget)
    });

    window.addEventListener("scroll",(e)=>{
            
        if(window.scrollY > 250) {
            header.classList.add("to-scroll")                    
        } 
        if(window.scrollY <= 0) {
            header.classList.remove("to-scroll")
            
        } 
    })
    
    $('#ham').click(function(){
        $(this).toggleClass('open');

        if($(this).hasClass("open")) {
            $(".mnav-list").fadeIn().append(navlist);
        } else {
            $(".mnav-list").fadeOut().emty()
        }
    })

    let toRegister = document.getElementById("register")
    toRegister.addEventListener("click", function(){
        var scrollDiv = document.getElementById("registerForm").offsetTop;
        window.scrollTo({ top: scrollDiv, behavior: 'smooth'});
    })

    //form validation
    $(".validate-input").focusout(function(){
        if($(this).val() <= 2 ) {
            alert("Please fill out the field with more than 2 characters")
        }
    })
    
    if (String(window.performance.getEntriesByType("navigation")[0].type) === "back_forward") {
        location.reload();
    } 

})