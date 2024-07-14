<?php
namespace Modules\Receptionist\Repositories;

use Modules\Receptionist\Entities\Receptionist;


class  ReceptionistRepository{

    public function all(){
        $receptionists = Receptionist::with('user:id,email,img_url')->get();

        foreach ($receptionists as $receptionist) {
            $imageData = null;
            if ($receptionist->user && $receptionist->user->img_url) {
                $imagePath = storage_path('app/public/uploads/' . basename($receptionist->user->img_url));
                if (file_exists($imagePath)) {
                    $imageData = base64_encode(file_get_contents($imagePath));
                }else{
                    $imageData = "No DATA!";
                }
            }
            $receptionist->img_data = $imageData;
        }

        return $receptionists;
    }
}
