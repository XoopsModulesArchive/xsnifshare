<?php
/*
 * admin/index.php edited on Nov 14, 2005
 *
 * GNU released
 * 
 */
require_once(dirname(__FILE__) . '/../../../mainfile.php');
include '../../../include/cp_header.php';
global $xoopsDB, $xoopsTpl;
xoops_cp_header();
$xsnif_name = explode("/", $_SERVER['SCRIPT_NAME']);
$xsnif_db = $xsnif_name[2] ."_data";
$check = $xoopsDB->queryF( "SELECT COUNT(*) FROM ".$xoopsDB->prefix($xsnif_db)."" ); /* >>limit<< is just to make it faster in case the db is huge */
if (!$check){
$xoopsDB->queryF("CREATE TABLE ".$xoopsDB->prefix($xsnif_db)."(
id INT NOT NULL AUTO_INCREMENT, 
PRIMARY KEY(id),
  head_text text NOT NULL,
  hidden_files_wildcards text NOT NULL,
  allow_sub_dirs text NOT NULL,
  allow_php_downloads text NOT NULL,
  use_auto_thumbnails text NOT NULL,
  cache_thumbnails text NOT NULL,
  external_stylesheet text NOT NULL,
  use_paging text NOT NULL,
  thumbnail_height text NOT NULL,
  thumbnail_width text NOT NULL,
  use_back_for_dir_up text NOT NULL,
  display_columns text NOT NULL,
  banned_uploads text NOT NULL,
  user_space text NOT NULL,
  admin_activation text NOT NULL,
  truncate_length text NOT NULL)");
}
if ($_REQUEST['update'] === "true"){
$xoopsDB->queryF( "DELETE FROM ".$xoopsDB->prefix($xsnif_db)."" );
$xoopsDB->queryF( "INSERT INTO ".$xoopsDB->prefix($xsnif_db)." SET head_text='".$_REQUEST['head_text']."',hidden_files_wildcards='".$_REQUEST['hidden_files_wildcards']."',allow_sub_dirs='".$_REQUEST['allow_sub_dirs']."',allow_php_downloads='".$_REQUEST['allow_php_downloads']."',use_auto_thumbnails='".$_REQUEST['use_auto_thumbnails']."',cache_thumbnails='".$_REQUEST['cache_thumbnails']."',external_stylesheet='".$_REQUEST['external_stylesheet']."',use_paging='".$_REQUEST['use_paging']."',thumbnail_height='".$_REQUEST['thumbnail_height']."',thumbnail_width='".$_REQUEST['thumbnail_width']."',use_back_for_dir_up='".$_REQUEST['use_back_for_dir_up']."',display_columns='".$_REQUEST['display_columns']."',banned_uploads='".$_REQUEST['banned_uploads']."',user_space='".$_REQUEST['user_space']."',admin_activation='".$_REQUEST['admin_activation']."',truncate_length='".$_REQUEST['truncate_length']."'" );
echo "Xoops-SNIF settings have been updated.";
} else {
$result = $xoopsDB->queryF( "SELECT * FROM ".$xoopsDB->prefix($xsnif_db)."");
while($row = mysql_fetch_array($result))
  {
  $head_text = $row['head_text'];
  $hidden_files_wildcards = $row['hidden_files_wildcards'];
  $allow_sub_dirs = $row['allow_sub_dirs'];
  $allow_php_downloads = $row['allow_php_downloads'];
  $use_auto_thumbnails = $row['use_auto_thumbnails'];
  $cache_thumbnails = $row['cache_thumbnails'];
  $external_stylesheet = $row['external_stylesheet'];
  $use_paging = $row['use_paging'];
  $thumbnail_height = $row['thumbnail_height'];
  $thumbnail_width = $row['thumbnail_width'];
  $use_back_for_dir_up = $row['use_back_for_dir_up'];
  $display_columns = $row['display_columns'];
  $truncate_length = $row['truncate_length'];
  $banned_uploads = $row['banned_uploads'];
  $user_space = $row['user_space'];
  $admin_activation = $row['admin_activation'];
  }
?>
<style type="text/css">
<!--
.style1 {
	color: #FF0000;
	font-weight: bold;
}
.style2 {color: #FF0000}
-->
</style>

<form name="form1" method="post" action="index.php?update=true">
<table width="100%" border="0">
  <tr>
    <td bgcolor="#CCCCCC"><div align="right"><strong>X.S.N.I.F. Share </strong></div></td>
    <td bgcolor="#CCCCCC"> <strong>Settings</strong></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC">&nbsp;</td>
    <td bgcolor="#CCCCCC">&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Require Admin Activation Per User:</strong> </td>
    <td><label>
<?php
if ($admin_activation === "1"){
$aatrue = "checked=\"checked\"";
} else {
$aafalse = "checked=\"checked\"";
}
?>
<input type="radio" name="admin_activation" value="1" <?php echo $aatrue; ?>/>
True</label>
<label>
<input type="radio" name="admin_activation" value="0" <?php echo $aafalse; ?> />
False</label></td>
  </tr>
  <tr>
    <td>If set to true you must active upload access per user by clicking the UNLOCK USER link when browsing the users folder as admin on the upload files page. </td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC">&nbsp;</td>
    <td bgcolor="#CCCCCC">&nbsp;</td>
  </tr>
  <tr>
    <td width="44%"><strong>Header Text:</strong></td>
    <td width="56%">
      <input type="text" name="head_text" value="<?php echo $head_text; ?> : " />  </td>
  </tr>
  <tr>
    <td>Specify the text for the header area directly above the file listing. </td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC">&nbsp;</td>
    <td bgcolor="#CCCCCC">&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Hidden File Wildcards: </strong></td>
    <td><input name="hidden_files_wildcards" type="text" value="<?php echo $hidden_files_wildcards; ?>" /></td>
  </tr>
  <tr>
    <td><p>Specify which files should be hidden in the file listing using unix/DOS wildcards <br />
        (? and *) separate them with a |  the This is case insensitive. </p>
      <p>Example(hides all png, php and zip files): *.png|*.php|*.zip</p>
      <p>This script, the current directory (.), the description file and the external style sheet will be automatically hidden.<br />
      </p></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC">&nbsp;</td>
    <td bgcolor="#CCCCCC">&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Disallowed Upload Types: </strong></td>
    <td><input name="banned_uploads" type="text" value="<?php echo $banned_uploads; ?>" /></td>
  </tr>
  <tr>
    <td><p>Specify what file extensions can NOT be uploaded, do not use wildcards here just the extension like in the below example.</p>
      <p>Example: php|php3|asp|aspx</p>      </td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC">&nbsp;</td>
    <td bgcolor="#CCCCCC">&nbsp;</td>
  </tr>
  <tr>
    <td><strong>User Disk Space Limit: </strong></td>
    <td><input name="user_space" type="text" value="<?php echo $user_space; ?>" /></td>
  </tr>
  
  <tr>
    <td>Set amount of space to give to each registered user in megabytes. </td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC">&nbsp;</td>
    <td bgcolor="#CCCCCC">&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Show Subdirectories:</strong></td>
    <td>
<label>
<?php
if ($allow_sub_dirs === "1"){
$asbtrue = "checked=\"checked\"";
} else {
$asbfalse = "checked=\"checked\"";
}
?>
<input type="radio" name="allow_sub_dirs" value="1" <?php echo $asbtrue; ?>/>
True</label>
<label>
<input type="radio" name="allow_sub_dirs" value="0" <?php echo $asbfalse; ?> />
False</label></td>
  </tr>
  <tr>
    <td><label>  Show sub directories and let the user change to them.<br />
It is impossible to go above the directory this script is in.<br />
<br />
Some server configurations will result in this being forced to true, if you have a subdirectory that needs to be hidden just place a blank .htaccess file in it and it will be ignored. <br />
    </label></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC">&nbsp;</td>
    <td bgcolor="#CCCCCC">&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Allow Download of PHP Files:</strong></td>
    <td>
<label>
<?php
if ($allow_php_downloads === "1"){
$apdtrue = "checked=\"checked\"";
} else {
$apdfalse = "checked=\"checked\"";
}
?>
<input type="radio" name="allow_php_downloads" value="1" <?php echo $apdtrue; ?> />
True</label>
<label>
<input type="radio" name="allow_php_downloads" value="0" <?php echo $apdfalse; ?> />
False</label></td>
  </tr>
  <tr>
    <td><p><span class="style1">WARNING TRUE = POSSIBLE SECURITY RISK !!!!!!</span><br />
      Allow the users to download .php files. This will expose the full contents of the downloaded files (including any database or ftp usernames and passwords used in them). Be careful with this!<br />
          <br />
        This only makes sense if you are using SNIF to share PHP scripts with others <br />
        </p>      </td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC">&nbsp;</td>
    <td bgcolor="#CCCCCC">&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Use Auto Thumbnails: </strong></td>
    <td>
  <label>
  <?php
if ($use_auto_thumbnails === "1"){
$uattrue = "checked=\"checked\"";
} else {
$uatfalse = "checked=\"checked\"";
}
?>
  <input type="radio" name="use_auto_thumbnails" value="1" <?php echo $uattrue; ?>/>
    True</label>
  <label>
  <input type="radio" name="use_auto_thumbnails" value="0" <?php echo $uatfalse; ?>/>
    False</label>
</p></td>
  </tr>
  <tr>
    <td>Automatically generate and display thumbnails for image files. This
  feature requires GDlib 2.0+ and for the description column to be set in the Display Columns field. </td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC">&nbsp;</td>
    <td bgcolor="#CCCCCC">&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Cache Thumbnails: </strong></td>
    <td>
  <label>
  <?php
if ($cache_thumbnails === "1"){
$cttrue = "checked=\"checked\"";
} else {
$ctfalse = "checked=\"checked\"";
}
?>
  <input type="radio" name="cache_thumbnails" value="1" <?php echo $cttrue; ?>/>
    True</label>
  <label>
<input type="radio" name="cache_thumbnails" value="0" <?php echo $ctfalse; ?>/>    
False</label></td>
  </tr>
  <tr>
    <td><p>Cache any thumbnails created for later use in a subdirectory called
      .snifthumbs This subdirectory is created in every directory and contains
      the cached thumbnails of its parent directory. This directory is hidden
      by the default settings of snif. If an image file is updated, so is the 
      thumbnail. If an image is removed though, the thumbnail has to be removed
      manually.</p>
      <p><span class="style2"><strong>Note</strong>:</span> this setting does not work on all server configurations if you experience broken thumbnail images after setting this to true you will need to change it to false and delete the .snifthumbs directories manually.</p>
      <p>If this is false and you have a large amount of images in the directory i suggest setting the <strong>Use Paging</strong> setting accordingly to avoid consuming to many server resources when creating thumbnails. </p></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC">&nbsp;</td>
    <td bgcolor="#CCCCCC">&nbsp;</td>
  </tr>
  <tr>
    <td><strong>External Style Sheet: </strong></td>
    <td><label>
      <input type="text" name="external_stylesheet" value="<?php echo $external_stylesheet; ?>" />
   </label></td>
  </tr>
  <tr>
    <td><p>Use an external style sheet file for setting the colors of the snif output.<br />
      Leave empty to use the built-in style sheet.</p>
      <label></label></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC">&nbsp;</td>
    <td bgcolor="#CCCCCC">&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Use Paging: </strong></td>
    <td>
        <label>
        <select name="use_paging">
          <option value="<?php echo $use_paging; ?>">currently set to <?php echo $use_paging; ?></option>
          <option value="0">0</option>
          <option value="5">5</option>
          <option value="10">10</option>
          <option value="20">20</option>
          <option value="40">40</option>
          <option value="60">60</option>
          <option value="80">80</option>
          <option value="100">100</option>
          <option value="200">200</option>
          <option value="300">300</option>
          <option value="400">400</option>
          <option value="500">500</option>
          <option value="600">600</option>
          <option value="700">700</option>
          <option value="800">800</option>
          <option value="900">900</option>
          <option value="1000">1000</option>
        </select>
        </label>
      </p></td>
  </tr>
  <tr>
    <td>Sets the
       number of files displayed per page. Set to 0 to disable multiple pages.</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC">&nbsp;</td>
    <td bgcolor="#CCCCCC">&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Thumbnail Height: </strong></td>
    <td><input type="text" name="thumbnail_height" value="<?php echo $thumbnail_height; ?>" /></td>
  </tr>
  <tr>
    <td><strong>Thumbnail Width: </strong></td>
    <td><input type="text" name="thumbnail_width" value="<?php echo $thumbnail_width; ?>" /></td>
  </tr>
  <tr>
    <td><p>Sets the maximum height and width of thumbnails. Images with one dimension bigger than 
      the respective value will be downsized.</p>
      <p> Smaller images will stay unchanged. Defaults to 50 height and 150 width. </p>
      <label></label></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC">&nbsp;</td>
    <td bgcolor="#CCCCCC">&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Use &quot;Back&quot; For Directory Up Link: </strong></td>
    <td>
      <label>
<?php
if ($use_back_for_dir_up === "1"){
$ubfdutrue = "checked=\"checked\"";
} else {
$ubfdufalse = "checked=\"checked\"";
}
?>
<input type="radio" name="use_back_for_dir_up" value="1" <?php echo $ubfdutrue; ?>/>
True</label>
<label>
<input type="radio" name="use_back_for_dir_up" value="0" <?php echo $ubfdufalse; ?>/>
False</label></td>
  </tr>
  <tr>
    <td>Uses a &quot;Back&quot; instead of &quot;..&quot; to go up in directories.</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC">&nbsp;</td>
    <td bgcolor="#CCCCCC">&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Display Columns: </strong></td>
    <td>
          <input name="display_columns" type="text" value="<?php echo $display_columns; ?>" />
      </p></td>
  </tr>
  <tr>
    <td><p>Determines which columns to display and in which order.
      To hide a column, delete it from this array. To rearrange columns,
      change their order in this array. </p>
      <p> Example: download|icon|name|type|size|date|description|delete</p>
      <p><em><strong>Possible values are:</strong></em><br />
          <span class="style2"><strong>download</strong></span> a link to download instead of open files <br />
          <span class="style2"><strong>icon</strong></span> a file icon according to its extension <br />
          <span class="style2"><strong>name</strong></span> the filename <br />
          <span class="style2"><strong>type</strong></span> the file extension <br />
          <span class="style2"><strong>size</strong></span> the file size <br />
          <span class="style2"><strong>date</strong></span> the file's modified date <br />
          <span class="style2"><strong>description</strong></span> image thumbnails or the file's description, if any <br />
        <span class="style2"><strong>cvsversion</strong></span> the file's CVS version tag<br />
        <span class="style2"><strong>delete</strong></span> adds a delete button dont forget this :P <br />
        Separate the values with  |</p>      </td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC">&nbsp;</td>
    <td bgcolor="#CCCCCC">&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Truncate  Names: </strong></td>
    <td>
  <label>
  <input name="truncate_length" type="text" id="truncate_length" value="<?php echo $truncate_length; ?>" />
  </label></td>
  </tr>
  <tr>
    <td>Specifies how long file and directory names are to be truncated. Defaults
   to 30, set to 0 to turn off truncation.</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td bgcolor="#CCCCCC">&nbsp;</td>
    <td bgcolor="#CCCCCC">&nbsp;</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td><div align="right">
      <input type="submit" name="Submit" value="Submit" />
    </div></td>
  </tr>
</table>
</form>
<?php
}
xoops_cp_footer();
?>
