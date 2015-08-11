<?php
    $subpage = 'callbacks';
    $title = 'Callbacks';
    $tbd = 1;
    include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-header.php');
?>

<h1>Callbacks</h1>

<p>Callbacks are the way plugins communicate with Serge engine and modify or extend the behavior of localization cycle. Each plugin can listen any number of callbacks. Some plugins have a predefined set of callbacks they listen to; others can be configured via configuration files. Documentation on each callback plugin shipped with Serge provides information on which callback phases are optional, and which are always on.</p>

<p>In the list below, callbacks are sorted by their first occurrence in the localization cycle.</p>

<h2 id="before_job">before_job</h2>
<p>Input parameters: none.</p>
<p>Return value: none.</p>
<p>This callback is called after the job is initialized and before the actual processing starts; phase can be used to implement some data initialization.</p>

<h2 id="before_update_database_from_source_files">before_update_database_from_source_files</h2>
<p>Input parameters: none.</p>
<p>Return value: none.</p>
<p>This callback is called immediately after <code><a href="#before_job">before_job</a></code> callback, before source files are scanned and parsed, and can be used to implement second phase of data initialization.</p>

<h2 id="rewrite_path">rewrite_path</h2>
<p>Input parameters:
    <em>(STRING)</em>relative_file_path.
</p>
<p>Return value: new value of <em>(STRING)</em>relative_file_path.</p>
<p>When source files are scanned, file path (relative to the root directory, see <code>job &rarr; source_dir</code> parameter) for files that match the file masks defined in a job is passed through <code>rewrite_path</code> callbacks. Each callback should either return an unmodified file path, or a rewritten one. Use this phase to change file names and paths, for example, remove language-specific filename suffixes. The final relative file path will be used for the corrensponding .po files, so rewriting the path affects the resulting .po folder/file structure.</p>

<h2 id="after_load_file">after_load_file</h2>
<p>Input parameters:
    <em>(STRING)</em>relative_file_path,
    <em>(STRING)</em>source_language,
    <em>(STRINGREF)</em>content.
</p>
<p>Return value: none.</p>
<p>This callback is called every time a source file is loaded, which happens twice during localization cycle: when all source files are loaded to extract strings from, and when they are loaded as templates to generate localized files.</p>

<h2 id="after_load_source_file_for_processing">after_load_source_file_for_processing</h2>
<p>Input parameters:
    <em>(STRING)</em>relative_file_path,
    <em>(STRINGREF)</em>content.
</p>
<p>Return value: none.</p>
<p>This callback is called when a source file is loaded to extract strings from.</p>

<h2 id="is_file_orphaned">is_file_orphaned</h2>
<p>Input parameters: <em>(STRING)</em>relative_file_path.</p>
<p>Return value: 1 if the file should be considered orphaned (and skipped), 0 otherwise.</p>
<p>This callback is called immediately after <code><a href="#after_load_source_file_for_processing">after_load_source_file_for_processing</a></code> callback, and is used to filter out unwanted files (such files are marked as orphaned in the database).</p>

<h2 id="can_process_source_file">can_process_source_file</h2>
<p>Input parameters:
    <em>(STRING)</em>relative_file_path,
    <em>(STRINGREF)</em>content.
</p>
<p>Return value: 1 if the file should be temporarily skipped, 0 otherwise.</p>
<p>This callback is called immediately after <code><a href="#is_file_orphaned">is_file_orphaned</a></code> callback, and is used to temporarily skip files from being processed (such files are not marked as orphaned in the database).</p>

<h2 id="can_extract">can_extract</h2>
<p>Input parameters:
    <em>(STRING)</em>relative_file_path,
    <em>reserved</em>,
    <em>(STRINGREF)</em>source_string,
    <em>(STRINGREF)</em>hint.
</p>
<p>Return value: 1 if the string should be extracted for translation, 0 otherwise.</p>
<p>This callback is called in source file parsing cycle for each found string, and allows to skip certain strings from translation. Since each source file is parsed twice during localziation cycle, this callback will also be called twice for each extracted string.</p>

<h2 id="before_update_database_from_po">before_update_database_from_po</h2>
<p>Input parameters: none.</p>
<p>Return value: none.</p>
<p>This callback is called after source files are scanned and parsed and before .po files are scanned and parsed.</p>

