<?php
/**
 * @template	Template by Jan Pavelka ( http://www.phoca.cz/ )
 * @copyright	Template - Copyright (C) 2011 Jan Pavelka
 * @copyright	Joomla! CMS - Copyright (C) 2005 - 2011 Open Source Matters. All rights reserved.
 * License GNU General Public License version 2 or later; see LICENSE.txt, see LICENSE.php
 */
defined('_JEXEC') or die;

$app 				= JFactory::getApplication();
$doc 				= JFactory::getDocument();
$this->language 	= $doc->language;
$this->direction 	= $doc->direction;
$siteName 			= $app->getCfg('sitename');
$paramsT			= $app->getTemplate(true)->params;


//$pSlideshow				= $this->params->get('display_slideshow', 0);
$logo       			= $this->params->get('display_logo', 1);
//$pSlideshowContent		= $this->params->get('slideshow', '');
$siteTitle				= $paramsT->get('sitetitle', '');
//$siteDesc				= $paramsT->get('sitedescription', '');
$logoContent   			= $this->params->get('logo', '');
if($logoContent == '') {
	$logoContent = 'templates/phoca_tre/images/logo.png';
}

$dR	= ($this->countModules('position-3') or $this->countModules('position-6') or $this->countModules('position-8'));
$dL	= ($this->countModules('position-4') or $this->countModules('position-7') or $this->countModules('position-5'));

if (!$dL && !$dR)	{$c = 12;}
if ($dL || $dR)		{$c = 9;}
if ($dL && $dR)		{$c = 6;}


$b = $b2 = $b9 = $b10 = $b11 = 0;
if ($this->countModules('position-9')) 	{$b9 	= 1;}
if ($this->countModules('position-10'))	{$b10 	= 1;}
if ($this->countModules('position-11'))	{$b11 	= 1;}
$b2 = $b9 + $b10 + $b11;
if ($b2 > 0) {$b = 12/($b2);}
$b9 	= $b9 * $b;
$b10	= $b10 * $b;
$b11	= $b11 * $b;


$d = $d2 = $d19 = $d20 = $d21 = 0;
if ($this->countModules('position-19')) {$d19 	= 1;}
if ($this->countModules('position-20'))	{$d20 	= 1;}
if ($this->countModules('position-21'))	{$d21 	= 1;}
$d2 = $d19 + $d20 + $d21;

if ($c == 9 && $d2 == 2) {
	if ($d19 == 1) 	{$d19 = 4;} else {$d19 = 1;}
	if ($d20 == 1) 	{$d20 = 4;} else {$d20 = 1;}
	if ($d21 == 1) 	{$d21 = 4;} else {$d21 = 1;}
} else {
	if ($d2 > 0) {$d = $c/($d2);}
	$d19 	= $d19 * $d;
	$d20	= $d20 * $d;
	$d21	= $d21 * $d;
}


//echo "$d19 - $d20 - $d21";

JHtml::_('bootstrap.framework');
JHtmlBootstrap::loadCss(true, $this->direction);

?><!DOCTYPE html>
<html lang="<?php echo $this->language; ?>">
<head>
<jdoc:include type="head" />
<link href="<?php echo $this->baseurl ?>/templates/phoca_tre/css/template.css"  rel="stylesheet" media="screen">
<link href="<?php echo $this->baseurl ?>/templates/phoca_tre/css/menu.css"  rel="stylesheet" media="screen">
</head>
<body id="phoca-site">

