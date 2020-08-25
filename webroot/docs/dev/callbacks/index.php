<?php
    $subpage = 'callbacks';
    $title = 'Callbacks';
    include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-header.php');

    include($_SERVER['DOCUMENT_ROOT'] . '/../inc/version-selector.php');
?>

<h1>Callbacks</h1>

<p>Callbacks are the way plugins communicate with Serge engine and modify or extend the behavior of its localization cycle. Each plugin can listen to any number of callbacks. Some plugins have a predefined set of callbacks they listen to; others can be configured via configuration files. Documentation on each callback plugin shipped with Serge provides information on which callback phases are optional, and which are always on.</p>

<p>In the list below, callbacks are sorted by their first occurrence in the localization cycle.</p>

<h2 id="before_job">before_job</h2>
<p>Input parameters: <em>none</em>.</p>
<p>Return value: <em>none</em>.</p>
<p>This callback is called after the job is initialized and before the actual processing starts; phase can be used to implement some data initialization.</p>

<h2 id="before_update_database_from_source_files">before_update_database_from_source_files</h2>
<p>Input parameters: <em>none</em>.</p>
<p>Return value: <em>none</em>.</p>
<p>This callback is called immediately after <code><a href="#before_job">before_job</a></code> callback, before source files are scanned and parsed, and can be used to implement second phase of data initialization.</p>

<h2 id="rewrite_path">rewrite_path</h2>
<p>Input parameters:
    <em>(STRING)</em><code>relative_file_path</code>.
</p>
<p>Return value: new value of <em>(STRING)</em><code>relative_file_path</code>.</p>
<p>When source files are scanned, file path (relative to the root directory, see <code>job &rarr; source_dir</code> parameter) for files that match the file masks defined in a job is passed through <code>rewrite_path</code> callbacks. Each callback should either return an unmodified file path, or a rewritten one. Use this phase to change file names and paths, for example, remove language-specific filename suffixes. The final relative file path will be used for the corresponding translation files, so rewriting the path affects the resulting translation folder/file structure.</p>

<h2 id="after_load_file">after_load_file</h2>
<p>Input parameters:
    <em>(STRING)</em><code>absolute_file_path</code>,
    <em>(STRING)</em><code>source_language</code>,
    <em>(STRINGREF)</em><code>content</code>.
</p>
<p>Return value: <em>none</em>.</p>
<p>This callback is called every time a source file is loaded, which happens twice during localization cycle: when all source files are loaded to extract strings from, and when they are loaded as templates to generate localized files.</p>

<h2 id="after_load_source_file_for_processing">after_load_source_file_for_processing</h2>
<p>Input parameters:
    <em>(STRING)</em><code>relative_file_path</code>,
    <em>(STRINGREF)</em><code>content</code>.
</p>
<p>Return value: <em>none</em>.</p>
<p>This callback is called when a source file is loaded into memory. This step can be used to unconditionally preprocess all the matching resource files on the fly, before the content hash of the file is calculated. See also the <code><a href="#before_parsing_source_file">before_parsing_source_file</a></code> callback below.</p>

<h2 id="is_file_orphaned">is_file_orphaned</h2>
<p>Input parameters: <em>(STRING)</em>relative_file_path.</p>
<p>Return value: <code>1</code> if the file should be considered orphaned (and skipped), <code>0</code> otherwise.</p>
<p>This callback is called immediately after <code><a href="#after_load_source_file_for_processing">after_load_source_file_for_processing</a></code> callback, and is used to filter out unwanted files (such files are marked as orphaned in the database).</p>

<h2 id="can_process_source_file">can_process_source_file</h2>
<p>Input parameters:
    <em>(STRING)</em><code>relative_file_path</code>,
    <em>(STRINGREF)</em><code>content</code>.
</p>
<p>Return value: <code>1</code> if the file should be temporarily skipped, <code>0</code> otherwise.</p>
<p>This callback is called immediately after <code><a href="#is_file_orphaned">is_file_orphaned</a></code> callback, and is used to temporarily skip files from being processed (such files are not marked as orphaned in the database).</p>

<h2 id="before_parsing_source_file">before_parsing_source_file</h2>
<p>Input parameters:
    <em>(STRING)</em><code>relative_file_path</code>,
    <em>(STRINGREF)</em><code>content</code>.
</p>
<p>Return value: <em>none</em>.</p>

<p>This callback is called after the file content was loaded, preprocessed, its hash value has been calculated, compared to a previous one stored in the database, and it was determined that the file content has been changed. This means that this callback (and content parsing that immediately follows it) will run only for files that have been modified since last run (or when Serge is running in a forced mode, which tells it to parse all the files unconditionally).

