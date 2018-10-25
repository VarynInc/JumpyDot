<?php global $viewpoint; ?>
<!DOCTYPE html>
<!--[if lt IE 7 ]><html style="margin-top: 0 !important" class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html style="margin-top: 0 !important" class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html style="margin-top: 0 !important" class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html style="margin-top: 0 !important" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
    <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
    <title><?php wp_title('-');?></title>
    <link rel="shortcut icon" href="/images/JumpyDotBallIcon32x32.png"/>
    <link rel="image_src" href="/images/JumpyDotLogo500x175.png" />
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
    <!-- Mobile Specific Metas
      ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
     <!--[if IE]>
        <link href="<?php echo get_stylesheet_directory_uri() . '/css/ie.css';?>" rel='stylesheet' type='text/css'>
    <![endif]-->
    <!--[if IE 7]>
        <link href="<?php echo get_stylesheet_directory_uri() . '/css/ie7.css';?>" rel='stylesheet' type='text/css'>
    <![endif]-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,400,300,600,700,800' rel='stylesheet' type='text/css'>

    <?php wp_head();
    if(isset($viewpoint['integration_header'])) echo $viewpoint['integration_header'] . PHP_EOL; ?>
</head>
<body <?php body_class();?>>
<div class="top-bar"></div>

        <?php if(is_front_page()) { ?>
    <div id="intro">
        <div class="bg1"></div>
        <?php } else { ?>
    <div id="introblog">
        <div class="bgblog"></div>
        <?php } ?>

        <nav>
            <?php show_top_menu(1); ?>
        </nav>
            <?php if(is_front_page()) { ?>
        <div class="title">
        
            <h1 style="display: none;"><?php echo $viewpoint['topheader_text'];?></h1>
            <div class="toplogoimg"><img src="/images/JumpyDotLogo500x176.png" alt="JumpyDot Games" title="JumpyDot Games" border="0" width="500" height="198" /></div>
            <h1 class="smallh1"><?php echo $viewpoint['topheader_smalltext'];?></h1>
            <h1 class="smallerh1"><?php echo $viewpoint['topheader_smallertext'];?></h1>
            
            <div class="social">
                <ul>
                    <?php if($viewpoint['facebook_url'] != '') { ?><li><a href="<?php echo $viewpoint['facebook_url'];?>"><div class="facebook sprite"></div></a></li><?php } ?>
                    <?php if($viewpoint['twitter_username'] != '') { ?><li><a href="http://twitter.com/<?php echo $viewpoint['twitter_username'];?>"><div class="twitter sprite"></div></a></li><?php } ?>
                    <?php if($viewpoint['gplus_url'] != '') { ?><li><a href="<?php echo $viewpoint['gplus_url'];?>"><div class="gplus sprite"></div></a></li><?php } ?>
                    <?php if($viewpoint['dribble_url'] != '') { ?><li><a href="<?php echo $viewpoint['dribble_url'];?>"><div class="dribbble sprite"></div></a></li><?php } ?>
                    <?php if($viewpoint['linkedin_url'] != '') { ?><li><a href="<?php echo $viewpoint['linkedin_url'];?>"><div class="linkedin sprite"></div></a></li><?php } ?>
                    <li><a href="http://www.youtube.com/channel/UC45mWPk8hgiOuEu_b9LFggA"><div class="youtube sprite"></div></a></li>
                    <li><a href="http://www.pinterest.com/jumpydot/jumpydot-games/"><div class="pinterest sprite"></div></a></li>
                </ul>
            </div> <!-- end social -->
            
        </div> <!-- end title -->
            <?php } ?>
    </div> <!-- end intro -->
    
    
    <div class="dotted-bar"></div>