<!-- header --><!-- /header -->
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="530">&nbsp;</td>
    <td rowspan="2">&nbsp;</td>
    <td width="290">&nbsp;</td>
  </tr>
  <tr>
    <td width="530" valign="top">
	<!-- leftpane --><form method="get">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="25">&nbsp;</td>
        <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td valign="top"><h1>[Search Users {7755}] </h1>
                    <p>[Trying to find someone that shares your interests  or matches what you&rsquo;re searching for?&nbsp;  Use the following options below to help narrow your search, and provide  you with the best possible results. {7760}]</p><!-- breadcrumbs -->
<!-- /breadcrumbs --></td>
                  <td align="right" valign="top"><img src="theme/default/images/icons/headers/search_users.gif" alt="[Calendar {350}]" width="100" height="100" /></td>
                </tr>
              </table>          </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="2">&nbsp;</td>
      </tr>
      <tr>
        <td height="1" colspan="3" bgcolor="#E5E9EC"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="1" /></td>
      </tr>
      <tr>
        <td height="8" colspan="3"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="8" /></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="2">
		<ZONE searchResultsHeader enabled><strong>[Your search produced {results.countTotal} result(s) {7765}]</strong></ZONE searchResultsHeader enabled>
		<ZONE searchResultsHeader noResult><strong>[Your search produced no result {7770}]</strong></ZONE searchResultsHeader noResult>
		<ZONE searchResultsHeader disabled>[Please fill in your search criteria below {7775}]		</ZONE searchResultsHeader disabled>		</td>
      </tr>
      <tr>
        <td height="8" colspan="3"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="8" /></td>
      </tr>
      <tr>
        <td colspan="3" background="theme/default/images/frame/block_border_top.gif" bgcolor="#AEC5FD"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="14" /></td>
      </tr>
      <tr>
        <td bgcolor="#DCE6FF">&nbsp;</td>
        <td colspan="2" bgcolor="#DCE6FF">&nbsp;</td>
      </tr>
      <tr>
        <td bgcolor="#DCE6FF">&nbsp;</td>
        <td colspan="2" bgcolor="#DCE6FF"><div class="tabber">
          
              <div class="tabbertab">
                <h2>[Search {300}]</h2>
				<table width="100%" border="0" cellspacing="3" cellpadding="0">
                  <tr>
                    <td><input type="hidden" name="L" value="search.users" />
                    <input name="query" type="text" id="query" class="fullwidth" /></td>
                    <td><select name="gender" id="gender">
                      <option value="">Any gender</option>
                      <LOOP genderOptionDropdown>
                        <option value="{gender.option}">{gender.option}</option>
                      </LOOP genderOptionDropdown>
                    </select></td>
                  </tr>
                  <tr>
                    <td colspan="2" valign="top">
					<label><input name="pattern" type="radio" value="or" checked="checked" /> [At least one word {165}] </label>
					<label><input name="pattern" type="radio" value="and" /> [All the words {170}]</label> 
					<label><input name="pattern" type="radio" value="all" /> [As a phrase {175}] </label>					</td>
                    </tr>
                  <tr>
                    <td width="50%" valign="top">&nbsp;</td>
                    <td valign="top">&nbsp;</td>
                  </tr>
                  <tr>
                    <td valign="top"><strong>[Only show {177}]</strong><br>
                      <p>
                        <label><input name="picture" type="checkbox" value="1" /> [Users with a picture {660}] </label>
                        <label><br>
                        <input name="online" type="checkbox" id="online" value="1" /> [Online users {665}]</label>
					  </p>                      </td>
                    <td valign="top"><p><strong>[With age between {670}]</strong><br />    
                        <input name="agelow" type="text" id="agelow" size="3" />
                        [and {675}]
                        <input name="agehigh" type="text" id="agehigh" size="3" />
                      [years old {680}] <br />
                      <br />
                      <strong>[Within a range of {685}] <br />
                      </strong><input name="range" type="text" id="range" size="3" />
                      <ZONE distanceLabel miles>[miles {690}]</ZONE distanceLabel miles>
					  <ZONE distanceLabel kilometers>[kilometers {695}]</ZONE distanceLabel kilometers>
                    </p>
                      </td>
                  </tr>
                  <tr>
                    <td valign="top"><p>
                      <input name="Submit" type="submit" id="Submit" value="[Search {300}]" class="submit" />
                    </p>
                      <br></td>
                    <td valign="top">&nbsp;</td>
                  </tr>
                </table>

                <p>&nbsp;</p>
              </div>
			  
			   <div class="tabbertab">
                <h2>[Advanced {700}]</h2>
				<table width="100%" border="0" cellspacing="3" cellpadding="0">

                  <tr>
                    <td width="50%" valign="top"><strong>[Search in {705}]</strong><br>
                      <label><input name="sin[]" type="checkbox" value="username" checked="checked" /> 
                      [Usernames {710}]</label><br/>
                      <label><input name="sin[]" type="checkbox" value="city" checked="checked" /> 
                      [City {715}]</label><br/>
                      <label><input name="sin[]" type="checkbox" value="state" checked="checked" /> 
                      [State {720}]</label><br/>
                      <label><input name="sin[]" type="checkbox" value="country" checked="checked" /> 
                      [Country {725}]</label><br/>
                      <label><input name="sin[]" type="checkbox" value="quote" checked="checked" /> 
                      [User quote {730}]</label><br/>
                      <label><input name="sin[]" type="checkbox" value="header" checked="checked" /> 
                      [User header {735}]</label><br/>
                      <label><input name="sin[]" type="checkbox" value="profile" checked="checked" /> 
                      [Profile data {740}]</label>					</td>
                    <td valign="top"><p><strong>[Order by {220}]</strong><br>
                      <input name="order" type="radio" value="username" checked="checked" />
                        [Username {745}]<br>
                        <input name="order" type="radio" value="last_login" />
                        [Last login {750}]<br>
                        <input name="order" type="radio" value="last_load" />
                        [Online/Offline {755}]<br>
                        <input name="order" type="radio" value="id" />
                        [Registration date {760}]<br>
                        <input name="order" type="radio" value="age" />
                        [Age {765}]<br>
                        <strong>[Direction {225}]</strong>  <br>
                        <input name="direction" type="radio" value="asc" checked />
                        [Ascending {230}]<br>
                        <input name="direction" type="radio" value="desc" /> 
                        [Descending {235}] 
                        <br>
                      <br>