<h2 id="rewrite_source">rewrite_source</h2>
<p>Input parameters:
    <em>(STRING)</em><code>relative_file_path</code>,
    <em>(STRING, OPTIONAL)</em><code>language</code>,
    <em>(STRINGREF)</em><code>source_string</code>,
    <em>(STRINGREF)</em><code>hint</code>.
</p>
<p>Return value: <em>none</em>.</p>
<p>This callback is used to rewrite source string before it is passed through translation pipeline. It can be used to normalize string input, adjust punctuation, etc. Note that this rewriting happens before the <code>can_extract</code> phase, so it is run for all strings,
even for ones that may later be discarded.</p>

<h2 id="can_extract">can_extract</h2>
<p>Input parameters:
    <em>(STRING)</em><code>relative_file_path</code>,
    <em>(STRING, OPTIONAL)</em><code>language</code>,
    <em>(STRINGREF)</em><code>source_string</code>,
    <em>(STRINGREF)</em><code>hint</code>,
    <em>(STRING)</em><code>context</code>,
    <em>(STRING)</em><code>key</code>.
</p>
<p>Return value: <code>1</code> if the string should be extracted for translation, <code>0</code> otherwise.</p>
<p>This callback is called in source file parsing cycle for each found string, and allows to skip certain strings from translation. Since each source file is parsed twice during localization cycle, this callback will also be called twice for each extracted string. During the first pass, the <code>language</code> parameter is not set (since Serge is dealing with the source file); During the second pass, language is set to the target language this file is being generated for.</p>

<h2 id="before_update_database_from_ts_file">before_update_database_from_ts_file</h2>

<p>DEPRECATED. Use <code><a href="#before_update_database_from_ts_files">before_update_database_from_ts_files</a></code>.</p>

<h2 id="before_update_database_from_ts_files">before_update_database_from_ts_files</h2>
<p>Input parameters: <em>none</em>.</p>
<p>Return value: <em>none</em>.</p>
<p>This callback is called after source files are scanned and parsed and before translation files are scanned and parsed.</p>

<h2 id="rewrite_relative_ts_file_path">rewrite_relative_ts_file_path</h2>
<p>Input parameters:
    <em>(STRING)</em><code>relative_file_path</code>,
    <em>(STRING)</em><code>language</code>.
</p>
<p>Return value: new value of <em>(STRING)</em><code>relative_file_path</code>, or <code>undef</code> if no rewrite is needed.</p>
<p>This callback is called before each translation file is read.</p>

<h2 id="rewrite_absolute_ts_file_path">rewrite_absolute_ts_file_path</h2>
<p>Input parameters:
    <em>(STRING)</em><code>absolute_file_path</code>,
    <em>(STRING)</em><code>language</code>.
</p>
<p>Return value: new value of <em>(STRING)</em><code>absolute_file_path</code>, or <code>undef</code> if no rewrite is needed.</p>
<p>This callback is called after <code>rewrite_relative_ts_file_path</code>, once the absolute path has been resolved.</p>

<h2 id="before_update_database_from_ts_lang_file">before_update_database_from_ts_lang_file</h2>
<p>Input parameters:
    <em>(STRING)</em><code>namespace</code>,
    <em>(STRING)</em><code>relative_file_path</code>,
    <em>(STRING)</em><code>language</code>.
</p>
<p>Return value: <em>none</em>.</p>
<p>This callback is called after <code>rewrite_absolute_ts_file_path</code>, once the target file has been checked for presence.</p>

<h2 id="can_process_ts_file">can_process_ts_file</h2>
<p>Input parameters:
    <em>(STRING)</em><code>relative_file_path</code>,
    <em>(STRING)</em><code>language</code>.
</p>
<p>Return value: <code>1</code> if the translation file should be processed, <code>0</code> otherwise.</p>
<p>This callback is called immediately after <code><a href="#before_update_database_from_ts_lang_file">before_update_database_from_ts_lang_file</a></code> callback, and is used to skip translation files from being parsed.</p>

<h2 id="before_deserialize_ts_file">before_deserialize_ts_file</h2>
<p>Input parameters:
    <em>(STRING)</em><code>relative_file_path</code>,
    <em>(STRINGREF)</em><code>content</code>.
</p>
<p>Return value: <em>none</em>.</p>
<p>This callback is called once the translation interchange file is read into memory. The callback allows to preprocess the file's content before parsing.</p>

