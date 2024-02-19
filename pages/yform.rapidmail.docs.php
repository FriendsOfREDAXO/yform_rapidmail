<?php

/**
 * @var rex_addon $this
 * @psalm-scope-this rex_addon
 */

$mdFiles = [];
$mdFiles['README'] = rex_addon::get('yform_rapidmail')->getPath('') . 'README.md';
foreach (glob(rex_addon::get('yform_rapidmail')->getPath('lib/rapidmail/docs') . '/*.md') ?: [] as $file) {
    $mdFiles[mb_substr(basename($file), 0, -3)] = $file;
}


$currenMDFile = rex_request('mdfile', 'string', 'README');
if (!array_key_exists($currenMDFile, $mdFiles)) {
    $currenMDFile = 'README';
}

$page = rex_be_controller::getPageObject('yform/rapidmail');

if (null !== $page) {
    foreach ($mdFiles as $key => $mdFile) {
        if($key === 'README') {
            continue;
        }
        $keyWithoudPrio = mb_substr($key, 3);
        $currenMDFileWithoudPrio = mb_substr($currenMDFile, 3);
        $page->addSubpage(
            (new rex_be_page($key, rex_i18n::msg('yform_rapidmail_' . $keyWithoudPrio)))
            ->setSubPath($mdFile)
            ->setHref('index.php?page=yform/rapidmail/docs&mdfile=' . $key)
            ->setIsActive($key == $currenMDFile),
        );
    }
}

echo rex_view::title($this->i18n('yform_rapidmail'));

[$Toc, $Content] = rex_markdown::factory()->parseWithToc(rex_file::require($mdFiles[$currenMDFile]), 2, 3, [
    rex_markdown::SOFT_LINE_BREAKS => false,
    rex_markdown::HIGHLIGHT_PHP => true,
]);

$fragment = new rex_fragment();
$fragment->setVar('content', $Content, false);
$fragment->setVar('toc', $Toc, false);
$content = $fragment->parse('core/page/docs.php');

$fragment = new rex_fragment();
$fragment->setVar('title', rex_i18n::msg('package_help') . ' YForm Rapidmail', false);
$fragment->setVar('body', $content, false);
echo $fragment->parse('core/page/section.php');