<h2 id="before_update_database_from_po_lang_file">before_update_database_from_po_lang_file</h2>
<p>Input parameters:
    <em>(STRING)</em>namespace,
    <em>(STRING)</em>relative_file_path,
    <em>(STRING)</em>language.
</p>
<p>Return value: none.</p>
<p>This callback is called before each .po file is read.</p>

<h2 id="can_process_po">can_process_po</h2>
<p>Input parameters:
    <em>(STRING)</em>relative_file_path,
    <em>(STRING)</em>language.
</p>
<p>Return value: 1 if the .po should be processed, 0 otherwise.</p>
<p>This callback is called immediately after <code><a href="#before_update_database_from_po_lang_file">before_update_database_from_po_lang_file</a></code> callback, and is used to skip .po files from being parsed.</p>

<h2 id="rewrite_parsed_po_item">rewrite_parsed_po_item</h2>
<p>Input parameters:
    <em>(STRING)</em>relative_file_path,
    <em>(STRING)</em>language,
    <em>(STRINGREF)</em>source_string,
    <em>(ARRAYREF)</em>flags,
    <em>(STRINGREF)</em>translation,
    <em>(STRINGREF)</em>comment,
    <em>(BOOLEANREF)</em>fuzzy,
    <em>(STRINGREF)</em>comment.
</p>
<p>This callback is called in .po file parsing cycle for each unit, and allows to rewrite certain .po fields before they are processed.</p>

<h2 id="after_update_database_from_po_lang_file">after_update_database_from_po_lang_file</h2>
<p>Input parameters:
    <em>(STRING)</em>namespace,
    <em>(STRING)</em>relative_file_path,
    <em>(STRING)</em>language.
</p>
<p>Return value: none.</p>
<p>This callback is called after each .po file is parsed and its translations have been imported.</p>

<h2 id="before_generate_po">before_generate_po</h2>
<p>Input parameters: none.</p>
<p>Return value: none.</p>
<p>This callback is called after .po files are scanned and parsed and before .po files are generated.</p>

<h2 id="can_generate_po">can_generate_po</h2>
<p>Input parameters:
    <em>(STRING)</em>relative_file_path,
    <em>(STRING)</em>language.
</p>
<p>Return value: 1 if the .po can be generated, 0 otherwise.</p>
<p>This callback is called before each .po file is about to be generated, and can be used to prohibit generating certain .po files.</p>

<h2 id="can_translate">can_translate</h2>
<p>[2]</p>

<h2 id="add_dev_comment">add_dev_comment</h2>
<p>[1]</p>

<h2 id="get_translation_pre">get_translation_pre</h2>
<p>[1]</p>

<h2 id="get_translation">get_translation</h2>
<p>[1]</p>

<h2 id="before_generate_localized_files">before_generate_localized_files</h2>
<p>[1]</p>

<h2 id="can_generate_localized_file">can_generate_localized_file</h2>
<p>[1]</p>

<h2 id="rewrite_relative_output_path">rewrite_relative_output_path</h2>
<p>[1]</p>

<h2 id="rewrite_absolute_output_path">rewrite_absolute_output_path</h2>
<p>[1]</p>

<h2 id="can_generate_localized_file_source">can_generate_localized_file_source</h2>
<p>[1]</p>

<h2 id="after_load_source_file_for_generating">after_load_source_file_for_generating</h2>
<p>[1]</p>

<h2 id="can_extract">can_extract</h2>
<p>[2]</p>
<p>Second call</p>

<h2 id="get_translation_pre">get_translation_pre</h2>
<p>Second call</p>

<h2 id="get_translation">get_translation</h2>
<p>Second call</p>

<h2 id="rewrite_translation">rewrite_translation</h2>
<p>[1]</p>

<h2 id="can_save_localized_file">can_save_localized_file</h2>
<p>[1]</p>

<h2 id="before_save_localized_file">before_save_localized_file</h2>
<p>[1]</p>

<h2 id="on_localized_file_change">on_localized_file_change</h2>
<p>[1]</p>

<h2 id="after_save_localized_file">after_save_localized_file</h2>
<p>[1]</p>

<h2 id="after_job">after_job</h2>
<p>Input parameters: none.</p>
<p>Return value: none.</p>
<p>This callback is called after the job finished execution; phase can be used to implement data cleanup or sending reports.</p>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-footer.php') ?>
