function loadCSS(e,n,t){"use strict";var o=window.document.createElement("link"),d=n||window.document.getElementsByTagName("script")[0],i=window.document.styleSheets;return o.rel="stylesheet",o.href=e,o.media="only x",d.parentNode.insertBefore(o,d),o.onloadcssdefined=function(e){for(var n,t=0;t<i.length;t++)i[t].href&&i[t].href===o.href&&(n=!0);n?e():setTimeout(function(){o.onloadcssdefined(e)})},o.onloadcssdefined(function(){o.media=t||"all"}),o}