/* Smooth scroll */

$(function() {
    $('a[href*="#"]:not([href="#myCarousel"])').click(function() {
        if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
            var target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
            if (target.length && $(window).width() > 768) {
                $('html, body').animate({
                    scrollTop: target.offset().top - 60
                }, 1000, 'easeInOutExpo');
                return false;
            } else {
                $('html, body').animate({
                    scrollTop: target.offset().top - 50
                }, 1000, 'easeInOutExpo');
                return false;
            }
        }
    });
});

/* BMI calculator */

function computeBMI() {
    var height = Number(document.getElementById("height").value);
    var weight = Number(document.getElementById("weight").value);

    var BMI = Math.round(weight / Math.pow(height, 2) * 10000);

    document.getElementById("output").innerText = Math.round(BMI * 100) / 100;

    var output = Math.round(BMI * 100) / 100;
    if (output < 18.5)
        document.getElementById("comment").innerText = "Svorio trūkumas";
    else if (output >= 18.5 && output <= 25)
        document.getElementById("comment").innerText = "Normalus svoris";
    else if (output >= 25 && output <= 30)
        document.getElementById("comment").innerText = "Antsvoris";
    else if (output > 30)
        document.getElementById("comment").innerText = "Nutukimas";
}