<h2 id="rewrite_parsed_ts_file_item">rewrite_parsed_ts_file_item</h2>
<p>Input parameters:
    <em>(STRING)</em><code>relative_file_path</code>,
    <em>(STRING)</em><code>language</code>,
    <em>(STRINGREF)</em><code>source_string</code>,
    <em>(ARRAYREF)</em><code>flags</code>,
    <em>(STRINGREF)</em><code>translation</code>,
    <em>(STRINGREF)</em><code>comment</code>,
    <em>(BOOLEANREF)</em><code>fuzzy</code>,
    <em>(STRINGREF)</em><code>comment</code>.
</p>
<p>This callback is called in translation file parsing cycle for each unit, and allows to rewrite certain unit properties before it is processed.</p>

<h2 id="after_update_database_from_ts_lang_file">after_update_database_from_ts_lang_file</h2>
<p>Input parameters:
    <em>(STRING)</em><code>namespace</code>,
    <em>(STRING)</em><code>relative_file_path</code>,
    <em>(STRING)</em><code>language</code>.
</p>
<p>Return value: <em>none</em>.</p>
<p>This callback is called after each translation file is parsed and its translations have been imported.</p>

<h2 id="before_generate_ts_files">before_generate_ts_files</h2>
<p>Input parameters: <em>none</em>.</p>
<p>Return value: <em>none</em>.</p>
<p>This callback is called after translation files are scanned and parsed and before translation files are generated.</p>

<h2 id="can_generate_ts_file">can_generate_ts_file</h2>
<p>Input parameters:
    <em>(STRING)</em><code>relative_file_path</code>,
    <em>(STRING)</em><code>language</code>.
</p>
<p>Return value: <code>1</code> if the translation file can be generated, <code>0</code> otherwise.</p>
<p>This callback is called before each translation file is about to be generated, and can be used to prohibit generating certain translation files.</p>

<h2 id="rewrite_relative_ts_file_path">rewrite_relative_ts_file_path</h2>
<p>This is second time <code><a href="#rewrite_relative_ts_file_path">rewrite_relative_ts_file_path</a></code> callback is called (before generating the translation interchange file).</p>

<h2 id="rewrite_absolute_ts_file_path">rewrite_absolute_ts_file_path</h2>
<p>This is second time <code><a href="#rewrite_absolute_ts_file_path">rewrite_absolute_ts_file_path</a></code> callback is called (before generating the translation interchange file).</p>

<h2 id="can_translate">can_translate</h2>
<p>Input parameters:
    <em>(STRING)</em><code>relative_file_path</code>,
    <em>(STRING)</em><code>language</code>,
    <em>(STRINGREF)</em><code>source_string</code>,
    <em>(STRINGREF)</em><code>hint</code>.
</p>
<p>Return value: <code>1</code> if the string can be translated (and thus, published in the translation file), <code>0</code> otherwise.</p>
<p>This callback is called for each string about to be added to translation file, and can be used to prohibit exposing  certain strings for translation. The same callback is called when the localized files are generated.</p>

<h2 id="add_dev_comment">add_dev_comment</h2>
<p>DEPRECATED. Use <code><a href="#add_hint">add_hint</a></code>.</p>

<h2 id="add_hint">add_hint</h2>
<p>Input parameters:
    <em>(STRING)</em><code>source_string</code>,
    <em>(STRING)</em><code>context</code>,
    <em>(STRING)</em><code>namespace</code>,
    <em>(STRING)</em><code>relative_file_path</code>,
    <em>(STRING)</em><code>key</code>,
    <em>(STRING)</em><code>language</code>,
    <em>(ARRAYREF)</em><code>hint_lines</code>.
</p>
<p>Return value: <em>none</em>.</p>
<p>This callback is called for units that are about to be added to the translation file, and can change the <code>hint_lines</code> array, usually to append extra comments.</p>

<h2 id="after_serialize_ts_file">after_serialize_ts_file</h2>
<p>Input parameters:
    <em>(STRING)</em><code>relative_file_path</code>,
    <em>(STRINGREF)</em><code>content</code>.
</p>
<p>Return value: <em>none</em>.</p>
<p>This callback is called once the translation interchange file content is generated in memory. The callback allows to post-process the file's content before saving.</p>

<h2 id="get_translation_pre">get_translation_pre</h2>
<p>Input parameters:
    <em>(STRING)</em><code>source_string</code>,
    <em>(STRING)</em><code>context</code>,
    <em>(STRING)</em><code>namespace</code>,
    <em>(STRING)</em><code>relative_file_path</code>,
    <em>(STRING)</em><code>language</code>,
    <em>(BOOLEAN)</em><code>disallow_similar_lang</code>,
    <em>(INTEGER)</em><code>item_id</code>,
    <em>(STRING)</em><code>key</code>.
