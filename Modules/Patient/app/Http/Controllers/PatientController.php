<?php

namespace Modules\Patient\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Services\TwilioService;
use App\Services\PasswordService;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Modules\Patient\Entities\Patient;
use Modules\User\Repositories\UserRepository;
use Modules\Patient\resources\PatientResource;
use Modules\Patient\Repositories\PatientRepository;
use Modules\Patient\Http\Requests\PatientAddRequest;
use Modules\Appointment\resources\AppointmentResource;
use Modules\Patient\Http\Requests\PatientUpdateRequest;
use Modules\Consultation\resources\ConsultationResource;
use Modules\Appointment\Repositories\AppointmentRepository;
use Modules\Consultation\Repositories\ConsultationRepository;
use Modules\Consultation\resources\ConsultationSummaryResource;



class PatientController extends Controller
{
    protected $patientRepository;
    protected $consultationRepository;
    protected $userRepository;
    protected $appointmentRepository;
    public function __construct(PatientRepository $patienRepository, UserRepository $userRepository, ConsultationRepository $consultationRepository, AppointmentRepository $appointmentRepository) {
        $this->patientRepository = $patienRepository;
        $this->userRepository = $userRepository;
        $this->consultationRepository = $consultationRepository;
        $this->appointmentRepository = $appointmentRepository;
    }

    public function index()
    {
        try {
            $patients = $this->patientRepository->all();
            return response()->json($patients, Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function count()
    {
        try {
            $daily = $this->patientRepository->dailyCount();
            $monthly = $this->patientRepository->monthlyCount();
            $yearly = $this->patientRepository->yearlyCount();

            $res = [
                'daily' => $daily,
                'monthly' => $monthly,
                'yearly' => $yearly
            ];
            return response()->json($res, Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
    public function countAllPatient()
    {
        try {
            $count = $this->patientRepository->totalPatientCount();

            return response()->json($count, Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show(int $id)
    {
        try {
            $patient = $this->patientRepository->Single($id);

            if (!$patient) {
                return response()->json(['error' => 'Resource not found'], Response::HTTP_NOT_FOUND);
            }

            return response()->json(new PatientResource($patient), Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(PatientAddRequest $request)
    {
        try {
            $password = PasswordService::generateRandomPassword(8);
            $userData = [
                'role' => 'patient',
                'img_url' => $request->input('img_url'),
                'email' => $request->input('email'),
                'password' => bcrypt($password),
            ];
            $user = $this->userRepository->createUser($userData);

            $patient = new Patient();
            $patient->fill($request->validated());
            $patient->user_id = $user->id;
            $patient->save();

            TwilioService::sendMessage($patient->phone, "Your password is: $password");

            return response()->json($patient, Response::HTTP_CREATED);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMEssage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(PatientUpdateRequest $request, int $id)
    {
        try {
            $patient = Patient::find($id);

            if (!$patient) {
                return response()->json(['error' => 'Resource not found'], Response::HTTP_NOT_FOUND);
            }
            $patient->fill($request->validated());
            $patient->save();

            $patient->update($request->validated());
            return response()->json($patient, Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMEssage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy(int $id)
    {
        try {
            $patient = Patient::find($id);

            if (!$patient) {
                return response()->json(['error' => 'Resource not found'], Response::HTTP_NOT_FOUND);
            }

            $patient->delete();

            return response()->json(['message' => 'Resource deleted successfully'], Response::HTTP_OK);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function getConsultations(Request $request, int $patientId)
    {
        $consultations = $this->consultationRepository->getConsultationsForPatient($patientId);

        return ConsultationResource::collection($consultations);
    }

    public function getAppointments(Request $request, int $patientId)
    {
        $appointments = $this->appointmentRepository->getPatientAppointments($patientId);

        return response()->json(AppointmentResource::collection($appointments), Response::HTTP_OK);
    }

    public function getFivePatients(Request $request)
    {
        $consultations = $this->patientRepository->getLastFivePatients();

        return response()->json($consultations);
    }
}
