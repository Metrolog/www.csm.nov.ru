!function(Abtf){console.warn("Abtf","debug notices visible to admin only"),Abtf.h=function(css){Abtf.proxy&&Abtf.ps(Abtf.proxy),Abtf.js&&!Abtf.js[1]&&Abtf.j(Abtf.js[0]),void 0!==Abtf.gwf&&Abtf.gwf[0]&&!Abtf.gwf[1]&&("a"===Abtf.gwf[0]?(Abtf.a(Abtf.gwf[2],"webfont"),console.log("Abtf.fonts()","async",WebFontConfig)):"undefined"!=typeof WebFont&&("string"==typeof Abtf.gwf[0]&&(Abtf.gwf[0]=eval("("+Abtf.gwf[0]+")")),WebFont.load(Abtf.gwf[0]),console.log("Abtf.fonts()",Abtf.gwf[0])))},Abtf.f=function(t){t&&Abtf.c&&(console.log("Abtf.css()","footer start"),Abtf.c()),Abtf.js&&Abtf.js[1]&&(console.log("Abtf.js()","footer start"),Abtf.j(Abtf.js[0])),void 0!==Abtf.gwf&&Abtf.gwf[0]&&Abtf.gwf[1]&&("a"===Abtf.gwf[0]?(this.a(Abtf.gwf[2],"webfont"),console.log("Abtf.fonts() [footer]","async",WebFontConfig)):"undefined"!=typeof WebFont&&(WebFont.load(Abtf.gwf[0]),console.log("Abtf.fonts() [footer]",Abtf.gwf[0])))},Abtf.a=function(t,f){!function(o){var e=o.createElement("script");e.src=t,f&&(e.id=f),e.async=!0;var n=o.getElementsByTagName("script")[0];n?n.parentNode.insertBefore(e,n):(document.head||document.getElementsByTagName("head")[0]).appendChild(e)}(document)};var SITE_URL=document.createElement("a");SITE_URL.href=document.location.href;var BASE_URL_REGEX=new RegExp("^(https?:)?//"+SITE_URL.host.replace(/[-\/\\^$*+?.()|[\]{}]/g,"\\$&"),"i");Abtf.localUrl=function(t){return t.replace(BASE_URL_REGEX,"")}}(window.Abtf);