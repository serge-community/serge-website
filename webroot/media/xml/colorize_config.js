$(document).ready(function() {
  $("script[language='text/xml']").each(function(index) {
    var o = $(this);
    var id = 'code_xml_' + index;
    o.replaceWith('<code class="block xml" id="' + id + '">' + id + '</code>');
    CodeMirror.runMode(o.text().trim(), 'text/xml', $('#' + id)[0]);
  });
});
