<!-- DESKTOP NAVBAR -->

<?php require("view/assets/desktop_navbar.php") ?>

<!-- PAGE -->

<div class="page">
	<div id="create">

		<!-- ANGLE POPUP -->

		<?php require("view/assets/angle_popup.php") ?>

		<!-- CREATOR -->

		<div id="creator">

			<?php require("view/assets/pic_model.php") ?>

			<div id="preview-bar"></div>

			<div id="sticker-bar">
				<img class="sticker" src="view/assets/s_dog.png" />
				<img class="sticker" src="view/assets/s_cat.png" />
				<img class="sticker" src="view/assets/s_panda.png" />
				<img class="sticker" src="view/assets/s_pikachu.png" />
				<img class="sticker" src="view/assets/s_mario.png" />
				<img class="sticker" src="view/assets/s_rolling_stones.png" />
				<img class="sticker" src="view/assets/s_rock.png" />
				<img class="sticker" src="view/assets/s_risitas.png" />
			</div>

			<div id="preview-sticker-bar">
				<div id="preview-sticker">
					<div id="stickers">
						<img class="sticker" src="view/assets/s_dog.png" />
						<img class="sticker" src="view/assets/s_cat.png" />
						<img class="sticker" src="view/assets/s_panda.png" />
						<img class="sticker" src="view/assets/s_pikachu.png" />
						<img class="sticker" src="view/assets/s_mario.png" />
						<img class="sticker" src="view/assets/s_rolling_stones.png" />
						<img class="sticker" src="view/assets/s_rock.png" />
						<img class="sticker" src="view/assets/s_risitas.png" />
					</div>
					<div id="previews"></div>
				</div>
				<div id="preview-sticker-bar-buttons">
					<button id="stickers-button">
						Stickers
					</button>
					<button id="previews-button">
						Previews
					</button>
				</div>
			</div>
			
			<div id="action-bar">
				<button id="cancel-button" class="button-icon window-button">
					Cancel
				</button>

				<button id="onoff-button" class="button-icon create-medium-button">
					<?php require ("view/assets/icons/onoff.svg"); ?>
				</button>

				<button class="camera-button button-icon create-big-button">
					<?php require ("view/assets/icons/camera.svg"); ?>
				</button>

				<button id="gallery-button" class="button-icon create-medium-button">
					<?php require ("view/assets/icons/gallery.svg"); ?>
				</button>

				<button id="publish-button" class="button-icon window-button">
					Publish
				</button>
			</div>

			<div id="action-bar-2">
				<button id="cancel-button" class="button-icon create-little-button">
					<?php require ("view/assets/icons/return.svg"); ?>
				</button>

				<button id="onoff-button" class="button-icon create-medium-button">
					<?php require ("view/assets/icons/onoff.svg"); ?>
				</button>

				<button class="camera-button button-icon create-big-button">
					<?php require ("view/assets/icons/camera.svg"); ?>
				</button>

				<button id="gallery-button" class="button-icon create-medium-button">
					<?php require ("view/assets/icons/gallery.svg"); ?>
				</button>

				<button id="publish-button" class="button-icon create-little-button">
					<?php require ("view/assets/icons/arrow_up.svg"); ?>
				</button>
			</div>

			<div id="mobile-action-bar">
				<button id="gallery-button" class="button-icon create-medium-button">
					<?php require ("view/assets/icons/gallery.svg"); ?>
				</button>

				<button class="camera-button button-icon create-big-button">
					<?php require ("view/assets/icons/camera.svg"); ?>
				</button>

				<button id="publish-button" class="button-icon create-medium-button">
					<?php require ("view/assets/icons/arrow_up.svg"); ?>
				</button>
			</div>

		</div>

	</div>
</div>