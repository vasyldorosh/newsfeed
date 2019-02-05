function gradientize($, selectorWrapper, sekectorTitle, sekectorBodyText, selectorGradientDiv, selectorImg, selectorChannel, card__text_after) {
    $(selectorWrapper).each(function () {
        const
                $title = $(this).find(sekectorTitle),
                $bodyText = $(this).find(sekectorBodyText),
                $gradient = $(this).find(selectorGradientDiv),
                $footer = $(this).find(selectorChannel);
        // $card__text_after = $(this).find(card__text_after);
        setTimeout(() => {

            $clamp($bodyText[0], {clamp: 9});
        }, 500);
        
        Vibrant
                .from($(this).find('img:first'))
                .maxColorCount(32)
                .quality(3)
                .getPalette(function (err, palette) {
                    //"Vibrant", "LightVibrant", "DarkVibrant", "Muted", "LightMuted", "DarkMuted"
                    if (err) console.log(err);

                    console.log(palette);

                    const color = 0
                            //|| palette.DarkVibrant
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
                            //|| palette.DarkVibrant
                            || palette.Vibrant
                            || palette.LightVibrant
                            ;
                    const shadowColor2 = 0
                            || palette.DarkMuted
                            || palette.LightMuted
                            || palette.Muted
                            //|| palette.DarkVibrant
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
    $(selectorWrapper).each(function () {
        const $gradient = $(this).find(selectorGradientDiv);

        RGBaster.colors($(this).find(selectorImg)[0], {
            success: function (payload) {
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

$(document).ready(() => {

    window.uniqId = 10;
    gradientize2($, '.card', '.card__title', '.card__text', '.card__gradient', '.card__image', '.card__footer', '.card__text::after');

    function loadMore() {
        $.ajax({
            headers: {
               'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content'),
            },      
            type: "GET",
            url: '/?offset=' + ($('a.js-item-card').length / 2),
            data: {},
            success: (html) => {
                $('.feed-wrapper').append(html);
                gradientize2($, '.card', '.card__title', '.card__text', '.card__gradient', '.card__image', '.card__footer');
                $(window).bind('scroll', bindScroll);
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
        if (scrollTop + windowHeight > documentHeight - waypoint) {
            $(window).unbind('scroll');
            if (window.location.href.indexOf('channels') !== -1) {
                loadMoreChannels();
            } else {
                loadMore();
            }
        }
    }

    $(window).bind('scroll', bindScroll);

});
