<?php

    $aImages = array(
        array(
            'src' => 'http://lorempixel.com/100/100',
            'width' => 100,
            'height' => 100
        ),
        array(
            'src' => 'http://lorempixel.com/500/300',
            'width' => 500,
            'height' => 300
        ),
        array(
            'src' => 'http://lorempixel.com/300/400',
            'width' => 300,
            'height' => 400
        ),
        array(
            'src' => 'http://lorempixel.com/600/200',
            'width' => 600,
            'height' => 200
        ),
        array(
            'src' => 'http://lorempixel.com/500/500',
            'width' => 500,
            'height' => 500
        ),
        array(
            'src' => 'http://lorempixel.com/300/400',
            'width' => 300,
            'height' => 400
        ),
        array(
            'src' => 'http://lorempixel.com/550/500',
            'width' => 550,
            'height' => 500
        ),
    );

    $iBlockWidth = 450;
    $iMaxPhotoInPost = 5;
    $iCount = count($aImages);
    $aResultImages = array();
    $iLastPhotoLayer = 0;

    uasort($aImages, function ($aFirst, $aSecond) {
        return $aSecond['width'] - $aFirst['width'];
    });

    $aImagesSlice = array_slice($aImages, 0, $iMaxPhotoInPost);
    $iCountImagesSlice = count($aImagesSlice);

    /**
     * 3-5 photos
     */
    if (($iCountImagesSlice === $iMaxPhotoInPost) || ($iCountImagesSlice < $iMaxPhotoInPost && ($iCountImagesSlice > 2)))
    {
        if ($aImagesSlice[0]['width'] > $aImagesSlice[1]['width'])
        {
            $aResultImages[] = array($aImagesSlice[0]);
            $iStartIndexNextRow = 1;
        }
        else
        {
            $aResultImages[] = array($aImagesSlice[0], $aImagesSlice[1]);
            $iStartIndexNextRow = 2;
        }

        $aResultImages[] = array_slice($aImagesSlice, $iStartIndexNextRow);
        $iLastPhotoLayer = $iCount - $iCountImagesSlice;

        if ($iLastPhotoLayer > 0)
        {
            end($aResultImages[1]);
            $referenceToLastElement = &$aResultImages[1][key($aResultImages[1])];
            $referenceToLastElement['last'] = $iLastPhotoLayer;
        }
    }

    if ($iCountImagesSlice === 2)
    {
        $aResultImages[] = array($aImagesSlice[0]);
        $aResultImages[] = array($aImagesSlice[1]);
    }

    if ($iCountImagesSlice === 1)
    {
        $aResultImages[] = array($aImagesSlice[0]);
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
    <link href="style.css" type="text/css" rel="stylesheet">
</head>
<body>
    <div class="imageGrid">
        <?php
            foreach ($aResultImages as $iRow => $aImagesItem)
            {
                echo '<div class="imageGrid_row">';
                    foreach ($aImagesItem as $aImage)
                    {
                        echo '<a class="imageGrid_item"> <img src="' . $aImage['src'] . '"/> </a>';
                    }
                echo '</div>';
            }
        ?>
    </div>
</body>
</html>

<!--<div class="imageGrid_row">-->
<!--    <a class="imageGrid_item">-->
<!--        <img src="http://lorempixel.com/100/100"/>-->
<!--    </a>-->
<!---->
<!--    <a class="imageGrid_item">-->
<!--        <img src="http://lorempixel.com/500/300"/>-->
<!--    </a>-->
<!--</div>-->
<!---->
<!---->
<!--<div class="imageGrid_row">-->
<!--    <a class="imageGrid_item">-->
<!--        <img src="http://lorempixel.com/600/200"/>-->
<!--    </a>-->
<!---->
<!--    <a class="imageGrid_item">-->
<!--        <img src="http://lorempixel.com/500/500"/>-->
<!--    </a>-->
<!--</div>-->