</p>                      </td>
                  </tr>

                  <tr>
                    <td valign="top"><p>
                        <input name="submit" type="submit" id="submit" value="[Search {300}]" class="submit" />
                      </p>
                        <br></td>
                    <td valign="top">&nbsp;</td>
                  </tr>
                </table>
			   </div>
          
        </div></td>
      </tr>
      <tr>
        <td height="2" colspan="3" bgcolor="#DCE6FF"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="2" /></td>
      </tr>
      <tr>
        <td colspan="3" background="theme/default/images/frame/block_border_bottom.gif" bgcolor="#AEC5FD"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="14" /></td>
      </tr>
      <tr>
        <td height="10" colspan="3"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="10" /></td>
      </tr>
      <ZONE searchResultsBlock enabled>
	  <tr>
		<td>&nbsp;</td>
        <td><h1>[Your Search Results {240}] </h1></td>
        <td align="right">[Page {page.thisPage} out of {page.total} {7780}] </td>
      </tr>
      <tr>
        <td height="5"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="5" /></td>
        <td height="5" colspan="2" background="{themePath}/images/frame/greenbar.gif" bgcolor="#C0FF5E"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="5" /></td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="2">
          <LOOP searchResultsLoop>
            <table width="100%" cellpadding="0" cellspacing="3">
              <tr>
                <td colspan="2" valign="top" style="padding-top:5px;" width="80"><a href="?L=users.profile&id={user.id}"> <img src="system/image.php?file={user.mainpicture}" alt="[Picture {150}]" border="0" id="picture" /> </a><br />
                  <a href="?L=users.profile&id={user.id}">{user.username}</a> </td>
                <td width="100%" valign="top"><h4>{user.quote}</h4>
                    <h6>[{user.username}, {user.gender}, {user.age} years old {7785}] </h6>
                    <p>{user.header}...</p>
                    <h6>[Last login: {750}] <img src="{themePath}/images/icons/date.gif" alt="[Date {135}]" width="16" height="16" hspace="2" align="absmiddle" /> {user.lastlogin} </h6></td>
                <td width="20" align="right" valign="middle"><OBJ online> <img src="{themePath}/images/icons/status/online_mini.gif" alt="[Online {425}]" /> </OBJ online>
                  {user.online}</td>
              </tr>
            </table>
          </LOOP searchResultsLoop>		  </td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td colspan="2" align="center">
		
		<ZONE paginationBlock enabled>
		  <ZONE pagination.back disabled>&laquo; [Back {255}]</ZONE pagination.back disabled>
		  <ZONE pagination.back linked><a href="{pagination.back.link}">&laquo; [Back {255}]</a></ZONE pagination.back linked>
		
		  <ZONE pagination.first disabled></ZONE pagination.first disabled>
		  <ZONE pagination.first linked><a href="{pagination.first.link}">1...</a> </ZONE pagination.first linked>
		
		  <OBJ pagination.unlinked.page><strong>{pagination.page.pageNumber}</strong></OBJ pagination.unlinked.page>
		  <OBJ pagination.linked.page> <a href="{pagination.page.link}">{pagination.page.pageNumber}</a> </OBJ pagination.linked.page>
		
		  {pagination.pages}

		  <ZONE pagination.last disabled></ZONE pagination.last disabled>
		  <ZONE pagination.last linked><a href="{pagination.last.link}">...{pagination.last.pageNumber}</a> </ZONE pagination.last linked>

		  <ZONE pagination.next disabled>[Next {260}] &raquo;</ZONE pagination.next disabled>
		  <ZONE pagination.next linked><a href="{pagination.next.link}">[Next {260}] &raquo;</a></ZONE pagination.next linked>
		</ZONE paginationBlock enabled>

		<ZONE paginationBlock disabled>
		</ZONE paginationBlock disabled>
		
		</td>
      </tr>
      </ZONE searchResultsBlock enabled>
    </table>
	</form><!-- /leftpane -->
	</td>
    <td width="290" valign="top"><!-- rightpane --><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><h1>[My Saved Searches {265}] </h1>
          <p>[Make your searching faster and easier by saving your searches for a one click operation. {270}]</p>
		  <br /><br />
          
 		  <ZONE savedSearchesList enabled>
		    <h4>[My saved searches {265}] </h4>
		    <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <LOOP favoriteSearches>
			    <tr>
                  <td><a href="{get}">{name}</a></td>
                  <td align="right"><a href="?L=search.users&rm={key}">Remove</a></td>
                </tr>
			  </LOOP favoriteSearches>
            </table>
		    <br /><br />
		  </ZONE savedSearchesList enabled>
		  
  		  <ZONE savedSearchesList disabled>
		  </ZONE savedSearchesList disabled>
		  
		  <ZONE saveThisSearch enabled>
            <form method="post">
              <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td colspan="2"><h4>[Save this search {7790}] </h4></td>
                </tr>
                <tr>
                  <td>[Name your search: {7795}]                    </td>
                  <td><input name="name" type="text" id="name" maxlength="25" /></td>
                </tr>
                <tr>
                  <td colspan="2"><input name="SaveSearch" type="submit" id="SaveSearch" value="[Save {640}]" class="submit" /></td>
                </tr>
              </table>
            </form>
 		  </ZONE saveThisSearch enabled>

          </td>
        <td width="25">&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="5" colspan="2" background="{themePath}/images/frame/greenbar.gif"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="5" /></td>
      </tr>
      <tr>
        <td height="8" colspan="2"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="8" /></td>
      </tr>
      <tr>
        <td><h2>[Other Search Options {7800}] </h2>
          <p><a href="?L=search.online">[Online Users {7805}]</a><br />
            <a href="?L=blogs.search">[Search in Blogs {7810}]</a> </p>
          <p>&nbsp;</p>
          <p><a href="?L=search.match">[Match me! {7815}]</a></p></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td><p>&nbsp;</p>          </td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td height="8" colspan="2"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="8" /></td>
      </tr>
      <tr>
        <td height="1" colspan="2" bgcolor="#E5E9EC"><img src="theme/default/images/frame/spacer.gif" alt="Spacer" height="1" /></td>
      </tr>
    </table><!-- /rightpane --></td>
  </tr>
</table>
<br>
<br>
<OBJ resultsBlockGridMode>
  <div style="float:left;">
    <a href="?L=users.profile&amp;id={id}">
      <img src="system/image.php?file={mainpicture}" alt="[Picture {150}]" hspace="2" border="0" id="picture" />
    </a>
    <br />
    <a href="?L=users.profile&amp;id={id}">{username}</a>
</div>
  <br />
</OBJ resultsBlockGridMode><!-- footer --><!-- /footer -->