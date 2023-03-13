{"version":3,"sources":["ui.hint.js"],"names":["BX","namespace","UI","Hint","isHovered","cursorPosition","element","elementRect","getBoundingClientRect","xMarginLeft","x","xMarginRight","width","yMarginLeft","y","yMarginRight","height","Manager","parameters","this","id","Date","attributeName","classNameIcon","className","attributeInitName","content","type","isDomNode","Error","popup","PopupWindow","popupParameters","initByClassName","ready","bind","prototype","attributeHtmlName","attributeInteractivityName","classNameContent","classNamePopup","classNamePopupInteractivity","ownerDocument","anchorNode","createInstance","nodes","document","getElementsByClassName","convert","nodeListToArray","forEach","initNode","init","context","body","querySelectorAll","initOwnerDocument","e","createNode","text","node","createElement","setAttribute","getAttribute","isNotEmptyString","hasAttribute","util","htmlspecialchars","addClass","innerHTML","iconNode","appendChild","show","hide","html","zIndex","darkMode","animationOptions","animation","angle","offset","offsetWidth","Dom","getPopupContainer","removeClass","setBindElement","timer","setTimeout","close"],"mappings":"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","file":"ui.hint.map.js"}