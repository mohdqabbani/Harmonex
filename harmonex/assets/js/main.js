(function ($) {
    'use strict';
//hrhehehrehehr
    //for select --> dropdown box
//    $('select[id!="material"]').selectize({
//        create: false,
//        dropdownParent: 'body'
//    });

    //for return material when select class room using ajax
//herehrheehrhe
//    $('#selectize-dropdown-class-room').on('change', function(){
//        var value = $(this).val();
//        $.ajax({
//            method: 'GET',
//            url: 'ajax_courses.php',
//            cache: false,
//            data: {value: value},
//            success: function (data) {
//                $('#material').html(data);
//            }
//        });
//    });
 // herererer
    //for smooth scroll when click <a></a> in the page
//    document.querySelectorAll('a[href^="#manage_videos"]').forEach(anchor => {
//        anchor.addEventListener('click', function (e) {
//            e.preventDefault();
//
//            document.querySelector(this.getAttribute('href')).scrollIntoView({
//                behavior: 'smooth'
//            });
//        });
//    });

    //For tooltip
    $('[data-toggle="tooltip"]').tooltip();


    //stop video when exit from modal
    $('.modal[data-video]').on('hide.bs.modal', function (e) {
        var video = $(this).attr('data-video');
        $(video).get(0).pause();
    });

    $('.container-video').mouseleave(function (e) {
        $('.dropdown, .dropdown-menu').removeClass('show');
        $('.dropdown div.btn-dropdown').attr('aria-expanded','false');
    });

    $('.modal').appendTo("body");

    $('.card-add').height($('.card-video').height());

})(jQuery);