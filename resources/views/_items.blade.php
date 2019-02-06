<?php 
$data = [
    "previews"=>[],
    "templates"=>[
        "feed" => "<%\r\n    const cardsRotate = [0, 1, 1, 0, 1, 1, 0, 1, 1];\r\n    let cardsRotateIndex = 0;\r\n    let uniqId;\r\n\r\n    for (let i = 0; i < previews.length; i++) {\r\n  \r\n        if (cardsRotate[cardsRotateIndex++] === 1) { \r\n            // html\r\n            %><div class=\"card-short-wrapper\"><%-card({ card: previews[i], short: true })%><% if (i === 7) {%><%-feedAd({ id: !window ? i : ++window.uniqId })%><%} else {%><%-card({ card: previews[i+1], short: true })%><%}%></div><%\r\n            // end html\r\n            cardsRotateIndex++;\r\n            i++;\r\n            continue;\r\n        }\r\n        // html\r\n        %><%-card({ card: previews[i], short: false })%><%\r\n        // rnd hmlt\r\n    }\r\n%>",
        "card"  => "<div class=\"card<%= short ? ' card_short': '' %>\">\r\n    <a class=\"card__link-wrapper\" href=\"/articles/<%= card.link %>\" target=\"_blank\">\r\n        <div class=\"card__gradient\"></div>\r\n        <img class=\"card-img-top card__image\" src=\"<%= card.img %>\" alt=\"Card image cap\">\r\n        <div class=\"card-body card__body\">\r\n            <h5 class=\"card-title card__title card_inverse\"><%= card.title.slice(0, 100) %></h5>\r\n            <% if (!short) {%><p class=\"card-text card__text\"><%= card.pha %>...</p><% }%>\r\n            <a class=\"text-muted card__footer card_inverse\" href=\"/channels/<%= card.channelLink %>\" target=\"_blank\"><%= card.channel %></a>\r\n        </div>\r\n    </a>\r\n</div>",
        "feedAd" => "<!-- Yandex.RTB R-A-281589-1 -->\n<div id=\"yandex_rtb_R-A-281589-<%=id%>\" class=\"card card_short\"></div>\n<script type=\"text/javascript\">\n    (function(w, d, n, s, t) {\n        w[n] = w[n] || [];\n        w[n].push(function() {\n            Ya.Context.AdvManager.render({\n                blockId: `R-A-281589-1`,\n                renderTo: `yandex_rtb_R-A-281589-<%=id%>`,\n                pageNumber: <%=id%>,\n                async: true,\n            });\n        });\n        t = d.getElementsByTagName(\"script\")[0];\n        s = d.createElement(\"script\");\n        s.type = \"text/javascript\";\n        s.src = \"//an.yandex.ru/system/context.js\";\n        s.async = true;\n        t.parentNode.insertBefore(s, t);\n    })(this, this.document, \"yandexContextAsyncCallbacks\");\n</script>",
    ],
];

foreach ($items as $item) {
    $data['previews'][] = [
        'title' => $item['title'],
        'img' => '/i?image=' . $item['image_url'],
        //'img' => (substr($item['image_url'], 0, 2) == '//' ? 'https:':'') . $item['image_url'],
        'pha' => $item['description'],
        'description' => $item['description'],
        'channel' => $item['resource'],
        'channelLink' => '//' . $item['resource'],
        'link' => $item['url'],
        'id' => $item['id'],
    ];
}
echo json_encode($data);
?>
