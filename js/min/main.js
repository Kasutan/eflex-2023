!function(t){t(document).ready(function(){t(window).width();var e=t("[aria-describedby]"),e=(0<e.length&&t(e).each(function(){var e=t(this).attr("aria-describedby");0===t("#"+e).length&&t(this).removeAttr("aria-describedby")}),t('label[for*="select"]'));console.log(e),0<e.length&&t(e).each(function(){var e=t(this).attr("for");console.log("f",e),e=e.replace("-label",""),console.log("f",e),t(this).attr("for",e)})})}(jQuery);