</p>
<p>Return values (array):
    <em>(STRING)</em><code>translation</code>,
    <em>(BOOLEAN)</em><code>fuzzy</code>,
    <em>(STRING)</em><code>comment</code>,
    <em>(BOOLEAN)</em><code>need_save</code>.
</p>
<p>This callback is called whenever Serge wants to get a translation for the string, before it tries looking up the translation in the database. If a plugin can't provide a translation, it should return both <code>translation</code> and <code>comment</code> member of the array as undefined values. If the comment is set but translation isn't, it means a valid 'empty' translation.</p>

<p>Plugin needs to provide true value for <code>need_save</code> flag for translation to be saved to the database. By default the translation won't be saved, and this makes sense when providing test auto-generated translations, which can always be generated on demand and which don't need to be stored in the database.</p>

<p>This callback is requested twice per localization cycle for each string: when generating translation files, and when generating localized files.</p>

<h2 id="get_translation">get_translation</h2>
<p>This callback is identical to <code><a href="#get_translation_pre">get_translation_pre</a></code> callback, but is run after Serge has tried all its internal methods to get a translation, and failed. In other words, this callback is called to only for strings with missing translations.</p>

<p>This callback is requested twice per localization cycle for each string: when generating translation files, and when generating localized files. However, if the callback provides a translation at translation file generation step and this translation is saved into the database, callback won't be called again for the same string when localized files are being generated, since the translation will be already in the database.</p>

<h2 id="before_generate_localized_files">before_generate_localized_files</h2>
<p>Input parameters: <em>none</em>.</p>
<p>Return value: <em>none</em>.</p>
<p>This callback is called after the translation files have been generated and before generation of localized files has been started.</p>

<h2 id="can_generate_localized_file">can_generate_localized_file</h2>
<p>Input parameters:
    <em>(STRING)</em><code>relative_file_path</code>,
    <em>(STRING)</em><code>language</code>.
</p>
<p>Return value: <code>1</code> if the localized file can be generated, <code>0</code> otherwise.</p>
<p>This callback is called before generating each localized file, and can be used to skip certain files. Note that it is called before the file was read from disk. If you need to analyze file content, use >This callback is similar to <code><a href="#can_generate_localized_file_source">can_generate_localized_file_source</a></code> callback instead.</p>

<h2 id="rewrite_relative_output_file_path">rewrite_relative_output_file_path</h2>
<p>Input parameters:
    <em>(STRING)</em><code>relative_file_path</code>.
</p>
<p>Return value: new value of <em>(STRING)</em><code>relative_file_path</code>, or <code>undef</code> if no rewrite is needed.</p>
<p>This callback is called before the localized file is about to be generated and is used to rewrite relative path (in other words, change output file location) before it expanded into an absolute path.</p>

<h2 id="rewrite_absolute_output_file_path">rewrite_absolute_output_file_path</h2>
<p>Input parameters:
    <em>(STRING)</em><code>absolute_file_path</code>.
</p>
<p>Return value: new value of <em>(STRING)</em><code>absolute_file_path</code>, or <code>undef</code> if no rewrite is needed.</p>
<p>This callback is called to rewrite already expanded output file path.</p>

<h2 id="can_generate_localized_file_source">can_generate_localized_file_source</h2>
<p>Input parameters:
    <em>(STRING)</em><code>relative_file_path</code>,
    <em>(STRING)</em><code>language</code>,
    <em>(STRINGREF)</em><code>content</code>.
</p>
<p>Return value: <code>1</code> if the localized file can be generated, <code>0</code> otherwise.</p>
<p>This callback is similar to <code><a href="#can_generate_localized_file">can_generate_localized_file</a></code> callback, but it is called after the file has been read from disk, so that plugin can analyze source file contents to decide whether to skip the file or not.</p>

<h2 id="after_load_source_file_for_generating">after_load_source_file_for_generating</h2>
<p>Input parameters:
    <em>(STRING)</em><code>relative_file_path</code>,
    <em>(STRING)</em><code>language</code>,
    <em>(STRINGREF)</em><code>content</code>.
</p>
<p>Return value: <em>none</em>.</p>
<p>This callback is called immediately after <code><a href="#can_generate_localized_file_source">can_generate_localized_file_source</a></code> callback for each file that was allowed to be generated.</p>

<h2 id="rewrite_source_2">rewrite_source</h2>
<p>This is second time <code><a href="#rewrite_source">rewrite_source</a></code> callback is called (when parsing source file to generate its localized copy).</p>

