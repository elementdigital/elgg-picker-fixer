<?php
/**
 * Picker Fixer
 */
?>

.friends-picker .friends-picker-navigation {
	
}
.friends-picker-container .panel {
	display: none;
}

.friends-picker-main-wrapper {
    margin-bottom: 0px;
	width: 100%;
}

.friends-picker-wrapper {
    margin: 0;
    padding: 0;
    position: relative;
    width: 0px;
}

.friends-picker-navigation {
    margin: 10px 0;
    padding: 0 0 10px;
    border-bottom: 1px solid #DCDCDC;
}

.friends-picker-navigation ul {
    list-style: none;
    padding-left: 0;
    width: 100%;
	font-family: Arial Black,Arial Bold,Gadget,sans-serif; 
}

.friends-picker-navigation ul::after {
    visibility: hidden;
    display: block;
    font-size: 0;
    content: " ";
    clear: both;
    height: 0;
}

.friends-picker-navigation ul li {
    float: left;
    margin: 0;
    background: #FFF;
}

.friends-picker-navigation a {
	font-size: 0.8em;
    line-height: 1.15em;
	font-weight: bold;
	text-align: center;
	background: #FFF;
	color: #999;
	text-decoration: none;
	display: inline-block;
	padding: 4px 5px;
	width: auto;
	border-radius: 3px;
	vertical-align: middle;
	font-family: Arial Black,Arial Bold,Gadget,sans-serif;
	height: auto;
	margin: 0 auto;
}
.friends-picker-navigation .tab1 a,
.friends-picker-navigation .tab5 a,
.friends-picker-navigation .tab6 a,
.friends-picker-navigation .tab7 a,
.friends-picker-navigation .tab17 a,
.friends-picker-navigation .tab19 a,
.friends-picker-navigation .tab20 a,
.friends-picker-navigation .tab1 a,
.friends-picker-navigation .tab1 a {
	/*width: 19px;*/
}
.friends-picker-navigation .tab13 a,
.friends-picker-navigation .tab23 a {
	/*width: 21px;*/
}

.friends-picker-navigation li a.current {
    background: #5097CF;
    color: #FFF !important;
}

.friends-picker-container h3 {
    font-size: 32px !important;
    line-height: 0px;
    text-align: left;
    margin: 10px 0 20px !important;
    color: #999 !important;
    background: none !important;
    padding: 0 !important;
}
.friends-picker-container .panel {
    height: auto;
}
.friends-picker .friends-picker-container .panel .wrapper {
    margin: 0;
    padding: 10px 10px 10px 10px;
    min-height: 230px;
}

.friends-picker-navigation-l, .friends-picker-navigation-r {
    position: absolute;
    top: 8px;
    text-indent: -9000em;
	background-image: url("<?= elgg_get_simplecache_url("friendspicker.png"); ?>");
	background-repeat: no-repeat; 
	background-position: left top;
	background-size: 57px 60px;
}
.friends-picker-navigation-l:hover, .friends-picker-navigation-r:hover{
	background-image: url("<?= elgg_get_simplecache_url("friendspicker.png"); ?>");
	background-repeat: no-repeat;
	background-position: left top;
	background-size: 57px 60px;
}

.friends-picker-navigation-l a, .friends-picker-navigation-r a {
    display: block;
    height: 26px;
    width: 24px;
}

.friends-picker-navigation-l {
    right: 36px;
    z-index: 1;
}

.friends-picker-navigation-r {
    right: 4px;
    z-index: 1;
}

.friends-picker-navigation-l {
   
}
.friends-picker-navigation-l:hover {
    background-position: left -26px;
}
.friends-picker-navigation-r {
    background-position: -36px top;
}
.friends-picker-navigation-r:hover {
    background-position: -36px -26px;
}

.collectionlist{
	
}
.collectionlist::after {
    visibility: hidden;
    display: block;
    font-size: 0;
    content: " ";
    clear: both;
    height: 0;
}
.collectionlist .item{
	float: left;
	width: 33.3%;
}
.collectionlist .item .inner {
    margin: 4px;
    box-shadow: 0 0 0 1px rgba(0, 0, 0, 0.1);
    background-color: rgba(255, 255, 255, 0.2);
    padding: 8px;
}
.collectionlist .item .inner::after {
    visibility: hidden;
    display: block;
    font-size: 0;
    content: " ";
    clear: both;
    height: 0;
}
.collectionlist .item .userinfo {
    float: none;
    padding-left: 30px;
    padding-top: 3px;
}
.collectionlist .item .elgg-avatar.elgg-avatar-tiny {
    float: left;
}
.collectionlist .item .userinfo p {
    text-overflow: ellipsis;
    white-space: nowrap;
    overflow: hidden;
    font-size: 0.8em;
	line-height: 1.8em;
    font-weight: bold;
}

/*views*/
.friendspicker-savebuttons .elgg-button-submit, .friendspicker-savebuttons .elgg-button-cancel {
    margin: 5px 0px 5px 5px;
}

/*No Grid*/
.friends-picker-wrapper .item {
    width: 33.3%;
    float: left;
}

.friends-picker-wrapper .item .inner {
    margin: 4px;
	box-shadow: 0 0 0 1px rgba(0, 0, 0, 0.1);
	background-color: rgba(255, 255, 255, 0.2);
	padding: 8px;
}
.friends-picker-wrapper .item .inner:hover {
	box-shadow: 0 0 0 1px rgba(0, 0, 0, 0.1);
	background-color: rgba(255, 255, 255, 0.6);
}
.friends-picker-wrapper .item .inner::after {
    visibility: hidden;
    display: block;
    font-size: 0;
    content: " ";
    clear: both;
    height: 0;
}
.friends-picker-wrapper .item .cbox {
    float: left;
	padding: 3px 2px 0 0px;
}
.friends-picker-wrapper .item .elgg-avatar.elgg-avatar-tiny {
    float: left;
}

.friends-picker-wrapper .item .userinfo{
	float: none;
	padding-left: 48px;
	padding-top: 3px;
}

.friends-picker-wrapper .item .userinfo p{
	text-overflow: ellipsis;
	white-space: nowrap;
	overflow: hidden;
	font-size: 0.8em;
	line-height: 1.8em;
	font-weight: bold;
}

@media (max-width: 680px) {
	.friends-picker-wrapper .item,
	.collectionlist .item	{
		width: 50%;
		float: left;
	}
}
@media (max-width: 420px) {
	.friends-picker-wrapper .item,
	.collectionlist .item{
		width: 100%;
		float: none;
	}
}










