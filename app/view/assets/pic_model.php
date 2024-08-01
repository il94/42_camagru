<div id="pic-model" class="pic">
	<div class="pic-recto">
		<div class="pic-header">
			<div class="pic-header-user-datas">
				<img src="<?php echo $user->avatar; ?>">
				<p><?php echo $user->username; ?></p>
			</div>
			<div class="pic-header-icons">
				<button class="button-icon selectable">
					<?php require ("view/assets/icons/trash.svg"); ?>
				</button>
				<button class="button-icon">
					<?php require ("view/assets/icons/more.svg"); ?>
				</button>
			</div>
		</div>
		<div class="pic-body-recto">
			<video id="video"></video>
			<img id="captured-photo" src="" alt="Captured Photo">
			<canvas id="canvas" width="640" height="480"></canvas>
		</div>
		

		<div class="pic-footer">
			<button class="button-icon selectable">
				<?php require ("view/assets/icons/like.svg") ?>
			</button>
			<button class="button-icon">
				<?php require ("view/assets/icons/comment.svg"); ?>
			</button>
		</div>
	</div>
</div>