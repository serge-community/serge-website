$(document).ready(function() {
    $("script[language='text/x-config-neat']").each(function(index) {
        var o = $(this);
        var id = 'code_' + index;
        o.replaceWith('<code class="block config" id="'+id+'">'+id+'</code>');
        CodeMirror.runMode(o.text().trim(), "text/x-config-neat", $('#'+id)[0]);
    });
});
