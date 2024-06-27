<?php
namespace Modules\Medicine\Repositories;

use Modules\Medicine\Entities\Medicine;


class MedicineRepository
{
    protected $model;

    public function __construct(Medicine $medicine)
    {
        $this->model = $medicine;
    }
}
