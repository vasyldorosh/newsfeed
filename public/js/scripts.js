feedOffset = 0;
    
function gradientize($, selectorWrapper, sekectorTitle, sekectorBodyText, selectorGradientDiv, selectorImg, selectorChannel, card__text_after) {
  $(selectorWrapper).each(function() {
    const
      $title = $(this).find(sekectorTitle),
      $bodyText = $(this).find(sekectorBodyText),
      $gradient = $(this).find(selectorGradientDiv),
      $footer = $(this).find(selectorChannel);
      // $card__text_after = $(this).find(card__text_after);
      setTimeout(() => {

      $clamp($bodyText[0], { clamp: 9 });
      }, 500);
    Vibrant
      .from($(this).find(selectorImg)[0])
      .maxColorCount(32)
      .quality(3)
      .getPalette(function(err, palette) {
      //"Vibrant", "LightVibrant", "DarkVibrant", "Muted", "LightMuted", "DarkMuted"
      // if (err) console.log(err);

      const color = 0
        || palette.DarkVibrant
        || palette.Muted
        || palette.DarkMuted
        || palette.Vibrant
        || palette.LightVibrant
        || palette.LightMuted
        ;

      const shadowColor1 = 0
        || palette.LightMuted
        || palette.Muted
        || palette.DarkMuted
        || palette.DarkVibrant
        || palette.Vibrant
        || palette.LightVibrant
        ;
      const shadowColor2 = 0
        || palette.DarkMuted
        || palette.LightMuted
        || palette.Muted
        || palette.DarkVibrant
        || palette.Vibrant
        || palette.LightVibrant
        ;

      const
        titleColor = color.getTitleTextColor(),
        bodyTextColor = color.getBodyTextColor(),
        footerColor = color.getBodyTextColor(),
        gradient = color.getRgb(),
        body = color.getRgb();

        // console.log(gradient);

      // $title.css('color', titleColor);
      // $title.css('text-shadow', `1px 1px 0 ${shadowColor1.getHex()}, -1px -1px 0 ${shadowColor2.getHex()}`)
      // $bodyText.css('color', titleColor);
      // $footer.css('color', `${footerColor} !important`);
      $gradient.css('background', getGrad(gradient));
      // $card__text_after.css('background', getGrad(gradient));
    });
  });

  function getGrad(rgbArray) {
    const rgbString = `rgb(${rgbArray[0]},${rgbArray[1]},${rgbArray[2]})`;
    return `-webkit-linear-gradient(top, rgba(255,255,255,0) 0%,rgba(255,255,255,0) 33%,${rgbString} 42%,${rgbString} 100%)`;
  }
}

function gradientize2($, selectorWrapper, sekectorTitle, sekectorBodyText, selectorGradientDiv, selectorImg, selectorChannel) {
  $(selectorWrapper).each(function() {
    const $gradient = $(this).find(selectorGradientDiv);

    RGBaster.colors($(this).find(selectorImg)[0], {
      success: function(payload) {
      // You now have the payload.
        // console.log(payload.dominant);
        $gradient.css('background', getGrad(payload.dominant));
      }
    });
  });

  function getGrad(rgbArray) {
    // const rgbString = `rgb(${rgbArray[0]},${rgbArray[1]},${rgbArray[2]})`;
    const rgbString = rgbArray;
    return `-webkit-linear-gradient(top, rgba(255,255,255,0) 0%,rgba(255,255,256,0) 33%,${rgbString} 42%,${rgbString} 100%)`;
  }
}

$( document ).ready(() => {
    $('.social-login').on('click', function(e) {
      $('.social-login').addClass("social-login_spread"); //you can list several class names 
      $('.social-login').removeClass("social-login_compressed"); //you can list several class names 
    });

    $('.social-login').mouseleave(function(e) {
      setTimeout(() => {
        $('.social-login').removeClass("social-login_spread"); //you can list several class names 
        $('.social-login').addClass("social-login_compressed"); //you can list several class names 
      }, 500);
    });


    window.uniqId = 10;
    //gradientize($, '.card', '.card__title', '.card__text', '.card__gradient', '.card__image', '.card__footer', '.card__text::after');

    var loaded = true;
    function loadMore() {
        if (!loaded) {
            return;
        }
        
        loaded = false;
        $.ajax({
          type: "GET",
          dataType: "json",
          url: '/?offset=' + feedOffset,
          data: {},
          success: (data) => {
              
              console.log(data.previews.length);
              const previews = data.previews;
              const feed = ejs.compile(data.templates.feed, { client: true })
              const card = ejs.compile(data.templates.card, { client: true })
              const feedAd = ejs.compile(data.templates.feedAd, { client: true })
              const newCards = feed({ previews, card, feedAd });
              //const newCards = feed({ previews, card});

              $('.feed-wrapper').append(newCards);
              gradientize($, '.card', '.card__title', '.card__text', '.card__gradient', '.card__image', '.card__footer');
              $(window).bind('scroll', bindScroll);
              
              loaded = true;
              feedOffset = feedOffset + 8;
          },
          error: (e) => console.log(e)
      });
    }

    function bindScroll() {
      const scrollTop = Math.round($(window).scrollTop());
      const windowHeight = $(window).height();
      const documentHeight = $(document).height();
      const waypoint = $(document).height() - Math.round($(document).height() * 0.7);
      // const waypoint = Math.round($(document).height() - ($(document).height() - windowHeight - windowHeight/2));
      // console.log(`${scrollTop} + ${windowHeight}=${scrollTop + windowHeight} > ${documentHeight} - ${waypoint}=${documentHeight - waypoint}`);
      if(scrollTop + windowHeight > documentHeight - waypoint) {
        $(window).unbind('scroll');
          loadMore();
      }
    }

    $(window).bind('scroll', bindScroll);

    loadMore();
});