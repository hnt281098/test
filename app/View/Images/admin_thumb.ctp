<link rel="stylesheet" href="/css/style.css">
</br/>
<div role="tabpanel">
  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Upload Image</a></li>
    <li role="presentation" class="active"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Collection </a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div role="tabpanel" class="tab-pane" id="home">
    	<br/>
		<div class="container-fluid">
			<div class="row" >
				<div id="dropbox">
					<span class="message">Drop images here to upload. <br /><i>(they will only be visible to you)</i></span>
				</div>
			</div>
		</div>
    </div>
    <div role="tabpanel" class="tab-pane active" id="profile">
    	<br/>
		<?php if(!empty( $imageUploaded)){
			$totalCols = count($imageUploaded);
			$col = 0;
			for($i = 0; $i< $totalCols; $i++){
				if($col == 0){
					echo '<div class="row">';
				}
				echo  '<div class="col-md-2 thumb">'. $imageUploaded[$i].'</div>';

				if($col==3){
					$col = 0;
					echo '</div>';
				}else{
					$col++;
				}
			}
		}?>
    </div>
  </div>
</div>

<link rel="stylesheet" href="/css/dropbox.css">
<!-- Including the HTML5 Uploader plugin -->
<script src="/js/jquery.filedrop.js"></script>
<!-- The main script file -->
<script src="/js/filedrop.js"></script>
