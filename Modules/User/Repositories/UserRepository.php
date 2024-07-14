<?php
namespace Modules\User\Repositories;

use Modules\User\Entities\User;
use Modules\Doctor\Entities\Doctor;
use Modules\Patient\Entities\Patient;
use Modules\Pharmacist\Entities\Pharmacist;
use Modules\Receptionist\Entities\Receptionist;
use Modules\Patient\Repositories\PatientRepository;


class UserRepository
{
    private $patientRepository;
    public function __construct(PatientRepository $patienRepository) {
        $this->patientRepository = $patienRepository;
    }

    public function createUser($data)
    {
        return User::create($data);
    }

    public function getUserData($userId)
    {
        $user = User::find($userId);
        if (!$user) {
            return null;
        }

        $name = null;
        $phone = null;
        $address = null;
        $email = $user->email;
        $role = $user->role;
        $imageData = null;
        if ($user && $user->img_url) {
            $imagePath = storage_path('app/public/uploads/' . basename($user->img_url));
            if (file_exists($imagePath)) {
                $imageData = base64_encode(file_get_contents($imagePath));
            }else{
                $imageData = "No DATA!";
            }
        }
        $image = $imageData;

        switch ($user->role) {
            case 'patient':
                $patient = $this->patientRepository->singleByUserId($user->id);
                if ($patient) {
                    $name = $patient->name;
                    $phone = $patient->phone;
                    $address = $patient->address;
                }
                break;

                case 'admin':
                        $name = 'admin';

                    break;


            case 'doctor':
                $doctor = Doctor::where('user_id', $user->id)->first();
                if ($doctor) {
                    $name = $doctor->name;
                    $phone = $doctor->phone;
                    $address = $doctor->address;
                }
                break;

            case 'pharmacist':
                $pharmacist = Pharmacist::where('user_id', $user->id)->first();
                if ($pharmacist) {
                    $name = $pharmacist->name;
                    $phone = $pharmacist->phone;
                    $address = $pharmacist->address;
                }
                break;

            case 'receptionist':
                $receptionist = Receptionist::where('user_id', $user->id)->first();
                if ($receptionist) {
                    $name = $receptionist->name;
                    $phone = $receptionist->phone;
                    $address = $receptionist->address;
                }
                break;

            default:
                return null;
        }

        return [
            'name' => $name,
            'phone' => $phone,
            'email' => $email,
            'role' => $role,
            'image' => $image,
            'address' => $address,
        ];
    }
}
