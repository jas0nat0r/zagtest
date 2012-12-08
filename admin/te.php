<?php
/**
 * Unicode Systems
 * @category   Uni
 * @package    Uni_Banner
 * @copyright  Copyright (c) 2010-2011 Unicode Systems. (http://www.unicodesystems.in)
 * @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 */
?>
<link rel="stylesheet" type="text/css" media="all" href="<?php echo $this->getSkinUrl('unibanner/css/global.css') ?>" />
<script type="text/javascript" src="<?php echo $this->getSkinUrl('unibanner/js/slides.min.jquery.js') ?>"></script>


<script>
    $(function(){
        // Set starting slide to 1
        var startSlide = 1;
        // Get slide number if it exists
        if (window.location.hash) {
            startSlide = window.location.hash.replace('#','');
        }
        // Initialize Slides
        $('#slides').slides({
            preload: true,
            preloadImage: 'img/loading.gif',
            generatePagination: true,
            play: 5000,
            pause: 2500,
            hoverPause: true,
            // Get the starting slide
            start: startSlide,
            animationComplete: function(current){
                // Set the slide number as a hash
                window.location.hash = '#' + current;
            }
        });
    });
</script>


<?php
$bannerGroupCode = $this->getBannerGroupCode();
$data = $this->getDataByGroupCode($bannerGroupCode);
$bannerGroupData = $data['group_data'];
$mediaDir = Mage::getBaseDir('media');
$bannerData = $data['banner_data'];
$bannerdest = (($bannerGroupData->getLinkTarget() == 0) ? '_blank' : '_self');
$bannerType = $bannerGroupData->getAnimationType();
$bannerWidth = $bannerGroupData->getBannerWidth();
$bannerHeight = $bannerGroupData->getBannerHeight();
$duration = Mage::getStoreConfig('banner/banner/banner_time_delay');
$autoplay = Mage::getStoreConfig('banner/banner/banner_autoplay');
$imageWidth = ((int) $bannerWidth);
$imageHeight = ((int) $bannerHeight);
$styleNWH = 'width: ' . ((int) $bannerWidth + 5) . 'px; height: ' . ((int) $bannerHeight + 5) . 'px;';
$styleWH = 'width: ' . $imageWidth . 'px; height: ' . $imageHeight . 'px;';
?>




<div id="slides">
    <div class="slides_container">
        <div class="slide">
            <h1>First Slide</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident.</p>
            <p><a href="#4" class="link">Check out the fourth slide &rsaquo;</a></p>
        </div>
        <div class="slide">
            <h1>Second Slide</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident.</p>
            <p><a href="#5" class="link">Check out the fifth slide &rsaquo;</a></p>
        </div>
        <div class="slide">
            <h1>Third Slide</h1>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident.</p>
            <p><a href="#1" class="link">Check out the first slide &rsaquo;</a></p>
        </div>					
    </div>


    <?php
    $i = 0;
    foreach ($bannerData as $banner):
        $i++;
        $disp = (($i == 1) ? 'inline' : 'none');
        $v = "imgnumber" . $i;
        $bannerPath = $banner->getFilename();
        $bannerType = $banner->getBannerType();
        $bannerTitle = $banner->getTitle();
        $bannerLink = $banner->getLink();
        $bannerContent = $banner->getBannerContent();
        if ($bannerType == 0) :
            $bannerImage = '';
            if ($bannerPath != '' && @file_exists($mediaDir . DS . $bannerPath)) :
                $bannerImage = $this->getResizeImage($bannerPath, $bannerGroupCode, $imageWidth, $imageHeight);
            endif;
            if ($bannerImage != '') :
                ?>
                
                <div class="slide">
                    <img src="<?php echo $bannerImage; ?>"  style="<?php echo $styleWH; ?>" alt="<?php echo $bannerTitle; ?>"/>
                </div>


            <?php endif;
        else: ?>            
            <div class="slide">
                    <img src="<?php echo $bannerImage; ?>"  style="<?php echo $styleWH; ?>" alt="<?php echo $bannerTitle; ?>"/>
            </div>
        <?php
        endif;
    endforeach;
    ?>
    <a href="#" class="prev"><img src="img/arrow-prev.png" width="24" height="43" alt="Arrow Prev"></a>
    <a href="#" class="next"><img src="img/arrow-next.png" width="24" height="43" alt="Arrow Next"></a>

</div>
</div>
