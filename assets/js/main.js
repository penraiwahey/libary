// function initMap() {
//     var uluru = {lat: 12.7059993, lng: 101.241382};
//     var map = new google.maps.Map(document.getElementById('map'), {
//         zoom: 15,
//         center: uluru
//     });
//     var marker = new google.maps.Marker({
//         position: uluru,
//         map: map
//     });
// }

// var map;
//     function initMap() {
//         map = new google.maps.Map(document.getElementById('map'), {
//         center: {lat: 12.7059993, lng: 101.241382},
//         zoom: 15
//     });
// }

$(window).scroll(function() {
    var scrollTop = $(this).scrollTop();
    if (scrollTop > 1) {
        $('#navbar').css('padding', '5px 25px')
    } else {
        $('#navbar').css('padding', '25px')
    }
})

$('.to-top').click(function() {
    $('html, body').animate({ scrollTop: '0px' }, 800)
        //console.log(Clicked)      //คลิกแล้วในคอนโซลขึ้นข้อความ และนับการคลิกด้วย
})

$('.jarallax').jarallax();
// การทำ owl-carousel ให้เป็น responesive 
// $(document).ready(function(){
//     $('.owl-carousel').owlCarousel({
//         loop: true,
//         nav:true,
//         dots: true,
//         responsive:{
//             0:{
//                 items:1
//             },
//             600:{
//                 items:2
//             },
//             1000:{
//                 items:3
//             }
//         }
//     });
//   });