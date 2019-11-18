/**
 * This code will convert all occurrences of text
 * `<serge_root>/path/to/file` inside <code> tags
 * to a clickable link to Github Source code:
 * https://github.com/evernote/serge/blob/master/path/to/file
 */

$(document).ready(function() {
  var GITHUB_ROOT = 'https://github.com/evernote/serge/blob/master';

  $("code").each(function(index) {
    var o = $(this);
    var s = o.text();
    if (s.startsWith('<serge_root>')) {
      var label = s.replace('<serge_root>', '&lt;serge_root&gt;');
      var url = s.replace('<serge_root>', GITHUB_ROOT);
      o.html('<a href="' + url + '">' + label + '</a>');
    }
  });
});