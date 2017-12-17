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
    $("#order_form_ingredients option:selected").prop("selected", false);
    var height = Number(document.getElementById("height").value);
    var weight = Number(document.getElementById("weight").value);
    //order_form_ingredients
    var BMI = Math.round(weight / Math.pow(height, 2) * 10000);

    document.getElementById("output").innerText = Math.round(BMI * 100) / 100;

    var output = Math.round(BMI * 100) / 100;
    if (output < 18.5) {
        var data="3,4";
        var dataarray=data.split(",");
        $("#order_form_ingredients").val(dataarray);
        $("#order_form_ingredients").trigger("change");
        document.getElementById("comment").innerText = "Svorio trūkumas";
    }
    else if  (output >= 18.5 && output <= 25) {
        var data="4,5";
        var dataarray=data.split(",");
        $("#order_form_ingredients").val(dataarray);
        $("#order_form_ingredients").trigger("change");
        document.getElementById("comment").innerText = "Normalus svoris";
    } else if (output >= 25 && output <= 30) {
        document.getElementById("comment").innerText = "Antsvoris";
    } else if (output > 30) {
        document.getElementById("comment").innerText = "Nutukimas";
    }
}

window.ParsleyConfig = window.ParsleyConfig || {};

(function ($) {
    window.ParsleyConfig = $.extend( true, {}, window.ParsleyConfig, {
        messages: {
            // parsley //////////////////////////////////////
            defaultMessage: "Laukas užpildytas neteisingai"
            , type: {
                email:      "Neteisingas elektroninio pašto adresas"
                , url:        "Neteisingas URL adresas"
                , urlstrict:  "Neteisingas URL adresas"
                , number:     "Šiame lauke turi būti įrašytas skaičius"
                , digits:     "Šiame lauke galima įrašyti tik skaičius"
                , dateIso:    "Datos formatas turi būti (YYYY-MM-DD)"
                , alphanum:   "Šiame lauke galima įrašyti tik skaičius ir raides"
            }
            , notnull:        "Reikšmė negali būti nulis"
            , notblank:       "Reikšmė negali būti tuščia"
            , required:       "Laukas privalomas"
            , regexp:         "Laukas užpildytas neteisingai"
            , min:            "Reikšmė negali būti mažesnė už %s"
            , max:            "Reikšmė negali būti didesnė už %s"
            , range:          "Reikšmė turi būti tarp %s ir %s"
            , minlength:      "Rėikšmė pertrumpa, jos ilgis turi būti bent %s"
            , maxlength:      "Rėikšmė perilga, jos ilgis turi būti mažiau nei %s"
            , rangelength:    "Rėikšmės ilgis turi būti tarp %s ir %s simbolių"
            , equalto:        "Reikšmės nesutampa"
            , mincheck:       "Būtina pažymėti bent %s"
            , maxcheck:       "Būtina pažymėti mažiau nei %s"
            , rangecheck:     "Galima pažymėti nuo %s iki %s langelių"

            // parsley.extend ///////////////////////////////
            , minwords:       "Žodžių turi būti bent %s"
            , maxwords:       "Žodžių turi būti mažiau nei %s"
            , rangewords:     "Žodžių kiekis turi būti tarp %s ir %s"
            , greaterthan:    "Reikšmė permaža, ji turi būti didesnė nei %s"
            , lessthan:       "Reikšmė perdidelė, ji turi būti mažesnė nei %s"
        }
    });
}(window.jQuery || window.Zepto));