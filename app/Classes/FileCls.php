<?php
namespace App\Classes;

use App\Directory;
use Storage;
use App\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
class FileCls {

	public static function ImageValidator($file){

	    // Build the input for validation
	    $fileArray = array('image' => $file);

	    // Tell the validator that this file should be an image
	    $rules = array(
	      'image' => 'mimes:jpeg,jpg,png,gif'
	    );

	    // Now pass the input and rules into the validator
	    $validator = Validator::make($fileArray, $rules);

		return $validator;
	}

	public static function ChangeProfilePicture($user, $profilePicture){
		if(!self::ImageValidator($profilePicture)->fails()){



			$oldPicture = File::find($user->profile_picture_id);


			$path = "public/{$user->id}";
			$fileName = Storage::putFile($path, $profilePicture);
			$fileName = str_replace($path.'/', '', $fileName);

			$file = new File();
			$file->name = pathinfo($profilePicture->getClientOriginalName(), PATHINFO_FILENAME);
			$file->private_name = pathinfo($fileName, PATHINFO_FILENAME);
			$file->extension = pathinfo($fileName, PATHINFO_EXTENSION);
			$file->description = 'Profile picture from '. date('d-m-Y');
			$file->is_crypted = 0;
			$file->save();

			$user->profile_picture_id = $file->id;
			$user->save();

			if($oldPicture->id != 1){
				$oldPicture->delete();
				$path = "public/{$user->id}/{$oldPicture->private_name}.{$oldPicture->extension}";
				Storage::delete($path);
			}

		}
	}
}