<?php
    $subpage = 'callback-phases';
    $title = 'Callback Phases';
    include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-header.php');
?>

<h1>Callback Phases</h1>

<h2 id="before_job">before_job</h2>
<p>[1]</p>

<h2 id="before_update_database_from_source_files">before_update_database_from_source_files</h2>
<p>[1]</p>

<h2 id="before_update_database_from_po">before_update_database_from_po</h2>
<p>[1]</p>

<h2 id="before_generate_po">before_generate_po</h2>
<p>[1]</p>

<h2 id="before_generate_localized_files">before_generate_localized_files</h2>
<p>[1]</p>

<h2 id="after_job">after_job</h2>
<p>[1]</p>

<h2 id="rewrite_path">rewrite_path</h2>
<p>[1]</p>

<h2 id="after_load_source_file_for_processing">after_load_source_file_for_processing</h2>
<p>[1]</p>

<h2 id="is_file_orphaned">is_file_orphaned</h2>
<p>[1]</p>

<h2 id="can_process_source_file">can_process_source_file</h2>
<p>[1]</p>

<h2 id="after_load_file">after_load_file</h2>
<p>[1]</p>

<h2 id="can_extract">can_extract</h2>
<p>[2]</p>

<h2 id="before_update_database_from_po_lang_file">before_update_database_from_po_lang_file</h2>
<p>[1]</p>

<h2 id="can_process_po">can_process_po</h2>
<p>[1]</p>

<h2 id="rewrite_parsed_po_item">rewrite_parsed_po_item</h2>
<p>[1]</p>

<h2 id="after_update_database_from_po_lang_file">after_update_database_from_po_lang_file</h2>
<p>[1]</p>

<h2 id="rewrite_relative_output_path">rewrite_relative_output_path</h2>
<p>[1]</p>

<h2 id="rewrite_absolute_output_path">rewrite_absolute_output_path</h2>
<p>[1]</p>

<h2 id="can_generate_po">can_generate_po</h2>
<p>[1]</p>

<h2 id="can_translate">can_translate</h2>
<p>[2]</p>

<h2 id="add_dev_comment">add_dev_comment</h2>
<p>[1]</p>

<h2 id="can_generate_localized_file">can_generate_localized_file</h2>
<p>[1]</p>

<h2 id="can_generate_localized_file_source">can_generate_localized_file_source</h2>
<p>[1]</p>

<h2 id="after_load_source_file_for_generating">after_load_source_file_for_generating</h2>
<p>[1]</p>

<h2 id="can_save_localized_file">can_save_localized_file</h2>
<p>[1]</p>

<h2 id="before_save_localized_file">before_save_localized_file</h2>
<p>[1]</p>

<h2 id="on_localized_file_change">on_localized_file_change</h2>
<p>[1]</p>

<h2 id="after_save_localized_file">after_save_localized_file</h2>
<p>[1]</p>

<h2 id="rewrite_translation">rewrite_translation</h2>
<p>[1]</p>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-footer.php') ?>