<div class="navbar navbar-fixed-top">
	<div class="navbar-inner phoca-top">
		<div class="container">
			
			 <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			</a>
			
			<a class="brand" href="<?php echo $this->baseurl ?>">
			<?php if ($logo == 1) { ?>
				<img src="<?php echo $this->baseurl ?>/<?php echo htmlspecialchars($logoContent); ?>"  alt="<?php echo htmlspecialchars($siteTitle);?>" />
			<?php }
			if ($logo == 0 ) {
				if (htmlspecialchars($siteTitle != '')) {
					echo htmlspecialchars($siteTitle);
				} else {
					echo htmlspecialchars($app->getCfg('sitename'));
				}
			} ?></a>
			
			<div class="nav-collapse pull-right navbar-search phoca-topsearch"><jdoc:include type="modules" name="position-0" /></div>
			
			<div class="nav-collapse pull-right phoca-topmenu">
				<div class="subnav - phoca-subnav"><jdoc:include type="modules" name="position-1" style="phocaTopMenu" /></div>
			</div>
		</div>
	</div>
</div>

	
<?php if ($this->countModules('position-26')) { ?>
<div class="slideshow-box">
	<div class="container">	
		<div class="span12">
			<div class="phoca-slideshow"><jdoc:include type="modules" name="position-26"  /></div>
		</div>
	</div>
</div>
<?php } ?>

<?php if ($this->countModules('position-2')) { ?>
<div class="container">	
	<div class="span12">
		<div id="breadcrumbs phoca-breadcrumbs"><jdoc:include type="modules" name="position-2" /></div>
	</div>
</div>
<?php } ?>

<div class="phoca-body container">
	<div class="row">
		<?php if ($dL) { ?>
		<div class="span3">
			<jdoc:include type="modules" name="position-7" style="phocaBasic" headerLevel="3" />
			<jdoc:include type="modules" name="position-4" style="phocaBasic" headerLevel="3" />
			<jdoc:include type="modules" name="position-5" style="phocaDivision" headerLevel="2" />
		</div>
		<?php } ?>
		
		<div class="span<?php echo $c; ?>">
			<?php if ($this->countModules('position-12')) { ?>
			<div id="phoca-top"><jdoc:include type="modules" name="position-12" /></div>
			<?php } ?>
			<jdoc:include type="message" />
			<jdoc:include type="component" />
			<div class="phoca-hr">&nbsp;</div>
			<div class="row">
				<div class="span<?php echo $d19; ?>"><jdoc:include type="modules" name="position-19" style="phocaDivision" headerlevel="3" /></div>
				<div class="span<?php echo $d20; ?>"><jdoc:include type="modules" name="position-20" style="phocaDivision" headerlevel="3" /></div>
				<div class="span<?php echo $d21; ?>"><jdoc:include type="modules" name="position-21" style="phocaDivision" headerlevel="3" /></div>
			</div>
			<?php if ($d19 || $d20 || $d21) { ?>
				<div>&nbsp;</div>
			<?php } ?>
		</div>
		
		<?php if ($dR) { ?>
		<div class="span3">
			<jdoc:include type="modules" name="position-6" style="phocaBasic"  headerLevel="3"/>
			<jdoc:include type="modules" name="position-8" style="phocaBasic"  headerLevel="3"  />
			<jdoc:include type="modules" name="position-3" style="phocaDivision"  headerLevel="3"  />
		</div>
		<?php } ?>
	</div>
</div>

<div id="phoca-bottom">
	<div class="container">
		<div class="row">
			<div class="span<?php echo $b9; ?>"><jdoc:include type="modules" name="position-9" style="phocaDivision" headerlevel="3" /></div>
			<div class="span<?php echo $b10; ?>"><jdoc:include type="modules" name="position-10" style="phocaDivision" headerlevel="3" /></div>
			<div class="span<?php echo $b11; ?>"><jdoc:include type="modules" name="position-11" style="phocaDivision" headerlevel="3" /></div>
		</div>
		<?php if ($b9 || $b10 || $b11) { ?>
				<div class="phoca-hrg">&nbsp;</div>
		<?php } ?>
		
		<?php if ($this->countModules('position-14')) { ?>
			<div class="span12">
				<div class="phoca-footer-top"><jdoc:include type="modules" name="position-14" /></div>
			</div>
		<?php } ?>
		<div id="phoca-footer"><?php include_once('templates.php'); ?></div>
	</div>
</div>
<jdoc:include type="modules" name="debug" style="none" />
</body>
</html>