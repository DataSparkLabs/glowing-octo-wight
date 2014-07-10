<?php
/*
Plugin Name: Redirect List
Plugin URI: http://memberfind.me/redirect-list-wordpress/
Description: Redirect List
Version: 1.4
Author: SourceFound
Author URI: http://memberfind.me
License: GPL2
*/

/*  Copyright 2013  SOURCEFOUND INC.  (email : info@sourcefound.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

if (is_admin()) {
	add_action('admin_menu','sf_red_admin_menu');
	add_action('admin_init','sf_red_admin_init');
}

function sf_red_admin_init() {
	register_setting('sf_red_admin_group','sf_red','sf_red_validate');
}

function sf_red_admin_menu() {
	add_options_page('Redirect Settings','Redirects','manage_options','sf_red_options','sf_red_options');
}

function sf_red_options() {
	if (!current_user_can('manage_options'))
		wp_die(__('You do not have sufficient permissions to access this page.'));
	echo '<div class="wrap"><h2>Redirect List</h2>'
		.'<form action="options.php" method="post">';
	settings_fields("sf_red_admin_group");
	$red=get_option('sf_red');
	echo '<div id="redirect-list">';
	for ($i=0;isset($red[$i]);$i++)
		echo '<div data-idx="'.$i.'"><input type="text" name="sf_red['.$i.'][0]" value="'.$red[$i][0].'" style="width:300px;"><span> &raquo; </span><input type="text" name="sf_red['.$i.'][1]" value="'.$red[$i][1].'" style="width:300px;"><select name="sf_red['.$i.'][2]"><option value="1"'.($red[$i][2]=='1'?' selected="selected"':'').'>301 permanent</option><option value="2"'.($red[$i][2]=='2'?' selected="selected"':'').'>302 temporary</option><select></div>';
	echo '<div data-idx="'.$i.'"><input type="text" name="sf_red['.$i.'][0]" onchange="if (this.value) sf_red_add();" placeholder="url-to-match" style="width:300px;"><span> &raquo; </span><input type="text" name="sf_red['.$i.'][1]" placeholder="destination-url" style="width:300px;"><select name="sf_red['.$i.'][2]"><option value="1">301 permanent</option><option value="2">302 temporary</option><select></div>'
		.'</div>'
		.'<p class="submit"><input type="submit" name="submit" id="submit" class="button-primary" value="Save Changes"></p>'
		.'</form>'
		.'<div>Redirect when there are no GET query specified: "url-to-match"<br>Ignore any GET parameters: "url-to-match?"<br>GET parameter should exist but value does not matter: "url-to-match?get-parameter"<br>GET parameter should exist and value must match: "url-to-match?get-parameter=value-to-match"<br>Empty url to delete.</div>'
		.'<p class="submit"><button class="button-secondary" onclick="sf_red_exp()">Export CSV</button> <button class="button-secondary" onclick="sf_red_inp()">Import CSV</button></p>'
		.'<textarea id="SFredtxt" style="display:none;width:100%;height:200px"></textarea>'
		.'<script>'
		.'function sf_red_add(){'
			.'var i,n,l=document.getElementById("redirect-list");'
			.'if (!l.lastChild.childNodes[0].value) return l.lastChild;'
			.'l.appendChild(n=l.lastChild.cloneNode(true));'
			.'n.setAttribute("data-idx",i=parseInt(n.getAttribute("data-idx"))+1);'
			.'n.childNodes[0].name="sf_red["+i+"][0]";n.childNodes[0].value="";'
			.'n.childNodes[2].name="sf_red["+i+"][1]";n.childNodes[2].value="";'
			.'n.childNodes[3].name="sf_red["+i+"][2]";'
			.'return n;'
		.'}'
		.'function sf_red_exp(){'
			.'var t=[],n,l=document.getElementById("redirect-list");'
			.'for(n=l.firstChild;n;n=n.nextSibling) if (n.childNodes[0].value)'
				.'t.push(\'"\'+n.childNodes[0].value+\'","\'+n.childNodes[2].value+\'",30\'+n.childNodes[3].value);'
			.'document.getElementById("SFredtxt").innerHTML=t.join("\n");'
			.'document.getElementById("SFredtxt").style.display="";'
			.'document.getElementById("SFredtxt").select();'
		.'}'
		.'function sf_red_inp(){'
			.'if(document.getElementById("SFredtxt").style.display){document.getElementById("SFredtxt").style.display="";return;}'
			.'var t=document.getElementById("SFredtxt").value.split("\n"),i,n,l=document.getElementById("redirect-list");'
			.'for(;l.childNodes.length>1;)l.removeChild(l.lastChild);'
			.'l.firstChild.childNodes[0].value=l.firstChild.childNodes[2].value="";'
			.'for(i=0,n=l.firstChild;i<t.length;i++) if (t[i]) {'
				.'t[i]=t[i].split(",");if (t[i].length<3) continue;'
				.'n.childNodes[0].value=t[i][0].substr(0,1)==\'"\'?t[i][0].slice(1,-1):t[i][0];'
				.'n.childNodes[2].value=t[i][1].substr(0,1)==\'"\'?t[i][1].slice(1,-1):t[i][1];'
				.'n.childNodes[3].value=t[i][2].substr(0,1)==\'"\'?t[i][2].substr(3,1):t[i][2].substr(2,1);'
				.'n=sf_red_add();'
			.'}'
		.'}'
		.'</script></div>';
}

function sf_red_validate($in) {
	$out=array();
	$url=get_site_url();
	for ($i=0;isset($in[$i]);$i++) if ($in[$i][0]) {
		$tmp=strpos($in[$i][0],substr(strstr($url,'//'),2));
		if ($tmp!==false) $in[$i][0]=substr($in[$i][0],$tmp+strlen(strstr($url,'//'))-2);
		if (substr($in[$i][0],0,1)!='/') $in[$i][0]='/'.$in[$i][0];
		$tmp=strpos($in[$i][1],'//');
		if ($tmp===false) $in[$i][1]=$url.(strpos($in[$i][1],'/')===0?'':'/').$in[$i][1];
		else if ($tmp===0) $in[$i][1]='http:'.$in[$i][1];
		if ($in[$i][1]==$url.'/') $in[$i][1]=$url;
		$out[]=$in[$i];
	}
	return $out;
}

function sf_red_after_setup_theme() {
	$red=get_option('sf_red');
	if (!empty($_SERVER['REQUEST_URI']))
		$uri=$_SERVER['REQUEST_URI'];
	else if (!empty($_SERVER['HTTP_X_ORIGINAL_URL'])) // IIS mod-rewrite
		$uri=$_SERVER['HTTP_X_ORIGINAL_URL'];
	else if (!empty($_SERVER['HTTP_X_REWRITE_URL'])) // IIS isapi_rewrite
		$uri=$_SERVER['HTTP_X_REWRITE_URL'];
	else {
		if (isset($_SERVER['PATH_INFO'])&&isset($_SERVER['SCRIPT_NAME']))
			$uri=$_SERVER['SCRIPT_NAME'].($_SERVER['PATH_INFO']==$_SERVER['SCRIPT_NAME']?'':$_SERVER['PATH_INFO']);
		else
			$uri=$_SERVER['PHP_SELF'];
		if (!empty($_SERVER['QUERY_STRING']))
			$uri.='?'.$_SERVER['QUERY_STRING'];
	}
	if (strpos($uri,'/index.php')===0) $uri=substr($uri,10);
	if (substr($uri,0,1)!='/') $uri='/'.$uri;
	$qry=strpos($uri,'?');
	$url=($qry!==false?substr($uri,0,$qry):$uri);
	for ($i=0;isset($red[$i]);$i++) {
		$tmp=explode('?',$red[$i][0]);
		if (strpos($url,$tmp[0])===0&&(!($x=substr($url,strlen($tmp[0])))||$x=='/')) {
			$exe=true;
			if (count($tmp)>1) {
				$tmp=explode('&',$tmp[1]);
				foreach ($tmp as $x) if ($x) {
					$x=explode('=',$x);
					if (!isset($_GET[$x[0]])||(count($x)>1&&urldecode($_GET[$x[0]])!=urldecode($x[1]))) $exe=false;
				}
			} else if ($qry!==false)
				$exe=false;
			if ($exe) {
				wp_redirect($red[$i][1],300+intval($red[$i][2])); 
				exit;
			}
		}
	}
}
add_action('after_setup_theme','sf_red_after_setup_theme');

?>