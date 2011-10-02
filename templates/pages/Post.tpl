{% for Post in Posts %}
<div class="message" id="Post{{ Post.ID }}">
	<div class="messageInner messageLeft dividers container-3">
		<div class="messageSidebar">
			<div class="messageAuthor">
				<p class="userName">
					<a title="Benutzerprofil von »{$UserName}« aufrufen" href="index.php?page=User&userID={{ Post.UserID }}">
						<span>{{ Post.UserID }}</span>
					</a>
				</p>
				<p class="userTitle smallFont">RANG</p>
			</div>
			<div class="userAvatar">
				<a title="Benutzerprofil von »{{ Post.UserID }}« aufrufen" href="index.php?page=User&userID={{ Post.UserID }}">
					Avatar
				</a>
			</div>
			<div class="userCredits">
				<p>
					<a href="#">Beiträge: BEITRÄGE</a>
				</p>
			</div>
			<div class="userMessenger">
				<ul>
					<li><a href="index.php?form=PMNew&userID={{ Post.UserID }}">Nachricht Senden</a></li>
				</ul>
			</div>
		</div>
		<div class="messageContent">
			<div class="messageContentInner color-1">
				<div class="messageHeader">
					<p class="messageCount">
						<a class="messageNumber" title="Permalink zum bla. Beitrag" href="index.php?page=Topic&TopicID={{ Post.ThreadID }}#Postbla">PostNum</a>
					</p>
				</div>
				<h2 class="messageTitle"><span style="color: #333333">{{ Post.Subject }}</span></h2>
				<div class="messageBody">
					<div id="postText{{ Post.ID }}">
						{{ Post.Message }}
					</div>
				</div>
				<div class="signature" style="margin-top: 15px;">
				SIGNATUR!!!
				</div>
				<div class="messageFooterRight">
					<div class="smallButtons">
						<ul id="postButtons">
							<li>
								<a title="Melden" href="index.php?form=PostReport&amp;postID=39908">
									<span>Melden</span>
								</a>
							</li>
						</div>
					</div>
			</div>
		</div>
		<div style="clear:both;"></div>
	</div>
</div>
{% endfor %}