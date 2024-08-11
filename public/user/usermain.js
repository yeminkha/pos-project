$(document).ready(function () {
    $(".side").click(function () {
        $(this).toggleClass("down");
        $(this).closest(".dropdown").find('.dropdown-content').toggleClass("menuactive");
    });

    $(".aboutRegister").hover(function () {
      $(".explainRegister").toggleClass("visible");
    });
    $(".aboutName").hover(function () {
        $(".explainName").toggleClass("visible");
    });
    $(".aboutPhone").hover(function () {
        $(".explainPhone").toggleClass("visible");
    });

    $(".aboutLogin").hover(function () {
        $(".explainLogin").toggleClass("visible");
    });
    $(".menu").click(function () {
        $(".menuSlider").toggleClass("menuSliderActive");
      });
    $(".downdownbtn").click(function () {
      let container = $(this).closest(".dropdownContainer");
      let contentBox = container.find(".dorpdownContentBox");

      if (!container.hasClass("active")) {
        container.addClass("active");


        $(this).find(".varti").css("transform", "rotate(270deg)");
        $(this).find(".hori").css("transform", "rotate(180deg)");

        contentBox.css({
            height: contentBox.prop("scrollHeight") + "px",
            "visibility": "visible"
        });

        container.find(".dropdowntitlecontainer").css({
            "border-bottom": "none",
            "border-bottom-left-radius": "0px",
            "border-bottom-right-radius": "0px",
            "transition-delay": "0s",
        });
      } else {
        container.removeClass("active");
        $(this).find(".varti").css("transform", "rotate(0deg)");
        $(this).find(".hori").css("transform", "rotate(0deg)");
        contentBox.css({
            height: "0px",
            visibility: "hidden",
        });
        container.find(".dropdowntitlecontainer").css({
            "border-bottom": "1px solid black",
            "border-bottom-left-radius": "5px",
            "border-bottom-right-radius": "5px",
            "transition-delay": "1s",
        });
      }
    });

    function sliderToggle() {
      if ($(".slider").hasClass("slide")) {
        $(".slider").removeClass("slide");
        $(".busket").removeClass("busketslide");
      } else {
        $(".slider").addClass("slide");
        $(".busket").addClass("busketslide");
      }
    }
    $(".busket").click(function () {
      sliderToggle();
    });
    $(".sliderHeader>.closeBtn").click(function () {
      sliderToggle();
    });

    let total = $(".btnGp>.total").val();
    total = parseInt(total);
    $(".calculateBtn").click(function () {
      let btn = $(this).val();
      if (btn == "+") {
        total = total + 1;
        $(".btnGp>.total").val(total);
      } else {
        if (total != 1) {
          total = total - 1;
          $(".btnGp>.total").val(total);
        }
      }
    });

    $("#accDropBtn").click(function () {
      if ($(".card").hasClass("card-flip")) {
        $(".card-container").css({
          height: "600px",
        });
      } else {
        $(".card-container").css({
          height: "650px",
        });
      }
      if ($(this).hasClass("active")) {
        $(this).removeClass("active");
        $(".card-container").css({
          height: "0px",
        });
      } else {
        $(this).addClass("active");
      }
    });

    $("#couponDropBtn").click(function () {
      if ($(".couponDrop").hasClass("active")) {
        $(".couponDrop").css({
          height: "0px",
          padding: "0px",
          border: "1px solid white",
        });
        $(".couponDrop").removeClass("active");
      } else {
        $(".couponDrop").css({
          height: "130px",
          padding: "10px",
          border: "1px solid black",
        });
        $(".couponDrop").addClass("active");
      }
    });
  });

  var swiper = new Swiper(".mySwiper", {
    slidesPerView: 1,
    spaceBetween: 30,
    loop: true,
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
  });
  var swiper = new Swiper(".swiper2", {
    slidesPerView: 4,
    spaceBetween: 40,
    loop: true,
    centeredSlides: true,
    autoplay: {
      delay: 2500,
      disableOnInteraction: false,
    },
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
  });
  var swiper = new Swiper(".homeswiper", {
    slidesPerView: 4,
    autoplay: {
      delay: 2500,
      disableOnInteraction: false,
    },
    spaceBetween: 30,
    loop: true,
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
  });
