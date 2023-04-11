<?php
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

global $APPLICATION;

if(empty($arResult))
	return "";

$strReturn = '';
$strReturn .= '<div class="breadcrumb--black"><nav aria-label="Breadcrumb" class="breadcrumb"><ul>';

$itemSize = count($arResult);
for($index = 0; $index < $itemSize; $index++)
{
	$title = htmlspecialcharsex($arResult[$index]["TITLE"]);

	if($arResult[$index]["LINK"] <> "" && $index != $itemSize-1 && $arResult[$index]["LINK"] ==='/')
	{
		$strReturn .= '
			<li>
				<a class="breadcrumb__link" href="'.$arResult[$index]["LINK"].'">
					<svg
                        width="15"
                        height="15"
                        viewBox="0 0 15 15"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                                d="M7.49969 3.94104L2.15001 8.35128C2.15001 8.35751 2.14845 8.36666 2.14532 8.37914C2.14225 8.39153 2.14062 8.40052 2.14062 8.40691V12.8727C2.14062 13.034 2.19958 13.1737 2.31745 13.2914C2.43528 13.4091 2.57482 13.4684 2.7361 13.4684H6.30868V9.89561H8.69073V13.4685H12.2633C12.4245 13.4685 12.5643 13.4094 12.6819 13.2914C12.7998 13.1739 12.8589 13.034 12.8589 12.8727V8.40691C12.8589 8.38214 12.8556 8.36344 12.8496 8.35128L7.49969 3.94104Z"
                                fill="black"
                        />
                        <path
                                d="M14.8965 7.34643L12.8591 5.65311V1.85708C12.8591 1.7703 12.8312 1.69894 12.7752 1.64308C12.7197 1.58729 12.6483 1.5594 12.5613 1.5594H10.775C10.6881 1.5594 10.6168 1.58729 10.5609 1.64308C10.5051 1.69894 10.4773 1.77034 10.4773 1.85708V3.67133L8.20717 1.77327C8.00891 1.61199 7.77317 1.53137 7.50021 1.53137C7.22729 1.53137 6.99159 1.61199 6.79313 1.77327L0.103386 7.34643C0.0413718 7.39596 0.00738296 7.46264 0.00106097 7.54639C-0.00522844 7.63007 0.0164423 7.70317 0.0661384 7.76515L0.642971 8.45366C0.692667 8.50945 0.757712 8.54357 0.838366 8.55605C0.912829 8.56231 0.987292 8.54054 1.06175 8.49094L7.50002 3.1224L13.9383 8.49091C13.9881 8.53418 14.0531 8.55579 14.1337 8.55579H14.1617C14.2422 8.54354 14.3071 8.50919 14.3571 8.45353L14.934 7.76512C14.9836 7.703 15.0053 7.63004 14.9989 7.54626C14.9925 7.46274 14.9584 7.39606 14.8965 7.34643Z"
                                fill="black"
                        />
                    </svg>
				</a>
			</li>';
	} elseif ($arResult[$index]["LINK"] <> "" && $index != $itemSize-1 && $arResult[$index]["LINK"] !== '/') {
        $strReturn .= '
			<li>
				<a class="breadcrumb__link" href="'.$arResult[$index]["LINK"].'">
					'.$title.'
				</a>
			</li>';
    } else {
		$strReturn .= '
			<li class="breadcrumb__page">
				<span>'.$title.'</span>
			</li>';
	}
}

$strReturn .= '</ul></nav></div>';

return $strReturn;
