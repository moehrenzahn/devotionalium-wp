#!/usr/bin/env php
<?php
$codeSrcDir = __DIR__ . '/../';
$svnDir = __DIR__ . '/../../devotionalium-wp-svn';
$trunkDir = $svnDir . '/trunk';

$readme = file_get_contents($codeSrcDir . '/readme.txt');
$matches = [];
if (preg_match_all('/Stable tag: (.*?)' . PHP_EOL . '/', $readme, $matches) === 1) {
    $version = $matches[1][0];
} else {
    print_r($matches);
    echo "Error: Could not read version from readme.txt" . PHP_EOL;
    exit(1);
}
if (file_exists($svnDir . "/tags/$version")) {
    echo "Error: Version '$version' already exists in SVN" . PHP_EOL;
    return 1;
}

shell_exec("rm -rf $trunkDir");
mkdir($trunkDir);
shell_exec("cp -r $codeSrcDir $trunkDir");
foreach (['.*', 'makefile', 'build', 'assets'] as $excludeFile) {
    shell_exec("rm -rf $trunkDir/$excludeFile");
}

$returnVar = 0;
// Remove all deleted files from svn
system("cd $svnDir && svn status | grep '^!' | awk '{print $2}' | xargs svn delete");
system("cd $svnDir && svn ci -m 'Update code to version $version'", $returnVar);
if ($returnVar > 0) {
    echo "Error: Could not push trunk to WordPress SVN." . PHP_EOL;
    return 1;
}
system("cd $svnDir && svn cp trunk tags/$version", $returnVar);
if ($returnVar > 0) {
    echo "Error: Could not create tag '$version'." . PHP_EOL;
    return 1;
}
system("cd $svnDir && svn ci -m 'Release version $version'", $returnVar);
if ($returnVar > 0) {
    echo "Error: Could not push new tag '$version' to WordPress SVN." . PHP_EOL;
    return 1;
}

return 0;
