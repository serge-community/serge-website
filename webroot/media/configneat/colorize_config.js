$( document ).ready(function() {
    var n = 0;
    $("script[language='text/x-config-neat']").each(function() {
        var o = $(this);
        var id = 'code_' + (n++);
        o.replaceWith('<code class="block config" id="'+id+'">'+id+'</code>');
        CodeMirror.runMode(o.text().trim(), "text/x-config-neat", $('#'+id)[0]);
    });
});
