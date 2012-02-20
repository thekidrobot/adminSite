<div id="page-top">

	<!-- start logo -->
	<div id="logo">
	<a href=""><img src="images/shared/logo.png" width="156" height="40" alt="" /></a>
	</div>
	<!-- end logo -->
	
	<!--  start top-search -->
	<form action="search.php" method="post">
	<div id="top-search">
		<table border="0" cellpadding="0" cellspacing="0">
		<tr>
		<td>
			<input type="text" name="search_text" value="Search" onblur="if (this.value=='') { this.value='Search'; }" onfocus="if (this.value=='Search') { this.value=''; }" class="top-search-inp" />
		</td>
		<td>
		<select name="search_term" class="styledselect">
			<option value="live"><?=_("Live Videos")?></option>
			<option value="vod"><?=_("VOD Videos")?></option>
			<option value="epg"><?=_("EPG")?></option>
		</select> 
		</td>
		<td>
		<input type="image" src="images/shared/top_search_btn.gif"  />
		</td>
		</tr>
		</table>
	</div>
	</form>
 	<!--  end top-search -->
 	<div class="clear"></div>

</div>
