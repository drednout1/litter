<html>

<head>
    <title>Litter</title>
</head>

<body>
    <form method="post" enctype="multipart/form-data">
        <input type="file" name="userFile">
        <button type="submit">Submit</button>
    </form>

    <?
    $allowedExt = ['jpg', 'jpeg'];

    echo "<pre>";
    print_r($_FILES);
    echo " </pre> ";

    $filename = md5(time() . rand(1, 999999) . $_FILES['userFile']['name']);

    $ext = explode('.', $_FILES['userFile']['name']);
    $ext = $ext[count($ext) - 1];

    if (!in_array($ext, $allowedExt)) {
        exit();
    };

    $subdirName = $filename[0];
    $subdirName2 = $filename[1];

    if (!file_exists('uploads/' .
        $subdirName . '/' .
        $subdirName2)) (mkdir('./uploads/' .
        $subdirName . '/' .
        $subdirName2, 0777, true));

    move_uploaded_file(
        $_FILES['userFile']['tmp_name'],
        'uploads/' .
            $subdirName . '/' .
            $subdirName2 . '/' .
            $filename . '.' . $ext
    );
    ?>
    <!-- <a href="download.php?name=<?= $filename . '.' . $ext ?>">Link</a> -->

    <?
    // $files = scandir('uploads');
    // foreach ($files as $file) {
    //     if ($file != '.' && $file != '..') {
    //         echo '<a href=download.php?name=' . $file . '>Link</a>';
    //         echo '<br>';
    //     }
    // }

    foreach (readFileSubDir('uploads/') as $fileItem) {
        echo ($fileItem . "\n");
    }
    function readFileSubDir($scanDir)
    {
        $handle = opendir($scanDir);
        while (($fileItem = readdir($hand$fileItemle)) !== false) {
            if (($fileItem == '.') || ($fileItem == '..')) continue;
            $fileItem = rtrim($scanDir, '/') . '/' . $fileItem;
            if (is_dir($fileItem)) {
                foreach (readFileSubDir($fileItem) as $childFileItem) {
                    yield $childFileItem;
                }
            } else {
                yield '<a href=download.php?name=' . $fileItem . '>Link</a>';
            }
        }
        closedir($handle);
    }

    ?>

</body>

</html>