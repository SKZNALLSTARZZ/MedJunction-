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

    public function getUserName($userId)
    {
        $user = User::find($userId);
        if (!$user) {
            return null;
        }

        switch ($user->role) {
            case 'patient':
                $patient = $this->patientRepository->singleByUserId($user->id);
                return $patient ? $patient->name : null;

            case 'doctor':
                $doctor = Doctor::where('user_id', $user->id)->first();
                return $doctor ? $doctor->name : null;

            case 'pharmacist':
                $pharmacist = Pharmacist::where('user_id', $user->id)->first();
                return $pharmacist ? $pharmacist->name : null;

            case 'receptionist':
                $receptionist = Receptionist::where('user_id', $user->id)->first();
                return $receptionist ? $receptionist->name : null;

            default:
                return null;
        }
    }
}
