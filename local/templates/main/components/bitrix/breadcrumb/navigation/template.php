<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

/**
 * @global CMain $APPLICATION
 */

global $APPLICATION;

//delayed function must return a string
if(empty($arResult) || count($arResult) == "1")
	return "";

$strReturn = '';

//we can't use $APPLICATION->SetAdditionalCSS() here because we are inside the buffered function GetNavChain()
//$css = $APPLICATION->GetCSSArray();
//if(!is_array($css) || !in_array("/bitrix/css/main/font-awesome.css", $css))
//{
//	$strReturn .= '<link href="'.CUtil::GetAdditionalFileURL("/bitrix/css/main/font-awesome.css").'" type="text/css" rel="stylesheet" />'."\n";
//}

$strReturn .= ' <div class="breadcrumbs">
                    <div class="breadcrumbs__container">
                        <div class="wrapper header__wrapper">
                            <div class="breadcrumbs__content">
                                <ul class="breadcrumbs__items" itemscope itemtype="http://schema.org/BreadcrumbList">';

$itemSize = count($arResult);
for($index = 0; $index < $itemSize; $index++)
{
	$title = htmlspecialcharsex($arResult[$index]["TITLE"]);
	$arrow = ($index > 0? '<i class="bx-breadcrumb-item-angle fa fa-angle-right"></i>' : '');

	if($arResult[$index]["LINK"] <> "" && $index != $itemSize-1)
	{
		$strReturn .=  '<li class="breadcrumbs__item" itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                            <a class="breadcrumbs__link" href="'.$arResult[$index]["LINK"].'" itemprop="item">
                                <span class="breadcrumbs__text" itemprop="name">'.$title.'</span>
                                <span class="breadcrumbs__icon">
                                    <svg width="7" height="11" viewBox="0 0 7 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M1 9.5L5 5.5L1 1.5" stroke-width="2" stroke-linecap="round" />
                                    </svg>
                                </span>
                            </a>
                            <meta itemprop="position" content="'.($index + 1).'" />
                        </li>';
	}
	else
	{
		$strReturn .= ' <li class="breadcrumbs__item" itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
                            <a itemprop="item">
                                <span class="breadcrumbs__text" itemprop="name">'.$title.'</span>
                            </a>
                            <meta itemprop="position" content="'.($index + 1).'" />
                        </li>';
	}
}

$strReturn .= ' </ul>
                </div>
                </div>
                </div>
                </div>';

return $strReturn;
