<div class="message">
	<div class="messageInner messageLeft dividers container-3">
		<div class="messageSidebar">
			<div class="messageAuthor">
				<p class="userName">
					<a title="Benutzerprofil von »{$UserName}« aufrufen" href="index.php?page=User&userID={$UserID}">
						<span>{$UserName}</span>
					</a>
				</p>
				<p class="userTitle smallFont">RANG</p>
			</div>
			<div class="userAvatar">
				<a title="Benutzerprofil von »{$UserName}« aufrufen" href="index.php?page=User&userID={$UserID}">
					{$Avatar}
				</a>
			</div>
			<div class="userCredits">
				<p>
					<a href="#">Beiträge: BEITRÄGE</a>
				</p>
			</div>
			<div class="userMessenger">
				<ul>
					<li><a href="index.php?form=PMNew&userID={$UserID}"><img title="Nachricht senden" alt="Nachricht senden" src="empty"></a></li>
				</ul>
			</div>
		</div>
		<div class="messageContent">
			<div class="messageContentInner color-1">
				<div class="messageHeader">
					<p class="messageCount">
						<a class="messageNumber" title="Permalink zum {$PostNum}. Beitrag" href="index.php?page=Topic&TopicID={$PostNum}">{$PostNum}</a>
					</p>
					<div class="containerIcon">
						<img alt="" src="icon/postM.png">
					</div>
					<div class="containerContent">
						<p class="smallFont light"></p>
					</div>
				</div>
				<h3 class="messageTitle"><span></span></h3>
				<div class="messageBody">
					<div id="postText{$ID}">
						{$Text}
					</div>
				</div>
				<div class="signature">
				SIGNATUR!!!
				</div>
				<div class="messageFooterRight">
					<div class="smallButtons">
						<ul id="postButtons39908">
							<li class="extraButton">
								<a title="Zum Seitenanfang" href="#top">
									<img alt="Zum Seitenanfang" src="wcf/icon/upS.png">
								</a>
							</li>
							<li class="options">
								<a title="Zitieren" href="javascript:void(0);" id="postQuote39908">
									<img alt="" src="wcf/icon/messageQuoteOptionsS.png">
									<span>Zitieren</span>
								</a>
							</li>
							<li>
								<a title="Melden" href="index.php?form=PostReport&amp;postID=39908">
									<img alt="" src="icon/postReportS.png">
									<span>Melden</span>
								</a>
							</li>
						</div>
					</div>
				<hr>
			</div>
		</div>
		<div style="clear:both;"></div>
	</div>
</div>