<h2 id="can_extract_2">can_extract</h2>
<p>This is second time <code><a href="#can_extract">can_extract</a></code> callback is called (when parsing source file to generate its localized copy).</p>

<h2 id="can_translate_2">can_translate</h2>
<p>This is second time <code><a href="#can_translate">can_translate</a></code> callback is called (when parsing source file to generate its localized copy).</p>

<h2 id="get_translation_pre">get_translation_pre</h2>
<p>This is second time <code><a href="#get_translation_pre">get_translation_pre</a></code> callback is called (when parsing source file to generate its localized copy).</p>

<h2 id="get_translation">get_translation</h2>
<p>This is second time <code><a href="#get_translation">get_translation</a></code> callback is called (when parsing source file to generate its localized copy).</p>

<h2 id="rewrite_translation">rewrite_translation</h2>
<p>Input parameters:
    <em>(STRING)</em><code>relative_file_path</code>,
    <em>(STRING)</em><code>language</code>,
    <em>(STRINGREF)</em><code>translation</code>.
</p>
<p>Return value: <em>none</em>.</p>
<p>This callback is used to rewrite translation before it is placed into a localized file. Note that this transformation is only applied to the translation in the localized file, and not in the translation file or database. This approach can be used to produce different set of localized files from the same set of translations. For example, one can statically rewrite product names, URLs or prices on the fly depending on language or some external parameters.</p>

<h2 id="log_translation">log_translation</h2>
<p>Input parameters:
    <em>(STRING)</em><code>source_string</code>,
    <em>(STRING)</em><code>context</code>,
    <em>(STRING)</em><code>hint</code>,
    <em>(ARRAYREF)</em><code>flags</code>,
    <em>(STRING)</em><code>language</code>,
    <em>(STRING)</em><code>key</code>,
    <em>(STRING)</em><code>translation</code>,
    <em>(STRING)</em><code>namespace</code>,
    <em>(STRING)</em><code>relative_file_path</code>.
</p>
<p>Return value: <em>none</em>.</p>
<p>This callback is called after the translation is determined for the source string, and can be used to save translations into a database, or save them in memory for some plugin-specific needs.</p>

<h2 id="can_save_localized_file">can_save_localized_file</h2>
<p>Input parameters:
    <em>(STRING)</em><code>relative_file_path</code>,
    <em>(STRING)</em><code>language</code>,
    <em>(STRINGREF)</em><code>content</code>.
</p>
<p>Return value: <code>1</code> if the localized file can be saved to file, <code>0</code> otherwise.</p>
<p>This callback is called after the localized file content has been fully generated and is about to be saved to disk, and can be used to prevent saving certain files.</p>

<h2 id="before_save_localized_file">before_save_localized_file</h2>
<p>Input parameters:
    <em>(STRING)</em><code>relative_file_path</code>,
    <em>(STRING)</em><code>language</code>,
    <em>(STRINGREF)</em><code>content</code>.
</p>
<p>Return value: <em>none</em>.</p>
<p>This callback is called immediately after <code><a href="#can_save_localized_file">can_save_localized_file</a></code> callback for each file that was allowed to be saved to disk.</p>

<h2 id="on_localized_file_change">on_localized_file_change</h2>
<p>Input parameters:
    <em>(STRING)</em><code>relative_file_path</code>,
    <em>(STRING)</em><code>language</code>,
    <em>(STRINGREF)</em><code>content</code>.
</p>
<p>Return value: <em>none</em>.</p>
<p>This callback is similar to <code><a href="#before_save_localized_file">before_save_localized_file</a></code> callback, but it is called after the localized file was saved to disk, and only for files that were changed.</p>

<h2 id="after_save_localized_file">after_save_localized_file</h2>
<p>Input parameters:
    <em>(STRING)</em><code>relative_file_path</code>,
    <em>(STRING)</em><code>language</code>,
    <em>(STRINGREF)</em><code>content</code>.
</p>
<p>Return value: <em>none</em>.</p>
<p>This callback is similar to <code><a href="#before_save_localized_file">before_save_localized_file</a></code> callback, but it is called after the localized file was saved to disk, even if the generated file didn't change from its previous version.</p>

<h2 id="after_job">after_job</h2>
<p>Input parameters: <em>none</em>.</p>
<p>Return value: <em>none</em>.</p>
<p>This callback is called after the job finished execution; phase can be used to implement data cleanup or sending reports.</p>

<?php include($_SERVER['DOCUMENT_ROOT'] . '/../inc/documentation-footer.php') ?>
