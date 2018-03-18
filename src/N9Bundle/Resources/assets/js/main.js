require("materialize-css")
require("./jquery.scrollfire.min.js")

$(document).ready(function () {
    
    $('.parallax').parallax();
    
    $('.materialboxed').materialbox();

    $('.tooltipped').tooltip({delay: 50});
    
    $(".button-collapse").sideNav({
        closeOnClick: true
    });
    
    $('.modal').modal({
        dismissible: true,
        opacity: .5,
        inDuration: 500,
        outDuration: 400,
        startingTop: '4%',
        endingTop: '10%',
    });
    $('.trigger-modal').on('click', function() {
        modal = $(this).data("target");
        modal.modal('open');
    });
    
    
    $('.alert').removeClass('light-green').removeClass('red').removeClass('lighten-4').hide();
    $('.alert .card-content').removeClass('light-green-text').removeClass('red-text').removeClass('text-darken-3').removeClass('text-darken-4').html('');
    $('.waiting').hide();
    
    var formContact = $('#div_form_contact form');
    
    $('.validate').keyup(function() {
        if (this.value.length < 3) return;
        validate_field($(this))
    });
    $('.validate').focus(function() {
        $(this).removeClass("invalid");
    });
    
    initContactForm();
    
    $('#div_form_contact').on('click', '#btn_send', function(event) {
        formContact.find('.validate').each(function(){
            if ($(this).prop('required')) {
                if ($(this).val() === "") {
                    $(this).addClass("invalid");
                } else {
                    validate_field($(this))
                }
            } else {
                validate_field($(this))
            }
        });
        
        if (formContact.find('.invalid').length > 0) {
            return;
        }
        
        event.preventDefault();
        formData = formContact.serialize();
        formContact.hide();
        $('.waiting').show();
        $('.btn_send').hide();
        
        $.ajax({
            url: formContact.attr('action'),
            type: 'POST',
            data: formData,
            dataType: 'json',
            beforeSend: function(xhr) {
                xhr.setRequestHeader("X-Requested-With", "XMLHttpRequest");
            },
            success: function(json) {
                if (json.status == 200) {
                    $('.waiting').hide();
                    $('.btn_send').hide();
                    $('.btn_close').show();
                    $('.alert .card-content').addClass('light-green-text').addClass('text-darken-3').html(json.message);
                    $('.alert').addClass('light-green').addClass('lighten-4').show().delay(2000).fadeOut( 800, function() {
                        $(this).hide();
                    });;
                    initContactForm();
                    
                    var $toastContent = $('<span class=" grey-text text-darken-2">'+json.message+'</span>');
                    Materialize.toast($toastContent, 5000, 'light-green lighten-2');
                } else {
                    if (typeof json.listFields !== "undefined") {
                        $.each(json.listFields, function (key, value) {
                            $("#contact_"+value).removeClass('valid').addClass('invalid');
                        });
                    }
                    $('.waiting').hide();
                    formContact.show();
                    $('.alert .card-content').addClass('red-text').addClass('text-darken-4').html(json.message);
                    $('.alert').addClass('red').addClass('lighten-4').show();
                    $('.btn_send').show();
                    $('.btn_close').hide();
                }
            },
            error: function(jqXHR, exception) {
                $('.waiting').hide();
                $('.alert .card-content').addClass('red-text').addClass('text-darken-4').html("Erreur technique");
                $('.alert').addClass('red').addClass('lighten-4').show();
                formContact.show();
                $('.btn_close').show();
                
                if (jqXHR.status === 0) {
                    console.log('Not connect.\n Verify Network.');
                } else if (jqXHR.status == 404) {
                    console.log('Requested page not found. [404]');
                } else if (jqXHR.status == 500) {
                    console.log('Internal Server Error [500].');
                } else if (exception === 'parsererror') {
                    console.log('Requested JSON parse failed.');
                } else if (exception === 'timeout') {
                    console.log('Time out error.');
                } else if (exception === 'abort') {
                    console.log('Ajax request aborted.');
                } else {
                    console.log('Uncaught Error.\n' + jqXHR.responseText);
                }
            }
        });
    });
    
    
    $('main').on('mouseover', ".animated", function(){
        $(this).removeClass($(this).data("effect")).removeClass('animated');
    });
    
    $('.not-animated').scrollfire({
        // Offsets
        offset: 0,
        topOffset: 150,
        bottomOffset: 150,

        onScrollDown: function( elm, distance_scrolled ) {
            if ($(elm).css('opacity') < 1) {
                duration = $(elm).data("duration");
                if (typeof duration == "undefined") {
                    duration = 200;
                }

                $(elm).removeClass('not-animated').addClass('animated').addClass($(elm).data("effect"));
                $(elm).animate({opacity: 1}, duration), function() {
                    $(elm).removeClass($(elm).data("effect"))
                };
            }
                
            $(".button-collapse").sideNav({
                closeOnClick: true
            });
            
        },
    });
              
});

function initContactForm() {
    $('#div_form_contact form').show();
    $("#div_form_contact :input:visible:not(button)").val('');
    
    $('.btn_send').show();
}