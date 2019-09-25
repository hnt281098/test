<?php
class UploadComponent extends Component {

	public $directory = null;

	/**
	 * [uploadFile description]
	 * @param  [type] $fileUpload [description]
	 * @return [type]             [description]
	 */
	public function uploadFile($fileUpload){
		if(isset($fileUpload) && $fileUpload['size'] > 0 ){
			$image_file_formats = image_file_formats();

			$directory = WWW_ROOT .'img'.DS.'blog';
			$fileUpload = explode(".", $fileUpload['name']);

			if(count($fileUpload) < 1 || !in_array($fileUpload[count($fileUpload) - 1],$image_file_formats)) {
				$this->Session->setFlash('Dữ liệu đã được cập nhật!, File hình ảnh không đúng định dạng.','flash/error');
				$this->render('edit');
				return ;
			}

			$fileUpload = _rename($fileUpload[0]).".". strtolower($fileUpload[count($fileUpload) - 1]);
			//Move upload
			if(move_uploaded_file($fileUpload['tmp_name'], $directory.DS. $fileUpload)){
				$data['Blog']['image_thumbnail'] = 'img/blog/'. strtolower($fileUpload);
			}
		}else{
			unset($data['Blog']['image_thumbnail']);
		}
	}

	/**
	 * [uploadBlogImage description]
	 * @param  [type] $blogImage [description]
	 * @param  [type] $directory [description]
	 * @return [type]            [description]
	 */
	public function uploadBlogImage($blogImage = null, $directory = null){

		if(empty($blogImage['size']) || (int) $blogImage['size'] == 0){
			return false;
		}

		$imageFileFormats = imageFileFormats();
		$fileUpload = explode(".", $blogImage['name']);

		if(count($fileUpload) < 1 || !in_array(strtolower($fileUpload[count($fileUpload) - 1]) ,$imageFileFormats)) {
			return false;
		}
		$extFile = $fileUpload[count($fileUpload) - 1];
		
		unset($fileUpload[count($fileUpload) - 1]);
		$fileUpload = str_replace(" ","_",_rename(implode("_",$fileUpload))).".". strtolower($extFile);

		//Move upload
		if(!move_uploaded_file($blogImage['tmp_name'], $directory.DS. $fileUpload)){
			return false;
		}

		return  $fileUpload;
	}

	/**
	 * [uploadFile description]
	 * @param  [type] $fileUpload [description]
	 * @param  [type] $directory  [description]
	 * @return [type]             [description]
	 */
	public function uploadFileWriting($file = null, $directory = null){
		if(empty($file['size']) || (int) $file['size'] == 0){
			return false;
		}

		$fileFormatted = fileUpload();
		$fileUpload = explode(".", strtolower($file['name']));

		if(count($fileUpload) < 1 || !in_array(strtolower($fileUpload[count($fileUpload) - 1]) ,$fileFormatted)) {
			return false;
		}
		$fileUpload = _rename($fileUpload[0]).".". strtolower($fileUpload[count($fileUpload) - 1]);
		//Move upload
		if(!move_uploaded_file($file['tmp_name'], $directory.DS. $fileUpload)){
			return false;
		}
		return  '/files/writing/'.$fileUpload;

	}
}

?>